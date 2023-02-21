<?php
class Genetika extends CI_Controller
{
	private $populasi;
	private $crossOver;
	private $mutasi;

	public $RowsProposal = '';
	public $RowsJadwal = '';
	public $RowsHari = '';
	public $RowsJam = '';
	public $RowsDospeng1 = '';
	public $RowsDospeng2 = '';
	public $RowsDosbim1 = '';
	public $RowsDosbim2 = '';

	public $data1 = '';
	public $data2 = '';
	public $data3 = '';
	public $data4 = '';
	public $data5 = '';

	public $fitness = '';

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
		$this->load->model('jadwal_model');
		$this->load->library('session');
	}

	public function Data()
	{
		$dataSempro = $this->jadwal_model->getDataSempro();
		$no = 0;
		foreach ($dataSempro->result() as $data) {
			$this->kode_sp[$no] = $data->kode_sp;
			$no++;
		}

		$dataJadwal = $this->jadwal_model->getDataJadwalDosen();
		$no = 0;
		foreach ($dataJadwal->result() as $data) {
			$this->kode_jd[$no] = $data->kode_jd;
			$no++;
		}

		// Ambil Data Hari
		// $dataHari = $this->jadwal_model->getJadwaHariDosen();
		// $no = 0;
		// foreach ($dataHari->result() as $data) {
		// 	$this->hari[$no] = $data->hari;
		// 	$no++;
		// }

		// // Ambil Data Jam
		// $dataJam = $this->jadwal_model->getJadwalJamDosen();
		// $no = 0;
		// foreach ($dataJam->result() as $data) {
		// 	$this->jam[$no] = $data->jam;
		// 	$no++;
		// }

		// // Ambil Data Dospeng 1
		// $dataDospeng1 = $this->jadwal_model->getJadwalDospeng1();
		// $no  = 0;
		// foreach ($dataDospeng1->result() as $data) {
		// 	$this->id_dosen[$no] = $data->id_dosen;
		// 	$no++;
		// }

		// // Ambil Data Dospeng 2
		// $dataDospeng2 = $this->jadwal_model->getJadwalDospeng2();
		// $no = 0;
		// foreach ($dataDospeng2->result() as $data) {
		// 	$this->id_dosen[$no] = $data->id_dosen;
		// 	$no++;
		// }

		// // Ambil Data Dosbim1
		// $dataDosbim = $this->jadwal_model->getDosbim();
		// $no = 0;
		// foreach ($dataDosbim->result() as $data) {
		// 	$this->dosbim_1[$no] = $data->dosbim_1;
		// 	$this->dosbim_2[$no] = $data->dosbim_2;
		// 	$no++;
		// }
		// // Ambil Data Dosbim2
		// $dataDosbim2 = $this->jadwal_model->getDosbim2();
		// $no = 0;
		// foreach($dataDosbim2->result() as $data){
		// 	$this->dosbim_2[$no] = $data->dosbim_2;
		// 	$no++;
		// }



		// if (empty($this->hari || $this->jam || $this->id_dosen || $this->kode_sp)) {
		// 	echo '<span>Data Kosong</span>';
		// } else {
		$RowsProposal =  count($this->kode_sp);
		$RowsJadwal =  count($this->kode_jd);
		// $RowsHari =  count($this->hari);
		// $RowsJam =  count($this->jam);
		// $RowsDospeng1 =  count($this->id_dosen);
		// $RowsDospeng2 =  count($this->id_dosen);
		// $RowsDosbim1 =  $this->dosbim_1;
		// $RowsDosbim2 =  $this->dosbim_2;
		// }

		$this->db->query("TRUNCATE TABLE data_acak_sp");

		for ($i = 0; $i < $RowsProposal; $i++) {
			$this->data_individu[$i][0] = $this->kode_sp[$i];
			$this->data_individu[$i][1] = $this->kode_jd[$i];
			// $this->data3 = mt_rand(0, $RowsJam);
			// $this->data4 = mt_rand(0, $RowsDospeng1);
			// $this->data5 = mt_rand(0, $RowsDospeng2);

			// if ($this->data2 == 0) {
			// 	$this->data_individu[$i][1] = $this->data2 + 1;
			// } else {
			// 	$this->data_individu[$i][1] = $this->data2;
			// }

			// if ($this->data3 == 0) {
			// 	$this->data_individu[$i][2] = $this->data3 + 1;
			// } else {
			// 	$this->data_individu[$i][2] = $this->data3;
			// }

			// if ($this->data4 == 0) {
			// 	$this->data_individu[$i][3] = $this->data4 + 1;
			// } else {
			// 	$this->data_individu[$i][3] = $this->data4;
			// }

			// if ($this->data5 == 0) {
			// 	$this->data_individu[$i][4] = $this->data5 + 1;
			// } else {
			// 	$this->data_individu[$i][4] = $this->data5;
			// }

			$a = $this->data_individu[$i][0];
			$b = $this->data_individu[$i][1];
			// $ccc = $this->data_individu[$i][2];

			// if ($ccc >= 9) {
			// 	$c = 8;
			// } else {
			// 	$c = $this->data_individu[$i][2];
			// }

			// $d = $this->data_individu[$i][3];
			// $e = $this->data_individu[$i][4];

			$this->db->query("INSERT INTO data_acak_sp VALUES ($a,$b)");

			$penalty_jadwal = 0;
			// $penalty_jam = 0;
			// $penalty_hari = 0;
			// $penalty_dospeng = 0;

			for ($j = 0; $j < $i; $j++) {
				$RowsJadwal_a = $this->data_individu[$i][1];
				// $jam_a = $this->data_individu[$i][2];
				// $dospeng_a = $this->data_individu[$i][3];
				// $dosbim_a = $RowsDosbim1;

				for ($k = 0; $k < $j; $k++) {
					$RowsJadwal_b = $this->data_individu[$i][1];
					// $jam_b = $this->data_individu[$i][2];
					// $dospeng_b = $this->data_individu[$i][3];
					// $dosbim_b = $RowsDosbim2;

					if ($RowsJadwal_a == $RowsJadwal_b) {
						$penalty_jadwal += 1;
					}
					// 	if ($hari_a == $hari_b) {
					// 		$penalty_hari += 1;
					// 	}
					// 	if ($dospeng_a == $dospeng_b) {
					// 		$penalty_dospeng += 1;
					// 	}
					// 	if ($dosbim_a == $dospeng_a) {
					// 		$penalty_dospeng += 1;
					// 	}
					// 	if ($dosbim_b == $dospeng_a) {
					// 		$penalty_dospeng += 1;
					// 	}
					// 	if ($dosbim_a == $dospeng_b) {
					// 		$penalty_dospeng += 1;
					// 	}
					// 	if ($dosbim_b == $dospeng_b) {
					// 		$penalty_dospeng += 1;
					// 	}

					// 	// end loop j
					// }
					// end loop k
				}
				$fitness = (1 / (1 + $penalty_jadwal));
			}

			for ($i = 0; $i < $this->RowsJadwal; $i++) {
				implode("", $this->data_individu[$i]);
			}
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . base_url() . 'menu/buat_jadwal_proposal?fit=' . $fitness . '">';
		}
	}
}

// konfigurasi database
// $host       =   "localhost";
// $user       =   "root";
// $password   =   "";
// $database   =   "db_penjadwalan_ta";
// // perintah php untuk akses ke database
// $koneksi = new PDO("mysql:host={$host};dbname={$database}", $user, $password);
// $koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// $t = new Genetika;
// $t->Data();

// $sql = "SELECT * FROM data_acak_sp";
// $exf = $koneksi->query($sql);

// $penalty_jam = 0;
// $penalty_hari = 0;
// $penalty_dospeng = 0;


// while ($q = $exf->fetch(PDO::FETCH_NUM)) {
// 	$jam_a = $q[2];
// 	$hari_a = $q[1];
// 	$dospeng_a = $q[3];
// 	while ($qq = $exf->fetch(PDO::FETCH_NUM)) {
// 		$jam_b = $qq[2];
// 		$hari_b = $qq[1];
// 		$dospeng_b = $qq[3];

// 		if ($jam_a == $jam_b) {
// 			$penalty_jam += 1;
// 		}
// 		if ($hari_a == $hari_b) {
// 			$penalty_hari += 1;
// 		}
// 		if ($dospeng_a == $dospeng_b) {
// 			$penalty_dospeng += 1;
// 		}
// 		if ($dosbim_a == $dospeng_a) {
// 			$penalty_dospeng += 1;
// 		}
// 		if ($dosbim_b == $dospeng_a) {
// 			$penalty_dospeng += 1;
// 		}
// 		if ($dosbim_a == $dospeng_b) {
// 			$penalty_dospeng += 1;
// 		}
// 		if ($dosbim_b == $dospeng_b) {
// 			$penalty_dospeng += 1;
// 		}
// 	}
// }

// $fitness = floatval(1 / (1 + $penalty_jam + $penalty_hari + $penalty_dospeng));


// echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . base_url() . 'menu/buat_jadwal_proposal?fit=' . $fitness . '">';
