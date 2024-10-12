<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Form <?= $judul ?></h3>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <?php
            // Notifikasi kesalahan validasi
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
            // Notifikasi pesan sukses
            if (session()->getFlashdata('pesan')) {
                echo '<div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h5><i class="icon fas fa-check"></i> ';
                echo session()->getFlashdata('pesan');
                echo '</h5></div>';
            }
            ?>

            <?php
            echo form_open_multipart('Anggota/SimpanData/' . $anggota['id_anggota']);
            ?>

            <!-- Foto Anggota -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <img src="<?= base_url('foto/' . $anggota['foto']) ?>" width="200px" alt="Foto Anggota">
                    </div>
                </div>
            </div>

            <!-- Ganti Foto -->
            <div class="form-group">
                <label>Ganti Foto</label>
                <input type="file" name="foto" class="form-control" accept="image/png, image/jpeg">
            </div>

            <!-- Input Data Anggota -->
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Kode</label>
                    <input class="form-control" name="kode" value="<?= $anggota['kode'] ?>" placeholder="Kode">
                </div>

                <div class="form-group">
                    <label>Nama Anggota</label>
                    <input class="form-control" name="nama_anggota" value="<?= $anggota['nama_anggota'] ?>" placeholder="Nama Anggota">
                </div>

                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control">
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki" <?= ($anggota['jenis_kelamin'] == 'Laki-laki') ? 'selected' : '' ?>>Laki-Laki</option>
                        <option value="Perempuan" <?= ($anggota['jenis_kelamin'] == 'Perempuan') ? 'selected' : '' ?>>Perempuan</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Lembaga</label>
                    <select name="id_jabatan" class="form-control">
                        <option value="">Pilih Lembaga</option>
                        <?php foreach ($jabatan as $key => $value) { ?>
                            <option value="<?= $value['id_jabatan'] ?>" <?= ($anggota['id_jabatan'] == $value['id_jabatan']) ? 'selected' : '' ?>>
                                <?= $value['nama_jabatan'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>No Handphone</label>
                    <input class="form-control" name="no_hp" value="<?= $anggota['no_hp'] ?>" placeholder="No Handphone">
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input class="form-control" name="password" value="<?= $anggota['password'] ?>" placeholder="Password">
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <input class="form-control" name="alamat" value="<?= $anggota['alamat'] ?>" placeholder="Alamat">
                </div>
            </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <a href="<?= base_url('Anggota') ?>" class="btn btn-secondary"><i class="fas fa-share"> Kembali</i></a>
            <button type="submit" class="btn btn-info"><i class="fas fa-save"> Simpan</i></button>
        </div>

        <?php echo form_close(); ?>
    </div>
    <!-- /.card -->
</div>