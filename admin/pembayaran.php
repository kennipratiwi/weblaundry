<h2>Data Pembayaran</h2>


<?php
error_reporting(0);
include 'koneksi.php';
// mendapatakan id_pembelian
$id_pembelian = $_GET['id'];

// mengambil data pembayaran berdasarkan id_pembelian
$ambil = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian='$id_pembelian' ");
$detail = $ambil->fetch_assoc();
?>

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
        <tr>
            <th>Bukti Pembayaran</th>
            <td><img src="../bukti_pembayaran/<?php echo $detail['bukti'] ?>" alt="" class="img-responsive"></td>
        </tr>
        
    </table>
</div>
</div>

<form method = "post">
    <div class="form group">
        <label>Status</label>
        <select class="form-control" name="status">
            <option value="">Pilih Status</option>
            <option value="Lunas">Lunas</option>
            <option value="Pemesanan Diproses">Pemesanan Diproses</option>
            <option value="Selesai">Selesai</option>
            <option value="Batal">Batal</option>
        </select>
    </div>
    <button class="btn btn-primary" name="proses">Proses</button>
</form>

<?php
if (isset($_POST["proses"]))
{
    $status = $_POST["status"];
    $koneksi->query("UPDATE pembelian SET status_pembelian='$status' WHERE id_pembelian='$id_pembelian' ");

    echo "<script>alert('Status Pembelian Berhasil diupdate');</script>";
    echo "<script>location='index.php?halaman=pembelian';</script>";
}