    <!-- Begin Page Content -->
    <div class="container-fluid">

      <!-- Page Heading -->
      <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

      <?php if (validation_errors()) : ?>
        <div class="alert alert-danger" role="alert">
          <?= validation_errors(); ?>
        </div>
      <?php endif; ?>
      <?= $this->session->flashdata('message');  ?>

      <!-- DataTables -->
      <div class="card mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Tabel Jadwal Seminar Proposal</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 14px;">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Judul Penelitian</th>
                  <th>Dosen Pembimbing 1</th>
                  <th>Dosen Pembimbing 2</th>
                  <th>Dosen Penguji 1</th>
                  <th>Dosen Penguji 2</th>
                  <th>Jam</th>
                  <th>Hari</th>
                  <th>Tanggal</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; ?>
                <?php foreach ($data_proposal as $dp => $data) : ?>
                  <tr>
                    <td scope="row"><?= $no; ?></td>
                    <td><?= $data['name']; ?></td>
                    <td><?= $data['judul']; ?></td>
                    <td><?= $data_dosbim1[$dp]['name']; ?></td>
                    <td><?= $data_dosbim2[$dp]['name']; ?></td>
                    <td><?= $data_dospeng1[$dp]['name']; ?></td>
                    <td><?= $data_dospeng2[$dp]['name']; ?></td>
                    <td><?= $data_jam[$dp]['range_jam']; ?></td>
                    <td><?= $data_hari[$dp]['nama_hari']; ?></td>
                    <td><?= $data['tanggal']; ?></td>
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