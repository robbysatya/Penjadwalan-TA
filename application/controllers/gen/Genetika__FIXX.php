$dataSempro = $this->jadwal_model->getDataSempro();
		$no = 0;
		foreach ($dataSempro->result() as $data) {
			$this->kode_sp[$no] = $data->kode_sp;
			$no++;
		}

		// Ambil Data Hari
		$dataHari = $this->jadwal_model->getJadwaHariDosen();
		$no = 0;
		foreach ($dataHari->result() as $data) {
			$this->hari[$no] = $data->kode_hari;
			$no++;
		}

		// Ambil Data Jam
		$dataJam = $this->jadwal_model->getJadwalJamDosen();
		$no = 0;
		foreach ($dataJam->result() as $data) {
			$this->jam[$no] = $data->kode_jam;
			$no++;
		}

		// Ambil Data Dospeng 1
		$dataDospeng1 = $this->jadwal_model->getJadwalDospeng1();
		$no = 0;
		foreach ($dataDospeng1->result() as $data) {
			$this->id_dosen_1[$no] = $data->id;
			$no++;
		}

		// Ambil Data Dospeng 2
		$dataDospeng2 = $this->jadwal_model->getJadwalDospeng2();
		$no = 0;
		foreach ($dataDospeng2->result() as $data) {
			$this->id_dosen_2[$no] = $data->id;
			$no++;
		}

		// Ambil Data Dosbim1
		$dataDosbim = $this->jadwal_model->getDosbim();
		$no = 0;
		foreach ($dataDosbim->result() as $data) {
			$this->dosbim_1[$no] = $data->dosbim_1;
			$this->dosbim_2[$no] = $data->dosbim_2;
			$no++;
		}
		// Ambil Data Dosbim2
		// $dataDosbim2 = $this->jadwal_model->getDosbim2();
		// $no = 0;
		// foreach($dataDosbim2->result() as $data){
		// 	$this->dosbim_2[$no] = $data->dosbim_2;
		// 	$no++;
		// }



		$RowsProposal =  count($this->kode_sp);
		$RowsHari =  count($this->hari);
		$RowsJam =  count($this->jam);
		$RowsDospeng1 =  count($this->id_dosen_1);
		$RowsDospeng2 =  count($this->id_dosen_2);
		$RowsDosbim1 =  $this->dosbim_1;
		$RowsDosbim2 =  $this->dosbim_2;

		$this->db->query("TRUNCATE TABLE data_acak_sp");

	for ($i = 0; $i < $RowsProposal; $i++) {
		$this->data_individu[$i][0] = $this->kode_sp[$i];
		$this->data_individu[$i][5] = $this->dosbim_1[$i];
		$this->data_individu[$i][6] = $this->dosbim_2[$i];
		$this->data2 = mt_rand(0, $RowsHari);
		$this->data3 = mt_rand(0, $RowsJam);
		$this->data4 = mt_rand(0, $RowsDospeng1);
		$this->data5 = mt_rand(0, $RowsDospeng2);

		if ($this->data2 == 0) {
			$this->data_individu[$i][1] = $this->data2 + 1;
		} else {
			$this->data_individu[$i][1] = $this->data2;
		}

		if ($this->data3 == 0) {
			$this->data_individu[$i][2] = $this->data3 + 1;
		} else {
			$this->data_individu[$i][2] = $this->data3;
		}

		if ($this->data4 == 0) {
			$this->data_individu[$i][3] = $this->data4 + 1;
		} else if ($this->data4 == $this->data5) {
			$this->data_individu[$i][3] = $this->data4 + 1;
		} else {
			$this->data_individu[$i][3] = $this->data4 ;
		}

		if ($this->data5 == 0) {
			$this->data_individu[$i][4] = $this->data5 + 1;
		} else if ($this->data5 == $this->data4){
			$this->data_individu[$i][4] = $this->data5 + 1;
		} else {
			$this->data_individu[$i][4] = $this->data5;
		}

		$a = $this->data_individu[$i][0];
		$bb = $this->data_individu[$i][1];
		$cc = $this->data_individu[$i][2];
		
		$d = $this->data_individu[$i][3];
		$e = $this->data_individu[$i][4];

		if ($bb >= $RowsHari) {
			$b = mt_rand(1, $RowsHari);
		} else {
			$b = $this->data_individu[$i][1];
		}

		if ($cc >= $RowsJam) {
			$c = mt_rand(1, $RowsJam);
		} else {
			$c = $this->data_individu[$i][2];
		}

		// if ($dd == $this->data_individu[$i][4]){
		// 	$d = $this->data_individu[$i][3] + 1;
		// } else if ($dd >= $RowsDospeng1) {
		// 	$d = mt_rand(0, $RowsDospeng1);
		// } else if($dd == $this->data_individu[$i][5]){
		// 	$d = $this->data_individu[$i][3] + 1;
		// } else if($dd == $this->data_individu[$i][6]){
		// 	$d = $this->data_individu[$i][3] + 1;
		// } else {
		// 	$d = $this->data_individu[$i][3];
		// }

		// if ($ee == $this->data_individu[$i][3]){
		// 	$e = $this->data_individu[$i][4] + 1;
		// } else if($ee >= $RowsDospeng2){
		// 	$e = mt_rand(0, $RowsDospeng2);
		// } else if($ee == $this->data_individu[$i][5]){
		// 	$e = $this->data_individu[$i][4] + 1;
		// } else if($ee == $this->data_individu[$i][6]){
		// 	$e = $this->data_individu[$i][4] + 1;
		// } else {
		// 	$e = $this->data_individu[$i][4];
		// }

		// if ($dd == $this->data_individu[$i][3]){
		// 	$d = $this->data_individu[$i][3] + 1;
		// } else {
		// 	$d = $this->data_individu[$i][3];
		// }

		// if ($ee == $this->data_individu[$i][4]){
		// 	$e = $this->data_individu[$i][4] + 1;
		// } else {
		// 	$e = $this->data_individu[$i][4];
		// }
		
		$this->db->query("INSERT INTO data_acak_sp VALUES ($a,$b,$c,$d,$e)");

		$penalty_jam = 0;
		$penalty_hari = 0;
		$penalty_dospeng = 0;

		for ($j = 0; $j < $i; $j++) {
			// $this->kode_sp[$j] = $this->data_individu[$i][0];
			$hari_a = $this->data_individu[$i][1];
			$jam_a = $this->data_individu[$i][2];
			$dospeng_a = $this->data_individu[$i][3];
			$dosbim_a = $this->data_individu[$i][5];

			for ($k = 0; $k < $i; $k++) { 
				$hari_b = $this->data_individu[$i][1];
				$jam_b = $this->data_individu[$i][2];
				$dospeng_b = $this->data_individu[$i][4];
				$dosbim_b = $this->data_individu[$i][6];
				if ($hari_a == $hari_b) {
					$penalty_hari += 1;
				}
				if ($jam_a == $jam_b) {
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

			// var_dump($penalty_dospeng);die;
			// end loop k
			$fitness = floatval(1 / (1 + $penalty_jam + $penalty_hari + $penalty_dospeng));
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.base_url().'menu/buat_jadwal_proposal?fit='.$fitness.'">';
		}
		
	}

		for ($i = 0; $i < $this->RowsProposal; $i++) {
			implode("", $this->data_individu[$i]);
		}