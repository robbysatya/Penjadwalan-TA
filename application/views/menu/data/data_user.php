    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

      <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
      <?= $this->session->flashdata('message');  ?>

      <!-- Button Add Trigger -->
      <a href="<?= base_url('menu/data_user/add') ?>" class="btn btn-primary mb-3"><i class="fas fa-fw fa-plus"></i> Tambah Akun</a>

      <!-- DataTales Example -->
      <div class="card mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Tabel Data User</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>NIM</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Password</th>
                  <th>Role</th>
                  <th>Status Akun</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; ?>
                <?php foreach ($data_user as $du) : ?>
                  <?php $disabled = 0;
                  $active = 1; ?>
                  <tr>
                    <td scope="row"><?= $no; ?></td>
                    <td><?= $du['nim']; ?></td>
                    <td><?= $du['name']; ?></td>
                    <td><?= $du['email']; ?></td>
                    <td>************</td>
                    <td><?= $du['role']; ?></td>
                    <td><?php if ($du['is_active'] == $active) : echo "Active";
                        elseif ($du['is_active'] == $disabled) : echo "Disabled" ?><?php endif; ?></td>
                    <td>
                      <a href="<?= base_url('menu/data_user/edit/' . $du['id']); ?>" type="button" class="btn btn-warning"><i class="fas fa-fw fa-edit"></i></a>
                      <br><br>
                      <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteDataUserModal<?= $du['id']; ?>"><i class="fas fa-fw fa-trash"></i></button>
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

    <!-- Modal Delete Data User -->
    <?php foreach ($data_user as $du) : ?>
      <div class="modal fade" id="deleteDataUserModal<?= $du['id']; ?>" tabindex="-1" aria-labelledby="deleteDataDosenLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteDataDosenLabel">Delete Account</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="<?= base_url('menu/data_user/deleteUser') ?>" method="post">
              <div class="modal-body">
                <p>Are you sure want to delete this account <b><?= $du['name']; ?></b>? </p>
                <input type="text" class="form-control" id="id" name="id" placeholder="ID" required value="<?= $du['id']; ?>" hidden>
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