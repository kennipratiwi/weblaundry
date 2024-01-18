<?php
session_start();
// mendapatkan id produk
$id_produk = $_GET['id'];


// jika sudah ada produk dikeranjang, maka produk jumlahnya ditambah 1
if (isset($_SESSION['keranjang'][$id_produk]))
{
    $_SESSION['keranjang'][$id_produk]+=1;
}
// jika belom ada dikeranjang, maka produk dianggap dibeli 1
else
{
    $_SESSION['keranjang'][$id_produk] = 1;
}


// echo "
// larikan ke halaman keranjang
echo "<script>alert('produk telah masuk ke keranjang');</script>";
echo "<script>location='keranjang.php';</script>";
?> 