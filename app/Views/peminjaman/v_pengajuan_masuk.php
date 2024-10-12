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

            <?php if (session()->getFlashdata('ditolak')): ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-times"></i> <?= session()->getFlashdata('ditolak') ?></h5>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('diterima')): ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-check"></i> <?= session()->getFlashdata('diterima') ?></h5>
                </div>
            <?php endif; ?>

            <?php
            $db = \Config\Database::connect();

            foreach ($pengajuanmasuk as $value):
                $barang = $db->table('tbl_peminjaman')
                    ->join('tbl_barang', 'tbl_barang.id_barang = tbl_peminjaman.id_barang', 'left')
                    ->where('id_anggota', $value['id_anggota'])
                    ->where('status_pinjam', 'Diajukan')
                    ->get()->getResultArray();
            ?>
                <div class="col-md-12">
                    <div class="card card-widget widget-user-2">
                        <div class="widget-user-header bg-secondary">
                            <div class="widget-user-image">
                                <img class="" src="<?= base_url('foto/' . $value['foto']) ?>">
                            </div>
                            <h3 class="widget-user-username"><?= $value['nama_anggota'] ?></h3>
                            <h5 class="widget-user-desc"><?= $value['kode'] ?></h5>
                        </div>

                        <table class="table table-bordered">
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Nama Barang</th>
                                <th>Tanggal</th>
                                <th>Surat Permohonan</th>
                                <th>Uraian Kegiatan</th>
                                <th>Action</th>
                            </tr>
                            <?php $no = 1;
                            foreach ($barang as $data): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td class="text-center">
                                        <img src="<?= base_url('gambar/' . $data['gambar']) ?>" width="80px" height="80px">
                                    </td>
                                    <td><?= $data['nama_barang'] ?></td>
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
                                    <td>
                                        <button class="right badge badge-danger" data-toggle="modal" data-target="#ditolak<?= $data['id_pinjam'] ?>">
                                            <i class="fas fa-times"></i> Tolak
                                        </button>
                                        <a href="<?= base_url('Admin/TerimaBarang/' .  $data['id_pinjam']) ?>" class="right badge badge-success">
                                            <i class="fas fa-check"></i> Terima
                                        </a>
                                    </td>
                                </tr>

                                <!-- Modal Ditolak -->
                                <div class="modal fade" id="ditolak<?= $data['id_pinjam'] ?>">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Tolak Permohonan <?= $data['nama_barang'] ?></h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <?= form_open(base_url('Admin/TolakBarang/' .  $data['id_pinjam'])) ?>
                                                <div class="form-group">
                                                    <label>Keterangan</label>
                                                    <textarea name="keterangan" rows="5" class="form-control" required></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-warning btn-flat">Tolak</button>
                                            </div>
                                            <?= form_close() ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>