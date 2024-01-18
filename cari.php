<?php 
session_start(); 
error_reporting(0);
include 'koneksi.php'; 

$keyword = $_GET["keyword"];

$semuadata=array();
$ambil = $koneksi->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' OR deskripsi_produk LIKE '%$keyword%'");
while($pecah = $ambil->fetch_assoc())
{
    $semuadata[]=$pecah;
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title> Pencarian Layanan</title>
        <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    </head>
    <body>
    <?php include 'menu.php'; ?>
        
    <div class="container">
        <h3>Hasil Pencarian : <?php echo $keyword ?></h3>

        <?php if(empty($semuadata)): ?>
            <div class="alert alert-danger">Layanan <strong><?php echo $keyword ?></strong> Tidak Tersedia</div>
        <?php endif ?>    

        <div class="row">
            <?php foreach($semuadata as $key => $value): ?>
                
        <div class="col-md-3">
            <div class="thumbnail">
                <img src="foto_produk/<?php echo $value["foto_produk"] ?>" alt="" class="img-responsive">
                <div class="caption">
                    <h3><?php echo $value["nama_produk"] ?></h3>
                    <h5>Rp. <?php echo number_format($value['harga_produk']) ?></h5>
                    <a href="pesan.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-primary">Pesan</a>
                    <a href="detail.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-default">Detail</a>
                </div>
            </div>
        </div>
        <?php endforeach ?>

        </div>
    </div>

</body>
</html>
