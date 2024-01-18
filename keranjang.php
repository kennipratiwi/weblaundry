<?php
session_start();



// koneksi database
include 'koneksi.php';
// jika keranjang kosong maka akan dilarikan ke index
if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"]))
{
    echo "<script>alert('Keranjang Anda Kosong, Silahkan Tambahkan Pesanan.');</script>";
    echo "<script>location='index.php';</script>";
}
// jika belum login maka dilarikan ke halaman login
if (!isset($_SESSION["pelanggan"]))
{
    echo "<script>alert('silahkan login');</script>";
    echo "<script>location='login.php';</script>";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>keranjang Pemesanan</title>
        <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    </head>
    <body>

<!-- navbar -->
<?php include 'menu.php'; ?>

    <section class="konten">
    <div class="container">
        <h1>Riwayat Pemesanan <?php echo $_SESSION["pelanggan"]["nama_pelanggan"] ?></h1>
        <hr> 
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subharga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor=1; ?>
                <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
                    <!-- tampilkan produk -->
                    <?php
                    $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                    $pecah = $ambil->fetch_assoc();
                    $subharga = $pecah["harga_produk"]*$jumlah;
                    ?>
                <tr>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $pecah["nama_produk"]; ?></td>
                    <td>Rp. <?php echo number_format($pecah["harga_produk"]); ?></td>
                    <td><?php echo $jumlah; ?></td>
                    <td>Rp. <?php echo number_format($subharga); ?></td>
                    <td>
                        <a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" class="btn btn-danger btn-xs">Hapus</a> 
                    </td>
                </tr>
                <?php $nomor++; ?>
                <?php endforeach ?>
            </tbody>
        </table>

        <a href="index.php" class="btn btn-default">Lanjut Order</a> 
        <a href="checkout.php" class="btn btn-primary">Checkout</a> 
    </div>
</section>
    </body>
</html>