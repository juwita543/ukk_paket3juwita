<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Pengaduan | Aplikasi Pengaduan Sarana Sekolah</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="vh-100 justify-content-center row align-content-center">
        <form action="#" method="post" class="col-md-3 bg-white border rounded-4 p-3 shadow-sm">
            <h3 class="text-center">Cek Pengaduan</h3>
            <p class="text-muted text-center mb-4">Aplikasi Pengaduan Sarana Sekolah</p>
            <hr>
            <div class="mb-3">
                <label class="form-label text-muted">NIS</label>
                <input type="number" name="nis" class="form-control" required placeholder="Masukan NIS">
            </div>
            <div class="mb-3">
                <label class="form-label text-muted">Kelas</label>
                <select name="kelas" class="form-control" required>
                    <option value="">=== Pilih Kelas ===</option>
                    <option value="X RPL 1">X RPL 1</option>
                    <option value="X RPL 2">X RPL 2</option>
                </select>
            </div>
            <button type="submit" name="tombol" class="btn btn-primary w-100">CEK ➡</button>
            <a href="index.php" class="btn btn-warning w-100 mt-2">⬅ Kembali</a>
            <?php
            if(isset($_SESSION['error'])) { ?>
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
    $nis   = $_POST['nis'];
    $kelas = $_POST['kelas'];
    include'koneksi.php';
    $sql  = "SELECT * FROM siswa WHERE nis='$nis' AND kelas='$kelas'";
    $data = mysqli_query($koneksi, $sql);
    if(mysqli_num_rows($data) > 0){
        $_SESSION['nis']   = $nis;
        $_SESSION['kelas'] = $kelas;
        header('Location: data-pengaduan.php');  exit;  } else {
        $_SESSION['error'] = "❌ Maaf Kombinasi NIS dan Kelas Salah!";
        header("Location: cek-pengaduan.php");exit;
   }
}