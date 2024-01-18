<?php
session_start();
error_reporting(0);
include 'koneksi.php';

// mendapatakan id_pembelian
$id_pembelian = $_GET['id'];

// mengambil data pembayaran berdasarkan id_pembelian
$ambil = $koneksi->query("SELECT * FROM pembayaran 
LEFT JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian
WHERE pembelian.id_pembelian='$id_pembelian' ");
$detail = $ambil->fetch_assoc();

if (empty($detail))
{
    echo "<script>alert('Belum Ada Data Pembayaran');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}

if ($_SESSION["pelanggan"]['id_pelanggan']!==$detail["id_pelanggan"])
{
    echo "<script>alert('Tidak Bisa Melihat Data Pembayaran Orang Lain');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit(); 
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Data Pembayaran</title>
        <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    </head>
    <body>
        <!-- navbar -->
        <?php include 'menu.php'; ?>


    <div class="container">
        <h3>Data Pembayaran</h3>    
    <div class="row">
    <div class="col-md-6">
    <table class="table">
        <tr>
            <th>Nama</th>
            <td><?php echo $detail['nama'] ?></td>
        </tr>
        <tr>
            <th>Bank Pembayaran</th>
            <td><?php echo $detail['bank'] ?></td>
        </tr>
        <tr>
            <th>Jumlah Pembayaran</th>
            <td>Rp. <?php echo number_format($detail['jumlah']) ?></td>
        </tr>
        <tr>
            <th>Tanggal Pembayaran</th>
            <td><?php echo $detail['tanggal'] ?></td>
        </tr>
    </table>
</div>
    <div class="col-md-6">
            <img src="bukti_pembayaran/<?php echo $detail['bukti'] ?>" alt="" class="img-responsive">
</div>
</div>
</div>

    </body>
    
</html>
