<?php
include'akses.php';
include'../koneksi.php';
function status($status){
    if($status =="Menunggu"){
        echo"<div class='badge bg-warning'> ⏱ $status</div>";
    }elseif($status=="Proses"){
        echo"<div class='badge bg-info'> 🔄$status</div>";
    }else{
        echo"<div class='badge bg-success'> ✅$status</div>";
    }

}
$id = $_GET['id'];
$sql = "SELECT input_aspirasi.*, kategori.ket_kategori, aspirasi.status, aspirasi.feedback, siswa.kelas 
FROM input_aspirasi
JOIN kategori ON kategori.id_kategori=input_aspirasi.id_kategori
JOIN aspirasi ON aspirasi.id_pelaporan=input_aspirasi.id_pelaporan
JOIN siswa ON siswa.nis=input_aspirasi.nis
WHERE input_aspirasi.id_pelaporan='$id'";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_array($query);
?>
<h4 class="text-center mb-4"><i class="fa fa-comments"></i> Tanggapi Pengaduan </h4>
<form method="post" action="#">
    <div class="row">
                <div class="col-md-3 fw-bold mb-1">NIS</div>
                <div class="col-md-9"><?= $data['nis'] ?></div>
                <div class="col-md-3 fw-bold mb-1">Kelas</div>
                <div class="col-md-9"><?=$data['kelas'] ?></div>
                <div class="col-md-3 fw-bold mb-1">Kategori Pengaduan</div>
                <div class="col-md-9"><?= $data['ket_kategori'] ?></div>
                <div class="col-md-3 fw-bold mb-1">Status</div>
                <div class="col-md-9"><?= status($data['status']) ?></div>
                <div class="col-md-3 fw-bold mb-1">Lokasi</div>
                <div class="col-md-9"><?= $data['lokasi'] ?></div>
                <div class="col-md-3 fw-bold mb-1"><i class="fa fa-lightbuld"></i>Pengaduan</div>
                <div class="col-md-12 p-3 border"><?= $data['ket'] ?></div>
                <div class="col-md-3 fw-bold mb-1"><i class="fa fa-comment"></i>Feedback</div>
                <div class="col-md-12 p-3 border">
                    <select name="status" class="form-control mb-2" required>
                        <option value="Menunggu" <?= ($data['status']=="Menunggu")?'selected':''?>>Menunggu</option>
                        <option value="Proses" <?= ($data['status']=="Proses") ?'selected':''?>>Proses</option>
                        <option value="Selesai" <?= ($data['status']=="Selesai") ?'selected':''?>>Selesai</option>
                    </select>
                    <textarea name="feedback" class="form-control mb-2" required placeholder="Masukkan Feedback"></textarea>
                    <button type="submit" name="tombol" class="btn btn-success w-100 mt-4">💾KIRIM</button>
                </div>
            </div>
</form>
<?php
if(isset($_POST['tombol'])){
    $status = $_POST['status'];
    $feedback = $_POST['feedback'];
    $data = mysqli_query($koneksi,"UPDATE aspirasi SET status='$status',feedback='$feedback' 
    WHERE id_pelaporan='$id'");
    if($data){
        echo"<script>alert('✅Feedback berhasil tersimpan / terkirim'); window.location.assign('?page=pengaduan')</script>";   
    }else{
        echo"<script>alert('❌Feedback gagal tersimpan / terkirim') ;window.location.assign('?page=pengaduan')</script>";
    }
}