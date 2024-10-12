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
            // Menampilkan pesan flash jika ada
            if (session()->getFlashdata('ditolak')) {
                echo '<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-times"></i> ' . session()->getFlashdata('ditolak') . '</h5>
                    </div>';
            }

            if (session()->getFlashdata('diterima')) {
                echo '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> ' . session()->getFlashdata('diterima') . '</h5>
                    </div>';
            }
            ?>

            <?php
            $db = \Config\Database::connect();
            $barang_total = [];

            foreach ($pengajuanditerima as $value) {
                $barang = $db->table('tbl_peminjaman')
                    ->join('tbl_barang', 'tbl_barang.id_barang = tbl_peminjaman.id_barang', 'left')
                    ->where('id_anggota', $value['id_anggota'])
                    ->where('status_pinjam', 'Diterima')
                    ->get()->getResultArray();

                // Menggabungkan data barang ke dalam satu array
                foreach ($barang as $data) {
                    $data['nama_anggota'] = $value['nama_anggota']; // Menyimpan nama pemohon
                    $barang_total[] = $data;
                }
            }
            ?>

            <table class="table table-bordered">
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($barang_total as $data) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td class="text-center">
                                <img src="<?= base_url('gambar/' . $data['gambar']) ?>" width="80" height="80" alt="Gambar Barang">
                            </td>
                            <td><?= $data['nama_barang'] ?></td>
                            <td><?= $data['nama_anggota'] ?></td>
                            <td>
                                <b>Tanggal Diajukan: </b><?= $data['tgl_pinjam'] ?><br>
                                <b>Tanggal Pinjam: </b><?= $data['tgl_pinjam'] ?><br>
                                <b>Lama Pinjam: </b><?= $data['lama_pinjam'] ?> hari<br>
                                <b>Tgl Harus Kembali: </b><?= $data['tgl_harus_kembali'] ?><br>
                            </td>
                            <td>
                                <a href="<?= base_url('uploads/surat/' . $data['surat']) ?>" target="_blank">Lihat Surat Permohonan</a>
                            </td>
                            <td><?= $data['uraian_kegiatan'] ?></td>
                            <td><?= $data['status_pinjam'] ?></td>
                            <td>
                                <a href="<?= base_url('Admin/KembaliBarang/' . $data['id_pinjam']) ?>" class="right badge badge-info">
                                    <i class="fas fa-check"></i> Kembali
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>