<?php
include 'akses.php';
include '../koneksi.php';
?>

<h4 class="text-center mt-2 mb-4">
    <i class="fa fa-tags"></i> Tambah Kategori Pengaduan
</h4>

<form method="post">
    <div class="mb-3">
        <label class="form-label fw-bold text-muted">Kategori Pengaduan</label>
        <input type="text" name="ket_kategori" class="form-control" required>
    </div>
    <button name="tombol" type="submit" class="btn btn-success w-100">
        <i class="fa fa-save"></i> SIMPAN
    </button>
</form>

<?php
if (isset($_POST['tombol'])) {
    $ket = $_POST['ket_kategori'];

    $query = "INSERT INTO kategori (ket_kategori) VALUES ('$ket')";
    $data = mysqli_query($koneksi, $query);

    if ($data) {
        echo "<script>
            alert('✅ Data sukses disimpan');
            window.location.assign('?page=kategori');
        </script>";
    } else {
        echo "<script>
            alert('❌ Data gagal disimpan');
            window.location.assign('?page=kategori');
        </script>";
    }
}
?>
