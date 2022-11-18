    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

      <div class="card shadow mb-4">
        <div class="card-header pt-4">
          <h6>Pengajuan Daftar Sidang</h6>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="modal-body">
              <?= $this->session->flashdata('message'); ?>
              <p>
                Berikut ini form untuk mengajukan Seminar Proposal, Seminar Akhir dan Sidang Akhir
              </p>
              <p style="color: red; font-size: 14px">*Pastikan anda sudah memiliki File Draft TA, PPT dan File
                Persetujuan, lalu
                mengupload dalam format PDF</p>
            </div>
            <?php if ($user['status'] == 1) { ?>
            <div class="col-lg-12 modal-footer d-flex flex-row justify-content-center mt-auto pt-3"
              style="background-color: #e4e4f4; border-radius:0;">Klik tombol berikut untuk membatalkan pengajuan<i
                class="fas fa-fw fa-arrow-right"></i>
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#batalDaftarSidangModal">
                Batalkan
                Pengajuan</button>
              <?php } else { ?>
              <div class="col-lg-12 modal-footer d-flex flex-row justify-content-center mt-auto pt-3"
                style="background-color: #e4e4f4; border-radius:0;">Klik tombol berikut untuk mengajukan <i
                  class="fas fa-fw fa-arrow-right"></i>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addDaftarSidangModal">
                  Ajukan
                  Daftar</button>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Modal Fitur -->
    <!-- Modal Daftar Sidang Mahasiswa -->
    <div class=" modal fade" id="addDaftarSidangModal" tabindex="-1" aria-labelledby="addDaftarSidangLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addDaftarSidangLabel">Ajukan Sidang</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?= base_url('user/save_daftar_sidang') ?>" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="judul" class="col-form-label">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul">
              </div>

              <div class="mb-3">
                <label for="topik" class="col-form-label">Topik</label>
                <input type="text" class="form-control" id="topik" name="topik" placeholder="Topik">
              </div>

              <div class="mb-3">
                <label class="col-form-label">Kelompok Keahlian</label>
                <select class="custom-select" id="keahlian_id" name="keahlian_id">
                  <option selected>Pilih Keahlian...</option>
                  <?php foreach ($data_keahlian as $dk) : ?>
                  <option value="<?= $dk['id']; ?>"><?= $dk['keahlian']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="mb-3">
                <label class="col-form-label">Jenis Ujian</label>
                <select class="custom-select" id="id_jenis_ujian" name="id_jenis_ujian">
                  <option selected>Pilih Jenis Ujian...</option>
                  <?php foreach ($list_data_ujian as $ldu) : ?>
                  <option value="<?= $ldu['id']; ?>"><?= $ldu['jenis_ujian']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="mb-3">
                <label for="dosbim_1" class="col-form-label">Dosen Pembimbing 1</label>
                <select class="custom-select" id="dosbim_1" name="dosbim_1">
                  <option selected>Pilih Dosen Pembimbing 1...</option>
                  <?php foreach ($list_data_dosen as $ldd) : ?>
                  <option value="<?= $ldd['id'] ?>"><?= $ldd['name']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="mb-3">
                <label class="col-form-label">Dosen Pembimbing 2</label>
                <select class="custom-select" id="dosbim_2" name="dosbim_2">
                  <option selected>Pilih Dosen Pembimbing 2...</option>
                  <?php foreach ($list_data_dosen as $ldd) : ?>
                  <option value="<?= $ldd['id'] ?>"><?= $ldd['name']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="mb-3">
                <label class="col-form-label">File Draft TA</label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="file_draft" name="file_draft">
                  <label class="custom-file-label">Choose file</label>
                </div>
              </div>

              <div class="mb-3">
                <label class="col-form-label">File PPT</label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="file_ppt" name="file_ppt">
                  <label class="custom-file-label">Choose file</label>
                </div>
              </div>

              <div class="mb-3">
                <label class="col-form-label">File Persetujuan</label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="file_persetujuan" name="file_persetujuan">
                  <label class="custom-file-label">Choose file</label>
                </div>
              </div>

              <div class="d-flex flex-row justify-content-end mt-auto pt-3 pb-3">
                <button type="submit" class="btn btn-primary">Daftar Sidang <i
                    class="fas fa-fw fa-arrow-right"></i></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Delete Data Dosen -->
    <div class="modal fade" id="batalDaftarSidangModal" tabindex="-1" aria-labelledby="batalDaftarSidangLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="batalDaftarSidangLabel">Delete Data Dosen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?= base_url('user/batal_daftar') ?>" method="post">
            <div class="modal-body">
              <p>Apakah Anda Yakin Untuk Membatalkan Pendaftaran? </p>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i>
                  No</button>
                <button type="submit" class="btn btn-danger"><i class="fas fa-fw fa-trash"></i> Yes</button>
              </div>
          </form>
        </div>
      </div>
    </div>
    </div>