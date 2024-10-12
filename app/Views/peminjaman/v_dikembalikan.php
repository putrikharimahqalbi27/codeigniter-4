<div class="col-md-12">
    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title"><?= $judul  ?></h3>


        </div>

        <div class="card-body">
            <?php
            $id_anggota = session()->get('id_anggota');
            $tgl = date('YmdHis');
            $no_pinjam = $id_anggota . $tgl;
            ?>
            <?php
            // notifikasi
            $errors = session()->getFlashdata('errors');
            if (!empty($errors)) { ?>
                <div class="alert alert-danger" role="alert">
                    <h4>Periksa Entry Form</h4>
                    <ul>
                        <?php foreach ($errors as $key => $error) { ?>
                            <li><?= esc($error) ?></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>

            <?php

            use PHPUnit\TextUI\Configuration\Variable;

            use function Symfony\Component\String\b;

            if (session()->getFlashdata('pesan')) {
                echo '<div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i> ';
                echo session()->getFlashdata('pesan');
                echo '</h5></div>';
            }
            ?>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Pinjam</th>
                        <th>Gambar Barang</th>
                        <th>Data Barang</th>
                        <th>Tanggal</th>
                        <th>Surat Permohonan</th>
                        <th>Uraian Kegiatan</th>
                        <th>Status</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($pengajuandikembalikan as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $value['no_pinjam'] ?></td>
                            <td class="text-center">
                                <img src="<?= base_url('gambar/' . $value['gambar']) ?>" width="125px" height="160px" alt="Gambar Barang">
                            </td>

                            <td>

                                <b> <?= $value['nama_barang'] ?></b>
                                <p>

                                    <b>Kategori : </b><?= $value['nama_kategori'] ?> <br>
                                    <b>Pj Barang : </b><?= $value['nama_pj'] ?> <br>
                                    <b>Lokasi Barang : </b> <?= $value['nama_lokasi'] ?> lantai <?= $value['lantai_lokasi'] ?> <br>

                                </p>

                            </td>
                            <td>
                                <p>
                                    <b>Tanggal Diajukan : </b><?= $value['tgl_pinjam'] ?> <br>
                                    <b>Tanggal Pinjam : </b><?= $value['tgl_pinjam'] ?> <br>
                                    <b>Lama Pinjam : </b><?= $value['lama_pinjam'] ?> hari <br>
                                    <b> Tgl harus kembali :</b> <?= $value['tgl_harus_kembali'] ?> <br>
                                    <b> Tgl kembali :</b> <?= $value['tgl_kembali'] ?> <br>

                                </p>
                            </td>
                            <td><a href="<?= base_url('surat/' . $value['surat']) ?>" target="_blank">Lihat Surat Permohonan</a></td>
                            <td><?= $value['uraian_kegiatan'] ?></td>
                            <td> <span class="right badge badge-success"><?= $value['status_pinjam'] ?></span></td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>


        </div>
    </div>
</div>