    <!-- Begin Page Content -->
    <div class="container-fluid">

      <div class="mb-4">
        <!-- Page Heading -->
        <h1 class="h3 text-gray-800"><?= $title; ?></h1>
        <p class="m-0 font-weight-regular" style="color: red;">* Data dalam tabel ini merupakan mahasiswa yang telah
          mendaftar <b style="color: red;">Seminar Proposal</b>
        </p>
        </p>
      </div>

      <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
      <?= $this->session->flashdata('message');  ?>

      <!-- Modal Trigger -->
      <!-- <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newDataMahasiswaModal"><i
          class="fas fa-fw fa-plus"></i> Add Data Mahasiswa</a> -->

      <!-- DataTales Example -->
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row">
          <h6 class="col-sm-9 m-0 font-weight-bold text-primary">Tabel Data Mahasiswa Seminar Proposal</h6>
					<form class="d-flex col-sm-3 justify-content-between">
					<div class="col-sm-3">
					</div>
					</form>
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
                  <th>Kelompok Keahlian</th>
                  <th>Jenis Ujian</th>
                  <th>Dosbim 1</th>
                  <th>Dosbim 2</th>
                  <th>File Draft</th>
                  <th>File PPT</th>
                  <th>File Persetujuan</th>
                  <th>Tanggal Daftar</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
							<?php $no = 1; ?>
                <?php foreach ($data_mahasiswa as $d => $dm) : ?>
                <tr style="font-size: 12px;">
                  <td scope="row"><?= $no; ?></td>
                  <td><?= $dm['nim']; ?></td>
                  <td><?= $dm['name']; ?></td>
                  <td><?= $dm['judul']; ?></td>
                  <td><?= $data_keahlian[$d]['keahlian']; ?></td>
                  <td><?= $data_ujian[$d]['jenis_ujian']; ?></td>
									<td><?= $data_dosen_1[$d]['name']; ?></td>
									<td><?= $data_dosen_2[$d]['name']; ?></td>


                  <!-- File Draft -->
                  <td>
                    <a class="btn btn-info" target="<?= base_url('assets/files/') . $dm['file_draft']; ?>"
                      href="<?= base_url('assets/files/') . $dm['file_draft']; ?>">
                      <i class="fas fa-eye"></i> Lihat
                    </a>
                  </td>

                  <!-- File PPT -->
                  <td>
                    <a class="btn btn-info" target="<?= base_url('assets/files/') . $dm['file_ppt']; ?>"
                      href="<?= base_url('assets/files/') . $dm['file_ppt']; ?>">
                      <i class="fas fa-eye"></i> Lihat
                    </a>
                  </td>

                  <!-- File Persetujuan -->
                  <td>
                    <a class="btn btn-info" target="<?= base_url('assets/files/') . $dm['file_persetujuan']; ?>"
                      href="<?= base_url('assets/files/') . $dm['file_persetujuan']; ?>">
                      <i class="fas fa-eye"></i> Lihat
                    </a>
                  </td>
									<td><?= date('d F Y', $dm['date_created']) ?></td>
                  <td>
                    <?php if ($dm['status'] == 1) { ?>
                    <button type="button" class="btn btn-danger" data-toggle="modal"
                      data-target="#lanjutSidang<?= $dm['nim']; ?>">Lanjut Sidang <i
                        class="fas fa-arrow-right"></i></button>
                    <?php } else if($dm['status'] == 2) { ?>
											<button type="button" class="btn btn-warning" data-toggle="modal"
                      data-target="#terimaSidang<?= $dm['nim']; ?>"><i class="fas fa-fw fa-check"></i>
                      Terima</button><br><br>
                    <button type="button" class="btn btn-danger" data-toggle="modal"
                      data-target="#tolakSidang<?= $dm['nim']; ?>"><i class="fas fa-fw fa-times"></i>
                      Tolak</button>
										<?php } else { ?>
                    <p>Siap Daftar Sidang</p>
                    <?php } ?>
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

    <!-- Modal Terima Sempro -->
    <?php foreach ($data_mahasiswa as $d => $dm) : ?>
    <div class="modal fade" id="terimaSidang<?= $dm['nim']; ?>" tabindex="-1" aria-labelledby="terimaSidangLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="terimaSidangLabel">Terima Pendaftaran Seminar Proposal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?= base_url('menu/data_mahasiswa_proposal/terimaSidang') ?>" method="post">
            <div class="modal-body">
              <p>Apakah kamu yakin menerima pendaftaran <b><?= $dm['name']; ?></b>? </p>
              <p class="m-0 font-weight-bold" style="color: red;">*Pastikan persyaratan pendaftaran sudah benar!</p>
              <input type="text" class="form-control" id="nim" name="nim" placeholder="ID" required
                value="<?= $dm['nim']; ?>" hidden>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i>
                No</button>
              <button type="submit" class="btn btn-success"><i class="fas fa-fw fa-check"></i> Yes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php endforeach; ?>


    <!-- Modal Tolak Sempro -->
    <?php foreach ($data_mahasiswa as $d => $dm) : ?>
    <div class="modal fade" id="tolakSidang<?= $dm['nim']; ?>" tabindex="-1" aria-labelledby="tolakSidangLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="tolakSidangLabel">Tolak Pendaftaran Seminar Proposal</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?= base_url('menu/data_mahasiswa_proposal/tolakSidang') ?>" method="post">
            <div class="modal-body">
              <p>Apakah kamu yakin menolak pendaftaran <b><?= $dm['name']; ?></b>? </p>
              <input type="text" class="form-control" id="nim" name="nim" placeholder="ID" required
                value="<?= $dm['nim']; ?>" hidden>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i>
                No</button>
              <button type="submit" class="btn btn-danger"><i class="fas fa-fw fa-check"></i> Yes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php endforeach; ?>

    <!-- Modal Lanjut Sidang -->
    <?php foreach ($data_mahasiswa as $dm) : ?>
    <div class="modal fade" id="lanjutSidang<?= $dm['nim']; ?>" tabindex="-1" aria-labelledby="deleteDataDosenLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="deleteDataDosenLabel">Lanjut Sidang</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?= base_url('menu/data_mahasiswa_proposal/lanjutSidang') ?>" method="post">
            <div class="modal-body">
              <p>Apakah kamu yakin menerima <b><?= $dm['name']; ?></b> dapat melanjutkan proses sidang selanjutnya? </p>
              <p class="m-0 font-weight-bold" style="color: red;">*Pastikan mahasiswa telah selesai melakukan seminar
                atau sidang!</p>
              <input type="text" class="form-control" id="nim" name="nim" placeholder="ID" required
                value="<?= $dm['nim']; ?>" hidden>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i>
                No</button>
              <button type="submit" class="btn btn-success"><i class="fas fa-fw fa-check"></i> Yes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
