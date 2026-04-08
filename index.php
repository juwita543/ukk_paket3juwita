<?php
session_start();
include'koneksi.php';
$kategori = mysqli_query($koneksi,"select*from kategori");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masukkan Saran | Aplikasi Pengaduan Sarana Sekolah</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="vh-100 justify-content-center row align-content-center">
        <form action="" method="post" class="col-md-3 bg-white border rounded-4 p-3 shadow-sm">
            <h3 class="text-center">Haii 👋</h3>
            <p class="text-muted text-center mb-4">Aplikasi Pengaduan Sarana Sekolah</p>
            <hr>
            <div class="mb-3">
                <label class="form-label text-muted">NISN</label>
                <input type="number" name="nis" class="form-control" required placeholder="Masukkan NISN">
            </div>
            <div class="mb-3">
                <label class="form-label text-muted">Kelas</label>
                <select name="kelas" class="form-control" required>
                    <option value="">=== Pilih Kelas ===</option>
                    <option value="XII RPL 1">XII RPL 1</option>
                    <option value="XII RPL 2">XII RPL 2</option>
                    <option value="XII DKV 1">XII DKV 1</option>
                    <option value="XII DKV 2">XII DKV 2</option>
                </select>
            </div>
            <div class="mb-3">
                 <label class="form-label text-muted">Kategori</label>
                 <select name="id_kategori" class="form-control" required>
                     <option value="">=== Pilih Kategori ===</option>
                     <?php foreach($kategori as $data) { ?>
                         <option value="<?= $data['id_kategori'] ?>"><?= $data['ket_kategori'] ?>
                         </option>
                     <?php } ?>
                 </select>
            </div>
            <div class="mb-3">
                <label class="form-label text-muted">Lokasi</label>
                <textarea name="lokasi" class="form-control" required placeholder="Masukkan Lokasi"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label text-muted">Keterangan / Deskripsi Laporan</label>
                <textarea name="ket" class="form-control" required placeholder="Masukkan Laporan"></textarea>
            </div>
            <button type="submit" name="tombol" class="btn btn-primary w-100">KIRIM ➡️</button>
            <a href="cek-pengaduan.php" class="btn btn-success mt-2 w-100">
                🔍 Cek Pengaduan 
            </a>
        </form>
    </div>
</body>
</html>
<?php
if(isset($_POST['tombol'])){
    include'koneksi.php';
    $nis = $_POST['nis'];
    $kelas = $_POST['kelas'];
    $cekSiswa = mysqli_query($koneksi,"SELECT nis FROM siswa WHERE nis='$nis'");
    if($cekSiswa && mysqli_num_rows($cekSiswa) > 0){
        mysqli_query($koneksi,"UPDATE siswa SET kelas='$kelas' WHERE nis='$nis'");
    }else{
        mysqli_query($koneksi,"INSERT INTO siswa(nis,kelas) VALUES('$nis','$kelas')");
    }
    //input aspirasi
    $id_kategori = $_POST['id_kategori'];
    $lokasi = $_POST['lokasi'];
    $ket = $_POST['ket'];
    date_default_timezone_set('Asia/Jakarta');
    $tgl = date('d-m-Y H:i:s');
    $sql = "INSERT INTO input_aspirasi(nis,id_kategori,lokasi,ket,tgl_input) VALUES('$nis','$id_kategori','$lokasi','$ket','$tgl')";
    $data = mysqli_query($koneksi,$sql);
    //aspirasi
    $id_pelaporan = mysqli_insert_id($koneksi);
    $status = "Menunggu";
    $sql = "INSERT INTO aspirasi (id_pelaporan,id_kategori,status) VALUES ('$id_pelaporan','$id_kategori','$status')";
    $data = mysqli_query($koneksi,$sql);
    session_start();
    $_SESSION['status'] = "✅ Pengaduan Berhasil Disimpan";
    header('location:cek-pengaduan.php');
}