<?php
defined('BASEPATH') or exit('No direct script access allowed');

// use application\controllers\menu\Genetika;

class Buat_Jadwal_Proposal extends CI_Controller
{
	private $populasi;
	private $crossOver;
	private $mutasi;

	public $RowsProposal = array();
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

	// public $fitness = array();

	public $data_individu = array(array(array(array(array()))));

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
		$data['data_hari'] = $this->jadwal_model->getNamaHari_acak();
		$data['data_jam'] = $this->jadwal_model->getNamaJam_acak();

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

			$this->AmbilData($populasi);
			$this->Inisialisasi($populasi);


			$found = false;


			for ($i = 0; $i < $jumlah_generasi; $i++) {
				$fitness = $this->HitungFitness($populasi);

				// if ($i == 10) {
				// 	var_dump($fitness);
				// 	exit();
				// }

				$this->Seleksi($fitness, $populasi);
				$this->StartCrossOver($populasi, $crossOver);

				$fitnessAfterMutation = $this->Mutasi($populasi, $mutasi);

				for ($j = 0; $j < count($fitnessAfterMutation); $j++) {
					//test here
					// var_dump($fitnessAfterMutation[$j]);
					// exit();
					if ($fitnessAfterMutation[$j] < 1) {

						$this->db->query("TRUNCATE TABLE data_acak_sp");

						$data_hasil = array(array(array(array(array()))));
						$data_hasil = $this->GetIndividu($j);


						for ($k = 0; $k < count($data_hasil); $k++) {

							$kode_sp = intval($data_hasil[$k][0]);
							$hari = intval($data_hasil[$k][1]);
							$jam = intval($data_hasil[$k][2]);
							$dospeng_1 = intval($data_hasil[$k][3]);
							$dospeng_2 = intval($data_hasil[$k][4]);
							$this->db->query("INSERT INTO data_acak_sp(kode_sp,hari,jam,dospeng_1,dospeng_2) " .
								"VALUES($kode_sp,$hari,$jam,$dospeng_1,$dospeng_2)");
						}

						echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . base_url() . 'menu/buat_jadwal_proposal?fit=' . $fitnessAfterMutation[$j] . '">';
						//var_dump($jadwal_kuliah);
						//exit();

						$found = true;
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
				$data['msg'] = 'Tidak Ditemukan Solusi Optimal';
			}
		}
	}

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


		// Ambil Data Hari
		$dataHari = $this->jadwal_model->getJadwalHariSempro();
		$no = 0;
		foreach ($dataHari->result() as $data) {
			$this->hari[$no] = intval($data->kode_hari);
			$no++;
		}

		// Ambil Data Jam
		$dataJam = $this->jadwal_model->getJadwalJamSempro();
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

		// Ambil Data Dosbim
		// $dataDosbim = $this->jadwal_model->getDosbim();
		// $no = 0;
		// foreach ($dataDosbim->result() as $data) {
		// 	$this->dosbim_1[$no] = intval($data->dosbim_1);
		// 	$this->dosbim_2[$no] = intval($data->dosbim_2);
		// 	$no++;
		// }
	}


	// INISIALISASI

	public function Inisialisasi($populasi)
	{
		$this->populasi = $populasi;

		$RowsProposal =  count($this->kode_sp);
		$RowsHari =  count($this->hari);
		$RowsJam =  count($this->jam);
		$RowsDospeng1 =  count($this->dospeng_1);
		$RowsDospeng2 =  count($this->dospeng_2);

		for ($i = 0; $i < $this->populasi; $i++) {
			for ($j = 0; $j < $RowsProposal; $j++) {
				$this->data_individu[$i][$j][0] = $j;
				// $this->data_individu[$i][$j][5];
				// $this->data_individu[$i][$j][6];
				// $this->data0 = mt_rand(0, $RowsDosbim1 - $RowsProposal + $RowsDospeng1);
				// $this->data1 = mt_rand(0, $RowsDosbim2 - $RowsProposal + $RowsDospeng1);
				$this->data2 = mt_rand(0, $RowsHari - 1);
				$this->data3 = mt_rand(0, $RowsJam - 1);
				$this->data4 = mt_rand(0, $RowsDospeng1 - 1);
				$this->data5 = mt_rand(0, $RowsDospeng2 - 1);

				// if ($this->data0 == 0) {
				// 	$this->data_individu[$i][$j][5] = $this->data0 + 1;
				// } else {
				// 	$this->data_individu[$i][$j][5] = $this->data0;
				// }

				// if ($this->data1 == 0) {
				// 	$this->data_individu[$i][$j][6] = $this->data1 + 1;
				// } else {
				// 	$this->data_individu[$i][$j][6] = $this->data1;
				// }

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
			}
		}
	}

	private function CekFitness($indv)
	{

		$penalty = 0;
		// $penalty_jam = 0;
		// $penalty_hari = 0;
		// $penalty_dospeng = 0;

		$RowsProposal =  count($this->kode_sp);
		$RowsDosbim1 =  $this->dosbim_1;
		$RowsDosbim2 =  $this->dosbim_2;

		for ($i = 0; $i < $RowsProposal; $i++) {
			$hari_a = intval($this->data_individu[$indv][$i][1]);
			$jam_a = intval($this->data_individu[$indv][$i][2]);
			$dospeng_a = intval($this->data_individu[$indv][$i][3]);
			$dosbim_a =  $RowsDosbim1;

			for ($j = 0; $j < $RowsProposal; $j++) {
				$hari_b = intval($this->data_individu[$indv][$j][1]);
				$jam_b = intval($this->data_individu[$indv][$j][2]);
				$dospeng_b = intval($this->data_individu[$indv][$j][4]);
				$dosbim_b = $RowsDosbim2;

				if ($i == $j) {
					continue;
				}
				if ($jam_a == $jam_b) {
					$penalty += 1;
				}
				if ($hari_a == $hari_b) {
					$penalty += 1;
				}
				if ($hari_a == 5 && $jam_a == 3) {
					$penalty += 1;
				}
				if ($hari_b == 5 && $jam_b == 3) {
					$penalty += 1;
				}
				if ($hari_b == 5 && $jam_a == 3) {
					$penalty += 1;
				}
				if ($hari_a == 5 && $jam_a == 4) {
					$penalty += 1;
				}
				if ($hari_a == 5 && $jam_b == 4) {
					$penalty += 1;
				}
				if ($hari_b == 5 && $jam_b == 4) {
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
		$fitness = floatval(1 / (1 + $penalty));
		return $fitness;
	}

	// HITUNG FITNESS
	public function HitungFitness($populasi)
	{
		$this->populasi = $populasi;
		for ($indv = 0; $indv < $this->populasi; $indv++) {
			$fitness[$indv] = $this->CekFitness($indv);
		}

		return $fitness;
	}


	// SELEKSI
	public function Seleksi($fitness, $populasi)
	{
		$this->populasi = $populasi;
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
	public function StartCrossOver($crossOver, $populasi)
	{
		$this->populasi = $populasi;
		$this->crossOver = $crossOver;

		$individuBaru = array(array(array(array(array()))));
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
	public function Mutasi($populasi, $mutasi)
	{
		$this->populasi = $populasi;
		$this->mutasi = $mutasi;
		$fitness = array();

		//proses perandoman atau penggantian komponen untuk tiap jadwal baru
		$r                = mt_rand(0, mt_getrandmax() - 1) / mt_getrandmax();

		$RowsProposal     = count($this->kode_sp);
		$RowsHari         = count($this->hari);
		$RowsJam          = count($this->jam);
		$RowsDospeng1     = count($this->dospeng_1);
		$RowsDospeng2     = count($this->dospeng_2);

		for ($i = 0; $i < $this->populasi; $i++) {

			//Ketika nilai random kurang dari nilai probalitas Mutasi, 
			//maka terjadi penggantian komponen

			if ($r < $this->mutasi) {

				//Penentuan pada matakuliah dan kelas yang mana yang akan dirandomkan atau diganti
				$krom = mt_rand(0, $RowsProposal - 1);

				//Proses penggantian hari
				$this->data_individu[$i][$krom][1] = mt_rand(0, ($RowsHari - 1));

				//Proses penggantian jam
				$this->data_individu[$i][$krom][2] = mt_rand(0, ($RowsJam - 1));

				//proses penggantian ruang               
				$this->data_individu[$i][$krom][3] = mt_rand(0, ($RowsDospeng1 - 1));

				$this->data_individu[$i][$krom][4] = mt_rand(0, ($RowsDospeng2 - 1));
			}

			$fitness[$i] = $this->CekFitness($i);
		}
		return $fitness;
	}

	public function GetIndividu($indv)
	{

		$individuSolusi = array(array(array(array(array()))));

		for ($j = 0; $j < count($this->kode_sp); $j++) {
			$individuSolusi[$j][0] = intval($this->kode_sp[$this->data_individu[$indv][$j][0]]);
			$individuSolusi[$j][1] = intval($this->hari[$this->data_individu[$indv][$j][1]]);
			$individuSolusi[$j][2] = intval($this->jam[$this->data_individu[$indv][$j][2]]);
			$individuSolusi[$j][3] = intval($this->dospeng_1[$this->data_individu[$indv][$j][3]]);
			$individuSolusi[$j][4] = intval($this->dospeng_2[$this->data_individu[$indv][$j][4]]);
		}

		return $individuSolusi;
	}
}
