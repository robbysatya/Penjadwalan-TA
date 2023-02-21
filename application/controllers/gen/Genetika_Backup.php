<?php
defined('BASEPATH') or exit('No direct script access allowed');

class generate_sempro extends CI_Controller
{
	private $populasi;
	private $crossOver;
	private $mutasi;
	
	public $RowsProposal = [];
	public $RowsHari = [];
	public $RowsJam = [];
	public $RowsDospeng1 = [];
	public $RowsDospeng2 = [];

	public $data1 = [];
	public $data2 = [];
	public $data3 = [];
	public $data4 = [];
	public $data5 = [];

	public $fitness = [];

	public $data_individu = array(array(array()));

  public function __construct()
  {
		parent::__construct();
    $this->load->model('jadwal_model');
  }

  public function AmbilData()
  {
		$dataSempro = $this->jadwal_model->getDataSempro();
		$no = 0;
		foreach($dataSempro->result() as $data){
			$this->id[$no] = $data->id;
			$no++;
		}

		// Ambil Data Hari
		$dataHari = $this->jadwal_model->getJadwaHari();
		$no = 0;
		foreach($dataHari->result() as $data){
			$this->kode_hari[$no] = $data->kode_hari;
			$no++;
		}

		// Ambil Data Jam
		$dataJam = $this->jadwal_model->getJadwalJam();
		$no = 0;
		foreach($dataJam->result() as $data){
			$this->kode_jam[$no] = $data->kode_jam;
			$no++;
		}

		// Ambil Data Dospeng 1
		$dataDospeng1 = $this->jadwal_model->getDospeng1();
		$no = 0;
		foreach($dataDospeng1->result() as $data){
			$this->id[$no] = $data->name;
			$no++;
		}

		// Ambil Data Dospeng 2
		$dataDospeng2 = $this->jadwal_model->getDospeng2();
		$no = 0;
		foreach($dataDospeng2->result() as $data){
			$this->id[$no] = $data->name;
			$no++;
		}
	}

	// INISIALISASI
	public function Inisialisai($populasi)
	{
		$RowsProposal =  count($this->kode_sp);
		$RowsHari =  count($this->kode_hari);
		$RowsJam =  count($this->kode_jam);
		$RowsDospeng1 =  count($this->id);
		$RowsDospeng2 =  count($this->id);
		
		for($i = 0; $i < $populasi; $i++ ){
			for($j = 0; $j < $RowsProposal; $j++ ){
				$this->data_individu[$i][0] = $this->kode_up[$i];
				$this->data2 = mt_rand(0,$RowsHari);
				$this->data3 = mt_rand(0,$RowsJam);
				$this->data4 = mt_rand(0,$RowsDospeng1);
				$this->data5 = mt_rand(0,$RowsDospeng2);
		
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
		
				$a = $this->data_individu[$i][$j][0];
						
				$b = $this->data_individu[$i][$j][1];
				$ccc = $this->data_individu[$i][$j][2];
		
				if ($ccc >= 9) {
					 $c = 8 ; 
				} else {
						$c = $this->data_individu[$i][2];
				}
				
				$d = $this->data_individu[$i][3];
		
				$this->db->query("INSERT INTO data_acak_sp VALUES ($a,$b,$c,$d)");
			}	
		}
	}

	private function CekFitness()
	{
			$RowsProposal =  count($this->kode_sp);

			$penalty_jam = 0;
			$penalty_hari = 0;
			$penalty_dospeng = 0;

			for ($i=0; $i < $RowsProposal; $i++) { 
				$jam_a = $this->data_individu[$i][2];
				$hari_a = $this->data_individu[$i][1];
				$dospeng_a = $this->data_individu[$i][3];
				$dosbim_a = $this->data_individu[$i][4];
		
						for ($j=0; $j < $RowsProposal; $j++) { 
								$jam_b = $this->data_individu[$i][2];
								$hari_b = $this->data_individu[$i][1];
								$dospeng_b = $this->data_individu[$i][3];
								$dosbim_b = $this->data_individu[$i][4];

								if ($jam_a == $jam_b){
										$penalty_jam += 1;
								}
								if ($hari_a == $hari_b){
										$penalty_hari +=1;
								}
								if ($dospeng_a == $dospeng_b){ 
										$penalty_dospeng += 1 ; 
								}
								if ($dosbim_a == $dospeng_a){ 
										$penalty_dospeng += 1 ; 
								}
								if ($dosbim_b == $dospeng_a){ 
										$penalty_dospeng += 1 ; 
								}
								if ($dosbim_a == $dospeng_b){ 
										$penalty_dospeng += 1 ; 
								}
								if ($dosbim_b == $dospeng_b){ 
										$penalty_dospeng += 1 ; 
								}

				// end loop j
						}
				// end loop k
			}
			$fitness = (1/(1+$penalty_jam+$penalty_hari+$penalty_dospeng));
			
			return $fitness;
		}

		// HITUNG FITNESS
		public function HitungFitness()
		{
			for($indv = 0; $indv < $this->populasi; $indv++){
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
                
                if ( $fitnessA > $fitnessB ) $rank[$i] += 1;                    
                
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
											$individuBaru[$i][$j][$k]     = $this->individu[$this->induk[$i]][$j][$k];
											$individuBaru[$i + 1][$j][$k] = $this->individu[$this->induk[$i + 1]][$j][$k];
									}
							}
							
							// Penentuan jadwal baru dai titik pertama sampai titik kedua
							for ($j = $a; $j < $b; $j++) {
									for ($k = 0; $k < 4; $k++) {
											$individuBaru[$i][$j][$k]     = $this->individu[$this->induk[$i + 1]][$j][$k];
											$individuBaru[$i + 1][$j][$k] = $this->individu[$this->induk[$i]][$j][$k];
									}
							}
							
							// Penentuan jadwal baru dari titik kedua sampai akhir
							for ($j = $b; $j < $RowsProposal; $j++) {
									for ($k = 0; $k < 4; $k++) {
											$individuBaru[$i][$j][$k]     = $this->individu[$this->induk[$i]][$j][$k];
											$individuBaru[$i + 1][$j][$k] = $this->individu[$this->induk[$i + 1]][$j][$k];
									}
							}
					} else { 

							// Ketika nilai random lebih dari nilai probabilitas pertukaran, maka jadwal baru sama dengan jadwal terpilih
							for ($j = 0; $j < $RowsProposal; $j++) {
									for ($k = 0; $k < 4; $k++) {
											$individuBaru[$i][$j][$k]     = $this->individu[$this->induk[$i]][$j][$k];
											$individuBaru[$i + 1][$j][$k] = $this->individu[$this->induk[$i + 1]][$j][$k];
									}
							}
					}
			}
			
			$RowsProposal = count($this->RowsProposal);
			
			for ($i = 0; $i < $this->populasi; $i += 2) {
					for ($j = 0; $j < $RowsProposal; $j++) {
							for ($k = 0; $k < 4; $k++) {
									$this->individu[$i][$j][$k] = $individuBaru[$i][$j][$k];
									$this->individu[$i + 1][$j][$k] = $individuBaru[$i + 1][$j][$k];
							}
					}
			}
		}

		public function Mutasi()
		{
			$fitness = [];

			$r              = mt_rand(0, mt_getrandmax() - 1) / mt_getrandmax();
			$RowsProposal   = count($this->RowsProposal);
			$jumlahJam      = count($this->jam);
			$jumlahHari     = count($this->hari);
			$jumlahDospeng1 = count($this->RowsDospeng1);
			$jumlahDospeng2 = count($this->RowsDospeng2);

			for ($i = 0; $i < $this->populasi; $i++) {

				//Ketika nilai random kurang dari nilai probalitas Mutasi, 
				//maka terjadi penggantian komponen
				
				if ($r < $this->mutasi) {

						//Penentuan pada matakuliah dan kelas yang mana yang akan dirandomkan atau diganti
						$krom = mt_rand(0, $RowsProposal - 1);
						
						$j = intval($this->sks[$krom]);
						
						switch ($j) {
								case 1:
										$this->individu[$i][$krom][1] = mt_rand(0, $jumlahJam - 1);
										break;
								case 2:
										$this->individu[$i][$krom][1] = mt_rand(0, ($jumlahJam - 1) - 1);
										break;
								case 3:
										$this->individu[$i][$krom][1] = mt_rand(0, ($jumlahJam - 1) - 2);
										break;
								case 4:
										$this->individu[$i][$krom][1] = mt_rand(0, ($jumlahJam - 1) - 3);
										break;
						}
						//Proses penggantian hari
						$this->individu[$i][$krom][3] = mt_rand(0, $jumlahHari - 1);
						
						//proses penggantian ruang               
						if ($this->RowsDospeng1[$krom] == $this->RowsDosbim1) {
								$this->individu[$i][$krom][3] = $this->RowsDospeng1[mt_rand(0, $jumlahDospeng1 - 1)];
						} else if($this->RowsDospeng1[$krom] == $this->RowsDosbim2) {
								$this->individu[$i][$krom][3] = $this->RowsDospeng1[mt_rand(0, $jumlahDospeng1 - 1)];
						} else if($this->RowsDospeng2[$krom] == $this->RowsDosbim1) {
							$this->individu[$i][$krom][3] = $this->RowsDospeng2[mt_rand(0, $jumlahDospeng2 - 1)];
						} else if($this->RowsDospeng2[$krom] == $this->RowsDosbim2) {
							$this->individu[$i][$krom][3] = $this->RowsDospeng2[mt_rand(0, $jumlahDospeng2 - 1)];
						}
				}
					$fitness[$i] = $this->CekFitness($i);
			}
			return $fitness;
		}

		public function GetIndividu($indv) {

			$individuSolusi = [[]];
			for ($j = 0; $j < count($this->RowsProposal); $j++){
					$individuSolusi[$j][0] = intval($this->RowsProposal[$this->individu[$indv][$j][0]]);
					$individuSolusi[$j][1] = intval($this->jam[$this->individu[$indv][$j][1]]);
					$individuSolusi[$j][2] = intval($this->hari[$this->individu[$indv][$j][2]]);                        
					$individuSolusi[$j][3] = intval($this->RowsDospeng1[$this->individu[$indv][$j][3]]);                        
					$individuSolusi[$j][4] = intval($this->RowsDospeng2[$this->individu[$indv][$j][4]]);                        
					$individuSolusi[$j][5] = intval($this->individu[$indv][$j][5]);            
			}
			
			return $individuSolusi;
	}
	
}

// $t = new generate_sempro;
// $t->buatJadwal();

// $exf = $this->db->query("SELECT * FROM data_acak_sp");

// $penalty_jam = 0;
// $penalty_hari = 0;
// $penalty_dospeng = 0;

// while ($q = $exf->fetch(PDO::FETCH_NUM)) {
// 	$jam_a = $q[2];
// 	$hari_a = $q[1];
// 	$dospeng_a = $q[3];
// 	while ($qq = $exf->fetch(PDO::FETCH_NUM)) {
// 			$jam_b = $qq[2];
// 			$hari_b = $qq[1];
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
