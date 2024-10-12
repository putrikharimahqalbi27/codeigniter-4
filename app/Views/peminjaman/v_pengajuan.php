<div class="col-md-12">
    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title"><?= $judul  ?></h3>

            <div class="card-tools">
                <button class="btn btn-info btn-flat btn-sm" data-toggle="modal" data-target="#modal-sm">
                    <i class="  fas fa-plus"></i> Tambah Pengajuan
                </button>
            </div>
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($pengajuanbarang as $key => $value) { ?>
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

                                </p>
                            </td>
                            <td><a href="<?= base_url('uploads/surat/' . $value['surat']) ?>" target="_blank">Lihat Surat Permohonan</a></td>
                            <td><?= $value['uraian_kegiatan'] ?></td>
                            <td> <span class=" right badge badge-warning"><?= $value['status_pinjam'] ?></span></td>
                            <td class="text-center"><button class=" btn btn-danger btn-flat btn-sm" data-toggle="modal" data-target="#modal-delete<?= $value['id_pinjam'] ?>"> <i class="fas fa-trash"></i></button> </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>


        </div>
    </div>
</div>

<!-- Modal Tambah Pengajuan -->

<div class="modal fade" id="modal-sm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah <?= $judul ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">




                <?php echo form_open(base_url('Peminjaman/AddPengajuan'), ['enctype' => 'multipart/form-data']); ?>
                <div class="card-body">
                    <div class="form-group">
                        <label>No Pinjam </label>
                        <input class="form-control" name="no_pinjam" value="<?= $no_pinjam ?>" readonly>
                    </div>
                    <div class="form-group">

                        <label>Nama Barang</label>
                        <select name="id_barang" class="form-control select2">
                            <option value="">--Pilih Barang--</option>
                            <?php foreach ($barang as $key => $value) { ?>
                                <option value=" <?= $value['id_barang'] ?>"> <?= $value['nama_barang'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Pinjam</label>
                        <input type="date" class="form-control" name="tgl_pinjam" required>
                    </div>
                    <div class="form-group">
                        <label>Lama Pinjam</label>
                        <input type="number" class="form-control" name="lama_pinjam">
                    </div>
                    <div class="form-group">
                        <label>Uraian Kegiatan</label>
                        <input type="text" class="form-control" name="uraian_kegiatan">
                    </div>

                    <div class="form-group">
                        <label for="surat">Upload Surat Permohonan:</label>
                        <input type="file" name="surat" id="surat" accept=".pdf" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info btn-flat">Ajukan Permohonan</button>
                </div>


                </form>


            </div>

            <?php echo form_close() ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- Modal Delete -->
<?php foreach ($pengajuanbarang as $key => $value) { ?>
    <div class="modal fade" id="modal-delete<?= $value['id_pinjam'] ?>">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Pengajuan <?= $judul ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open(base_url('Peminjaman/DeleteData/' .  $value['id_pinjam'])) ?>
                    <div class="form-group">
                        apakah anda yakin Hapus Pengajuan <b><?= $value['nama_barang'] ?></b> ...?

                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger btn-flat">Delete</button>
                </div>
                <?php echo form_close() ?>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

<?php } ?>