<?php
include'koneksi.php';
session_start();
function status($status){
    if($status =="Menunggu"){
        echo"<div class='badge bg-warning'> ⏱ $status</div>";
    }elseif($status=="Proses"){
        echo"<div class='badge bg-info'> 🔄$status</div>";
    }else{
        echo"<div class='badge bg-success'> ✅$status</div>";
    }
}
$id=$_GET["id"];
$sql= mysqli_query($koneksi,"SELECT input_aspirasi.*, kategori.ket_kategori, aspirasi.status, aspirasi.feedback 
FROM input_aspirasi
JOIN kategori ON kategori.id_kategori=input_aspirasi.id_kategori
JOIN aspirasi ON aspirasi.id_pelaporan=input_aspirasi.id_pelaporan
WHERE input_aspirasi.id_pelaporan='$id'");
$data = mysqli_fetch_array($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengaduan | Aplikasi Pengaduan Sarana Sekolah</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="vh-100 justify-content-center row align-content-center">
        <form action="" method="post" class="col-md-8 bg-white border rounded-4 p-3 shadow-sm">
            <h3 class="text-center"> Data Pengaduan NIS <?= $_SESSION['nis']?> ,kelas <?= $_SESSION['kelas'] ?></h3>
            <p class="text-muted text-center mb-4">Aplikasi Pengaduan Sarana Sekolah</p>
            <a href="index.php" class="btn btn-primary w-100">➕ Tambah Pengaduan</a>
            <hr>
            <div class="row">
                <div class="col-md-3 fw-bold mb-1">NIS</div>
                <div class="col-md-9"><?= $data['nis'] ?></div>
                <div class="col-md-3 fw-bold mb-1">Kelas</div>
                <div class="col-md-9"><?=$_SESSION['kelas'] ?></div>
                <div class="col-md-3 fw-bold mb-1">Kategori Pengaduan</div>
                <div class="col-md-9"><?= $data['ket_kategori'] ?></div>
                <div class="col-md-3 fw-bold mb-1">Status</div>
                <div class="col-md-9"><?= status($data['status']) ?></div>
                <div class="col-md-3 fw-bold mb-1">Lokasi</div>
                <div class="col-md-9"><?= $data['lokasi'] ?></div>
                <div class="col-md-3 fw-bold mb-1"><i class="fa fa-lightbuld"></i>Pengaduan</div>
                <div class="col-md-12 p-3 border"><?= $data['ket'] ?></div>
                <div class="col-md-3 fw-bold mb-1"><i class="fa fa-comment"></i>Feedback</div>
                <div class="col-md-12 p-3 border"><?= $data['feedback'] ?></div>
            </div>

            <a href="data-pengaduan.php" class="btn btn-warning w-100 text-white mt-4">⬅️ Kembali </a>
           
        </form>
    </div>
</body>
</html>

<?php
if(isset($_POST['tombol'])){
    $nis = $_POST['nis'];
    $kelas = $_POST['kelas'];
    include 'koneksi.php';
    $sql = "SELECT * FROM siswa WHERE nis='$nis' AND kelas ='$kelas'";
    $data = mysqli_query($koneksi, $sql);
    if(mysqli_num_rows($data) > 0){
        $_SESSION['nis'] = $nis;
        $_SESSION['kelas'] = $kelas;
        header('location:admin/dashboard.php');
    }else{
        $_SESSION['error'] = "❌ Maaf Kombinasi NIS dan kelas salah";
        header("location:cek-pengaduan.php");
    }
}
?>