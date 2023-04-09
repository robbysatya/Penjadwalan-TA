    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

      <?php if (validation_errors()) : ?>
        <div class="alert alert-danger" role="alert">
          <?= validation_errors(); ?>
        </div>
      <?php endif; ?>
      <?= $this->session->flashdata('message');  ?>

      <!-- Form Buat Jadwal -->
      <div class="row">
        <div class="card mb-2 col-md-6" style="padding: 0;">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Proses Buat Jadwal Sempro</h6>
          </div>
          <form action="<?= base_url('menu/Buat_Jadwal_Proposal/Genetika'); ?>" method="post">
            <div class="card-body">
              <div class="row col-sm-12">
                <label class="col-sm-4">Fitness</label>
                <div class="col-sm-8">
                  <?php error_reporting(0);
                  if ($_GET['fit'] == '') {
                    $fit = 0;
                  } else {
                    $fit = $_GET['fit'];
                  }
                  ?>
                  <input type="text" name="fitness" class="form-control" id="fitness" placeholder="Nilai Fitness" readonly="Readonly" value="<?php echo $fit ?>">
                </div>
              </div>

              <div class="row col-sm-12 pt-2">
                <label class="col-sm-4">Populasi</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="populasi" value="<?php echo isset($populasi) ? $opulasi : '500'; ?>">
                </div>
              </div>

              <div class="row col-sm-12 pt-2">
                <label class="col-sm-4">Crossover</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="crossover" value="<?php echo isset($crossover) ? $crossover : '0.7'; ?>">
                </div>
              </div>

              <div class="row col-sm-12 pt-2">
                <label class="col-sm-4">Mutasi</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="mutasi" value="<?php echo isset($mutasi) ? $mutasi : '0.3'; ?>">
                </div>
              </div>

              <div class="row col-sm-12 pt-2">
                <label class="col-sm-4">Jumlah Generasi</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" name="jumlah_generasi" value="<?php echo isset($jumlah_generasi) ? $jumlah_generasi : '100'; ?>">
                </div>
              </div>

              <!-- <div class="row col-sm-12 pt-2">
              <label class="col-sm-4">Generasi</label>
              <div class="col-sm-8">
                <input type="text" name="jumlah_generasi" class="form-control">
              </div>
            </div> -->

              <!-- <div class="row col-sm-12 pt-2">
						<label for="" class="col-sm-4">Jadwal Bentrok</label>
						<div class="col-sm-8">	
							<input type="text" name="bentrok" class="form-control" id="bentrok" placeholder="Jadwal Bentrok" readonly="Readonly" value="0" >
						</div>
					</div>

            <!- Button Buat Jadwal -->
              <div class="col-sm-4 pt-4">
                <button class="btn btn-success mb-3" type="submit"><i class="fas fa-sync-alt"></i> Buat Jadwal</button>
              </div>
            </div>
          </form>
        </div>

        <div class="card mb-2 col-md-6" style="padding: 0;">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Simpan Jadwal Sempro</h6>
          </div>
          <form action="<?= base_url('menu/buat_jadwal_proposal/simpan_jadwal') ?>" method="post">
            <div class="card-body">
              <div class="row col-sm-12 pt-2">
                <label for="" class="col-sm-4">Kode Jadwal</label>
                <div class="col-sm-8">
                  <?php
                  $host       =   "localhost";
                  $user       =   "root";
                  $password   =   "";
                  $database   =   "db_penjadwalan_ta";
                  // perintah php untuk akses ke database
                  $koneksi = new PDO("mysql:host={$host};dbname={$database}", $user, $password);
                  $koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                  $sql =  "SELECT max(kode_jadwal_sp) as kode_jadwal_sp FROM tb_jadwal_proposal";

                  $result = $koneksi->query($sql);

                  while ($r = $result->fetch(PDO::FETCH_ASSOC)) {
                    if ($result->rowCount() == 1) {
                      $kode_jadwal = $r['kode_jadwal_sp'];
                      $waktu = "SP" . date('dmY');
                      $kode_jadwal_new = $waktu;
                    } else {
                      $kode_jadwal_new = "SP" . date('dmY');
                    }
                  }

                  ?>

                  <input type="text" name="kode_jadwal_sp" class="form-control" id="kode_jadwal_sp" placeholder="Kode Jadwal" readonly="Readonly" value="<?php echo $kode_jadwal_new;  ?>">
                </div>
              </div>

              <div class="row col-sm-12 pt-2">
                <!-- Logika Tahun Ajaran -->
                <?php
                $bln = date('m');
                $thn = date('Y');
                if ($bln <= 6) {
                  $tahun = $thn - 1;
                  $output = "$tahun/$thn";
                }
                if ($bln >= 7) {
                  $tahun = $thn + 1;
                  $output = "$thn/$tahun";
                }
                ?>
                <label for="" class="col-sm-4">Tahun Ajaran</label>
                <div class="col-sm-8">
                  <input type="text" name="tahun_ajaran" class="form-control" id="tahun_ajaran" placeholder="Tahun Ajaran" readonly="Readonly" value="<?php echo $output; ?>">
                </div>
              </div>

              <div class="row col-sm-12 pt-2">
                <label for="" class="col-sm-4">Periode</label>
                <div class="col-sm-8">
                  <select name="periode" id="periode" class="custom-select">
                    <option value="Periode 1">Periode 1</option>
                    <option value="Periode 2">Periode 2</option>
                    <option value="Periode 3">Periode 3</option>
                    <option value="Periode 4">Periode 4</option>
                    <option value="Periode 5">Periode 5</option>
                    <option value="Periode 6">Periode 6</option>
                  </select>
                </div>
              </div>

              <!-- <div class="row col-sm-12 pt-2">
                <label for="" class="col-sm-4">Tanggal</label>
                <div class="col-sm-4">
                  <label for="">Mulai</label>
                  <input type="date" class="form-control" name="tanggal_mulai" id="tanggal_mulai">
                </div>
                <div class="col-sm-4">
                  <label for="">Akhir</label>
                  <input type="date" class="form-control" name="tanggal_akhir" id="tanggal_akhir">
                </div>
              </div> -->

              <div class="col-sm-12 pt-4">
                <p class="m-0 font-weight-bold" style="color: red;">*Pastikan data jadwal sudah benar, sebelum menyimpan data!</p>
              </div>
              <!-- Button Simpan Jadwal -->
              <div class="col-sm-4 pt-4">
                <button class="btn btn-primary mb-3"><i class="fas fa-save"></i> Simpan Jadwal</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <!-- DataTables -->
      <div class="card mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Tabel Jadwal Seminar Proposal</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 14px;">
              <thead>
                <tr>
                  <th>No</th>
                  <!-- <th>Nama</th> -->
                  <th>Judul Penelitian</th>
                  <th>Dosbim 1</th>
                  <th>Dosbim 2</th>
                  <th>Dospeng 1</th>
                  <th>Dospeng 2</th>
                  <th>Jam</th>
                  <th>Hari</th>
                  <th>Tanggal</th>
                  <th>Link Zoom</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <!-- Fungsi Untuk Mengubah Nama Bulan Menjadi Bahasa Indonesia -->
                <?php function tanggal_indo($tanggal)
                {
                  $bulan = array(
                    1 =>   'Januari',
                    'Februari',
                    'Maret',
                    'April',
                    'Mei',
                    'Juni',
                    'Juli',
                    'Agustus',
                    'September',
                    'Oktober',
                    'November',
                    'Desember'
                  );
                  $split = explode('-', $tanggal);
                  return $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];
                } ?>
                <?php $no = 1; ?>
                <?php foreach ($data_proposal as $dp => $data) : ?>
                  <?php if ($data_dospeng1[$dp]['name'] ==  $data_dospeng2[$dp]['name']) { ?>
                    <tr style="background: red; color: white;">
                      <td scope="row"><?= $no; ?></td>
                      <!-- <td><?= $data['name']; ?></td> -->
                      <td><?= $data['judul']; ?></td>
                      <td><?= $data_dosbim1[$dp]['name']; ?></td>
                      <td><?= $data_dosbim2[$dp]['name']; ?></td>
                      <td><?= $data_dospeng1[$dp]['name']; ?></td>
                      <td><?= $data_dospeng2[$dp]['name']; ?></td>
                      <td><?= $data_jam[$dp]['range_jam']; ?></td>
                      <td><?= $data_hari[$dp]['nama_hari']; ?></td>
                      <td><?= tanggal_indo($data_jadwal[$dp]['tanggal']); ?></td>
                      <td><a href="<?= $data_jadwal[$dp]['link']; ?>" target="_blank"><?= $data_jadwal[$dp]['link']; ?></a></td>
                      <td><button type="button" class="btn btn-primary input-block-level" data-toggle="modal" data-target="#editJadwalModal<?= $data['kode_sp']; ?>">Edit</button></td>
                    </tr>
                  <?php } else if ($data_dosbim1[$dp]['name'] ==  $data_dospeng1[$dp]['name']) { ?>
                    <tr style="background: red; color: white;">
                      <td scope="row"><?= $no; ?></td>
                      <!-- <td><?= $data['name']; ?></td> -->
                      <td><?= $data['judul']; ?></td>
                      <td><?= $data_dosbim1[$dp]['name']; ?></td>
                      <td><?= $data_dosbim2[$dp]['name']; ?></td>
                      <td><?= $data_dospeng1[$dp]['name']; ?></td>
                      <td><?= $data_dospeng2[$dp]['name']; ?></td>
                      <td><?= $data_jam[$dp]['range_jam']; ?></td>
                      <td><?= $data_hari[$dp]['nama_hari']; ?></td>
                      <td><?= tanggal_indo($data_jadwal[$dp]['tanggal']); ?></td>
                      <td><a href="<?= $data_jadwal[$dp]['link']; ?>" target="_blank"><?= $data_jadwal[$dp]['link']; ?></a></td>
                      <td><button type="button" class="btn btn-primary input-block-level" data-toggle="modal" data-target="#editJadwalModal<?= $data['kode_sp']; ?>">Edit</button></td>
                    </tr>

                  <?php } else if ($data_dosbim1[$dp]['name'] ==  $data_dospeng2[$dp]['name']) { ?>
                    <tr style="background: red; color: white;">
                      <td scope="row"><?= $no; ?></td>
                      <!-- <td><?= $data['name']; ?></td> -->
                      <td><?= $data['judul']; ?></td>
                      <td><?= $data_dosbim1[$dp]['name']; ?></td>
                      <td><?= $data_dosbim2[$dp]['name']; ?></td>
                      <td><?= $data_dospeng1[$dp]['name']; ?></td>
                      <td><?= $data_dospeng2[$dp]['name']; ?></td>
                      <td><?= $data_jam[$dp]['range_jam']; ?></td>
                      <td><?= $data_hari[$dp]['nama_hari']; ?></td>
                      <td><?= tanggal_indo($data_jadwal[$dp]['tanggal']); ?></td>
                      <td><a href="<?= $data_jadwal[$dp]['link']; ?>" target="_blank"><?= $data_jadwal[$dp]['link']; ?></a></td>
                      <td><button type="button" class="btn btn-primary input-block-level" data-toggle="modal" data-target="#editJadwalModal<?= $data['kode_sp']; ?>">Edit</a></td>
                    </tr>

                  <?php } else if ($data_dosbim2[$dp]['name'] ==  $data_dospeng1[$dp]['name']) { ?>
                    <tr style="background: red; color: white;">
                      <td scope="row"><?= $no; ?></td>
                      <!-- <td><?= $data['name']; ?></td> -->
                      <td><?= $data['judul']; ?></td>
                      <td><?= $data_dosbim1[$dp]['name']; ?></td>
                      <td><?= $data_dosbim2[$dp]['name']; ?></td>
                      <td><?= $data_dospeng1[$dp]['name']; ?></td>
                      <td><?= $data_dospeng2[$dp]['name']; ?></td>
                      <td><?= $data_jam[$dp]['range_jam']; ?></td>
                      <td><?= $data_hari[$dp]['nama_hari']; ?></td>
                      <td><?= tanggal_indo($data_jadwal[$dp]['tanggal']); ?></td>
                      <td><a href="<?= $data_jadwal[$dp]['link']; ?>" target="_blank"><?= $data_jadwal[$dp]['link']; ?></a></td>
                      <td><button type="button" class="btn btn-primary input-block-level" data-toggle="modal" data-target="#editJadwalModal<?= $data['kode_sp']; ?>">Edit</button></td>
                    </tr>

                  <?php } else if ($data_dosbim2[$dp]['name'] ==  $data_dospeng2[$dp]['name']) { ?>
                    <tr style="background: red; color: white;">
                      <td scope="row"><?= $no; ?></td>
                      <!-- <td><?= $data['name']; ?></td> -->
                      <td><?= $data['judul']; ?></td>
                      <td><?= $data_dosbim1[$dp]['name']; ?></td>
                      <td><?= $data_dosbim2[$dp]['name']; ?></td>
                      <td><?= $data_dospeng1[$dp]['name']; ?></td>
                      <td><?= $data_dospeng2[$dp]['name']; ?></td>
                      <td><?= $data_jam[$dp]['range_jam']; ?></td>
                      <td><?= $data_hari[$dp]['nama_hari']; ?></td>
                      <td><?= tanggal_indo($data_jadwal[$dp]['tanggal']); ?></td>
                      <td><a href="<?= $data_jadwal[$dp]['link']; ?>" target="_blank"><?= $data_jadwal[$dp]['link']; ?></a></td>
                      <td><button type="button" class="btn btn-primary input-block-level" data-toggle="modal" data-target="#editJadwalModal<?= $data['kode_sp']; ?>">Edit</button></td>
                    </tr>
                  <?php } else { ?>
                    <tr>
                      <td scope="row"><?= $no; ?></td>
                      <!-- <td><?= $data['name']; ?></td> -->
                      <td><?= $data['judul']; ?></td>
                      <td><?= $data_dosbim1[$dp]['name']; ?></td>
                      <td><?= $data_dosbim2[$dp]['name']; ?></td>
                      <td><?= $data_dospeng1[$dp]['name']; ?></td>
                      <td><?= $data_dospeng2[$dp]['name']; ?></td>
                      <td><?= $data_jam[$dp]['range_jam']; ?></td>
                      <td><?= $data_hari[$dp]['nama_hari']; ?></td>
                      <td><?= tanggal_indo($data_jadwal[$dp]['tanggal']); ?></td>
                      <td><a href="<?= $data_jadwal[$dp]['link']; ?>" target="_blank"><?= $data_jadwal[$dp]['link']; ?></a></td>
                      <td><button type="button" class="btn btn-primary input-block-level" data-toggle="modal" data-target="#editJadwalModal<?= $data['kode_sp']; ?>">Edit</button></td>
                    </tr>
                  <?php } ?>

                  <?php $no++; ?>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->

    <!-- Modal Fitur -->

    <!-- Modal Edit Data Jadwal -->
    <?php foreach ($data_jadwal as $dj => $data) : ?>
      <div class="modal fade" id="editJadwalModal<?= $data['kode_sp']; ?>" tabindex="-1" aria-labelledby="editJadwalModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editJadwalModalLabel">Edit Jadwal</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="<?= base_url('menu/Buat_Jadwal_Proposal/edit') ?>" method="post">
              <div class="modal-body">
                <div class="form-group">
                  <input type="text" class="form-control" id="kode_sp" name="kode_sp" required value="<?= $data['kode_sp']; ?>" hidden>
                  <div class="mb-3">
                    <label for="">Dosen Penguji 1</label>
                    <select class="form-control" id="dospeng_1" name="dospeng_1" placeholder="Dosen Penguji 1" required>
                      <option selected value="<?= $data['dospeng_1'] ?>"><?= $data_dospeng1[$dj]['name'] ?></option>
                      <?php foreach ($data_list_dosen as $dd) : ?>
                        <option value="<?= $dd['id'] ?>"><?= $dd['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="">Dosen Penguji 2</label>
                    <select class="form-control" id="dospeng_2" name="dospeng_2" placeholder="Dosen Penguji 2" required>
                      <option selected value="<?= $data['dospeng_2'] ?>"><?= $data_dospeng2[$dj]['name'] ?></option>
                      <?php foreach ($data_list_dosen as $dd) : ?>
                        <option value="<?= $dd['id'] ?>"><?= $dd['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="">Hari</label>
                    <select class="form-control" id="hari" name="hari" placeholder="Hari" required>
                      <option selected value="<?= $data['hari'] ?>"><?= $data_hari[$dj]['nama_hari'] ?></option>
                      <?php foreach ($data_hari as $dh) : ?>
                        <option value="<?= $dh['kode_hari'] ?>"><?= $dh['nama_hari'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="">Jam</label>
                    <select class="form-control" id="jam" name="jam" placeholder="Jam" required>
                      <option selected value="<?= $data['jam'] ?>"><?= $data_jam[$dj]['range_jam'] ?></option>
                      <?php foreach ($data_jam as $dj) : ?>
                        <option id="jam" name="jam" value="<?= $dj['kode_jam'] ?>"> <?= $dj['range_jam'] ?><br>
                        <?php endforeach; ?>
                        <select>
                  </div>
                  <div class="mb-3">
                    <label for="">Tanggal</label><br>
                    <input min="<?= date('Y-m-d'); ?>" type="date" class="form-control" name="tanggal" value="<?= $data['tanggal']; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="">Link Zoom</label><br>
                    <input type="text" class="form-control" name="link" id="link" value="<?= $data['link']; ?>">
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i>
                  Close</button>
                <button type="submit" class="btn btn-warning"><i class="fas fa-fw fa-edit"></i> Save Edit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    <?php endforeach; ?>