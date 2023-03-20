$populasi = $this->input->post('populasi');
		$crossOver = $this->input->post('crossover');
		$mutasi = $this->input->post('mutasi');
		$jumlah_generasi = $this->input->post('jumlah_generasi');

		$data['populasi'] = $populasi;
		$data['crossover'] = $crossOver;
		$data['mutasi'] = $mutasi;
		$data['jumlah_generasi'] = $jumlah_generasi;
		
		$Gen = new Genetika($populasi,$crossOver,$mutasi);

		$Gen->AmbilData();
		$Gen->Inisialisai();

		for($i = 0;$i < $jumlah_generasi;$i++ ){
			$fitness = $Gen->HitungFitness();

			$Gen->Seleksi($fitness);
			$Gen->StartCrossOver();
			
			$fitnessAfterMutation = $Gen->Mutasi();

			for ($j = 0; $j < count($fitnessAfterMutation); $j++){
				//test here
				if($fitnessAfterMutation[$j] == 1){
					
					$this->db->query("TRUNCATE TABLE data_acak_sp");
					
					$jadwal_sp = array(array(array(array(array()))));
					$jadwal_sp = $Gen->GetIndividu($j);
					
					
					
					for($k = 0; $k < count($jadwal_sp);$k++){
						
						$kode_sp = intval($jadwal_sp[$k][0]);
						$jam = intval($jadwal_sp[$k][1]);
						$hari = intval($jadwal_sp[$k][2]);
						$dospeng_1 = intval($jadwal_sp[$k][3]);
						$dospeng_2 = intval($jadwal_sp[$k][4]);
						$this->db->query("INSERT INTO data_acak_sp(kode_sp,jam,hari,dospeng_1,dospeng_2) ".
										 "VALUES($kode_sp,$jam,$hari,$dospeng_1,$dospeng_2)");
						
						
					}
					
					//var_dump($jadwal_kuliah);
					//exit();
					
					$found = true;								
				}
				
				if($found){break;}
			}
		}
	
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL='.base_url().'menu/buat_jadwal_proposal?fit='.$fitness.'">';