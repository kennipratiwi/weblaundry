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
        <center><a href="index.php"><img src="images/judul web.jpg"  width="1540" height="200" allowfullscreen="" loading="lazy" > </a></center>

    </div>

    <?php include 'menu.php'; ?>
    <section class="konten">
        <div class="container">
          <div class="row">
           <div class="col-md-9 col-md-offset-2">
            <div class="panel panel-default">
              <div class="panel-heading">
                <h5 class="panel-title"><font color='teal'>Tata Cara Pelayanan Kami</h5></color></font>
                  </div>
                <div class="panel-body">
                <form method="post" class="form-horizontal">
                <center><h4><b><font color='blue'>Siap Melayani Anda Sepenuh Tenaga dan Hati <br>
                                                  Tata Cara Pemesanan : </h4></b></center></color></font>
                <br><h5>* Pilih Jenis Layanan yang Anda Butuhkan</br></h5>
                        * Jika Anda Telah Memesan dan Membayar Tagihan yang Tertera Maka Kami Akan Menjemput ke Alamat Anda
                <br><h5>* Jika Pesanan Sudah diproses Maka Tunggu Sampai Pesanan Anda Kembali diantar Kembali</br></h5>
                        * Duduk dirumah dan Anda Siap Menerima Barang Bersih Kembali
                         <br></br> 
                         <br></br>
                        <center><div id="copyright-container">
                        <div class="inner hybrid">
                        Copyright &copy; 2024 <a href="" rel="home">Website Cuci Karpet,Sofa,Springbed</a>
                        <p class="credit"><a href=""></a> Laundry Brayan Urip</p>
                        </div>
                        </div></center>
</body>
</html>