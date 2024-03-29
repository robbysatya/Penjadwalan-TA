<?php
defined('BASEPATH') or exit('No direct script access allowed');

// use application\controllers\menu\Genetika;

class Buat_Jadwal_Proposal extends CI_Controller
{
	private $populasi;
	private $crossOver;
	private $mutasi;

	public $RowsProposal = array();
	public $RowsWaktu = array();
	public $RowsHari = array();
	public $RowsJam = array();
	public $RowsDospeng1 = array();
	public $RowsDospeng2 = array();
	public $RowsDosbim1 = array();
	public $RowsDosbim2 = array();

	public $data0 = array();
	public $data1 = array();
	public $data2 = array();
	public $data3 = array();
	public $data4 = array();
	public $data5 = array();

	private $induk = array();

	// public $fitness = array();

	private $data_individu = array(array(array()));

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('email')) {
			redirect('auth');
		} else if ($this->session->userdata('role_id') == null) {
			redirect('auth');
		} else if ($this->session->userdata('role_id') != '1') {
			redirect('auth/blocked');
		}
		$this->load->library('form_validation');
		$this->load->model('jadwal_model');
		$this->load->model('mahasiswa_model');
		$this->load->model('dosen_model');
	}

	public function index()
	{
		$data['title'] = 'Buat Jadwal Seminar Proposal';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['data_jadwal'] = $this->jadwal_model->getDataAcakProposal();
		// $data['data_dosen'] = $this->dosen_model->getNamaDosen();
		$data['data_list_dosen'] = $this->dosen_model->getDosen();
		// $data['data_hari'] = $this->db->get('tb_hari')->result_array();
		// $data['data_jam'] = $this->db->get('tb_jam_sempro')->result_array();

		$data['data_dospeng'] = $this->db->get('data_acak_sp')->result_array();
		$data['data_list_dospeng_1'] = $this->jadwal_model->getNamaDospeng_1();
		$data['data_list_dospeng_2'] = $this->jadwal_model->getNamaDospeng_2();

		$data['data_proposal'] = $this->jadwal_model->getNamaMahasiswa_acak();
		$data['data_dospeng1'] = $this->jadwal_model->getNamaDospeng1_acak();
		$data['data_dospeng2'] = $this->jadwal_model->getNamaDospeng2_acak();
		$data['data_dosbim1'] = $this->mahasiswa_model->getDosBim_1_proposal();
		$data['data_dosbim2'] = $this->mahasiswa_model->getDosBim_2_proposal();
		$data['data_waktu'] = $this->jadwal_model->getNamaWaktu_acak_sempro();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('menu/jadwal/buat_jadwal_sempro', $data);
		$this->load->view('templates/footer');

		// if($this->jadwal_model->getDataAcakProposal('jam') == $this->jadwal_model->getDataAcakProposal('jam')){
		// 	$this->Genetika();
		// }
	}

	public function simpan_jadwal()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->jadwal_model->simpan_sempro();
		$this->db->query("TRUNCATE TABLE data_acak_sp");

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Jadwal Berhasil Disimpan!</div>');
		redirect('menu/buat_jadwal_proposal');
	}
	public function edit()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->jadwal_model->edit_jadwal_sempro();

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Jadwal Berhasil Diubah!</div>');
		redirect('menu/buat_jadwal_proposal');
	}

	// KEAJAIBAN DIMULAI, GENERATE JADWAL DENGAN ALGORITMA GENETIKA
	public function Genetika()
	{
		$cek = ($this->db->query("SELECT * FROM tb_proposal WHERE status = 1"));
		// var_dump($cek->num_rows());
		// die;
		if ($cek->num_rows() < 2) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data pendaftar Sempro yang diterima kurang dari aturan untuk generate jadwal minimal 2 data pendaftar!</div>');
			redirect('menu/buat_jadwal_proposal');
		} else {
			$populasi = $this->input->post('populasi');
			$crossOver = $this->input->post('crossover');
			$mutasi = $this->input->post('mutasi');
			$jumlah_generasi = $this->input->post('jumlah_generasi');

			$data['populasi'] = $populasi;
			$data['crossover'] = $crossOver;
			$data['mutasi'] = $mutasi;
			$data['jumlah_generasi'] = $jumlah_generasi;

			$dataSempro = $this->jadwal_model->getDataSempro();
			$no = 0;
			foreach ($dataSempro->result() as $data) {
				$this->kode_sp[$no] = intval($data->kode_sp);
				$this->dosbim_1[$no] = intval($data->dosbim_1);
				$this->dosbim_2[$no] = intval($data->dosbim_2);
				$no++;
			}

			$RowsProposal =  count($this->kode_sp);

			$this->AmbilData();
			$this->Inisialisasi($populasi);
			$found = false;
			for ($i = 0; $i < $jumlah_generasi; $i++) {

				echo '===== Generasi Ke- ' . $i . ' =====<br>';

				for ($k = 0; $k < count($this->data_individu); $k++) {
					echo "Individu ke - " . $k . "<br>";
					for ($m = 0; $m < $RowsProposal; $m++) {
						echo "V" . $m . " = ["
							. $this->data_individu[$k][$m][0] . ","
							. $this->data_individu[$k][$m][1] . ","
							. $this->data_individu[$k][$m][2] . ","
							. $this->data_individu[$k][$m][3] . "] - ";
					}
					echo "<br><br>";
				}

				$fitness = $this->HitungFitness();

				$this->Seleksi($fitness);
				$this->StartCrossOver($crossOver, $populasi);

				$fitnessAfterMutation = $this->Mutasi($mutasi);

				$found = false;
				for ($j = 0; $j < count($fitnessAfterMutation); $j++) {
					//test here
					// var_dump($fitnessAfterMutation[$j]);
					// exit();
					echo 'Fitness ke-' . $j . ' : ', $fitnessAfterMutation[$j], '</br>';

					if ($fitnessAfterMutation[$j] == 1) {

						$this->db->query("TRUNCATE TABLE data_acak_sp");

						$data_hasil = array(array());
						$data_hasil = $this->GetIndividu($j);

						for ($k = 0; $k < count($data_hasil); $k++) {

							$kode_sp = intval($data_hasil[$k][0]);
							$waktu = intval($data_hasil[$k][1]);
							$dospeng_1 = intval($data_hasil[$k][2]);
							$dospeng_2 = intval($data_hasil[$k][3]);
							echo "A" . $k . " = ["
								. $kode_sp . ","
								. $waktu . ","
								. $dospeng_1 . ","
								. $dospeng_2 . "] - ";
							echo "<br><br>";
							$this->db->query("INSERT INTO data_acak_sp(kode_sp,kode_waktu,dospeng_1,dospeng_2) " .
								"VALUES($kode_sp,$waktu,$dospeng_1,$dospeng_2)");
						}
						$found = true;

						//echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . base_url() . 'menu/buat_jadwal_proposal?fit=' . $fitnessAfterMutation[$j] . '">';
						//var_dump($jadwal_kuliah);
						//exit();

					}
					if ($found) {
						break;
					}
				}
				if ($found) {
					break;
				}
			}
			if (!$found) {
				echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . base_url() . 'menu/buat_jadwal_proposal">';
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak ditemukan solusi optimal!</div>');
			}
		}
	}

	// AMBIL DATA
	public function AmbilData()
	{
		// Ambil Data Seminar
		$dataSempro = $this->jadwal_model->getDataSempro();
		$no = 0;
		foreach ($dataSempro->result() as $data) {
			$this->kode_sp[$no] = intval($data->kode_sp);
			$this->dosbim_1[$no] = intval($data->dosbim_1);
			$this->dosbim_2[$no] = intval($data->dosbim_2);
			$no++;
		}

		// Ambil Data Waktu
		$dataWaktu = $this->jadwal_model->getWaktuSempro();
		$no = 0;
		foreach ($dataWaktu->result() as $data) {
			$this->waktu[$no] = intval($data->kode_waktu);
			$no++;
		}

		// Ambil Data Dospeng 1
		$dataDospeng1 = $this->jadwal_model->getDospeng1();
		$no = 0;
		foreach ($dataDospeng1->result() as $data) {
			$this->dospeng_1[$no] = intval($data->id);
			$no++;
		}

		// Ambil Data Dospeng 2
		$dataDospeng2 = $this->jadwal_model->getDospeng2();
		$no = 0;
		foreach ($dataDospeng2->result() as $data) {
			$this->dospeng_2[$no] = intval($data->id);
			$no++;
		}
	}


	// INISIALISASI

	public function Inisialisasi($populasi)
	{
		$RowsProposal =  count($this->kode_sp);
		$RowsWaktu =  count($this->waktu);
		$RowsDospeng1 =  count($this->dospeng_1);
		$RowsDospeng2 =  count($this->dospeng_2);

		for ($i = 0; $i < $populasi; $i++) {
			for ($j = 0; $j < $RowsProposal; $j++) {
				$this->data_individu[$i][$j][0] = $j;
				$this->data_individu[$i][$j][1] = mt_rand(0, $RowsWaktu - 1);
				$this->data_individu[$i][$j][2] = mt_rand(0, $RowsDospeng1 - 1);
				$this->data_individu[$i][$j][3] = mt_rand(0, $RowsDospeng2 - 1);

				if ($this->data_individu[$i][$j][1] == 0) {
					$this->data_individu[$i][$j][1] = $this->data_individu[$i][$j][1] + 1;
				} else {
					$this->data_individu[$i][$j][1] = $this->data_individu[$i][$j][1];
				}

				if ($this->data_individu[$i][$j][2] == 0) {
					$this->data_individu[$i][$j][2] = $this->data_individu[$i][$j][2] + 1;
				} else {
					$this->data_individu[$i][$j][2] = $this->data_individu[$i][$j][2];
				}

				if ($this->data_individu[$i][$j][3] == 0) {
					$this->data_individu[$i][$j][3] = $this->data_individu[$i][$j][3] + 1;
				} else {
					$this->data_individu[$i][$j][3] = $this->data_individu[$i][$j][3];
				}
			}
		}
	}

	private function CekFitness($indv)
	{

		$penalty = 0;

		$RowsProposal =  count($this->kode_sp);
		$RowsDosbim1 =  $this->dosbim_1;
		$RowsDosbim2 =  $this->dosbim_2;

		for ($i = 0; $i < $RowsProposal; $i++) {
			$waktu_a = intval($this->data_individu[$indv][$i][1]);
			$dospeng_a = intval($this->data_individu[$indv][$i][2]);
			$dosbim_a = $RowsDosbim1[$i];

			for ($j = 0; $j < $RowsProposal; $j++) {
				$waktu_b = intval($this->data_individu[$indv][$j][1]);
				$dospeng_b = intval($this->data_individu[$indv][$j][3]);
				$dosbim_b = $RowsDosbim2[$j];

				if ($i == $j)
					continue;

				if ($waktu_a == $waktu_b) {
					$penalty += 1;
				}
				if ($waktu_a == $waktu_b && $dospeng_a == $dospeng_b) {
					$penalty += 1;
				}
				if ($waktu_a == $waktu_b && $dosbim_a == $dospeng_a) {
					$penalty += 1;
				}
				if ($waktu_a == $waktu_b && $dosbim_b == $dospeng_a) {
					$penalty += 1;
				}
				if ($waktu_a == $waktu_b && $dosbim_a == $dospeng_b) {
					$penalty += 1;
				}
				if ($waktu_a == $waktu_b && $dosbim_b == $dospeng_b) {
					$penalty += 1;
				}

				if ($dospeng_a == $dospeng_b) {
					$penalty += 1;
				}
				if ($dosbim_a == $dospeng_a) {
					$penalty += 1;
				}
				if ($dosbim_b == $dospeng_a) {
					$penalty += 1;
				}
				if ($dosbim_a == $dospeng_b) {
					$penalty += 1;
				}
				if ($dosbim_b == $dospeng_b) {
					$penalty += 1;
				}
				// end loop j
			}
			// end loop k
		}

		$fitness = floatval(1 / (1.0 * $penalty + 1));
		return $fitness;
	}

	// HITUNG FITNESS
	public function HitungFitness()
	{
		// $pop = $this->data_individu;
		// var_dump($this->data_individu);
		// die;
		$fitness = array();
		for ($indv = 0; $indv < count($this->data_individu); $indv++) {
			$fitness[$indv] = $this->CekFitness($indv);
		}

		return $fitness;
	}


	// SELEKSI
	public function Seleksi($fitness)
	{
		$jumlah = 0;
		$rank   = array();

		for ($i = 0; $i < count($this->data_individu); $i++) {

			//proses ranking berdasarkan nilai fitness
			$rank[$i] = 1;
			for ($j = 0; $j < count($this->data_individu); $j++) {

				$fitnessA = floatval($fitness[$i]);
				$fitnessB = floatval($fitness[$j]);

				if ($fitnessA > $fitnessB) {
					$rank[$i] += 1;
				}
			}

			$jumlah += $rank[$i];
		}

		echo
		"<br>" . $jumlah . "==" . $rank[0] . "==" . $rank[1] . "==" . $rank[2] . "==" . $rank[3] . "==" . $rank[4] . "==" . $rank[5] . "==" . $rank[6] . "==" . $rank[7] . "==" . $rank[8] . "==" . $rank[9] . "==" . "<br><br>";

		$jumlahRank = count($rank);
		for ($i = 0; $i < count($this->data_individu); $i++) {
			//proses seleksi berdasarkan ranking yang telah dibuat
			//int nexRandom = random.Next(1, jumlah);
			//random = new Random(nexRandom);
			$target = mt_rand(0, $jumlah - 1);

			$cek    = 0;
			for ($j = 0; $j < $jumlahRank; $j++) {
				$cek += $rank[$j];
				echo $i . "==" . $j . "==" . $target . "==" . $cek . "<==>data_individu($i)==data_individu($j)==target==cek<br>";
				if (intval($cek) >= intval($target)) {
					$this->induk[$i] = $j; //induk[]
					break;
				}
			}
		}
	}

	// CROSSOVER
	public function StartCrossOver($crossOver, $populasi)
	{
		$individuBaru = array(array(array(array())));
		$RowsProposal = count($this->kode_sp);

		for ($i = 0; $i < $populasi; $i += 2) {
			$cr = mt_rand(0, mt_getrandmax() - 1) / mt_getrandmax();
			$b = 0;

			if (floatval($cr) < floatval($crossOver)) {
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

		for ($i = 0; $i < $populasi; $i += 2) {
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
	public function Mutasi($mutasi)
	{
		$fitness = array();

		//proses perandoman atau penggantian komponen untuk tiap jadwal baru
		$r                = mt_rand(0, mt_getrandmax() - 1) / mt_getrandmax();

		$RowsProposal     = count($this->kode_sp);
		$RowsWaktu         = count($this->waktu);
		// $RowsHari         = count($this->hari);
		// $RowsJam          = count($this->jam);
		$RowsDospeng1     = count($this->dospeng_1);
		$RowsDospeng2     = count($this->dospeng_2);

		for ($i = 0; $i < count($this->data_individu); $i++) {

			//Ketika nilai random kurang dari nilai probalitas Mutasi, 
			//maka terjadi penggantian komponen

			if ($r < floatval($mutasi)) {

				//Penentuan pada matakuliah dan kelas yang mana yang akan dirandomkan atau diganti
				$krom = mt_rand(0, $RowsProposal - 1);

				//Proses penggantian waktu
				$this->data_individu[$i][$krom][1] = mt_rand(0, ($RowsWaktu - 1));

				// //Proses penggantian hari
				// $this->data_individu[$i][$krom][1] = mt_rand(0, ($RowsHari - 1));

				// //Proses penggantian jam
				// $this->data_individu[$i][$krom][2] = mt_rand(0, ($RowsJam - 1));

				//proses penggantian ruang               
				$this->data_individu[$i][$krom][2] = mt_rand(0, ($RowsDospeng1 - 1));

				$this->data_individu[$i][$krom][3] = mt_rand(0, ($RowsDospeng2 - 1));
			}

			$fitness[$i] = $this->CekFitness($i);
		}
		return $fitness;
	}

	public function GetIndividu($indv)
	{

		$individuSolusi = array(array(array(array())));

		for ($j = 0; $j < count($this->kode_sp); $j++) {
			$individuSolusi[$j][0] = intval($this->kode_sp[$this->data_individu[$indv][$j][0]]);
			$individuSolusi[$j][1] = intval($this->waktu[$this->data_individu[$indv][$j][1]]);
			$individuSolusi[$j][2] = intval($this->dospeng_1[$this->data_individu[$indv][$j][2]]);
			$individuSolusi[$j][3] = intval($this->dospeng_2[$this->data_individu[$indv][$j][3]]);
		}

		return $individuSolusi;
	}
}
