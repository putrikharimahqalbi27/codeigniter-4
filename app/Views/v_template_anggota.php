<?php

use App\Controllers\DashboardAnggota;
?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BMN UNSULBAR | <?= $judul ?> </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?> /plugins/fontawesome-free/css/all.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?> /plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?> /plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('AdminLTE') ?> /dist/css/adminlte.min.css">
    <link rel="icon" type="image/png" href="<?= base_url('../images/logobmn.png'); ?>">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?= base_url() ?>" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link btn btn-info text-white" href="<?= base_url('Auth/LogOutAnggota') ?>">
                        <i class="fas fa-user  "></i> Logout
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-info elevation-4">
            <!-- Brand Logo -->

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?= base_url('foto/' . $anggota['foto']) ?>" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?= $anggota['nama_anggota'] ?></a>
                        <?php
                        if ($anggota['verifikasi'] == 1) {
                            echo '<a class="text-success"><i class="fa fa-check-circle "> </i> Terverifikasi</a>';
                        } else {
                            echo '<a class="text-danger"><i class="fa fa-times "> </i> Belum Terverifikasi</a>';
                        }
                        ?>

                    </div>
                </div>



                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                        <li class="nav-item">
                            <a href=" <?= base_url('DashboardAnggota') ?> " class="nav-link <?= $menu == 'dashboard' ? 'active' : '' ?>">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p> Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item <?= $menu == 'peminjaman' ? 'menu-open' : '' ?> ">
                            <a href="#" class="nav-link <?= $menu == 'peminjaman' ? 'active' : '' ?>">
                                <i class=" nav-icon fas fa-swatchbook"></i>
                                <p> Peminjaman
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('Peminjaman/Pengajuan') ?>" class="nav-link <?= $submenu == 'pengajuan' ? 'active' : '' ?> ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Pengajuan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('Peminjaman/PengajuanDiterima') ?>" class="nav-link <?= $submenu == 'diterima' ? 'active' : '' ?> ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Diterima</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('Peminjaman/PengajuanDitolak') ?>" class="nav-link <?= $submenu == 'ditolak' ? 'active' : '' ?> ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Ditolak</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('Peminjaman/PengajuanDikembalikan') ?>" class="nav-link <?= $submenu == 'dikembalikan' ? 'active' : '' ?> ">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kembali</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><?= $judul ?></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url('') ?>">Home</a></li>
                                <li class="breadcrumb-item active">Starter Page</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">

                        <?php
                        if ($page) {
                            echo view($page);
                        }
                        ?>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; <?= date('Y') ?> <a href="<?= base_url() ?>">RT-BMN UNSULBAR</a>.</strong> Putri Kharimah Qalbi.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="<?= base_url('AdminLTE') ?>/plugins/select2/js/select2.full.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('AdminLTE') ?>/dist/js/adminlte.min.js"></script>

    <script>
        $(document).ready(function() {
            function bacaGambar(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#gambar_load').attr('src', e.target.result).show();
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    $('#gambar_load').hide();
                }
            }

            $('#preview_gambar').change(function() {
                bacaGambar(this);
            });
        });
    </script>

    <script>
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    </script>
</body>

</html>