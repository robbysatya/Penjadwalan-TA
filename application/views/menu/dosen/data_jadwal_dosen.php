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
      <!-- Modal Trigger --> 
      <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#newJadwalDosenModal"><i
          class="fas fa-fw fa-plus"></i> Tambah Data Jadwal</button>

      <!-- DataTables -->
      <div class="card mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Tabel Data Jadwal Dosen</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 14px;">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Hari</th>
                  <th>Jam</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; ?>
                <?php foreach ($data_jadwal_dosen as $jd => $data) : ?>
                <tr>
                  <td scope="row"><?= $no; ?></td>
                  <td><?= $data_dosen[$jd]['name']; ?></td>
                  <td><?= $hari[$jd]['nama_hari']; ?></td>
                  <td><?= $jam[$jd]['range_jam']; ?></td>
                  <td>
                    <!-- <button type="button" class="btn btn-warning " data-toggle="modal"
                      data-target="#editDataDosenModal<?= $data['id']; ?>"><i class="fas fa-fw fa-edit"></i></button> -->
                    
                    <button type="button" class="btn btn-danger input-block-level" data-toggle="modal"
                      data-target="#deleteDataDosenModal<?= $data['id']; ?>"><i class="fas fa-fw fa-trash"></i> Hapus</a>
                  </td>
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
              <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
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
