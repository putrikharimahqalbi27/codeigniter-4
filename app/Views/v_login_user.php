<div class="row justify-content-center mt-5">
    <div class="login-box" style="width: 600px;">
        <!-- Card dengan border lebih menarik -->
        <div class="card card-outline card-info shadow-lg">
            <div class="card-header text-center">
                <img src="<?= base_url('../images/logo.png') ?>" alt="Logo UNSULBAR" style="width: 100px; height: auto;">
                <div class="card-header text-center">
                    <a href="<?= base_url('Auth') ?>" class="text-info h2"> <b> BMN UNIVERSITAS SULAWESI BARAT</b> </a>
                </div>
            </div>



            <div class="card-header text-center">

                <a href="#" class="h3"><b><?= $judul ?></b></a>

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
                if (session()->getFlashdata('pesan')) {
                    echo '<div class="alert alert-danger" role="alert" >';
                    echo session()->getFlashdata('pesan');
                    echo '</div>';
                }
                ?>
                <?php echo form_open('Auth/CekLoginUser') ?>
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <a class="btn btn-secondary" href="<?= base_url('Auth') ?>">Kembali</a>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-info btn-block">Login</button>
                    </div>
                    <!-- /.col -->
                </div>
                </form>

                <!-- /.social-auth-links -->

                <?php echo form_close() ?>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
    <!-- /.card -->