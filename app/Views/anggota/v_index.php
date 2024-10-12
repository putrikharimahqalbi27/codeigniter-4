<div class="col-md-12">
    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">Data <?= $judul ?></h3>
            <div class="card-tools">
                <a href="<?= base_url('Anggota/AddData') ?>" class="btn btn-info btn-flat btn-sm">
                    <i class="fas fa-plus"></i> Add
                </a>
            </div>
        </div>

        <div class="card-body">
            <?php
            if (session()->getFlashdata('pesan')) {
                echo '<div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5><i class="icon fas fa-check"></i> ';
                echo session()->getFlashdata('pesan');
                echo '</h5></div>';
            }
            ?>
            <table id="example1" class="table table-bordered table-hover">
                <thead>
                    <tr class="text-center">
                        <th width="50px">NO</th>
                        <th>kode</th>
                        <th>Nama Anggota</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Organisasi</th>
                        <th>No Handphone</th>
                        <th>Password</th>
                        <th>Foto</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($anggota as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?>.</td>
                            <td><?= $value['kode'] ?></td>
                            <td>
                                <?= $value['nama_anggota'] ?><br>
                                <?php if ($value['verifikasi'] == 1) { ?>
                                    <a class="text-success"><i class="fa fa-check"></i> Verifikasi</a>
                                <?php } else { ?>
                                    <a class="text-danger"><i class="fa fa-times"></i> Belum Verifikasi</a><br>
                                    <a class="btn btn-success btn-xs" href="<?= base_url('Anggota/Verifikasi/' . $value['id_anggota']) ?>">Verifikasi</a>
                                <?php } ?>
                            </td>
                            <td><?= $value['jenis_kelamin'] ?></td>
                            <td><?= $value['alamat'] ?></td>
                            <td><?= $value['nama_jabatan'] ?></td>
                            <td><?= $value['no_hp'] ?></td>
                            <td><?= $value['password'] ?></td>
                            <td class="text-center">
                                <img src="<?= base_url('foto/' . $value['foto']) ?>" width="125px" height="160px">
                            </td>
                            <td class="text-center">
                                <a href="<?= base_url('Anggota/EditData/' . $value['id_anggota']) ?>" class="btn btn-warning btn-flat btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-flat btn-sm" data-toggle="modal" data-target="#modal-delete<?= $value['id_anggota'] ?>">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<?php foreach ($anggota as $key => $value) { ?>
    <div class="modal fade" id="modal-delete<?= $value['id_anggota'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete <?= $judul ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open(base_url('anggota/DeleteData/' . $value['id_anggota'])) ?>
                    <div class="form-group">
                        Apakah anda yakin Hapus data <b><?= $value['nama_anggota'] ?></b>...?
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger btn-flat">Delete</button>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
<?php } ?>