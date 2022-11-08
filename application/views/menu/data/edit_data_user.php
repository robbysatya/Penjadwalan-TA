    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

      <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
      <?= $this->session->flashdata('message');  ?>

      <!-- DataTales Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <a href="<?= base_url('menu/data_user') ?>"><i class="fas fa-fw fa-arrow-left"></i>
            Back</a>
        </div>
        <div class="card-body">
          <?= form_open_multipart('menu/data_user/editUser'); ?>
          <?php $disabled = 0;
          $active = 1; ?>
          <form>
            <div class="modal-body">
              <div class="form-group">
                <input type="text" class="form-control" id="id" name="id" placeholder="ID"
                  value="<?= $user_recent['id']; ?>" hidden>
                <div class="mb-3">
                  <label for="">Nama Lengkap</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Nama Mahasiswa"
                    value="<?= $user_recent['name']; ?>">
                  <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="mb-3">
                  <label for="">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email Mahasiswa"
                    value="<?= $user_recent['email']; ?>" readonly>
                </div>

                <div class="mb-3">
                  <label for="">Password</label>
                  <br>
                  <a href="<?= base_url('menu/data_user/changepassword/' . $user_recent['id']); ?>"
                    class="btn btn-outline-danger">Change Password</a>
                </div>

                <div class="mb-3">
                  <label for="">Role</label>
                  <select class="custom-select" id="role_id" name="role_id" required>
                    <option selected value="<?= $user_recent['role_id']; ?>">
                      <?php $admin = 1;
                      $mahasiswa = 2;
                      if ($user_recent['role_id'] == 1) : echo "Administrator";
                      elseif ($user_recent['role_id'] == 2) : echo "Mahasiswa" ?><?php endif; ?></option>
                    <?php foreach ($data_role as $dr) : ?>
                    <option value="<?= $dr['id']; ?>"><?= $dr['role']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="">Status Akun</label>
                  <select class="custom-select" id="is_active" name="is_active" required>
                    <option selected value="<?= $user_recent['is_active']; ?>">
                      <?php if ($user_recent['is_active'] == $active) : echo "Active";
                      elseif ($user_recent['is_active'] == $disabled) : echo "Disabled" ?><?php endif; ?>
                    </option>
                    <option value="0">Disabled</option>
                    <option value="1">Active</option>
                  </select>
                </div>
              </div>
              <div class="d-flex flex-row justify-content-end mt-auto pt-3">
                <button type="submit" class="btn btn-success"><i class="fas fa-fw fa-edit"></i> Save Edit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->