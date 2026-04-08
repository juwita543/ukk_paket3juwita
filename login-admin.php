<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Aplikasi Pengaduan Sarana Sekolah</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #0d6efd;">
    <div class="vh-100 justify-content-center row align-content-center">
        <form action="" method="post" class="col-md-3 bg-white border rounded-4 p-3 shadow-sm">
            <h3 class="text-center">Login Admin</h3>
            <p class="text-muted text-center mb-4">Aplikasi Pengaduan Sarana Sekolah</p>
            <hr>

            <div class="mb-3">
                 <label class="form-label text-muted">Username</label>
                 <input type="text" name="username" class="form-control" required placeholder="Masukkan Username">
            </div>

            <div class="mb-3">
                 <label class="form-label text-muted">Password</label>
                 <input type="password" name="password" class="form-control" required placeholder="Masukkan Password">
            </div>

            <button type="submit" name="tombol" class="btn btn-primary w-100">LOGIN ➡️</button>

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
    $username = $_POST['username'];
    $password = $_POST['password'];

    include 'koneksi.php';

    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $data = mysqli_query($koneksi, $sql);

    if(mysqli_num_rows($data) > 0){
        $_SESSION['login'] = true;
        header('location:admin/dashboard.php');
    }else{
        $_SESSION['error'] = "❌ Maaf login gagal, periksa username/password";
        header("location:login-admin.php");
    }
}
?>