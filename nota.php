<?php
session_start();
error_reporting(0);
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Nota Pemesanan</title>
        <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    </head>
    <body onload="print()">
<!-- navbar -->
<?php include 'menu.php'; ?>

    <section class="konten">
    <div class="container">

    <h2>Nota Pemesanan</h2>
    <?php
    $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan on pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
    $detail = $ambil->fetch_assoc();
    ?>

<!-- pelanggan yang login tidak bisa melihat nota pelanggan lain -->
<?php
$idpelangganyangbeli = $detail["id_pelanggan"];

$idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];

if ($idpelangganyangbeli!==$idpelangganyanglogin)
{
    echo "<script>alert('Tidak bisa melihat nota orang lain');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
}
?>
    <div class="row">
        <div class="col-md-4">
            <h3>Pemesanan</h3>
            <strong>No. Pemesanan: <?php echo $detail['id_pembelian'] ?></strong><br>
            Tanggal:<?php echo $detail['tanggal_pembelian']; ?> <br>
            Total :Rp. <?php echo number_format($detail['total_pembelian']); ?> <br>
            Status :<?php echo $detail['status_pembelian']; ?>
        </div>
        <div class="col-md-4">
        <h3>Pelanggan</h3>
        <strong><?php echo $detail['nama_pelanggan']; ?></strong><br>
        <p>
        <?php echo $detail['telepon_pelanggan']; ?> <br>
        <?php echo $detail['email_pelanggan']; ?>    
        </p>
        </div>
        <div class="col-md-4">
        <h3>Pengiriman</h3>
        <strong><?php echo $detail['jarak']; ?></strong><br>
        Ongkos Kirim: Rp. <?php echo number_format($detail['tarif']); ?><br>
        Alamat: <?php echo $detail['alamat_pengiriman']; ?>
        </div>
    </div>
  


<table class ="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Harga</th>
            <th>Berat</th>
            <th>Jumlah</th>
            <th>Subberat</th>
            <th>Subtotal</th>
        </tr>
</thead>
<tbody>
    <?php $nomor=1; ?>
    <?php $ambil= $koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian='$_GET[id]' "); ?>
    <?php while($pecah=$ambil->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama']; ?></td>
            <td>Rp. <?php echo number_format($pecah['harga']); ?></td>
            <td><?php echo number_format($pecah['berat']); ?> Gr.</td>
            <td><?php echo $pecah['jumlah']; ?></td>
            <td><?php echo number_format($pecah['subberat']); ?> Gr.</td>
            <td>Rp. <?php echo number_format($pecah['subharga']); ?></td>
    </tr>
    <?php $nomor++; ?>
    <?php } ?>
         
</tbody>
</table>

<div class="row">
    <div class="col-md-7">
        <div class="alert alert-info">
            <p>
                Silahkan melakukan pembayaran Rp. <?php echo number_format($detail['total_pembelian']); ?> ke <br>
                <strong> BANK BRI 1666-00-99999-90-2 AN. Cuci Pakaian <strong>  
            </p>

        </div>
    </div>
</div>
    </div>
    </section>

    </body>
</html>