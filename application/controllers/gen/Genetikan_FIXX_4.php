// $populasi = $this->input->post('populasi');
// $crossOver = $this->input->post('crossover');
// $mutasi = $this->input->post('mutasi');
// $jumlah_generasi = $this->input->post('jumlah_generasi');

$populasi = 10;
// $data['crossover'] = $crossOver;
// $data['mutasi'] = $mutasi;
// $data['jumlah_generasi'] = $jumlah_generasi;

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

$RowsProposal = count($this->kode_sp);
$RowsHari = count($this->hari);
$RowsJam = count($this->jam);
$RowsDospeng1 = count($this->id_dosen_1);
$RowsDospeng2 = count($this->id_dosen_2);

$this->db->query("TRUNCATE TABLE data_acak_sp");

for ($i = 0; $i < $RowsProposal; $i++) { $this->data_individu[$i][0] = $this->kode_sp[$i];
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
    $this->data_individu[$i][3] = $this->data4;
    }

    if ($this->data5 == 0) {
    $this->data_individu[$i][4] = $this->data5 + 1;
    } else if ($this->data5 == $this->data4) {
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

    $this->db->query("INSERT INTO data_acak_sp VALUES ($a,$b,$c,$d,$e)");
    }

    // CEK FITNESS DAN HITUNG FITNESS
    for ($i = 0; $i < $populasi; $i++) { $penalty_jam=0; $penalty_hari=0; $penalty_dospeng=0; for ($j=0; $j < $RowsProposal; $j++) { // $this->kode_sp[$j] = $this->data_individu[$i][0];
        $hari_a = $this->data_individu[$i][$j][1];
        $jam_a = $this->data_individu[$i][$j][2];
        $dospeng_a = $this->data_individu[$i][$j][3];
        $dosbim_a = $this->data_individu[$i][$j][5];

        for ($k = 0; $k < $RowsProposal; $k++) { $hari_b=$this->data_individu[$i][$j][1];
            $jam_b = $this->data_individu[$i][$j][2];
            $dospeng_b = $this->data_individu[$i][$j][4];
            $dosbim_b = $this->data_individu[$i][$j][6];
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
            // end loop k
            $fitness = floatval(1 / (1 + $penalty_jam + $penalty_hari + $penalty_dospeng));
            }
            }

            $jumlah = 0;
            $rank = [];


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

                        $cek = 0;
                        for ($j = 0; $j < $jumlahRank; $j++) { $cek +=$rank[$j]; if (intval($cek)>= intval($target)) {
                            $this->induk[$i] = $j;
                            break;
                            }
                            }
                            }

                            // CROSSOVER

                            $individuBaru = [[[]]];
                            $RowsProposal = count($this->kode_sp);

                            for ($i = 0; $i < $this->populasi; $i += 2) {
                                $b = 0;
                                $cr = mt_rand(0, mt_getrandmax() - 1) / mt_getrandmax();
                                if (floatval($cr) < floatval($this->crossOver)) {
                                    //ketika nilai random kurang dari nilai probabilitas pertukaran
                                    //maka jadwal mengalami prtukaran

                                    $a = mt_rand(0, $RowsProposal - 2);
                                    while ($b <= $a) { $b=mt_rand(0, $RowsProposal - 1); } //penentuan jadwal baru dari awal sampai titik pertama for ($j=0; $j < $a; $j++) { for ($k=0; $k < 4; $k++) { $individuBaru[$i][$j][$k]=$this->data_individu[$this->induk[$i]][$j][$k];
                                        $individuBaru[$i + 1][$j][$k] = $this->data_individu[$this->induk[$i + 1]][$j][$k];
                                        }
                                        }

                                        // Penentuan jadwal baru dai titik pertama sampai titik kedua
                                        for ($j = $a; $j < $b; $j++) { for ($k=0; $k < 4; $k++) { $individuBaru[$i][$j][$k]=$this->data_individu[$this->induk[$i + 1]][$j][$k];
                                            $individuBaru[$i + 1][$j][$k] = $this->data_individu[$this->induk[$i]][$j][$k];
                                            }
                                            }

                                            // Penentuan jadwal baru dari titik kedua sampai akhir
                                            for ($j = $b; $j < $RowsProposal; $j++) { for ($k=0; $k < 4; $k++) { $individuBaru[$i][$j][$k]=$this->data_individu[$this->induk[$i]][$j][$k];
                                                $individuBaru[$i + 1][$j][$k] = $this->data_individu[$this->induk[$i + 1]][$j][$k];
                                                }
                                                }
                                                } else {

                                                // Ketika nilai random lebih dari nilai probabilitas pertukaran, maka jadwal baru sama dengan jadwal terpilih
                                                for ($j = 0; $j < $RowsProposal; $j++) { for ($k=0; $k < 4; $k++) { $individuBaru[$i][$j][$k]=$this->data_individu[$this->induk[$i]][$j][$k];
                                                    $individuBaru[$i + 1][$j][$k] = $this->data_individu[$this->induk[$i + 1]][$j][$k];
                                                    }
                                                    }
                                                    }
                                                    }

                                                    $RowsProposal = count($this->kode_sp);

                                                    for ($i = 0; $i < $this->populasi; $i += 2) {
                                                        for ($j = 0; $j < $RowsProposal; $j++) { for ($k=0; $k < 4; $k++) { $this->data_individu[$i][$j][$k] = $individuBaru[$i][$j][$k];
                                                            $this->data_individu[$i + 1][$j][$k] = $individuBaru[$i + 1][$j][$k];
                                                            }
                                                            }
                                                            }

                                                            return $individuBaru;


                                                            $fitness = [];
                                                            $mutasi = 0.4;

                                                            $r = mt_rand(0, mt_getrandmax() - 1) / mt_getrandmax();
                                                            $RowsProposal = count($this->kode_sp);
                                                            $RowsJam = count($this->jam);
                                                            $RowsHari = count($this->hari);
                                                            $RowsDospeng1 = count($this->dospeng_1);
                                                            $RowsDospeng2 = count($this->dospeng_2);

                                                            for ($i = 0; $i < $populasi; $i++) { //Ketika nilai random kurang dari nilai probalitas Mutasi, //maka terjadi penggantian komponen if ($r < $mutasi) { //Penentuan pada matakuliah dan kelas yang mana yang akan dirandomkan atau diganti // $krom=mt_rand(0, $RowsProposal - 1); $this->data_individu[$i][1] = mt_rand(0, $RowsJam - 1);
                                                                //Proses penggantian hari
                                                                $this->data_individu[$i][2] = mt_rand(0, $RowsHari - 1);

                                                                //proses penggantian ruang
                                                                $this->data_individu[$i][3] = $this->id_dosen[mt_rand(0, $RowsDospeng1 - 1)];
                                                                $this->data_individu[$i][4] = $this->id_dosen[mt_rand(0, $RowsDospeng2 - 1)];
                                                                }

                                                                $fitness[$i] = $this->CekFitness($i);
                                                                echo '
                                                                <META HTTP-EQUIV="Refresh" Content="0; URL=' . base_url() . 'menu/buat_jadwal_proposal?fit=' . $fitness . '">';
                                                                }

                                                                for ($i = 0; $i < $this->RowsProposal; $i++) {
                                                                    $cek = implode("", $this->data_individu[$i]);
                                                                    }