<div class="col-sm-12">
    <?php
    if ($anggota['verifikasi'] == 1) { ?>
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Akun Anda sudah terverivikasi !!!</h5>
        </div>

    <?php } else { ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-times"></i> Akun anda belum terverifikasi lengkapi data terlebih dahulu !!! tunggu 1X24 Jam</h5>

        </div>
    <?php }    ?>

</div>

<div class="col-md-3">
    <div class="card card-info card-outline">
        <div class="card-body box-profile">
            <div class="text-center">
                <img class=" img-fluid " src=" <?= base_url('foto/' . $anggota['foto'])  ?>" width="150px">
            </div>

        </div>
    </div>
</div>

<div class="col-md-9">
    <div class="card card-outline card-info">
        <div class="card-header">
            <h3 class="card-title">Data <?= $judul  ?></h3>
            <div class="card-tools">
                <a href="<?= base_url('DashboardAnggota/EditProfile') ?>" class="btn btn-info btn-flat btn-sm">
                    <i class="fas fa-edit"></i> Lengkapi Profile
                </a>
            </div>
        </div>

        <div class="card-body">

            <table class="table">
                <tr>
                    <th width="150px"> Kode</th>
                    <th width="50px">:</th>
                    <td> <?= $anggota['kode'] ?> </td>

                </tr>
                <tr>
                    <th>Nama Anggota</th>
                    <th>:</th>
                    <td> <?= $anggota['nama_anggota'] ?> </td>

                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <th>:</th>
                    <td> <?= $anggota['jenis_kelamin'] ?> </td>

                </tr>
                <tr>
                    <th>Nama Organisasi</th>
                    <th>:</th>
                    <td> <?= $anggota['nama_jabatan'] ?> </td>

                </tr>
                <tr>
                    <th>No Handphone</th>
                    <th>:</th>
                    <td> <?= $anggota['no_hp'] ?> </td>

                </tr>
                <tr>
                    <th>Alamat</th>
                    <th>:</th>
                    <td> <?= $anggota['alamat'] ?> </td>

                </tr>

            </table>
        </div>
    </div>
</div>