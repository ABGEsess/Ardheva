<?php
session_start();
include 'koneksi.php';

// Pastikan user sudah login sebelum checkout
$is_login = isset($_SESSION['login']) && $_SESSION['login'] === true;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Keranjang Belanja</title>
</head>
<body>

    <h2>Keranjang Belanja Anda</h2>
    <a href="dashboardClient.php">← Kembali ke Menu</a>
    <hr>

    <?php if (!empty($_SESSION['keranjang'])): ?>
        <form action="proses_keranjang.php" method="POST">
            <table border="1" cellpadding="8" cellspacing="0" width="100%">
                <thead>
                    <tr bgcolor="#f2f2f2">
                        <th>No</th>
                        <th>Nama Menu</th>
                        <th>Harga Satuan</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $total_belanja = 0;
                    
                    foreach ($_SESSION['keranjang'] as $id_menu => $detail):
                        // Ambil detail nama menu dari database
                        $query_menu = mysqli_query($koneksi, "SELECT nama_menu FROM menu WHERE id_menu = '$id_menu'");
                        $data_menu  = mysqli_fetch_assoc($query_menu);
                        
                        $nama_menu = $data_menu ? $data_menu['nama_menu'] : 'Menu Tidak Ditemukan';
                        $subtotal  = $detail['harga_satuan'] * $detail['jumlah'];
                        $total_belanja += $subtotal;
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($nama_menu); ?></td>
                            <td>Rp <?php echo number_format($detail['harga_satuan'], 0, ',', '.'); ?></td>
                            <td>
                                <input type="number" name="jumlah[<?php echo $id_menu; ?>]" value="<?php echo $detail['jumlah']; ?>" min="1" style="width: 50px;">
                            </td>
                            <td>Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                            <td align="center">
                                <a href="proses_keranjang.php?aksi=hapus&id=<?php echo $id_menu; ?>" onclick="return confirm('Hapus item ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    
                    <tr>
                        <td colspan="4" align="right"><strong>Total Keseluruhan:</strong></td>
                        <td colspan="2"><strong>Rp <?php echo number_format($total_belanja, 0, ',', '.'); ?></strong></td>
                    </tr>
                </tbody>
            </table>

            <br>
            <button type="submit" name="update_keranjang">Update Jumlah</button>
        </form>

        <br><hr><br>

        <!-- FORM CHECKOUT / PROSES PESANAN -->
        <h3>Form Konfirmasi Pesanan</h3>
        <?php if ($is_login): ?>
            <form action="proses_checkout.php" method="POST">
                <input type="hidden" name="total_harga" value="<?php echo $total_belanja; ?>">
                <table>
                    <tr>
                        <td>Catatan Khusus (Opsional)</td>
                        <td><textarea name="catatan_khusus" rows="3" placeholder="Contoh: Tidak pedas, tambahkan sendok"></textarea></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button type="submit" name="checkout">Proses Checkout Sekarang</button></td>
                    </tr>
                </table>
            </form>
        <?php else: ?>
            <p>Silakan <a href="login.php">Login</a> terlebih dahulu untuk melakukan pemesanan/checkout.</p>
        <?php endif; ?>

    <?php else: ?>
        <p>Keranjang belanja Anda masih kosong. <a href="dashboardClient.php">Lihat Menu</a></p>
    <?php endif; ?>

</body>
</html>