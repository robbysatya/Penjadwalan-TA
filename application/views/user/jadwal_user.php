<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="card shadow mb-4">
        <div class="card-header pt-4">
            <h6>Jadwal Seminar Proposal Anda</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="modal-body">
                    <?= $this->session->flashdata('message'); ?>

                    <!-- DATA JADWAL SEMPRO -->
                    <p>
                        Berikut ini jadwal Seminar Proposal anda :
                    </p>
                    <table class="table table-bordered" width="100%" cellspacing="0" style="font-size: 14px;">
                        <thead>
                            <tr>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Judul Penelitian</th>
                                <th>Dosbim 1</th>
                                <th>Dosbim 2</th>
                                <th>Dospeng 1</th>
                                <th>Dospeng 2</th>
                                <th>Jam</th>
                                <th>Hari</th>
                                <th>Tanggal</th>
                                <th>Link Zoom</th>
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
                            <?php foreach ($data_jadwal_user as $dju => $data) : ?>
                                <tr>
                                    <td><?= $data['nim']; ?></td>
                                    <td><?= $data['name']; ?></td>
                                    <td><?= $data['judul']; ?></td>
                                    <td><?= $data_dosbim_1[$dju]['name']; ?></td>
                                    <td><?= $data_dosbim_2[$dju]['name']; ?></td>
                                    <td><?= $data_dospeng_1[$dju]['name']; ?></td>
                                    <td><?= $data_dospeng_2[$dju]['name']; ?></td>
                                    <td><?= $data_jam[$dju]['range_jam']; ?></td>
                                    <td><?= $data_hari[$dju]['nama_hari']; ?></td>
                                    <td><?= tanggal_indo($data_tanggal[$dju]['tanggal']); ?></td>
                                    <td><a class="btn btn-primary" href="<?= $data_link[$dju]['link']; ?>" target="_blank"><i class="fa far fa-link"></i> Buka Zoom</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="card shadow mb-4">
        <div class="card-header pt-4">
            <h6>Jadwal Sidang Akhir Anda</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="modal-body">
                    <?= $this->session->flashdata('message'); ?>

                    <!-- DATA JADWAL SIDANG -->
                    <p>
                        Berikut ini jadwal Sidang Akhir anda :
                    </p>

                    <table class="table table-bordered" width="100%" cellspacing="0" style="font-size: 14px;">
                        <thead>
                            <tr>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Judul Penelitian</th>
                                <th>Dosbim 1</th>
                                <th>Dosbim 2</th>
                                <th>Dospeng 1</th>
                                <th>Dospeng 2</th>
                                <th>Jam</th>
                                <th>Hari</th>
                                <th>Tanggal</th>
                                <th>Link Zoom</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_jadwal_user_sidang as $djus => $data) : ?>
                                <tr>
                                    <td><?= $data['nim']; ?></td>
                                    <td><?= $data['name']; ?></td>
                                    <td><?= $data['judul']; ?></td>
                                    <td><?= $data_dosbim_1[$djus]['name']; ?></td>
                                    <td><?= $data_dosbim_2[$djus]['name']; ?></td>
                                    <td><?= $data_dospeng_1[$djus]['name']; ?></td>
                                    <td><?= $data_dospeng_2[$djus]['name']; ?></td>
                                    <td><?= $data_jam[$djus]['range_jam']; ?></td>
                                    <td><?= $data_hari[$djus]['nama_hari']; ?></td>
                                    <td><?= tanggal_indo($data_tanggal[$djus]['tanggal']); ?></td>
                                    <td><a class="btn btn-primary" href="<?= $data_link[$djus]['link']; ?>" target="_blank"><i class="fa far fa-link"></i> Buka Zoom</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->