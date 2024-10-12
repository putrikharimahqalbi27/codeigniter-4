<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Form <?= $judul ?></h3>
        </div>
        <!-- /.card-header -->

        <div class="card-body">
            <?php
            // Notifikasi error
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

            <!-- Form Update Data -->
            <?php echo form_open_multipart('User/UpdateData/' . $user['id_user']); ?>

            <!-- Foto User -->
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Foto</label>
                    <div>
                        <img src="<?= base_url('foto/' . $user['foto']) ?>" width="200px" alt="Foto User">
                    </div>
                </div>
            </div>

            <!-- Ganti Foto -->
            <div class="form-group">
                <label>Ganti Foto</label>
                <input type="file" name="foto" class="form-control" accept="image/png, image/jpeg">
            </div>

            <!-- Input Data User -->
            <div class="form-group">
                <label>Nama User</label>
                <input type="text" class="form-control" name="nama_user" value="<?= $user['nama_user'] ?>" placeholder="Nama User">
            </div>

            <div class="form-group">
                <label>E-mail</label>
                <input type="email" class="form-control" name="email" value="<?= $user['email'] ?>" placeholder="E-Mail">
            </div>

            <div class="form-group">
                <label>No Handphone</label>
                <input type="text" class="form-control" name="no_hp" value="<?= $user['no_hp'] ?>" placeholder="No Handphone">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" value="<?= $user['password'] ?>" placeholder="Password">
            </div>

            <div class="form-group">
                <label>Level</label>
                <select name="level" class="form-control">
                    <option value="<?= $user['level'] ?>">-- Pilih Level -- <?= $user['level'] == 0 ? 'Admin' : 'Petugas' ?></option>
                    <option value="0">Admin</option>
                    <option value="1">Petugas</option>
                </select>
            </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <a href="<?= base_url('User') ?>" class="btn btn-secondary"><i class="fas fa-share"> Kembali </i></a>
            <button type="submit" class="btn btn-info"><i class="fas fa-save"> Simpan</i></button>
        </div>

        <?php echo form_close(); ?>
    </div>
    <!-- /.card -->
</div>