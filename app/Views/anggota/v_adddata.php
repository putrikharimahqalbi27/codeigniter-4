<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Form <?= $judul ?></h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->


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

            <?php
            echo form_open_multipart('Anggota/SimpanData');
            ?>
            <div class="row">
                <div class="col-sm-2">
                    <div class="row">
                        <div class="col-sm-12">
                            <label>Foto </label>
                            <img src="<?= base_url('foto/blankfoto.jpg') ?>" id="gambar_load" class="img-fluid" width="200px" height="200px">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>File Foto</label>
                            <input type="file" name="foto" class="form-control" id="preview_gambar" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="col-sm-10">

                    <div class="form-group">
                        <label>Kode</label>
                        <input class="form-control" name="kode" value="<?= old('kode') ?>" placeholder="Kode">
                    </div>

                    <div class="form-group">
                        <label>Nama Anggota</label>
                        <input class="form-control" name="nama_anggota" value="<?= old('nama_anggota') ?>" placeholder="Nama Anggota">
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control">
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Lembaga</label>
                        <select name="id_jabatan" class="form-control">
                            <option value="">-Pilih Lembaga -</option>
                            <?php foreach ($jabatan as $key => $value) { ?>
                                <option value="<?= $value['id_jabatan'] ?>"><?= $value['nama_jabatan'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>No Handphone</label>
                        <input class="form-control" name="no_hp" value="<?= old('no_hp') ?>" placeholder="No Handphone">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" name="password" value="<?= old('password') ?>" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <input class="form-control" name="alamat" value="<?= old('alamat') ?>" placeholder="Alamat">
                    </div>


                </div>

            </div>
        </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <a href="<?= base_url('Anggota') ?>" class="btn btn-secondary"><i class="fas fa-share"> Kembali </i></a>
        <button type="submit" class="btn btn-info"><i class="fas fa-save"> Simpan</i></button>

    </div>
    <?php echo form_close() ?>
</div>

<!-- /.card -->