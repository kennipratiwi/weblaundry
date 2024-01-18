<?php
session_start();
// koneksi database
error_reporting(0);
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
        <title> Checkout</title>
        <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    </head>
    <body>

<!-- navbar -->
<?php include 'menu.php'; ?>
    <section class="konten">
    <div class="container">
        <h1>keranjang Pemesanan</h1>
        <hr> 
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subharga</th>
                </tr>
            </thead>
            <tbody>
                <?php $nomor=1; ?>
                <?php $totalbelanja = 0; ?>
                <?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah){ ?>
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
                    </td>
                </tr>
                <?php $nomor++; ?>
                <?php $totalbelanja+=$subharga; ?>
                <?php }?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="4">Total Pesanan</th>
                    <th>Rp. <?php echo number_format($totalbelanja) ?>  </th>
                </tr>
            </tfoot>
        </table>

        <form method="post">
        <?php
        if (isset($_POST["checkout"]))
        {
            
            $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
            $id_ongkir = $_POST["id_ongkir"];
            $tanggal_pembelian = date("Y-m-d");
            $alamat_pengiriman = $_POST['alamat_pengiriman'];

            $ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'");
            $arrayongkir = $ambil->fetch_assoc();
            $jarak = $arrayongkir['jarak'];
            $tarif = $arrayongkir['tarif'];

            $total_pembelian = $totalbelanja + $tarif;

            // Menyimpan data ke tabel pembelian
            $koneksi->query("INSERT INTO pembelian (id_pelanggan,id_ongkir,tanggal_pembelian,total_pembelian,jarak,tarif,alamat_pengiriman) VALUES ('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian','$jarak','$tarif','$alamat_pengiriman')" );

            // Mendapatkan id_pembelian terbaru 
            $id_pembelian_terbaru = $koneksi->insert_id;
            
            foreach ($_SESSION["keranjang"] as $id_produk => $jumlah)
            {
                // mendapatkan data produk berdasarkan id_produk
            $ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
            $perproduk = $ambil->fetch_assoc();

            $nama = $perproduk['nama_produk'];
            $harga = $perproduk['harga_produk'];
            $berat = $perproduk['berat_produk'];

            $subberat = $perproduk['berat_produk']*$jumlah;
            $subharga = $perproduk['harga_produk']*$jumlah;
            $koneksi->query("INSERT INTO pembelian_produk (id_pembelian,id_produk,nama,harga,berat,subberat,subharga,jumlah) VALUES ('$id_pembelian_terbaru','$id_produk','$nama',' $harga','$berat','$subberat','$subharga','$jumlah') ");
            }
           

            // mengkosongkan keranjang belanja 
            unset($_SESSION["keranjang"]);

            // tampilan dilarikan ke nota, nota pemesanan terbaru 
            echo "<script>alert('Pemesanan Berhasil');</script>";
            echo "<script>document.location.href='nota.php?id=$id_pembelian_terbaru';</script>";
        }

        ?>  
        <div class="row">
            <div class="col-md-4">
                <input type="type" readonly value="<?php echo $_SESSION["pelanggan"]['nama_pelanggan'] ?>" class="form-control">
             </div>
        <div class="col-md-4">
                <input type="type" readonly value="<?php echo $_SESSION["pelanggan"]['telepon_pelanggan'] ?>" class="form-control">
        </div>
        <div class="col-md-4">
                <select class="form-control" name="id_ongkir">
                    <option value="">Pilih Ongkos Kirim</option>
                    <?php
                    $ambil = $koneksi->query("SELECT * FROM ongkir");
                    while($perongkir = $ambil->fetch_assoc()){
                        ?>
                        <option value="<?php echo $perongkir["id_ongkir"] ?>" >
                            <?php echo $perongkir['jarak'] ?>
                            Rp. <?php echo number_format($perongkir['tarif']) ?>
                        </option>
                   <?php } ?>
                </select>
         </div> 
        </div>
        <div class="form-group">
            <label>Alamat Pengiriman</label>
            <textarea class="form-control" name="alamat_pengiriman" placeholder="masukkan alamat lengkap pengiriman"></textarea>
        </div>
        <button class="btn btn-primary" name="checkout">Checkout</button>
        </form>


    </div>
</section>

</body>
</html>