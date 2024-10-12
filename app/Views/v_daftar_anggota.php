<div class="row justify-content-center mt-5">
    <div class="login-box" style="width: 900px; margin-bottom: 20px;">
        <!-- Card dengan border lebih menarik -->
        <div class="card card-outline card-info shadow-lg">
            <div class="card-header text-center">
                <img src="<?= base_url('../images/logounsulbar.png') ?>" alt="Logo UNSULBAR" style="width: 100px; height: auto;">
                <div class="card-header text-center">
                    <a href="<?= base_url('Auth') ?>" class="text-info h2">
                        <b>BMN UNIVERSITAS SULAWESI BARAT</b>
                    </a>
                </div>
            </div>

            <div class="card-header text-center">
                <a href="<?= base_url('Auth') ?>" class="h3">
                    <b><?= $judul ?></b>
                </a>
            </div>

            <div class="card-body">
                <!-- Notifikasi Validasi -->
                <?php
                $errors = session()->getFlashdata('errors');
                if (!empty($errors)) { ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <h4 class="alert-heading">Periksa Entry Form!</h4>
                        <ul>
                            <?php foreach ($errors as $key => $error) { ?>
                                <li><?= esc($error) ?></li>
                            <?php } ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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

                <?php echo form_open('Auth/Daftar') ?>

                <!-- Input No Handphone -->
                <div class="form-group mb-3">
                    <label for="no_hp">No Handphone</label>
                    <input class="form-control" name="no_hp" value="<?= old('no_hp') ?>" placeholder="Masukkan No Handphone/WhatsApp Aktif">
                </div>

                <!-- Pilihan Lembaga -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Lembaga</label>
                            <select name="id_jabatan" class="form-control">
                                <option value="">-Pilih Lembaga-</option>
                                <?php foreach ($jabatan as $key => $value) { ?>
                                    <option value="<?= $value['id_jabatan'] ?>"><?= $value['nama_jabatan'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Kode</label>
                            <input class="form-control" name="kode" value="<?= old('kode') ?>" placeholder="NIM / NIP / NIK">
                        </div>
                    </div>
                </div>

                <!-- Input Nama dan Jenis Kelamin -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nama Anggota</label>
                            <input class="form-control" name="nama_anggota" value="<?= old('nama_anggota') ?>" placeholder="Nama Lengkap">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control">
                                <option value="">-Pilih Jenis Kelamin-</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Input Password -->
                <div class="form-row">
                    <div class="form-group col-md-6 mb-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" value="<?= old('password') ?>" placeholder="Masukkan Password">
                    </div>

                    <div class="form-group col-md-6 mb-3">
                        <label for="ulangi_password">Konfirmasi Password</label>
                        <input type="password" class="form-control" name="ulangi_password" value="<?= old('ulangi_password') ?>" placeholder="Masukkan Ulang Password">
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="row">
                    <div class="col-sm-6">
                        <a class="btn btn-secondary btn-block" href="<?= base_url('Auth/LoginAnggota') ?>">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>

                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-info btn-block">
                            <i class="fas fa-user-plus"></i> Daftar
                        </button>
                    </div>
                </div>

                <?php echo form_close() ?>

                <!-- Link Kembali ke Home -->
                <div class="social-auth-links text-center mt-3">
                    <p>- Atau -</p>
                    <a href="<?= base_url('Auth') ?>" class="btn btn-warning btn-block">
                        <i class="fas fa-sign-in-alt"></i> Kembali ke Halaman Home Login
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>