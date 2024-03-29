    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

      <div class="row">
        <div class="col-lg-6">

          <?= form_open_multipart('user/edit'); ?>
          <div class="form-group row">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="email" name="email" value="<?= $user['email']; ?>" readonly>
            </div>
          </div>

          <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">NIM</label>
            <div class="col-sm-10">
              <input type="number" class="form-control" id="nim" name="nim" value="<?= $user['nim']; ?>">
              <?= form_error('nim', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
          </div>

          <div class="form-group row">
            <label for="name" class="col-sm-2 col-form-label">Full Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="name" name="name" value="<?= $user['name']; ?>">
              <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-2">Picture</label>
            <div class="col-sm-10">
              <div class="row">
                <div class="col-sm-3">
                  <img src="<?= base_url('/assets/img/profile/') . $user['image']; ?>" class="img-thumbnail">
                </div>
                <div class="col-sm-9">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image" name="image" value="<?= $user['image']; ?>">
                    <label class="custom-file-label" for="image"><?= $user['image']; ?></label>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
            </div>
          </div>

          </form>
        </div>
      </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
