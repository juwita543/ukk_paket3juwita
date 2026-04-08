<?php
include 'akses.php';
include '../koneksi.php';

// Pastikan ID ada dan amankan dari input jahat
$id = mysqli_real_escape_string($koneksi, $_GET['id']);

if (isset($id)) {
    $query = "DELETE FROM kategori WHERE id_kategori='$id'";
    $data = mysqli_query($koneksi, $query);

    if($data){
        echo "<script>
                alert('✅ Data sukses dihapus'); 
                window.location.href='?page=kategori';
              </script>";
    } else {
        echo "<script>
                alert('❌ Data gagal dihapus: " . mysqli_error($koneksi) . "'); 
                window.location.href='?page=kategori';
              </script>";
    }
} else {
    echo "<script>
            alert('❌ ID tidak ditemukan'); 
            window.location.href='?page=kategori';
          </script>";
}
?>