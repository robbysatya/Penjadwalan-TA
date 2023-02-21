    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <a href="<?= base_url('menu/data_user/edit/' . $user_recent['id']); ?>"><i
              class="fas fa-fw fa-arrow-left"></i>
            Kembali</a>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="modal-body">
              <?= $this->session->flashdata('message'); ?>
              <form action="<?= base_url('menu/data_user/changepasswordUser/' . $user_recent['id']); ?>" method="POST">
                <input type="text" class="form-control" id="id" name="id" placeholder="ID"
                  value="<?= $user_recent['id']; ?>" hidden>
                <div class="form-group">
                  <label for="new_password1">New Password</label>
                  <input type="password" class="form-control" id="new_password1" name="new_password1">
                  <?= form_error('new_password1', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                  <label for="new_password2">Repeat Password</label>
                  <input type="password" class="form-control" id="new_password2" name="new_password2">
                  <?= form_error('new_password2', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <div class="d-flex flex-row justify-content-end mt-auto pt-3">
                  <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-key"></i> Ubah
                    Password</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
