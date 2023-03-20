// 	public function acak_jadwal()
// 	{

// 		$this->Genetika();

// 		$exf = $this->db->query("SELECT * FROM data_acak_sp");

// 		$penalty_jam = 0;
// 		$penalty_hari = 0;
// 		$penalty_dospeng = 0;


// 		while ($q = $exf->fetch(PDO::FETCH_NUM)) {
// 			$hari_a = $q[1];
// 			$jam_a = $q[2];
// 			$dospeng_a = $q[3];
// 			while ($qq = $exf->fetch(PDO::FETCH_NUM)) {
// 				$hari_b = $qq[1];
// 				$jam_b = $qq[2];
// 				$dospeng_b = $qq[3];

// 				if ($jam_a == $jam_b) {
// 					$penalty_jam += 1;
// 				}
// 				if ($hari_a == $hari_b) {
// 					$penalty_hari += 1;
// 				}
// 				if ($dospeng_a == $dospeng_b) {
// 					$penalty_dospeng += 1;
// 				}
// 				if ($dosbim_a == $dospeng_a){ 
// 						$penalty_dospeng += 1 ; 
// 				}
// 				if ($dosbim_b == $dospeng_a){ 
// 						$penalty_dospeng += 1 ; 
// 				}
// 				if ($dosbim_a == $dospeng_b){ 
// 						$penalty_dospeng += 1 ; 
// 				}
// 				if ($dosbim_b == $dospeng_b){ 
// 						$penalty_dospeng += 1 ; 
// 				}

// 			}
// 		}

// 	$fitness = floatval(1 / (1 + $penalty_jam + $penalty_hari + $penalty_dospeng));


// 	echo '<META HTTP-EQUIV="Refresh" Content="0; URL=' . base_url() . 'menu/buat_jadwal_proposal?fit=' . $fitness . '">';

// }


// 	public function Genetika()
// 	{
// 		$dataSempro = $this->jadwal_model->getDataSempro();
// 		$no = 0;
// 		foreach ($dataSempro->result() as $data) {
// 			$this->kode_sp[$no] = $data->kode_sp;
// 			$no++;
// 		}

// 		// Ambil Data Hari
// 		$dataHari = $this->jadwal_model->getJadwaHariDosen();
// 		$no = 0;
// 		foreach ($dataHari->result() as $data) {
// 			$this->hari[$no] = $data->hari;
// 			$no++;
// 		}

// 		// Ambil Data Jam
// 		$dataJam = $this->jadwal_model->getJadwalJamDosen();
// 		$no = 0;
// 		foreach ($dataJam->result() as $data) {
// 			$this->jam[$no] = $data->jam;
// 			$no++;
// 		}

// 		// Ambil Data Dospeng 1
// 		$dataDospeng1 = $this->jadwal_model->getJadwalDospeng1();
// 		$no = 0;
// 		foreach ($dataDospeng1->result() as $data) {
// 			$this->id_dosen[$no] = $data->id_dosen;
// 			$no++;
// 		}

// 		// Ambil Data Dospeng 2
// 		$dataDospeng2 = $this->jadwal_model->getJadwalDospeng2();
// 		$no = 0;
// 		foreach ($dataDospeng2->result() as $data) {
// 			$this->id_dosen[$no] = $data->id_dosen;
// 			$no++;
// 		}

// 		// Ambil Data Dosbim1
// 		$dataDosbim = $this->jadwal_model->getDosbim();
// 		$no = 0;
// 		foreach ($dataDosbim->result() as $data) {
// 			$this->dosbim_1[$no] = $data->dosbim_1;
// 			$this->dosbim_2[$no] = $data->dosbim_2;
// 			$no++;
// 		}
// 		// Ambil Data Dosbim2
// 		// $dataDosbim2 = $this->jadwal_model->getDosbim2();
// 		// $no = 0;
// 		// foreach($dataDosbim2->result() as $data){
// 		// 	$this->dosbim_2[$no] = $data->dosbim_2;
// 		// 	$no++;
// 		// }

// 		$RowsProposal =  count($this->kode_sp);
// 		$RowsHari =  count($this->hari);
// 		$RowsJam =  count($this->jam);
// 		$RowsDospeng1 =  count($this->id_dosen);
// 		$RowsDospeng2 =  count($this->id_dosen);
// 		$RowsDosbim1 =  $this->dosbim_1;
// 		$RowsDosbim2 =  $this->dosbim_2;

// 		$this->db->query("TRUNCATE TABLE data_acak_sp");

// 		for ($i = 0; $i < $RowsProposal; $i++) {
// 			$this->data_individu[$i][0] = $this->kode_sp[$i];
// 			$this->data2 = mt_rand(0, $RowsHari);
// 			$this->data3 = mt_rand(0, $RowsJam);
// 			$this->data4 = mt_rand(0, $RowsDospeng1);
// 			$this->data5 = mt_rand(0, $RowsDospeng2);

// 			if ($this->data2 == 0) {
// 				$this->data_individu[$i][1] = $this->data2 + 1;
// 			} else {
// 				$this->data_individu[$i][1] = $this->data2;
// 			}

// 			if ($this->data3 == 0) {
// 				$this->data_individu[$i][2] = $this->data3 + 1;
// 			} else {
// 				$this->data_individu[$i][2] = $this->data3;
// 			}

// 			if ($this->data4 == 0) {
// 				$this->data_individu[$i][3] = $this->data4 + 1;
// 			} else if ($this->data4 == $this->data5) {
// 				$this->data_individu[$i][3] = $this->data4 + 1;
// 			} else {
// 				$this->data_individu[$i][3] = $this->data4 ;
// 			}

// 			if ($this->data5 == 0) {
// 				$this->data_individu[$i][4] = $this->data5 + 1;
// 			} else if ($this->data5 == $this->data4){
// 				$this->data_individu[$i][4] = $this->data5 + 1;
// 			} else {
// 				$this->data_individu[$i][4] = $this->data5;
// 			}

// 			$a = $this->data_individu[$i][0];
// 			$bb = $this->data_individu[$i][1];
// 			$cc = $this->data_individu[$i][2];
			
// 			$dd = $this->data_individu[$i][3];
// 			$ee = $this->data_individu[$i][4];

// 			$acakHari = 5;
// 			$acakJam = 8;

// 			if ($bb >= 6) {
// 				$b = mt_rand(1, $acakHari);
// 			} else {
// 				$b = $this->data_individu[$i][1];
// 			}

// 			if ($cc >= 9) {
// 				$c = mt_rand(1, $acakJam);;
// 			} else {
// 				$c = $this->data_individu[$i][2];
// 			}

// 			if ($dd == $this->data_individu[$i][4]){
// 				$d = $this->data_individu[$i][3] + 1;
// 			} else if ($dd >= 21) {
// 				$d = 20;
// 			} else {
// 				$d = $this->data_individu[$i][3];
// 			}

// 			if ($ee == $this->data_individu[$i][3]){
// 				$e = $this->data_individu[$i][4] + 1;
// 			} else if($ee >= 21){
// 				$e = 20;
// 			} else {
// 				$e = $this->data_individu[$i][4];
// 			}

// 			// if ($dd == $this->data_individu[$i][3]){
// 			// 	$d = $this->data_individu[$i][3] + 1;
// 			// } else {
// 			// 	$d = $this->data_individu[$i][3];
// 			// }

// 			// if ($ee == $this->data_individu[$i][4]){
// 			// 	$e = $this->data_individu[$i][4] + 1;
// 			// } else {
// 			// 	$e = $this->data_individu[$i][4];
// 			// }
			
// 			$this->db->query("INSERT INTO data_acak_sp VALUES ($a,$b,$c,$d,$e)");

// 			$penalty_jam = 0;
// 			$penalty_hari = 0;
// 			$penalty_dospeng = 0;

// 			for ($j = 0; $j < $i; $j++) {
// 				$this->data_individu[$i][0] = $this->kode_sp[$j];
// 				$hari_a = $this->data_individu[$i][1];
// 				$jam_a = $this->data_individu[$i][2];
// 				$dospeng_a = $this->data_individu[$i][3];
// 				$dosbim_a = $RowsDosbim1;

// 				for ($k = 0; $k < $j; $k++) {
// 					$hari_b = $this->data_individu[$i][1];
// 					$jam_b = $this->data_individu[$i][2];
// 					$dospeng_b = $this->data_individu[$i][4];
// 					$dosbim_b = $RowsDosbim2;

// 					if ($hari_a == $hari_b) {
// 						$penalty_hari += 1;
// 					}
// 					if ($jam_a == $jam_b) {
// 						$penalty_jam += 1;
// 					}
// 					if ($dospeng_a == $dospeng_b) {
// 						$penalty_dospeng += 1;
// 					}
// 					if ($dosbim_a == $dospeng_a) {
// 						$penalty_dospeng += 1;
// 					}
// 					if ($dosbim_b == $dospeng_a) {
// 						$penalty_dospeng += 1;
// 					}
// 					if ($dosbim_a == $dospeng_b) {
// 						$penalty_dospeng += 1;
// 					}
// 					if ($dosbim_b == $dospeng_b) {
// 						$penalty_dospeng += 1;
// 					}

// 					// end loop j
// 				}
// 				// end loop k
// 			}

// 			$fitness = (1 / (1 + $penalty_jam + $penalty_hari + $penalty_dospeng));
// 		}

// 		for ($i = 0; $i < $this->RowsProposal; $i++) {
// 			implode("", $this->data_individu[$i]);
// 		}
// 		echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.base_url().'menu/buat_jadwal_proposal?fit='.$fitness.'">';
// 	}
// }

// public function generate_jadwal()
// {
// 	$populasi = 4;
// 	$crossOver = 0.7;
// 	$mutasi = 0.5;
// 	$jumlah_generasi = 2;

// 	$individu_awal = array(array(array()));
// 	$hasil_crossover = array(array(array()));
// 	$hasil_mutasi = array(array(array()));
// 	$hasil_kromosom = array(array(array()));

// 		$genetika = new Genetika();
// 		$genetika->AmbilData();
// 		$individu_awal = $genetika->Inisialisasi($populasi);
		

// 		for($i = 0;$i < $jumlah_generasi;$i++ ){
// 				$fitness = $genetika->HitungFitness($populasi, $individu_awal);

// 				$hasil_crossover = $genetika->StartCrossOver($individu_awal, $populasi, $crossOver);

// 				$hasil_mutasi = $genetika->Mutasi($individu_awal, $populasi, $mutasi);

// 				$panjang_kromosom = $populasi+count($hasil_crossover)+count($hasil_mutasi);
				
// 				for ($i=0; $i < $populasi; $i++) {
// 						$hasil_kromosom [$i] = $individu_awal[$i];
// 				}
// 				$index = 0;
// 				for ($i=$populasi; $i <($populasi+count($hasil_crossover)) ; $i++) {
// 						$hasil_kromosom[$i] =$hasil_crossover[$index];
// 						$index++;
// 				}
// 				$index1 = 0;
// 				for ($i=($populasi+count($hasil_crossover)); $i <$panjang_kromosom ; $i++) {
// 						$hasil_kromosom[$i] =$hasil_mutasi[$index1];
// 						$index1++;
// 				}

// 				$fitness_reproduksi = $genetika->HitungFitness($panjang_kromosom, $hasil_kromosom);

// 				$kromosom_akhir = $genetika->Seleksi($fitness_reproduksi, $hasil_kromosom,$populasi);
// 				$fitness_hasil = $genetika->HitungFitness(count($kromosom_akhir), $kromosom_akhir);
				
// 		}

		
// 		for ($i = 0; $i < count($kromosom_akhir); $i++) {

//           for ($j = 0; $j < count($kromosom_akhir[0]); $j++) {
//           $dataindividu = array(
// 					'kode_sp' => $i+1,
// 					'hari' => $kromosom_akhir[$i][$j][0],
// 					'jam' => $kromosom_akhir[$i][$j][1],
// 					'dospeng_1' => $kromosom_akhir[$i][$j][2],
// 					'dospeng_2' => $kromosom_akhir[$i][$j][2],
// 					);
// 					$insert = $this->db->query("INSERT INTO data_acak_sp VALUES ($dataindividu)");;
//           }
//     }
		
// 			foreach ($fitness_hasil as $f) {
// 					$datafitness = array(
// 					'fitness' => $f,);
// 					$insert = $this->karyawan->tambahDatafitness($datafitness);
// 		}
// 		redirect('Buat_Jadwal_Proposal');
// 	}
// }

	// public function Genetika()
  // {
	// 	$dataSempro = $this->jadwal_model->getDataSempro();
	// 	$no = 0;
	// 	foreach($dataSempro->result() as $data){
	// 		$this->kode_sp[$no] = $data->kode_sp;
	// 		$this->judul[$no] = $data->judul;
	// 		$this->dosbim_1[$no] = $data->dosbim_1;
	// 		$this->dosbim_2[$no] = $data->dosbim_2;
	// 		$no++;
	// 	}

	// 	// Ambil Data Hari
	// 	$dataHari = $this->jadwal_model->getJadwaHari();
	// 	$no = 0;
	// 	foreach($dataHari->result() as $data){
	// 		$this->kode_hari[$no] = $data->kode_hari;
	// 		$no++;
	// 	}

	// 	// Ambil Data Jam
	// 	$dataJam = $this->jadwal_model->getJadwalJam();
	// 	$no = 0;
	// 	foreach($dataJam->result() as $data){
	// 		$this->kode_jam[$no] = $data->kode_jam;
	// 		$no++;
	// 	}

	// 	// Ambil Data Dospeng 1
	// 	$dataDospeng1 = $this->jadwal_model->getDospeng1();
	// 	$no = 0;
	// 	foreach($dataDospeng1->result() as $data){
	// 		$this->id[$no] = $data->name;
	// 		$no++;
	// 	}

	// 	// Ambil Data Dospeng 2
	// 	$dataDospeng2 = $this->jadwal_model->getDospeng2();
	// 	$no = 0;
	// 	foreach($dataDospeng2->result() as $data){
	// 		$this->id[$no] = $data->name;
	// 		$no++;
	// 	}

		
	// 	$RowsProposal =  count($this->id);
	// 	$RowsHari =  count($this->kode_hari);
	// 	$RowsJam =  count($this->kode_jam);
	// 	$RowsDospeng1 =  count($this->id);
	// 	$RowsDospeng2 =  count($this->id);

	// 	$sql = $this->db->query("TRUNCATE TABLE data_acak_sp");
		
	// 		for($i = 0; $i < $RowsProposal; $i++ ){
	// 			$this->data_individu[$i][0] = $this->id[$i];
	// 			$this->data2 = mt_rand(0,$RowsHari);
	// 			$this->data3 = mt_rand(0,$RowsJam);
	// 			$this->data4 = mt_rand(0,$RowsDospeng1);
	// 			$this->data5 = mt_rand(0,$RowsDospeng2);
		
	// 			if ($this->data2 == 0) {
	// 					$this->data_individu[$i][1] = $this->data2 + 1;
	// 			} else {
	// 					$this->data_individu[$i][1] = $this->data2;
	// 			}
		
	// 			if ($this->data3 == 0) {
	// 					$this->data_individu[$i][2] = $this->data3 + 1;
	// 			} else {
	// 					$this->data_individu[$i][2] = $this->data3;
	// 			}
		
	// 			if ($this->data4 == 0) {
	// 					$this->data_individu[$i][3] = $this->data4 + 1;
	// 			} else {
	// 					$this->data_individu[$i][3] = $this->data4;
	// 			}
		
	// 			if ($this->data5 == 0) {
	// 					$this->data_individu[$i][4] = $this->data5 + 1;
	// 			} else {
	// 					$this->data_individu[$i][4] = $this->data5;
	// 			}
						
	// 			$a = $this->data_individu[$i][0];
	// 			$b = $this->data_individu[$i][1];
	// 			$ccc = $this->data_individu[$i][2];
		
	// 			if ($ccc >= 9) {
	// 				 $c = 8 ; 
	// 			} else {
	// 					$c = $this->data_individu[$i][2];
	// 			}
				
	// 			$d = $this->data_individu[$i][3];
	// 			$e = $this->data_individu[$i][4];
		
	// 	$sql = $this->db->query("INSERT INTO data_acak_sp VALUES ($a,$b,$c,$d,$e)");	

	// 	$penalty_jam = 0;
	// 	$penalty_hari = 0;
	// 	$penalty_dospeng = 0;

	// 		for ($j=0; $j < $i; $j++) { 
	// 			$jam_a = $this->data_individu[$i][2];
	// 			$hari_a = $this->data_individu[$i][1];
	// 			$dospeng_a = $this->data_individu[$i][3];
	// 			$dosbim_a = $this->data_individu[$i][4];
		
	// 					for ($k=0; $k < $j; $k++) { 
	// 							$jam_b = $this->data_individu[$i][2];
	// 							$hari_b = $this->data_individu[$i][1];
	// 							$dospeng_b = $this->data_individu[$i][3];
	// 							$dosbim_b = $this->data_individu[$i][4];

	// 							if ($jam_a == $jam_b){
	// 									$penalty_jam += 1;
	// 							}
	// 							if ($hari_a == $hari_b){
	// 									$penalty_hari +=1;
	// 							}
	// 							if ($dospeng_a == $dospeng_b){ 
	// 									$penalty_dospeng += 1 ; 
	// 							}
	// 							if ($dosbim_a == $dospeng_a){ 
	// 									$penalty_dospeng += 1 ; 
	// 							}
	// 							if ($dosbim_b == $dospeng_a){ 
	// 									$penalty_dospeng += 1 ; 
	// 							}
	// 							if ($dosbim_a == $dospeng_b){ 
	// 									$penalty_dospeng += 1 ; 
	// 							}
	// 							if ($dosbim_b == $dospeng_b){ 
	// 									$penalty_dospeng += 1 ; 
	// 							}

	// 			// end loop j
	// 					}
	// 			// end loop k
	// 		}
	// 		$this->fitness = (1/(1+$penalty_jam+$penalty_hari+$penalty_dospeng));
			
	// 	}

	// 	for ($i=0; $i < $this->RowsProposal ; $i++) { 

	// 		$cek = implode("", $this->data_individu[$i]);
	// 	}
	// }

	// public function acak_jadwal()
	// {
	// $this->Genetika();
	
	// $exf = $this->db->query("SELECT * FROM data_acak_sp");
	
	// $penalty_jam = 0;
	// $penalty_hari = 0;
	// $penalty_dospeng = 0;
	
	// while ($q = $exf->fetch(PDO::FETCH_NUM)) {
	// 	$hari_a = $q[1];
	// 	$jam_a = $q[2];
	// 	$dospeng_a = $q[3];
	// 	while ($qq = $exf->fetch(PDO::FETCH_NUM)) {
	// 		$hari_b = $qq[1];
	// 			$jam_b = $qq[2];
	// 			$dospeng_b = $qq[3];
	
	// 			if ($jam_a == $jam_b){
	// 			$penalty_jam += 1;
	// 			}
	// 			if ($hari_a == $hari_b){
	// 					$penalty_hari +=1;
	// 			}
	// 			if ($dospeng_a == $dospeng_b){ 
	// 				$penalty_dospeng += 1 ; 
	// 			}
	// 	}
	// }
	
	// $fitness = floatval(1/(1+$penalty_jam+$penalty_hari+$penalty_dospeng));
	
	// echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.base_url().'menu/buat_jadwal_proposal&&fit='.$fitness.'">';
	
	
	// }
}
