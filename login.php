<?php
session_start();
// koneksi database
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title> Login Pelanggan</title>
        <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    </head>

    <!-- navbar -->
    <nav class="navbar navbar-default">
        <div class="container">
            
            <ul class="nav navbar-nav">
                <li><a href="index.php">Beranda</a></li>
               
                
                <!-- jika sudah login(ada session pelanggan) -->
                <?php if (isset($_SESSION["pelanggan"])): ?>
                    <li><a href="riwayat.php">Riwayat Pemesanan</a></li>
                    <li><a href="logout.php">keluar</a></li>
                <!-- selain itu jika belum login maka belum ada session pelanggan -->
                <?php else: ?>
                    <li><a href="login.php">Masuk</a></li>
                    <li><a href="daftar.php">Daftar</a></li>
                <?php endif ?>    
                <li><a href="tentang.php">Tentang Layanan</a></li>             
            </ul>
        </div>
    </nav>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Login Pelanggan</h3>
             </div>
             <div class="panel-body">
                 <form method="post">
                     <div class="form-group">
                         <label>Email</label>
                         <input type="email" class="form-control" name="email">
             </div>
             <div class="form-group">
                         <label>Password</label>
                         <input type="password" class="form-control" name="password">
            </div>
            <button class="btn btn-primary" name="login">Login</button>
          </form>
          <?php
          if (isset($_POST["login"]))
          {
              $email = $_POST["email"];
              $password = $_POST["password"];
              // lakukan query mengecek akun pada tabel pelanggan di database
              $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND password_pelanggan='$password'");

              // menghitung akun yang terambil
              $akunyangcocok = $ambil->num_rows;

              // jika 1 akun cocok maka diloginkan
              if ($akunyangcocok==1)
              {
                  // anda sukses login
                  // mendapatkan akun dalam bentuk array
                  $akun = $ambil->fetch_assoc();
                  // simpan di session pelanggan
                  $_SESSION["pelanggan"] = $akun;
                  echo "<script>alert('anda sukses login');</script>";

                  // jk sudah memesan
                  if (isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"]))
                  {
                  echo "<script>location='checkout.php';</script>";
                  }
                  else
                  {
                    echo "<script>location='riwayat.php';</script>";
                  }
              
            }
              else
              {
                  // anda gagal login
                  echo "<script>alert('anda gagal login, periksa kembali akun anda');</script>";
                  echo "<script>location='login.php';</script>";
              }
          }
          ?>
    </body>
</html>