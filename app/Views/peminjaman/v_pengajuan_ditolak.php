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

            $db = \Config\Database::connect();
            ?>

            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Nama Barang</th>
                            <th>Nama Pemohon</th>
                            <th>Tanggal Diajukan</th>
                            <th>Surat Permohonan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($pengajuanditolak as $key => $value) {
                            $barang = $db->table('tbl_peminjaman')
                                ->join('tbl_barang', 'tbl_barang.id_barang = tbl_peminjaman.id_barang', 'left')
                                ->where('id_anggota', $value['id_anggota'])
                                ->where('status_pinjam', 'Ditolak')
                                ->get()->getResultArray();

                            foreach ($barang as $key => $data) { ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td class="text-center">
                                        <img src="<?= base_url('gambar/' . $data['gambar']) ?>" width="80px" height="80px">
                                    </td>
                                    <td><?= $data['nama_barang'] ?></td>
                                    <td><?= $value['nama_anggota'] ?></td>
                                    <td><?= $data['tgl_pinjam'] ?></td>
                                    <td>
                                        <a href="<?= base_url('uploads/surat/' . $data['surat']) ?>" target="_blank">Lihat Surat Permohonan</a>
                                    </td>
                                </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>