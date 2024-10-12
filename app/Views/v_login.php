<div class="card-header text-center">
    <img src="<?= base_url('../images/logo.png') ?>" alt="Logo UNSULBAR" style="width: 100px; height: auto;">
    <div class="card-header text-center">
        <a href="<?= base_url('') ?>" class="text-light h2"> <b> BMN | UNIVERSITAS SULAWESI BARAT</b> </a>
    </div>
</div>


<div class="row">
    <div class="login-box">
        <div class="col-lg-12 col-12">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>User</h3>
                    <p>Login untuk Admin dan Petugas</p>
                </div>
                <div class="icon">
                    <i class="fas fa fa-user"></i>
                </div>
                <a href="<?= base_url('Auth/LoginUser') ?>" class="small-box-footer">LOGIN <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="login-box">
        <div class="col-lg-12 col-12">
            <div class="login-box">
                <div class="small-box bg-secondary">
                    <div class="inner">
                        <h3>Anggota</h3>

                        <p>Login Untuk Peminjam</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa fa-users"></i>
                    </div>
                    <a href="<?= base_url('Auth/LoginAnggota') ?>" class="small-box-footer">LOGIN <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>

</div>