    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

      <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
      <?= $this->session->flashdata('message');  ?>

      <!-- DataTales Example -->
      <div class="card mb-4">
        <div class="card-header py-3">
          <a href="<?= base_url('menu/data_user') ?>"><i class="fas fa-fw fa-arrow-left"></i>
            Kembali</a>
        </div>
        <div class="card-body">
          <form action="<?= base_url('menu/data_user/addUser') ?>" method="post">
            <div class="modal-body">
              <div class="form-group">
                <div class="mb-3">
                  <label for="">NIM</label>
                  <input type="text" class="form-control" id="nim" name="nim" placeholder="NIM Mahasiswa" value="<?= set_value('nim'); ?>">
                  <?= form_error('nim', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="mb-3">
                  <label for="">Nama Lengkap</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Nama Mahasiswa" value="<?= set_value('name'); ?>">
                  <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="mb-3">
                  <label for="">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email Mahasiswa" value="<?= set_value('email'); ?>">
                  <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="mb-3">
                  <label for="">Password</label>
                  <input type="password" class="form-control" id="password1" name="password1" placeholder="************">
                  <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="mb-3">
                  <label for="">Repeat Password</label>
                  <input type="password" class="form-control" id="password2" name="password2" placeholder="************">
                </div>
                <div class="mb-3">
                  <label for="">Role</label>
                  <select class="custom-select" id="role_id" name="role_id" required>
                    <option selected>Pilih Role Akun...</option>
                    <option value="1">Administrator</option>
                    <option value="2">Mahasiswa</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="">Status Akun</label>
                  <select class="custom-select" id="is_active" name="is_active" required>
                    <option selected>
                      Pilih Status Akun...
                    </option>
                    <option value="0">Disabled</option>
                    <option value="1">Active</option>
                  </select>
                </div>
              </div>
              <div class="d-flex flex-row justify-content-end mt-auto pt-3">
                <button type="submit" class="btn btn-success"><i class="fas fa-fw fa-save"></i> Simpan</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
    </div>
    <!-- End of Main Content -->