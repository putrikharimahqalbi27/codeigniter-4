<div class="col-md-12">
    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title"><?= $judul ?></h3>
        </div>

        <div class="card-body">
            <?php
            $id_anggota = session()->get('id_anggota');
            $tgl = date('YmdHis');
            $no_pinjam = $id_anggota . $tgl;
            ?>
            <?php

            if (session()->getFlashdata('ditolak')) {
                echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-times"></i> ';
                echo session()->getFlashdata('ditolak');
                echo '</h5></div>';
            }

            if (session()->getFlashdata('diterima')) {
                echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> ';
                echo session()->getFlashdata('diterima');
                echo '</h5></div>';
            }

            if (session()->getFlashdata('dikembalikan')) {
                echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> ';
                echo session()->getFlashdata('dikembalikan');
                echo '</h5></div>';
            }
            ?>


            <?php
            $db = \Config\Database::connect();

            foreach ($pengajuandikembalikan as $key => $value) {
                $barang = $db->table('tbl_peminjaman')
                    ->join('tbl_barang', 'tbl_barang.id_barang= tbl_peminjaman.id_barang', 'left')
                    ->where('id_anggota', $value['id_anggota'])
                    ->where('status_pinjam', 'Dikembalikan')
                    ->get()->getResultArray();
            ?>

                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Barang</th>
                            <th>Nama Pemohon</th>
                            <th>Tanggal</th>
                            <th>Surat Permohonan</th>
                            <th>Uraian Kegiatan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($barang as $key => $data) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td class="text-center">
                                    <img src="<?= base_url('gambar/' . $data['gambar']) ?>" width="80px" height="80px">
                                </td>
                                <td><?= $data['nama_barang'] ?></td>
                                <td><?= $value['nama_anggota'] ?></td>

                                <td>
                                    <b>Tanggal Diajukan : </b><?= $data['tgl_pinjam'] ?> <br>
                                    <b>Tanggal Pinjam : </b><?= $data['tgl_pinjam'] ?> <br>
                                    <b>Lama Pinjam : </b><?= $data['lama_pinjam'] ?> hari <br>
                                    <b>Tgl harus kembali :</b> <?= $data['tgl_harus_kembali'] ?> <br>
                                    <b>Tgl kembali :</b> <?= $data['tgl_kembali'] ?> <br>
                                </td>

                                <td><a href="<?= base_url('uploads/surat/' . $data['surat']) ?>" target="_blank">Lihat Surat Permohonan</a></td>
                                <td><?= $data['uraian_kegiatan'] ?></td>
                                <td><?= $data['status_pinjam'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
        </div>

    <?php } ?>



    </div>
</div>
</div>