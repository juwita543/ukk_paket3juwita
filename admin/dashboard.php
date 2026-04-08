<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../fontawesome/css/all.min.css" rel="stylesheet">
    <style>
        .nav-link{
            background-color: red;
            margin: 0 10px;
            color: white !important;
            border-radius: 10px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand text-muted fw-bold" href="#">
            Aplikasi Pengaduan Sarana Sekolah
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarID">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarID">
            <div class="navbar-nav">
                <a class="nav-link" href="dashboard.php">
                    <i class="fa fa-home"></i> Home
                </a>
                <a class="nav-link" href="?page=kategori">
                    <i class="fa fa-tags"></i> Kategori Pengaduan
                </a>
                <a class="nav-link" href="?page=pengaduan">
                    <i class="fa fa-message"></i> Pengaduan
                </a>
                <a class="nav-link" href="logout.php">
                    <i class="fa fa-power-off"></i> Logout
                </a>
            </div>
        </div>
    </div>
</nav>

<div class="container bordered shadow-lg w-100 p-5 mt-5 rounded-3">
    <?php
    $page = isset($_GET['page']) ? $_GET['page'] : '';
    if (file_exists($page . ".php")){
        include $page . ".php";
    } else {?>
        <h4>Selamat Datang Admin 👋</h4>
        <p class="text-muted fst-italic">
            Pengelolaan Pengaduan Sarana Sekolah digunakan untuk menerima,memverifikasi dan menindaklanjuti laporan atas kerusakan dan kendala fisik sekolah secara terstruktur dan terdokumentasi.
                </p>
         <?php } ?>
   </div>
</body>
</html>
