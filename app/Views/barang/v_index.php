<div class="col-md-12">
    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">Data <?= $judul  ?></h3>

            <div class="card-tools">
                <a href="<?= base_url('Barang/AddData') ?>" class="btn btn-info btn-flat btn-sm">
                    <i class="fas fa-plus"></i> Add
                </a>
            </div>
        </div>

        <div class="card-body">
            <?php

            use PHPUnit\TextUI\Configuration\Variable;

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
                        <th>Gambar</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah </th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>

                <body>
                    <?php $no = 1;
                    foreach ($barang as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?> .</td>
                            <td class="text-center">
                                <img src="<?= base_url('gambar/' . $value['gambar']) ?>" width="125px" height="160px">
                            </td>
                            <td class="text-center"><?= $value['kode_barang'] ?></td>
                            <td>
                                <h5> <?= $value['nama_barang'] ?> </h5>
                                <p>

                                    <b>Kategori : </b><?= $value['nama_kategori'] ?> <br>
                                    <b>Pj Barang : </b><?= $value['nama_pj'] ?> <br>
                                    <b>Lokasi Barang : </b> <?= $value['nama_lokasi'] ?> lantai <?= $value['lantai_lokasi'] ?> <br>

                                </p>

                            </td>

                            <td class="text-center">
                                <span class="badge badge-info"> <?= $value['jumlah_barang'] ?> </span> <br>
                            </td>


                            <td class="text-center">
                                <a href="<?= base_url('Barang/EditData/' . $value['id_barang']) ?>" class="btn btn-warning btn-flat btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-flat btn-sm" data-toggle="modal" data-target="#modal-delete<?= $value['id_barang'] ?>">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                    <?php } ?>
                </body>
        </div>

        </table>
    </div>

</div>

<!-- Modal Delete -->
<?php foreach ($barang as $key => $value) { ?>
    <div class="modal fade" id="modal-delete<?= $value['id_barang'] ?>">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Delete Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open(base_url('Barang/DeleteData/' .  $value['id_barang'])) ?>
                    <div class="form-group">
                        apakah anda yakin Hapus data <b><?= $value['nama_barang'] ?></b> ...?

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