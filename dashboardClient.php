<?php
session_start();
include 'koneksi.php';

// Ambil kategori unik untuk filter
$query_kategori = mysqli_query($koneksi, "SELECT DISTINCT kategori_menu FROM menu");

// Filter berdasarkan kategori jika ada request GET
$kategori_terpilih = isset($_GET['kategori']) ? mysqli_real_escape_string($koneksi, $_GET['kategori']) : '';

if (!empty($kategori_terpilih)) {
    $query_menu = "SELECT * FROM menu WHERE kategori_menu = '$kategori_terpilih'";
} else {
    $query_menu = "SELECT * FROM menu";
}

$result_menu = mysqli_query($koneksi, $query_menu);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Client - ARDHEYA FOOD & SNACK</title>
</head>
<body>
    <!-- Header & Navigasi Sederhana Client -->
    <header>
        <h1>ARDHEYA FOOD & SNACK</h1>
        <nav>
            <a href="dashboardClient.php">Home</a> | 
            <a href="#daftar-menu">Menu</a> | 
            <a href="keranjang.php">Keranjang</a> | 
            <?php if (isset($_SESSION['login'])): ?>
                <span>Halo, <?php echo htmlspecialchars($_SESSION['nama_user']); ?></span> | 
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a> | 
                <a href="register.php">Register</a>
            <?php endif; ?>
        </nav>
    </header>

    <hr>

    <!-- Section Hero Banner -->
    <section>
        <h2>Masakan Rumah, Rasa Restoran</h2>
        <p>Eksplorasi rasa terbaik dengan sajian bahan berkualitas.</p>
    </section>

    <hr>

    <!-- Filter Kategori Menu -->
    <section id="daftar-menu">
        <h3>Eksplorasi Rasa - Daftar Menu</h3>
        
        <form method="GET" action="dashboardClient.php#daftar-menu">
            <label for="kategori">Filter Kategori: </label>
            <select name="kategori" id="kategori" onchange="this.form.submit()">
                <option value="">Semua Kategori</option>
                <?php while ($kat = mysqli_fetch_assoc($query_kategori)): ?>
                    <option value="<?php echo htmlspecialchars($kat['kategori_menu']); ?>" 
                        <?php echo ($kategori_terpilih == $kat['kategori_menu']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($kat['kategori_menu']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <?php if (!empty($kategori_terpilih)): ?>
                <a href="dashboardClient.php#daftar-menu">Reset Filter</a>
            <?php endif; ?>
        </form>
    </section>

    <br>

    <!-- Grid / List Display Data Menu -->
    <section>
        <?php if (mysqli_num_rows($result_menu) > 0): ?>
            <table border="1" cellpadding="10" cellspacing="0" width="100%">
                <tr>
                    <?php 
                    $kolom = 0;
                    while ($row = mysqli_fetch_assoc($result_menu)): 
                        // Pecah tampilan menjadi 4 kolom per baris tabel
                        if ($kolom > 0 && $kolom % 4 == 0) {
                            echo "</tr><tr>";
                        }
                        $kolom++;
                    ?>
                        <td width="25%" align="center" valign="top">
                            <!-- Gambar Menu -->
                            <?php if (!empty($row['gambar_menu']) && file_exists('img/' . $row['gambar_menu'])): ?>
                                <img src="img/<?php echo $row['gambar_menu']; ?>" width="150" height="150" alt="<?php echo htmlspecialchars($row['nama_menu']); ?>">
                            <?php else: ?>
                                <p>[Gambar Tidak Tersedia]</p>
                            <?php endif; ?>

                            <!-- Detail Menu -->
                            <h4><?php echo htmlspecialchars($row['nama_menu']); ?></h4>
                            <p><small><i>Kategori: <?php echo htmlspecialchars($row['kategori_menu']); ?></i></small></p>
                            <p><?php echo htmlspecialchars($row['deskripsi_menu']); ?></p>
                            <p><strong>Rp <?php echo number_format($row['harga_menu'], 0, ',', '.'); ?></strong></p>
                            <p><a href="detail_menu.php?id=<?php echo $row['id_menu']; ?>">Lihat Detail Menu</a></p>

                            <!-- Form Tambah Ke Keranjang/Pesan -->
                            <form action="proses_keranjang.php" method="POST">
                                <input type="hidden" name="id_menu" value="<?php echo $row['id_menu']; ?>">
                                <input type="hidden" name="harga_satuan" value="<?php echo $row['harga_menu']; ?>">
                                <label for="qty_<?php echo $row['id_menu']; ?>">Jumlah:</label>
                                <input type="number" id="qty_<?php echo $row['id_menu']; ?>" name="jumlah" value="1" min="1" style="width: 40px;">
                                <br><br>
                                <button type="submit" name="tambah_keranjang">Pesan Sekarang</button>
                            </form>
                        </td>
                    <?php endwhile; ?>
                </tr>
            </table>
        <?php else: ?>
            <p>Menu tidak ditemukan atau belum tersedia.</p>
        <?php endif; ?>
    </section>

</body>
</html>