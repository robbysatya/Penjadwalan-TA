    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

      <?php if (validation_errors()) : ?>
        <div class="alert alert-danger" role="alert">
          <?= validation_errors(); ?>
        </div>
      <?php endif; ?>
      <?= $this->session->flashdata('message');  ?>
      <!-- Modal Trigger -->
      <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#newDataDosenModal"><i class="fas fa-fw fa-plus"></i> Tambah Data Dosen</button>

      <!-- DataTables -->
      <div class="card mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Tabel Data Dosen</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>NIP</th>
                  <th>NIDN</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Kelompok Keahlian</th>
                  <!-- <th>Kuota Uji</th> -->
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; ?>
                <?php foreach ($data_dosen as $dd) : ?>
                  <tr>
                    <td scope="row"><?= $no; ?></td>
                    <td><?= $dd['nip']; ?></td>
                    <td><?= $dd['nidn']; ?></td>
                    <td><?= $dd['name']; ?></td>
                    <td><?= $dd['email']; ?></td>
                    <td><?= $dd['keahlian']; ?></td>
                    <!-- <td><?= $dd['kuota_uji']; ?></td> -->
                    <td class="d-grid gap-2">
                      <button type="button" class="btn btn-warning input-block-level form-control" data-toggle="modal" data-target="#editDataDosenModal<?= $dd['id']; ?>"><i class="fas fa-fw fa-edit"></i></button>
                      <br> <br>
                      <button type="button" class="btn btn-danger input-block-level form-control" data-toggle="modal" data-target="#deleteDataDosenModal<?= $dd['id']; ?>"><i class="fas fa-fw fa-trash"></i></a>
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

    <!-- Modal Add Data Dosen -->
    <div class="modal fade" id="newDataDosenModal" tabindex="-1" aria-labelledby="newDataDosenLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="newDataDosenLabel">Add New Data Dosen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="<?= base_url('menu/data_dosen/add') ?>" method="post">
            <div class="modal-body">
              <div class="form-group">
                <div class="mb-3">
                  <input type="number" class="form-control" id="nip" name="nip" placeholder="NIP" required>
                </div>
                <div class="mb-3">
                  <input type="number" class="form-control" id="nidn" name="nidn" placeholder="NIDN" required>
                </div>
                <div class="mb-3">
                  <input type="text" class="form-control" id="name" name="name" placeholder="Nama Dosen" required>
                </div>
                <div class="mb-3">
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="mb-3">
                  <select class="custom-select" id="keahlian_id" name="keahlian_id" required>
                    <option selected>Pilih Kelompok Keahlian...</option>
                    <?php foreach ($data_keahlian as $dk) : ?>
                      <option value="<?= $dk['id']; ?>"><?= $dk['keahlian']; ?></option>
                    <?php endforeach; ?>
                  </select>
                  <!-- <input type="text" class="form-control" id="kelompok_keahlian" name="kelompok_keahlian" placeholder="Kelompok Keahlian"> -->
                </div>
                <!-- <div class="mb-3">
                  <input type="number" class="form-control" id="kuota" name="kuota" placeholder="Kuota Uji" required>
                </div> -->

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
    <?php
    foreach ($data_dosen as $dd) : ?>
      <div class="modal fade" id="editDataDosenModal<?= $dd['id']; ?>" tabindex="-1" aria-labelledby="editDataDosenLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editDataDosenLabel">Edit Data Dosen</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="<?= base_url('menu/data_dosen/edit') ?>" method="post">
              <div class="modal-body">
                <div class="form-group">
                  <input type="text" class="form-control" id="id" name="id" placeholder="ID" required value="<?= $dd['id']; ?>" hidden>
                  <div class="mb-3">
                    <label for="">NIP</label>
                    <input type="number" class="form-control" id="nip" name="nip" placeholder="NIP" required value="<?= $dd['nip']; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="">NIDN</label>
                    <input type="number" class="form-control" id="nidn" name="nidn" placeholder="NIDN" required value="<?= $dd['nidn']; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nama Dosen" required value="<?= $dd['name']; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required value="<?= $dd['email']; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="">Kelompok Keahlian</label>
                    <select class="custom-select" id="keahlian_id" name="keahlian_id" required>
                      <option selected value="<?= $dd['keahlian_id']; ?>"><?= $dd['keahlian']; ?></option>
                      <?php foreach ($data_keahlian as $dk) { ?>
                        <option value="<?= $dk['id']; ?>"><?= $dk['keahlian']; ?></option>
                      <?php } ?>
                    </select>
                    <!-- <input type="text" class="form-control" id="kelompok_keahlian" name="kelompok_keahlian" placeholder="Kelompok Keahlian"> -->
                  </div>
                  <!-- <div class="mb-3">
                    <label for="">Kuota Uji</label>
                    <input type="number" class="form-control" id="kuota" name="kuota" placeholder="Kuota Uji" required value="<?= $dd['kuota_uji']; ?>">
                  </div> -->

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

    <!-- Modal Delete Data Dosen -->
    <?php foreach ($data_dosen as $dd) : ?>
      <div class="modal fade" id="deleteDataDosenModal<?= $dd['id']; ?>" tabindex="-1" aria-labelledby="deleteDataDosenLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteDataDosenLabel">Delete Data Dosen</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="<?= base_url('menu/data_dosen/delete') ?>" method="post">
              <div class="modal-body">
                <p>Are you sure want to delete this data dosen <b><?= $dd['name']; ?></b>? </p>
                <input type="text" class="form-control" id="id" name="id" placeholder="ID" required value="<?= $dd['id']; ?>" hidden>
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