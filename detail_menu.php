<?php
session_start();
include 'koneksi.php';

// Cek apakah ada parameter ID di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: dashboardClient.php");
    exit;
}

$id_menu = mysqli_real_escape_string($koneksi, $_GET['id']);

// Ambil data menu spesifik dari database
$query  = "SELECT * FROM menu WHERE id_menu = '$id_menu'";
$result = mysqli_query($koneksi, $query);

if (mysqli_num_rows($result) === 0) {
    echo "<script>alert('Menu tidak ditemukan!'); window.location='dashboardClient.php';</script>";
    exit;
}

$menu = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Menu - <?php echo htmlspecialchars($menu['nama_menu']); ?></title>
</head>
<body>

    <a href="dashboardClient.php">← Kembali ke Daftar Menu</a>
    <hr>

    <h2>Detail Menu</h2>

    <table border="0" cellpadding="10" cellspacing="0">
        <tr>
            <td valign="top" width="200">
                <!-- Gambar Menu -->
                <?php if (!empty($menu['gambar_menu']) && file_exists('img/' . $menu['gambar_menu'])): ?>
                    <img src="img/<?php echo $menu['gambar_menu']; ?>" width="200" height="200" alt="<?php echo htmlspecialchars($menu['nama_menu']); ?>">
                <?php else: ?>
                    <p>[Gambar Tidak Tersedia]</p>
                <?php endif; ?>
            </td>
            <td valign="top">
                <!-- Info Menu -->
                <h3><?php echo htmlspecialchars($menu['nama_menu']); ?></h3>
                <p><strong>Kategori:</strong> <?php echo htmlspecialchars($menu['kategori_menu']); ?></p>
                <p><strong>Harga:</strong> Rp <?php echo number_format($menu['harga_menu'], 0, ',', '.'); ?></p>
                <p><strong>Deskripsi:</strong><br><?php echo nl2br(htmlspecialchars($menu['deskripsi_menu'])); ?></p>
                
                <hr>

                <!-- Form Tambah ke Keranjang -->
                <form action="proses_keranjang.php" method="POST">
                    <input type="hidden" name="id_menu" value="<?php echo $menu['id_menu']; ?>">
                    <input type="hidden" name="harga_satuan" value="<?php echo $menu['harga_menu']; ?>">
                    
                    <label for="jumlah">Jumlah Porsi:</label>
                    <input type="number" id="jumlah" name="jumlah" value="1" min="1" required>
                    <br><br>
                    
                    <button type="submit" name="tambah_keranjang">Tambahkan ke Keranjang</button>
                </form>
            </td>
        </tr>
    </table>

</body>
</html>