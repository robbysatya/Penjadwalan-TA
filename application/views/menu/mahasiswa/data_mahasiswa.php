    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

      <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
      <?= $this->session->flashdata('message');  ?>

      <!-- Modal Trigger -->
      <!-- <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newDataMahasiswaModal"><i
          class="fas fa-fw fa-plus"></i> Add Data Mahasiswa</a> -->

      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Tabel Data Mahasiswa</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr style="font-size: 14px;">
                  <th>No</th>
                  <th>NIM</th>
                  <th>Nama</th>
                  <th>Judul Topik</th>
                  <th>Topik TA</th>
                  <th>Kelompok Keahlian</th>
                  <th>Email</th>
                  <th>Jenis Ujian</th>
                  <th>Dosbim 1</th>
                  <th>Dosbim 2</th>
                  <th>File Draft</th>
                  <th>File PPT</th>
                  <th>File Persetujuan</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; ?>
                <?php foreach ($data_mahasiswa as $dm) : ?>
                <tr style="font-size: 14px;">
                  <td scope="row"><?= $no; ?></td>
                  <td><?= $dm['nim']; ?></td>
                  <td><?= $dm['name']; ?></td>
                  <td><?= $dm['judul']; ?></td>
                  <td><?= $dm['topik']; ?></td>
                  <td><?= $dm['keahlian']; ?></td>
                  <td><?= $dm['email']; ?></td>
                  <?php foreach ($data_ujian as $du) : ?>
                  <td><?= $du['jenis_ujian']; ?></td>
                  <?php endforeach; ?>
                  <td><?= $dm['dosbim_1']; ?></td>
                  <td><?= $dm['dosbim_2']; ?></td>
                  <td><?= $dm['file_draft']; ?></td>
                  <td><?= $dm['file_ppt']; ?></td>
                  <td><?= $dm['file_persetujuan']; ?></td>
                  <td>
                    <button type="button" class="btn btn-warning" data-toggle="modal"
                      data-target="#editDataDosenModal<?= $dm['id']; ?>"><i class="fas fa-fw fa-edit"></i> Edit</button>
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
    <?php foreach ($data_mahasiswa as $dm) : ?>
    <!-- Modal Edit Data Mahasiswa -->
    <div class="modal fade" id="editDataDosenModal<?= $dm['id']; ?>" tabindex="-1"
      aria-labelledby="editDataMahasiswaLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editDataMahasiswaLabel">Edit Data Mahasiswa</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?= base_url('menu/data_mahasiswa/edit') ?>" method="post">
            <div class="modal-body">
              <div class="form-group">
                <input type="number" class="form-control" id="id" name="id" placeholder="id" value="<?= $dm['id']; ?>"
                  hidden>
                <div class="mb-3">
                  <label for="">NIM</label>
                  <input type="number" class="form-control" id="nim" name="nim" placeholder="NIM"
                    value="<?= $dm['nim']; ?>" readonly>
                </div>
                <div class="mb-3">
                  <label for="">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email Mahasiswa"
                    value="<?= $dm['email']; ?>" readonly>
                </div>
                <div class="mb-3">
                  <label for="">Nama Lengkap</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Nama Mahasiswa"
                    value="<?= $dm['name']; ?>" readonly>
                </div>
                <div class="mb-3">
                  <label for="">Judul TA</label>
                  <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul Topik"
                    value="<?= $dm['judul']; ?>">
                </div>
                <div class="mb-3">
                  <label for="">Topik TA</label>
                  <input type="text" class="form-control" id="topik" name="topik" placeholder="Topik TA"
                    value="<?= $dm['topik']; ?>">
                </div>
                <div class="mb-3">
                  <label for="">Kelompok Keahlian</label>
                  <select class="custom-select" id="keahlian_id" name="keahlian_id">
                    <option selected value="<?= $dm['keahlian_id']; ?>"><?= $dm['keahlian']; ?></option>
                    <?php foreach ($data_keahlian as $dk) : ?>
                    <option value="<?= $dk['id']; ?>"><?= $dk['keahlian']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="">Jenis Ujian</label>
                  <select class="custom-select" id="id_jenis_ujian" name="id_jenis_ujian">
                    <?php foreach ($data_ujian as $du) : ?>
                    <option selected value="<?= $du['id_jenis_ujian']; ?>"><?= $du['jenis_ujian']; ?></option>
                    <?php endforeach; ?>
                    <?php foreach ($list_data_ujian as $ldu) : ?>
                    <option value="<?= $ldu['id']; ?>"><?= $ldu['jenis_ujian']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <!-- <div class="mb-3">
                  <label for="">Dosen Pembimbing 1</label>
                  <select class="custom-select" id="dosbim_1" name="dosbim_1">
                    <option selected>Pilih Dosen Pembimbing 1...</option>
                    <?php foreach ($data_keahlian as $dk) : ?>
                    <option value="<?= $dk['id']; ?>"><?= $dk['keahlian']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="">Dosen Pembimbing 2</label>
                  <select class="custom-select" id="dosbim_2" name="dosbim_2">
                    <option selected>Pilih Dosen Pembimbing 2...</option>
                    <?php foreach ($data_keahlian as $dk) : ?>
                    <option value="<?= $dk['id']; ?>"><?= $dk['keahlian']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div> -->
                <!-- <div class="mb-3">
                  <label for="">File Draft TA</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="file_draft" name="file_draft">
                    <label class="custom-file-label">Choose file</label>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="">File PPT</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="file_ppt" name="file_ppt">
                    <label class="custom-file-label">Choose file</label>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="">File Persetujuan</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="file_persetujuan" name="file_persetujuan">
                    <label class="custom-file-label">Choose file</label>
                  </div>
                </div> -->

              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                  class="fas fa-fw fa-times"></i>Close</button>
              <button type="submit" class="btn btn-primary"><i class="fas fa-edit"></i> Save Edit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php endforeach; ?>