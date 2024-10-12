<div class="col-md-12">
    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">Data <?= $judul  ?></h3>

            <div class="card-tools">
                <button type="button" class="btn btn-info btn-flat btn-sm" data-toggle="modal" data-target="#modal-default">
                    <i class="fas fa-plus"></i> Add
                </button>
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
            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th width="50px">NO</th>
                        <th>NAMA PENANGGUNG JAWAB</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>

                <body>
                    <?php $no = 1;
                    foreach ($pj as $key => $value) { ?>
                        <tr>
                            <td><?= $no++ ?> .</td>
                            <td><?= $value['nama_pj'] ?> </td>
                            <td>
                                <button type="button" class="btn btn-warning btn-flat btn-sm" data-toggle="modal" data-target="#modal-edit<?= $value['id_pj'] ?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-flat btn-sm" data-toggle="modal" data-target="#modal-delete<?= $value['id_pj'] ?>">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>

                    <?php } ?>
                </body>

            </table>
        </div>

    </div>

</div>

<!-- Modal Add -->

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah <?= $judul ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open(base_url('Pj/AddData')) ?>
                <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Penanggung Jawab</label>
                        <input class="form-control" name="nama_pj" placeholder="Nama Pj" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info btn-flat">Save </button>
            </div>
            <?php echo form_close() ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- Modal Edit -->
<?php foreach ($pj as $key => $value) { ?>
    <div class="modal fade" id="modal-edit<?= $value['id_pj'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit <?= $judul ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open(base_url('Pj/EditData/' .  $value['id_pj'])) ?>
                    <div class="form-group">
                        <label>Nama Penanggung Jawab</label>
                        <input class="form-control" value="<?= $value['nama_pj'] ?>" name=" nama_pj" placeholder="Nama Pj" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info btn-flat">Update</button>
                </div>
                <?php echo form_close() ?>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

<?php } ?>
<!-- Modal Delete -->
<?php foreach ($pj as $key => $value) { ?>
    <div class="modal fade" id="modal-delete<?= $value['id_pj'] ?>">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus <?= $judul ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php echo form_open(base_url('Pj/DeleteData/' .  $value['id_pj'])) ?>
                    <div class="form-group">
                        apakah anda yakin Hapus data <b><?= $value['nama_pj'] ?></b> ...?

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