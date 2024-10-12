<div class="col-md-12">
    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">Data <?= $judul  ?></h3>


        </div>

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
            <?php echo form_open_multipart('DashboardAnggota/UpdateProfile') ?>

            <div class="row">
                <div class="col-sm-2">
                    <div class="row">
                        <div class="col-sm-12">
                            <label>File Foto</label>
                            <img src="<?= base_url('foto/' . $anggota['foto']) ?>" id="gambar_load" class="img-fluid" width="200px" height="200px">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Foto</label>
                            <input type="file" name="foto" class="form-control" id="preview_gambar" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="col-sm-10">

                    <div class="form-group">
                        <label>Kode</label>
                        <input class="form-control" name="kode" value="<?= $anggota['kode'] ?>" placeholder="Kode">
                    </div>
                    <div class="form-group">
                        <label>Nama Anggota</label>
                        <input class="form-control" name="nama_anggota" value="<?= $anggota['nama_anggota'] ?>" placeholder="Nama Anggota">
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin </label>
                        <select name="jenis_kelamin" class="form-control">
                            <option value="<?= $anggota['jenis_kelamin'] ?>"><?= $anggota['jenis_kelamin'] ?></option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="col-sm-12">
                        <label>Lembaga</label>
                        <select name="id_jabatan" class="form-control">
                            <option value="<?= $anggota['id_jabatan'] ?>"><?= $anggota['nama_jabatan'] ?></option>
                            <?php foreach ($jabatan as $key => $value) { ?>
                                <option value="<?= $value['id_jabatan'] ?>"><?= $value['nama_jabatan'] ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>No Handphone</label>
                        <input class="form-control" name="no_hp" value="<?= $anggota['no_hp'] ?>" placeholder="No handhphone">
                    </div>
                    <div class="form-group">
                        <label>Alamat </label>
                        <input class="form-control" name="alamat" value="<?= $anggota['alamat'] ?>" placeholder="Alamat">
                    </div>
                    <div class="form-group">
                        <label>Password </label>
                        <input class="form-control" name="password" value="<?= $anggota['password'] ?>" placeholder="Password">
                    </div>
                </div>
                <a href="<?= base_url('DashboardAnggota') ?>" class="btn btn-secondary" style="margin-right: 10px;">
                    <i class="fas fa-share"></i> Kembali
                </a>
                <button type="submit" class="btn btn-info">
                    <i class="fas fa-save"></i> Simpan
                </button>

            </div>
            <?php echo form_close() ?>
        </div>

    </div>

</div>