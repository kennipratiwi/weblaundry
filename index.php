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
        
    <div class="navbar-inner navbar-transparant">
        <center><a href="index.php"><img src="images/head.jpg"  width="1540" height="200" allowfullscreen="" loading="lazy" > </a></center>

    </div>
    
    <?php include 'menu.php'; ?>
    <section class="konten">
        <div class="container">
            
            <h1>Jenis Layanan</h1>

            <div class="row">
                <?php $ambil = $koneksi->query("SELECT * FROM produk "); ?>
                <?php while($perproduk = $ambil->fetch_assoc()){ ?>
                    <div class="col-md-4">
                        <div class="thumbnail">
                            <img src="foto_produk/<?php echo $perproduk['foto_produk']; ?>" alt="">
                            <div class="caption">
                                <h3><?php echo $perproduk['nama_produk']; ?></h3>
                                <h5>Rp. <?php echo$perproduk['harga_produk']; ?></h5>
                                <a href="pesan.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-primary">Pesan</a>
                                <a href="detail.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-default">Detail</a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
            </div>
        </div>
    </section>
    </body>
<div class ="container">
    <div class="row">
<div>  <center><b><h1><font><color='black'>Kontak Kami:</h1></b></center></color></font>
</div>
<div class="clearfix"> </div>
</div>
</div>
<div class="container">
<div class="row">
<div class="col-md-8 col-md-offset-0"> <br>
<a href="https://api.whatsapp.com/send?phone=6281385160795" 
target="_blank"><img src="images/whatsapp.jpg" width="65" 
height="65" style="border:0"></a></br>
<br>

</div>
<div class="container">
<div class="row">
<div class="col-md-31 col-md-offset-0">
<div class="panel panel-default">
<div class="panel-heading">
<h4><b><font color='teal'>Alamat </h4></b></color></font>
<h4><b><font color='black'>Jl.Pisang Emas 2 No. 2, Harapan Baru 1, Bekasi Barat, Jawa Barat.</h3></color></font>
<center><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.3460342766834!2d106.96294431537001!3d-6.218017062634857!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e698c7bff1de68f%3A0xd443ef4c0963ba2a!2sJl.%20Pisang%20Emas%202%2C%20RT.004%2FRW.009%2C%20Kota%20Baru%2C%20Kec.%20Bekasi%20Bar.%2C%20Kota%20Bks%2C%20Jawa%20Barat%2017133!5e0!3m2!1sid!2sid!4v1655435208588!5m2!1sid!2sid" width="1100" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></br></a></center>
</h6></div>

<div class="clearfix"> </div>
</div>
<div class="footer">
<div class="container">
    <div class="row">
<center><div id="copyright-container">
Copyright &copy; 2022 <a href="" 
rel="home">Website Cuci Pakaian</a>
 <p class="credit"><a href=""></a> Rafi Peshawar Albuthy</p>
 </div>
</div>
</div>
</div></center>
</html>