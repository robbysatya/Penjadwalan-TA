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
                <h6 class="m-0 font-weight-bold text-primary">Tabel Jadwal Sidang Akhir</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 14px;">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Judul Penelitian</th>
                                <th>Dosbim 1</th>
                                <th>Dosbim 2</th>
                                <th>Dospeng 1</th>
                                <th>Dospeng 2</th>
                                <th>Jam</th>
                                <th>Hari</th>
                                <th>Tanggal</th>
                                <th>Periode</th>
                                <th>Tahun Ajaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Fungsi Untuk Mengubah Nama Bulan Menjadi Bahasa Indonesia -->
                            <?php function tanggal_indo($tanggal)
                            {
                                $bulan = array(
                                    1 =>   'Januari',
                                    'Februari',
                                    'Maret',
                                    'April',
                                    'Mei',
                                    'Juni',
                                    'Juli',
                                    'Agustus',
                                    'September',
                                    'Oktober',
                                    'November',
                                    'Desember'
                                );
                                $split = explode('-', $tanggal);
                                return $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];
                            } ?>
                            <?php $no = 1; ?>
                            <?php foreach ($data_sidang as $ds => $data) : ?>
                                <tr>
                                    <td scope="row"><?= $no; ?></td>
                                    <td><?= $data['name']; ?></td>
                                    <td><?= $data['judul']; ?></td>
                                    <td><?= $data_dosbim1[$ds]['name']; ?></td>
                                    <td><?= $data_dosbim2[$ds]['name']; ?></td>
                                    <td><?= $data_dospeng1[$ds]['name']; ?></td>
                                    <td><?= $data_dospeng2[$ds]['name']; ?></td>
                                    <td><?= $data_jam[$ds]['range_jam']; ?></td>
                                    <td><?= $data_hari[$ds]['nama_hari']; ?></td>
                                    <td><?= tanggal_indo($data['tanggal']); ?></td>
                                    <td><?= $data_link[$ds]['link']; ?></td>
                                    <td><?= $data['periode']; ?></td>
                                    <td><?= $data['tahun_ajaran']; ?></td>
                                    <td><button type="button" class="btn btn-primary input-block-level" data-toggle="modal" data-target="#editJadwalModal<?= $data['kode_sa']; ?>">Edit</a></td>
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

    <!-- Modal Edit Data Jadwal -->
    <?php foreach ($data_jadwal as $dj => $data) : ?>
        <div class="modal fade" id="editJadwalModal<?= $data['kode_sa']; ?>" tabindex="-1" aria-labelledby="editJadwalModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editJadwalModalLabel">Edit Jadwal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('jadwal/Jadwal_Sidang/edit') ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" class="form-control" id="kode_sa" name="kode_sa" required value="<?= $data['kode_sa']; ?>" hidden>
                                <!-- <div class="mb-3">
                    <label for="">Dosen Penguji 1</label>
                    <select class="form-control" id="dospeng_1" name="dospeng_1" placeholder="Dosen Penguji 1" required>
                      <option selected value="<?= $data['dospeng_1'] ?>"><?= $data_dospeng1[$dj]['name'] ?></option>
                      <?php foreach ($data_list_dosen as $dd) : ?>
                        <option value="<?= $dd['id'] ?>"><?= $dd['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="">Dosen Penguji 2</label>
                    <select class="form-control" id="dospeng_2" name="dospeng_2" placeholder="Dosen Penguji 2" required>
                      <option selected value="<?= $data['dospeng_2'] ?>"><?= $data_dospeng2[$dj]['name'] ?></option>
                      <?php foreach ($data_list_dosen as $dd) : ?>
                        <option value="<?= $dd['id'] ?>"><?= $dd['name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div> -->
                                <div class="mb-3">
                                    <label for="">Hari</label>
                                    <select class="form-control" id="hari" name="hari" placeholder="Hari" required>
                                        <option selected value="<?= $data['hari'] ?>"><?= $data_hari[$dj]['nama_hari'] ?></option>
                                        <?php foreach ($data_hari as $dh) : ?>
                                            <option value="<?= $dh['kode_hari'] ?>"><?= $dh['nama_hari'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="">Jam</label>
                                    <select class="form-control" id="jam" name="jam" placeholder="Jam" required>
                                        <option selected value="<?= $data['jam'] ?>"><?= $data_jam[$dj]['range_jam'] ?></option>
                                        <?php foreach ($data_jam as $dj) : ?>
                                            <option id="jam" name="jam" value="<?= $dj['kode_jam'] ?>"> <?= $dj['range_jam'] ?><br>
                                            <?php endforeach; ?>
                                            <select>
                                </div>
                                <div class="mb-3">
                                    <label for="">Tanggal</label><br>
                                    <input id="dateEnd" type="date" class="form-control" name="tanggal" id="tanggal" value="<?= $data['tanggal']; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="">Link Zoom</label><br>
                                    <input type="text" class="form-control" name="link" id="link" value="<?= $data['link']; ?>">
                                </div>
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