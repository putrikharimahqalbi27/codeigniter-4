<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Form <?= $judul ?></h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <?php
        echo form_open_multipart('Pengaturan/UpdateWeb');
        ?>
        <div class="card-body">
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

            if (session()->getFlashdata('pesan')) {
                echo '<div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h5><i class="icon fas fa-check"></i> ';
                echo session()->getFlashdata('pesan');
                echo '</h5></div>';
            }
            ?>


            <div class="row">
                <div class="col-sm-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Logo Organisasi</label>
                            <div class="form-group">
                                <img src="<?= base_url('logo/' . $web['logo']) ?>" width="200px">
                            </div>
                        </div>


                    </div>

                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Ganti Logo</label>
                        <input type="file" name="logo" class="form-control" accept="image/png">
                    </div>
                </div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Nama Organisasi</label>
                                <input class="form-control" name="bmn_univ" value="<?= $web['bmn_univ'] ?>" placeholder="Nama Organisasi">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Alamat</label>
                                <input class="form-control" name="alamat" value="<?= $web['alamat'] ?>" placeholder="Alamat">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Kecamatan</label>
                                <input class="form-control" name="kecamatan" value="<?= $web['kecamatan'] ?>" placeholder="Kecamatan">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Kabupaten/ Kota</label>
                                <input class="form-control" name="kab_kota" value="<?= $web['kab_kota'] ?>" placeholder="Kabupaten / Kota">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Kode Pos</label>
                                <input class="form-control" name="pos" value="<?= $web['pos'] ?>" placeholder="Kode Pos">
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>No Telepon</label>
                                <input class="form-control" name="no_telpon" value="<?= $web['no_telpon'] ?>" placeholder="No Telpon">
                            </div>
                        </div>



                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Visi </label>
                                <textarea rows="4" class="form-control" name="visi"> <?= $web['visi'] ?> </textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Misi </label>
                                <textarea rows="4" class="form-control" name="misi"> <?= $web['misi'] ?> </textarea>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Info</label>
                                <textarea rows="4" class="form-control" name="sejarah"> <?= $web['Sejarah'] ?> </textarea>
                            </div>
                        </div>


                    </div>

                </div>



            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a href="<?= base_url('Admin') ?>" class="btn btn-secondary"><i class="fas fa-share"> Kembali </i></a>
                <button type="submit" class="btn btn-info"><i class="fas fa-save"> Simpan</i></button>

            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>
<!-- /.card -->