<?php
session_start();
// koneksi database
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title> Cuci Pakaian</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>

<body>
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
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Daftar Pelanggan</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" class="form-horizontal">
                            <div class="form-group">
                                <label class="control-label col-md-3">Nama</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="nama" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Email</label>
                                <div class="col-md-7">
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Password</label>
                                <div class="col-md-7">
                                    <input type="password" class="form-control" name="password" reduired>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Confirm Password</label>
                                <div class="col-md-7">
                                    <input type="password" class="form-control" name="confirm_password" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Alamat</label>
                                <div class="col-md-7">
                                    <textarea class="form-control" name="alamat" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">No.Telp
                                    HP</label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="telepon" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-7 col-md-offset-3">
                                    <button class="btn btn-primary" name="daftar">Daftar</button>
                                </div>
                            </div>
                        </form>
                        <?php
                        // jk daftar
                        if (isset($_POST["daftar"])) {
                            // mengambil isian form daftar
                            $nama = $_POST["nama"];
                            $email = $_POST["email"];
                            $password = $_POST["password"];
                            $confirm_password = $_POST["confirm_password"];
                            $alamat = $_POST["alamat"];
                            $telepon = $_POST["telepon"];

                            // Validasi password dan confirm password
                            if ($password !== $confirm_password) {
                                echo "<script>alert('Password dan Confirm Password tidak sesuai!');</script>";
                                echo "<script>location='daftar.php';</script>";
                                exit; // Mencegah eksekusi lebih lanjut jika tidak valid
                            }

                            // jk email sudah digunakan maka tidak bisa
                            $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'");
                            $yangcocok = $ambil->num_rows;
                            if ($yangcocok == 1) {
                                echo "<script>alert('Pendaftaran tidak berhasil, Email Sudah digunakan');</script>";
                                echo "<script>location='daftar.php';</script>";
                            } else {
                                // insert ke database
                                $koneksi->query("INSERT INTO pelanggan(email_pelanggan,password_pelanggan,nama_pelanggan,telepon_pelanggan,alamat_pelanggan) VALUES ('$email','$password','$nama','$telepon','$alamat') ");

                                echo "<script>alert('Pendaftaran berhasil, Silahkan login');</script>";
                                echo "<script>location='login.php';</script>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>