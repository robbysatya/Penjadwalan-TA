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

              <!-- MENDAFTAR SEMPRO -->
              <p>
                Berikut ini form untuk mengajukan Seminar Proposal dan Sidang Akhir
              </p>
              <p style="color: red; font-size: 14px">*Pastikan anda sudah memiliki File Draft TA, PPT dan File Persetujuan, lalu mengupload dalam format PDF dan Maksimal File 25 Mb</p>
              <?php if ($user['status'] == 0) { ?>
                <b><?= $user['alasan']; ?></b>
                <!-- MENUNGGU PERSETUJUAN SEMPRO -->
              <?php } else if ($user['status'] == 2) { ?>
                Anda tercatat pernah mendaftar <b>Seminar Proposal</b>. Silahkan tunggu pendaftaran anda distujui.

                <!-- DISETUJUI SEMPRO -->
              <?php } else if ($user['status'] == 1) { ?>
                Anda tercatat pernah mendaftar <b>Seminar Proposal</b>. Untuk mengetahui jadwal seminar/sidang silahkan pantau pada menu <b>Jadwal Sidang</b>.

                <!-- DAFTAR SIDANG -->
              <?php } else if ($user['status'] == 3) { ?>
                Anda tercatat pernah mendaftar <b>Seminar Proposal</b>. Pendaftaran untuk <b>Sidang Akhir</b> telah disetujui untuk mendaftar, silahkan mendaftar.

                <!-- MENUNGGU PERSETUJUAN SIDANG -->
              <?php } else if ($user['status'] == 4) { ?>
                Anda tercatat pernah mendaftar <b>Seminar Proposal</b> dan <b>Sidang Akhir</b>. Silahkan tunggu persetujuan sidang.

                <!-- DISETUJUI SIDANG -->
              <?php } else if ($user['status'] == 5) { ?>
                Selamat anda telah telah menyelesaikan perjalanan panjang anda.
              <?php } ?>
            </div>

            <!-- DAFTAR SEMPRO -->
            <?php if ($user['status'] == 0) { ?>
              <div class="col-lg-12 modal-footer d-flex flex-row justify-content-center mt-auto pt-3" style="background-color: #e4e4f4; border-radius:0;">Klik tombol berikut untuk melakukan pendaftaran <i class="fas fa-fw fa-arrow-right"></i>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#DaftarSemproModal">
                  Daftar Sempro</button>
              </div>

              <!-- DISETUJUI PENDAFTARAN SEMPRO -->
            <?php } else if ($user['status'] == 1) { ?>
              <div class="col-lg-12 modal-footer d-flex flex-row justify-content-center mt-auto pt-3" style="background-color: #e4e4f4; border-radius:0;">Pendaftaran <b>Seminar Proposal</b>anda telah disetujui
              </div>

              <!-- DAFTAR SIDANG -->
            <?php } else if ($user['status'] == 3) { ?>
              <div class="col-lg-12 modal-footer d-flex flex-row justify-content-center mt-auto pt-3" style="background-color: #e4e4f4; border-radius:0;">Klik tombol berikut untuk melakukan pendaftaran <i class="fas fa-fw fa-arrow-right"></i>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#DaftarSidangModal">
                  Daftar Sidang</button>
              </div>


              <!-- PEMBATALAN PENDAFTARAN SEMPRO -->
            <?php } else if ($user['status'] == 2) { ?>
              <div class="col-lg-12 modal-footer d-flex flex-row justify-content-center mt-auto pt-3" style="background-color: #e4e4f4; border-radius:0;">Klik tombol berikut untuk membatalkan pendaftaran<i class="fas fa-fw fa-arrow-right"></i>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#batalDaftarSemproModal">
                  Batalkan Pendaftaran</button>
              </div>
          </div>

          <!-- PEMBATALAN PENDAFTARAN SIDANG -->
        <?php } else if ($user['status'] == 4) { ?>
          <div class="col-lg-12 modal-footer d-flex flex-row justify-content-center mt-auto pt-3" style="background-color: #e4e4f4; border-radius:0;">Klik tombol berikut untuk membatalkan pendaftaran<i class="fas fa-fw fa-arrow-right"></i>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#batalDaftarSidangModal">
              Batalkan Pendaftaran</button>
          </div>
        </div>

        <!-- DISETUJUI PENDAFTARAN SIDANG -->
      <?php } else if ($user['status'] == 5) { ?>
        <div class="col-lg-12 modal-footer d-flex flex-row justify-content-center mt-auto pt-3" style="background-color: #e4e4f4; border-radius:0;">Pendaftaran <b>Sidang Akhir</b>anda telah disetujui. Selamat anda telah selesai menyelesaikan semua misi. Good luck for next journey!
        <?php } ?>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Modal Fitur -->
    <!-- Modal Daftar Sempro Mahasiswa -->
    <div class=" modal fade" id="DaftarSemproModal" tabindex="-1" aria-labelledby="addDaftarSemproLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addDaftarSemproLabel">Daftar Sempro</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?= base_url('user/save_daftar_sempro') ?>" method="post" enctype="multipart/form-data">
              <input type="number" class="form-control" id="nim" name="nim" placeholder="NIM" value="<?= $user['nim']; ?>" hidden>
              <input type="text" class="form-control" id="name" name="name" placeholder="Nama" value="<?= $user['name']; ?>" hidden>
              <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= $user['email']; ?>" hidden>
              <div class="form-group">
                <label for="judul" class="col-form-label">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul">
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
                <select class="custom-select" id="id_jenis_ujian" name="id_jenis_ujian" style="pointer-events: none;">
                  <option selected value="1">Seminar Proposal</option>
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
                  <input type="file" class="custom-file-input" id="file_draft" name="file_draft" accept=" application/pdf">
                  <label class="custom-file-label">Choose file</label>
                </div>
              </div>

              <div class="mb-3">
                <label class="col-form-label">File PPT</label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="file_ppt" name="file_ppt" accept=" application/pdf">
                  <label class="custom-file-label">Choose file</label>
                </div>
              </div>

              <div class="mb-3">
                <label class="col-form-label">File Persetujuan</label>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" id="file_persetujuan" name="file_persetujuan" accept=" application/pdf">
                  <label class="custom-file-label">Choose file</label>
                </div>
              </div>

              <div class="d-flex flex-row justify-content-end mt-auto pt-3 pb-3">
                <button type="submit" class="btn btn-primary">Daftar Sidang <i class="fas fa-fw fa-arrow-right"></i></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Daftar Sidang Mahasiswa -->
    <div class=" modal fade" id="DaftarSidangModal" tabindex="-1" aria-labelledby="addDaftarSidangLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addDaftarSidangLabel">Daftar Sidang</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?= base_url('user/save_daftar_sidang') ?>" method="post" enctype="multipart/form-data">
              <input type="number" class="form-control" id="nim" name="nim" placeholder="NIM" value="<?= $user['nim']; ?>" hidden>
              <input type="text" class="form-control" id="name" name="name" placeholder="Nama" value="<?= $user['name']; ?>" hidden>
              <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= $user['email']; ?>" hidden>
              <div class="form-group">
                <label for="judul" class="col-form-label">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" placeholder="Judul" value="<?= $data_proposal['judul'] ?>" style="pointer-events: none;">
              </div>
              <div class="mb-3">
                <label class="col-form-label">Kelompok Keahlian</label>
                <select class="custom-select" id="keahlian_id" name="keahlian_id" style="pointer-events: none;">
                  <?php foreach ($data_keahlian as $dk) : ?>
                    <option selected value="<?= $data_proposal['keahlian_id'] ?>"><?= $dk['keahlian']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="mb-3">
                <label class="col-form-label">Jenis Ujian</label>
                <select class="custom-select" id="id_jenis_ujian" name="id_jenis_ujian" style="pointer-events: none;">
                  <option selected value="3">Sidang Akhir</option>
                </select>
              </div>

              <div class="mb-3">
                <label for="dosbim_1" class="col-form-label">Dosen Pembimbing 1</label>
                <select class="custom-select" id="dosbim_1" name="dosbim_1" style="pointer-events: none;">
                  <?php foreach ($data_dosen_1_proposal as $dd_1) : ?>
                    <option value="<?= $data_proposal['dosbim_1'] ?>"><?= $dd_1['name']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="mb-3">
                <label class="col-form-label">Dosen Pembimbing 2</label>
                <select class="custom-select" id="dosbim_2" name="dosbim_2" style="pointer-events: none;">
                  <?php foreach ($data_dosen_2_proposal as $dd_2) : ?>
                    <option value="<?= $data_proposal['dosbim_2'] ?>"><?= $dd_2['name']; ?></option>
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
                <button type="submit" class="btn btn-primary">Daftar Sidang <i class="fas fa-fw fa-arrow-right"></i></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Batal Daftar Sempro -->
    <div class="modal fade" id="batalDaftarSemproModal" tabindex="-1" aria-labelledby="batalDaftarSemproLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="batalDaftarSemproLabel">Batal Pendaftaran</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?= base_url('user/batal_daftar_sempro') ?>" method="post">
            <div class="modal-body">
              <p>Apakah anda yakin ingin membatalkan pendaftaran? </p>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> No</button>
                <button type="submit" class="btn btn-danger"><i class="fas fa-fw fa-trash"></i> Yes</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal Batal Daftar Sidang -->
    <div class="modal fade" id="batalDaftarSidangModal" tabindex="-1" aria-labelledby="batalDaftarSidangLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="batalDaftarSidangLabel">Batal Pendaftaran</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?= base_url('user/batal_daftar_sidang') ?>" method="post">
            <div class="modal-body">
              <p>Apakah anda yakin ingin membatalkan pendaftaran? </p>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> No</button>
                <button type="submit" class="btn btn-danger"><i class="fas fa-fw fa-trash"></i> Yes</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>