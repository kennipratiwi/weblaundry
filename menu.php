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
            
            <form action="cari.php" method="get" class="navbar-form navbar-right">
                <input type="text" class="form-control" name="keyword">
                <button class="btn btn-primary">Cari Layanan</button>
            </form>
        </div>
    </nav>
