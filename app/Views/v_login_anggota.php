<div class="row justify-content-center mt-5">
    <div class="login-box" style="width: 600px; margin-bottom: 20px;"> <!-- Tambahkan margin-bottom -->
        <!-- Card dengan border lebih menarik -->
        <div class="card card-outline card-info shadow-lg">
            <div class="card-header text-center">
                <img src="<?= base_url('../images/logo.png') ?>" alt="Logo UNSULBAR" style="width: 100px; height: auto;">
                <div class="card-header text-center">
                    <a href="<?= base_url('Auth') ?>" class="text-info h2"> <b> BMN UNIVERSITAS SULAWESI BARAT</b> </a>
                </div>
            </div>

            <div class="card-header text-center">
                <a href="<?= base_url('Auth') ?>" class="h3"> <b> <?= $judul ?></b> </a>
            </div>

            <!-- Isi Form Login -->
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
                if (session()->getFlashdata('pesan')) {
                    echo '<div class="alert alert-danger" role="alert">';
                    echo session()->getFlashdata('pesan');
                    echo '</div>';
                }
                ?>

                <!-- Form untuk login -->
                <?php echo form_open('Auth/CekLoginAnggota') ?>
                <div class="input-group mb-3">
                    <input type="text" name="kode" class="form-control" placeholder="Nim/Nik/Nip yang terdaftar">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Kata Sandi">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <a class="btn btn-secondary btn-block" href="<?= base_url('Auth') ?>">Kembali</a>
                    </div>
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-info btn-block">Login</button>
                    </div>
                </div>
                <div class="social-auth-links text-center mb-3">
                    <p>- OR -</p>
                    <a href="<?= base_url('Auth/Register') ?>" class="btn btn-block btn-warning">
                        <i class="fa fa-user-plus"></i> Daftar Anggota
                    </a>
                </div>
            </div>
            <?php echo form_close() ?>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>