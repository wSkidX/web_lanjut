<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('location:../login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard | Teknologi Informasi</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="AdminLTE-3.2.0/dist/css/adminlte.min.css?v=3.2.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .main-sidebar { background-color: #343a40; }
        .main-sidebar .brand-link { border-bottom: 1px solid #4b545c; }
        .main-sidebar .sidebar { padding-top: 0; }
        .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active { background-color: #007bff; }
        .content-wrapper { background-color: #f4f6f9; }
        .main-footer { background-color: #ffffff; border-top: 1px solid #dee2e6; }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index.php?p=home" class="nav-link">Home</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../logout.php" role="button" title="Logout">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index.php" class="brand-link">
                <img src="asset/1595472616513_teknologi-informasi-01-01-300x111.png" alt="TI Logo" class="brand-image img-fluid" style="opacity: .8; max-height: 33px; margin-left: 2px;">
                <span class="brand-text font-weight-light">TI Admin</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="asset/images.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Admin TI</a>
                    </div>
                </div>

                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user-graduate"></i>
                                <p>
                                    Mahasiswa
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="index.php?p=mhs&aksi=input" class="nav-link">
                                        <i class="far fa-plus-square nav-icon"></i>
                                        <p>Tambah Mahasiswa</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?p=mhs" class="nav-link">
                                        <i class="far fa-list-alt nav-icon"></i>
                                        <p>Data Mahasiswa</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-graduation-cap"></i>
                                <p>
                                    Program Studi
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="index.php?p=prodi&aksi=input" class="nav-link">
                                        <i class="far fa-plus-square nav-icon"></i>
                                        <p>Tambah Prodi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?p=prodi" class="nav-link">
                                        <i class="far fa-list-alt nav-icon"></i>
                                        <p>Data Prodi</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chalkboard-teacher"></i>
                                <p>
                                    Dosen
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="index.php?p=dosen&aksi=input" class="nav-link">
                                        <i class="far fa-plus-square nav-icon"></i>
                                        <p>Tambah Dosen</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?p=dosen" class="nav-link">
                                        <i class="far fa-list-alt nav-icon"></i>
                                        <p>Data Dosen</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>
                                    Kategori
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="index.php?p=kategori&aksi=input" class="nav-link">
                                        <i class="far fa-plus-square nav-icon"></i>
                                        <p>Tambah Kategori</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?p=kategori" class="nav-link">
                                        <i class="far fa-list-alt nav-icon"></i>
                                        <p>Data Kategori</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-newspaper"></i>
                                <p>
                                    Berita
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="index.php?p=berita&aksi=input" class="nav-link">
                                        <i class="far fa-plus-square nav-icon"></i>
                                        <p>Tambah Berita</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="index.php?p=berita" class="nav-link">
                                        <i class="far fa-list-alt nav-icon"></i>
                                        <p>Data Berita</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <?php
            $page=isset($_GET['p']) ? $_GET['p'] : 'home';
            if($page=='home') include 'home.php';
            if($page=='mhs') include 'mahasiswa.php';
            if($page=='prodi') include 'prodi.php';
            if($page=='dosen') include 'dosen.php';
            if($page=='kategori') include 'kategori.php';
            if($page=='berita') include 'berita.php';
            if($page=='detail') include 'detail.php';
        ?>
        </div>

        <aside class="control-sidebar control-sidebar-dark">
        </aside>

        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>
    </div>

    <script src="AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
    <script src="AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="AdminLTE-3.2.0/dist/js/adminlte.js?v=3.2.0"></script>
    <script src="AdminLTE-3.2.0/plugins/chart.js/Chart.min.js"></script>
    <script src="AdminLTE-3.2.0/dist/js/pages/dashboard3.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
