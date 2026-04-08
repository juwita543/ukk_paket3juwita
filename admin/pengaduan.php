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
?>
<h4 class="text-center">Daftar Pengaduan</h4>
<table class="table table-bordered table-striped">
    <tr class="fw-bold">
        <td>No</td>
        <td>NIS</td>
        <td>kelas</td>
        <td>Kategori</td>
        <td>Keterangan</td>
        <td>Status</td>
        <td>Tanggapi</td>
    </tr>
    <?php
    $no = 1;
    $sql = "SELECT DISTINCT input_aspirasi.*, 
           kategori.ket_kategori, 
           aspirasi.status,
           siswa.kelas
    FROM input_aspirasi
    JOIN kategori 
        ON input_aspirasi.id_kategori = kategori.id_kategori
    JOIN aspirasi 
        ON aspirasi.id_pelaporan = input_aspirasi.id_pelaporan
    JOIN siswa
        ON siswa.nis = input_aspirasi.nis";
    $data = mysqli_query($koneksi, $sql);
    if (!$data) {
        die(mysqli_error($koneksi));
    }
    if(mysqli_num_rows($data) === 0){ ?>
        <tr>
            <td colspan="7" class="text-center text-muted">Belum ada data pengaduan</td>
        </tr>
    <?php } else { 
        while($pengaduan = mysqli_fetch_assoc($data)){ ?>
       <tr>
            <td><?= $no++; ?></td>
            <td><?= $pengaduan['nis'] ?></td>
            <td><?= $pengaduan['kelas'] ?></td>
            <td><?= $pengaduan['ket_kategori'] ?></td>
            <td><?= $pengaduan['ket'] ?></td>
            <td><?= status ($pengaduan['status']) ?></td>
            <td>
                <?php $cek = ($pengaduan['status']=="Selesai")?'disabled':'';?>
                <a href="?page=tanggapi&id=<?= $pengaduan['id_pelaporan'] ?>" class="btn btn-primary <?= $cek ?>">
                    🔄Tanggapi
                </a>
            </td>
       </tr>
    <?php } } ?>
</table>