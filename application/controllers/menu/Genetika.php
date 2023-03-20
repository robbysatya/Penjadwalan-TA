<?php
class Genetika extends CI_Controller
{
	private $populasi;
	private $crossOver;
	private $mutasi;

	public $RowsProposal = [];
	public $RowsHari = [];
	public $RowsJam = [];
	public $RowsDospeng1 = [];
	public $RowsDospeng2 = [];
	public $RowsDosbim1 = [];
	public $RowsDosbim2 = [];

	public $data1 = [];
	public $data2 = [];
	public $data3 = [];
	public $data4 = [];
	public $data5 = [];

	public $fitness = [];

	public $data_individu = array(array(array(array(array()))));

	public function __construct($params)
	{
		parent::__construct();
		if (!$this->session->userdata('email')) {
			redirect('auth');
		} else if ($this->session->userdata('role_id') == null) {
			redirect('auth');
		} else if ($this->session->userdata('role_id') != '1') {
			redirect('auth/blocked');
		}
		$this->load->model('jadwal_model');

		$this->RowsProposal = $params['kode_sp'];
		$this->RowsHari = $params['kode_hari'];
		$this->RowsJam = $params['kode_jam'];
		$this->RowsDospeng1 = $params['id_dosen'];
		$this->RowsDospeng2 = $params['id_dosen'];
		$this->RowsDosbim1 = $params['dosbim_1'];
		$this->RowsDosbim2 = $params['dosbim_2'];

		$this->populasi = intval($params['populasi']);
		$this->crossOver = intval($params['crossOver']);
		$this->mutasi = $params['mutasi'];
	}

	public function AmbilData()
	{
		$dataSempro = $this->jadwal_model->getDataSempro();
		$no = 0;
		foreach ($dataSempro->result() as $data) {
			$this->kode_sp[$no] = intval($data->kode_sp);
			$this->dosbim_1[$no] = intval($data->dosbim_1);
			$this->dosbim_2[$no] = intval($data->dosbim_2);
			$no++;
		}

		// Ambil Data Hari
		$dataHari = $this->jadwal_model->getJadwaHariDosen();
		$no = 0;
		foreach ($dataHari->result() as $data) {
			$this->hari[$no] = intval($data->kode_hari);
			$no++;
		}

		// Ambil Data Jam
		$dataJam = $this->jadwal_model->getJadwalJamDosen();
		$no = 0;
		foreach ($dataJam->result() as $data) {
			$this->jam[$no] = intval($data->kode_jam);
			$no++;
		}

		// Ambil Data Dospeng 1
		$dataDospeng1 = $this->jadwal_model->getJadwalDospeng1();
		$no = 0;
		foreach ($dataDospeng1->result() as $data) {
			$this->dospeng_1[$no] = intval($data->id);
			$no++;
		}

		// Ambil Data Dospeng 2
		$dataDospeng2 = $this->jadwal_model->getJadwalDospeng2();
		$no = 0;
		foreach ($dataDospeng2->result() as $data) {
			$this->dospeng_2[$no] = intval($data->id);
			$no++;
		}
	}


	// INISIALISASI
	public function Inisialisasi()
	{
		$RowsProposal =  count($this->kode_sp);
		$RowsHari =  count($this->hari);
		$RowsJam =  count($this->jam);
		$RowsDospeng1 =  count($this->dospeng_1);
		$RowsDospeng2 =  count($this->dospeng_2);

		for ($i = 0; $i < $this->populasi; $i++) {
			for ($j = 0; $j < $RowsProposal; $j++) {
				$this->data_individu[$i][$j][0] = $this->kode_sp[$j];
				$this->data_individu[$i][$j][5] = $this->dosbim_1[$j];
				$this->data_individu[$i][$j][6] = $this->dosbim_2[$j];
				$this->data2 = mt_rand(0, $RowsHari);
				$this->data3 = mt_rand(0, $RowsJam);
				$this->data4 = mt_rand(0, $RowsDospeng1);
				$this->data5 = mt_rand(0, $RowsDospeng2);

				if ($this->data2 == 0) {
					$this->data_individu[$i][$j][1] = $this->data2 + 1;
				} else {
					$this->data_individu[$i][$j][1] = $this->data2;
				}

				if ($this->data3 == 0) {
					$this->data_individu[$i][$j][2] = $this->data3 + 1;
				} else {
					$this->data_individu[$i][$j][2] = $this->data3;
				}

				if ($this->data4 == 0) {
					$this->data_individu[$i][$j][3] = $this->data4 + 1;
				} else {
					$this->data_individu[$i][$j][3] = $this->data4;
				}

				if ($this->data5 == 0) {
					$this->data_individu[$i][$j][4] = $this->data5 + 1;
				} else {
					$this->data_individu[$i][$j][4] = $this->data5;
				}

				// $a = $this->data_individu[$i][0];
				$bb = $this->data_individu[$i][$j][1];
				$cc = $this->data_individu[$i][$j][2];

				// $d = $this->data_individu[$i][3];
				// $e = $this->data_individu[$i][4];

				if ($bb >= $RowsHari) {
					$b = mt_rand(1, $RowsHari);
				} else {
					$b = $this->data_individu[$i][$j][1];
				}

				if ($cc >= $RowsJam) {
					$c = mt_rand(1, $RowsJam);
				} else {
					$c = $this->data_individu[$i][$j][2];
				}
			}
		}
	}

	private function CekFitness($indv)
	{

		// $penalty = 0;
		$penalty_jam = 0;
		$penalty_hari = 0;
		$penalty_dospeng = 0;

		$RowsProposal =  count($this->kode_sp);

		for ($i = 0; $i < $RowsProposal; $i++) {
			$hari_a = intval($this->data_individu[$i][1]);
			$jam_a = intval($this->data_individu[$i][2]);
			$dospeng_a = intval($this->data_individu[$i][3]);
			$dosbim_a = intval($this->data_individu[$i][5]);

			for ($j = 0; $j < $RowsProposal; $j++) {
				$hari_b = intval($this->data_individu[$j][1]);
				$jam_b = intval($this->data_individu[$j][2]);
				$dospeng_b = intval($this->data_individu[$j][4]);
				$dosbim_b = intval($this->data_individu[$j][6]);

				if ($i == $j) {
					continue;
				}
				if ($jam_a == $jam_b) {
					$penalty_jam += 1;
				}
				if ($hari_a == $hari_b) {
					$penalty_hari += 1;
				}
				if ($hari_a == 5) {
					$penalty_jam += 1;
				}
				if ($hari_b == 5) {
					$penalty_jam += 1;
				}

				if ($dospeng_a == $dospeng_b) {
					$penalty_dospeng += 1;
				}
				if ($dosbim_a == $dospeng_a) {
					$penalty_dospeng += 1;
				}
				if ($dosbim_b == $dospeng_a) {
					$penalty_dospeng += 1;
				}
				if ($dosbim_a == $dospeng_b) {
					$penalty_dospeng += 1;
				}
				if ($dosbim_b == $dospeng_b) {
					$penalty_dospeng += 1;
				}

				// end loop j
			}
			$fitness = floatval(1 / (1 + $penalty_dospeng + $penalty_jam + $penalty_hari));
			// end loop k
		}
	}

	// HITUNG FITNESS
	public function HitungFitness()
	{
		$fitness = [];
		for ($indv = 0; $indv < $this->populasi; $indv++) {
			$fitness[$indv] = $this->CekFitness($indv);
		}
		return $fitness;
	}


	// SELEKSI
	public function Seleksi($fitness)
	{
		$jumlah = 0;
		$rank   = [];


		for ($i = 0; $i < $this->populasi; $i++) {

			//proses ranking berdasarkan nilai fitness
			$rank[$i] = 1;
			for ($j = 0; $j < $this->populasi; $j++) {

				$fitnessA = floatval($fitness[$i]);
				$fitnessB = floatval($fitness[$j]);

				if ($fitnessA > $fitnessB) $rank[$i] += 1;
			}

			$jumlah += $rank[$i];
		}

		$jumlahRank = count($rank);
		for ($i = 0; $i < $this->populasi; $i++) {
			//proses seleksi berdasarkan ranking yang telah dibuat
			//int nexRandom = random.Next(1, jumlah);
			//random = new Random(nexRandom);
			$target = mt_rand(0, $jumlah - 1);

			$cek    = 0;
			for ($j = 0; $j < $jumlahRank; $j++) {
				$cek += $rank[$j];
				if (intval($cek) >= intval($target)) {
					$this->induk[$i] = $j;
					break;
				}
			}
		}
	}

	// CROSSOVER
	public function StartCrossOver()
	{
		$individuBaru = [[[]]];
		$RowsProposal = count($this->kode_sp);

		for ($i = 0; $i < $this->populasi; $i += 2) {
			$b = 0;
			$cr = mt_rand(0, mt_getrandmax() - 1) / mt_getrandmax();
			if (floatval($cr) < floatval($this->crossOver)) {
				//ketika nilai random kurang dari nilai probabilitas pertukaran
				//maka jadwal mengalami prtukaran

				$a = mt_rand(0, $RowsProposal - 2);
				while ($b <= $a) {
					$b = mt_rand(0, $RowsProposal - 1);
				}

				//penentuan jadwal baru dari awal sampai titik pertama
				for ($j = 0; $j < $a; $j++) {
					for ($k = 0; $k < 4; $k++) {
						$individuBaru[$i][$j][$k]     = $this->data_individu[$this->induk[$i]][$j][$k];
						$individuBaru[$i + 1][$j][$k] = $this->data_individu[$this->induk[$i + 1]][$j][$k];
					}
				}

				// Penentuan jadwal baru dai titik pertama sampai titik kedua
				for ($j = $a; $j < $b; $j++) {
					for ($k = 0; $k < 4; $k++) {
						$individuBaru[$i][$j][$k]     = $this->data_individu[$this->induk[$i + 1]][$j][$k];
						$individuBaru[$i + 1][$j][$k] = $this->data_individu[$this->induk[$i]][$j][$k];
					}
				}

				// Penentuan jadwal baru dari titik kedua sampai akhir
				for ($j = $b; $j < $RowsProposal; $j++) {
					for ($k = 0; $k < 4; $k++) {
						$individuBaru[$i][$j][$k]     = $this->data_individu[$this->induk[$i]][$j][$k];
						$individuBaru[$i + 1][$j][$k] = $this->data_individu[$this->induk[$i + 1]][$j][$k];
					}
				}
			} else {

				// Ketika nilai random lebih dari nilai probabilitas pertukaran, maka jadwal baru sama dengan jadwal terpilih
				for ($j = 0; $j < $RowsProposal; $j++) {
					for ($k = 0; $k < 4; $k++) {
						$individuBaru[$i][$j][$k]     = $this->data_individu[$this->induk[$i]][$j][$k];
						$individuBaru[$i + 1][$j][$k] = $this->data_individu[$this->induk[$i + 1]][$j][$k];
					}
				}
			}
		}

		$RowsProposal = count($this->kode_sp);

		for ($i = 0; $i < $this->populasi; $i += 2) {
			for ($j = 0; $j < $RowsProposal; $j++) {
				for ($k = 0; $k < 4; $k++) {
					$this->data_individu[$i][$j][$k] = $individuBaru[$i][$j][$k];
					$this->data_individu[$i + 1][$j][$k] = $individuBaru[$i + 1][$j][$k];
				}
			}
		}

		return $individuBaru;
	}

	// MUTASI
	public function Mutasi()
	{
		$fitness = [];

		$r                = mt_rand(0, mt_getrandmax() - 1) / mt_getrandmax();
		$RowsProposal     = count($this->kode_sp);
		$RowsJam          = count($this->jam);
		$RowsHari         = count($this->hari);
		$RowsDospeng1     = count($this->dospeng_1);
		$RowsDospeng2     = count($this->dospeng_2);

		for ($i = 0; $i < $this->populasi; $i++) {

			//Ketika nilai random kurang dari nilai probalitas Mutasi, 
			//maka terjadi penggantian komponen

			if ($r < $this->mutasi) {

				//Penentuan pada matakuliah dan kelas yang mana yang akan dirandomkan atau diganti
				$krom = mt_rand(0, $RowsProposal - 1);

				$this->data_individu[$i][$krom][1] = mt_rand(0, $RowsJam - 1);
				//Proses penggantian hari
				$this->data_individu[$i][$krom][2] = mt_rand(0, $RowsHari - 1);

				//proses penggantian ruang               
				$this->data_individu[$i][$krom][3] = $this->id_dosen[mt_rand(0, $RowsDospeng1 - 1)];
				$this->data_individu[$i][$krom][4] = $this->id_dosen[mt_rand(0, $RowsDospeng2 - 1)];
			}

			$fitness[$i] = $this->CekFitness($i);
		}
		return $fitness;
	}

	public function GetIndividu($indv)
	{

		$individuSolusi = [[]];
		for ($j = 0; $j < count($this->kode_sp); $j++) {
			$individuSolusi[$j][0] = intval($this->kode_sp[$this->data_individu[$indv][$j][0]]);
			$individuSolusi[$j][1] = intval($this->jam[$this->data_individu[$indv][$j][1]]);
			$individuSolusi[$j][2] = intval($this->hari[$this->data_individu[$indv][$j][2]]);
			$individuSolusi[$j][3] = intval($this->id_dosen[$this->data_individu[$indv][$j][3]]);
			$individuSolusi[$j][4] = intval($this->id_dosen[$this->data_individu[$indv][$j][4]]);
			$individuSolusi[$j][5] = intval($this->data_individu[$indv][$j][5]);
		}

		return $individuSolusi;
	}
}
