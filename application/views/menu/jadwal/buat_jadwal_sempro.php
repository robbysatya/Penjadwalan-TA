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
			<div class="card mb-4 col-lg-6" style="padding: 0;">
				<div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Form Buat Jadwal Sempro</h6>
        </div>
				<form action="<?= base_url('menu/buat_jadwal_proposal/simpan_jadwal') ?>" method="post">
				<div class="card-body">
					<div class="row col-sm-12">
						<label class="col-sm-4">Fitness</label>
						<div class="col-sm-8">
							<?php error_reporting(0);
								if ($_GET['fit']== '') {
										$fit = 0;
								} else {
										$fit = $_GET['fit']; 
								} 
								?>
							<input type="text" name="fitness" class="form-control" id="fitness" placeholder="Nilai Fitness" readonly="Readonly" value="<?php echo $fit ?>" >
						</div>
					</div>
					
					<!-- <div class="row col-sm-12 pt-2">
						<label for="" class="col-sm-4">Jadwal Bentrok</label>
						<div class="col-sm-8">	
							<input type="text" name="bentrok" class="form-control" id="bentrok" placeholder="Jadwal Bentrok" readonly="Readonly" value="0" >
						</div>
					</div> -->
					
					<!-- Button Buat Jadwal -->
					<div class="col-sm-4 pt-4">
						<a class="btn btn-success mb-3" id="acak" href="<?= base_url('menu/Buat_Jadwal_Proposal/Genetika')?>"><i class="fas fa-sync-alt"></i> Buat Jadwal</a>
					</div>

					<div class="row col-sm-12 pt-2">
						<label for="" class="col-sm-4">Kode Jadwal</label>
						<div class="col-sm-8">	
						<?php
						$host       =   "localhost";
						$user       =   "root";
						$password   =   "";
						$database   =   "db_penjadwalan_ta";
						// perintah php untuk akses ke database
						$koneksi = new PDO("mysql:host={$host};dbname={$database}",$user,$password);
						$koneksi->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								    		  
						$sql =  "SELECT max(kode_jadwal_sp) as kode_jadwal_sp FROM tb_jadwal_proposal";
                        			
						$result = $koneksi->query($sql);

                        		while($r=$result->fetch(PDO::FETCH_ASSOC)){
                        			if ($result->rowCount() == 1) {
																$kode_jadwal = $r['kode_jadwal_sp'];
																$waktu = "SP".date('Ydm') ;
																$kode_jadwal_new = $waktu . sprintf("%03s");
															} else { 
																$kode_jadwal_new = "SP".date('Ydm'); }
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
							if ($bln <= 6){
								$tahun = $thn-1;
								$output = "$tahun - $thn";
								}
							if ($bln >= 7){
								$tahun = $thn+1;
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
							</select>
						</div>
					</div>

					<!-- Button Simpan Jadwal -->
					<div class="col-sm-4 pt-4">
						<button class="btn btn-primary mb-3"><i class="fas fa-save"></i> Simpan Jadwal</button>
					</div>
				</div> 
			</form>
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
                  <th>Dosen Penguji 1</th>
                  <th>Dosen Penguji 2</th>
                  <th>Jam</th>
                  <th>Hari</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; ?>
                <?php foreach ($data_proposal as $dp => $data) : ?>
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
                </tr>
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

    <!-- Modal Data Jadwal Dosen -->
		<div class="modal fade" id="newJadwalDosenModal" tabindex="-1" aria-labelledby="newJadwalDosenLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="newJadwalDosenLabel">Tambah Jadwal Dosen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?= base_url('menu/data_jadwal_dosen/add') ?>" method="post">
            <div class="modal-body">
              <div class="form-group">
                <div class="mb-3">
									<select class="form-control" id="id_dosen" name="id_dosen" placeholder="Dosen" required>
											<option value="" selected="" disabled="">Pilih Dosen...</option>
											<?php foreach($data_list_dosen as $dd) : ?>
											<option value="<?= $dd['id']?>"><?= $dd['name']?></option>
											<?php endforeach; ?>
									</select>
                </div>
                <div class="mb-3">
                  <select class="form-control" id="hari" name="hari" placeholder="Hari" required>
										<option value="" selected="" disabled="">Pilih Hari...</option>
										<?php foreach($data_hari as $dh) : ?>
										<option value="<?= $dh['kode_hari']?>"><?= $dh['nama_hari']?></option>
										<?php endforeach; ?>
									</select>
                </div>
                <div class="mb-3">
									<label for="">Jam</label><br>
									<?php foreach($data_jam as $dj) : ?>
									<input type="checkbox" id="jam" name="jam[]" value="<?= $dj['kode_jam']?>"> <?= $dj['range_jam']?><br>
									<?php endforeach; ?>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i>
                Close</button>
              <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal Edit Data Dosen -->
    <!-- <?php foreach ($data_jadwal_dosen as $data) : ?>
    <div class="modal fade" id="editDataDosenModal<?= $data['id']; ?>" tabindex="-1" aria-labelledby="editDataDosenLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editDataDosenLabel">Edit Jadwal Dosen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?= base_url('menu/data_jadwal_dosen/edit') ?>" method="post">
            <div class="modal-body">
              <div class="form-group">
                <input type="text" class="form-control" id="id" name="id" placeholder="ID" required
                  value="<?= $data['id']; ?>" hidden>
                <div class="mb-3">
                  <label for="">Nama</label>
									<select class="form-control" id="id_dosen" name="id_dosen" placeholder="Dosen" required>
											<?php foreach($data_list_dosen as $dd) : ?>
											<option selected value="<?= $dd['id']?>"><?= $dd['name']?></option>
											<?php endforeach; ?>
									</select>
                </div>
                <div class="mb-3">
                  <label for="">Hari</label>
									<select class="form-control" id="hari" name="hari" placeholder="Hari" required>
										<option value="" selected="" disabled="">Pilih Hari...</option>
										<?php foreach($data_hari as $dh) : ?>
										<option value="<?= $dh['kode_hari']?>"><?= $dh['nama_hari']?></option>
										<?php endforeach; ?>
									</select>
                </div>
                <div class="mb-3">
									<label for="">Jam</label><br>
										<?php foreach($data_jam as $dj) : ?>
										<input type="checkbox" id="jam" name="jam[]" value="<?= $dj['kode_jam']?>"> <?= $dj['range_jam']?><br>
										<?php endforeach; ?>
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
    <?php endforeach; ?> -->

    <!-- Modal Delete Data Dosen -->
    <?php foreach ($data_jadwal_dosen as $djd => $data) : ?>
    <div class="modal fade" id="deleteDataDosenModal<?= $data['id']; ?>" tabindex="-1"
      aria-labelledby="deleteDataDosenLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteDataDosenLabel">Delete Jadwal Dosen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?= base_url('menu/data_jadwal_dosen/delete') ?>" method="post">
            <div class="modal-body">
              <p>Apakah kamu yakin ingin menghapus jadwal <b><?= $data_dosen[$djd]['name']; ?></b>, hari <b><?= $hari[$djd]['nama_hari']?></b>, pukul <b><?=  $jam[$djd]['range_jam']?></b> ? </p>
              <input type="text" class="form-control" id="id" name="id" placeholder="ID" required
                value="<?= $data['id']; ?>" hidden>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i>
                No</button>
              <button type="submit" class="btn btn-danger"><i class="fas fa-fw fa-trash"></i> Yes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
