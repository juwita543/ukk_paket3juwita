<?php
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengaduan | Aplikasi Pengaduan Sarana Sekolah</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="vh-100 justify-content-center row align-content-center">
        <form action="" method="post" class="col-md-8 bg-white border rounded-4 p-3 shadow-sm">
            <h3 class="text-center"> Data Pengaduan</h3>
            <p class="text-muted text-center mb-4">Aplikasi Pengaduan Sarana Sekolah</p>
            <a href="index.php" class="btn btn-primary w-100">➕ Tambah Pengaduan</a>
            <hr>
            <table class="table table-bordered table-striped">
                <tr class="fw-bold">
                    <td>No</td>
                    <td>Kategori</td>
                    <td>Keterangan</td>
                    <td>Status</td>
                    <td>Detail</td>
                </tr>
                <?php
                include'koneksi.php';
                $no=1;
                $sql="SELECT*FROM input_aspirasi , kategori ,aspirasi WHERE 
                input_aspirasi.id_kategori=kategori.id_kategori AND
                aspirasi.id_pelaporan=input_aspirasi.id_pelaporan AND
                input_aspirasi.nis='$_SESSION[nis]'";
                $data = mysqli_query($koneksi,$sql);
                foreach($data as $pengaduan){ ?>
                <tr>
                   <td><?= $no++; ?></td>
                   <td><?= $pengaduan['ket_kategori'] ?></td>
                   <td><?= $pengaduan['ket'] ?></td>
                   <td><?= status ($pengaduan['status']) ?></td>
                   <td>
                        <a href="detail.php?id=<?= $pengaduan['id_pelaporan'] ?>" class="btn btn-primary">
                           🔍 Detail
                        </a>
                   </td>
                </tr>
                <?php } ?>
            </table>
            <a href="cek-pengaduan.php" class="btn btn-warning w-100 text-white">⬅️ Kembali </a>
            <?php
            if(isset($_SESSION['error'])){ ?>
                 <div class="alert alert-danger mt-1 mb-1">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                 </div>
            <?php } ?>
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