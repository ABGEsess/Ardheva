<?php
session_start();
include 'koneksi.php';

if (isset($_POST['checkout']) && !empty($_SESSION['keranjang'])) {
    $id_user        = $_SESSION['id_user'];
    $catatan_khusus = mysqli_real_escape_string($koneksi, $_POST['catatan_khusus']);
    $total_harga    = (int)$_POST['total_harga'];
    $tanggal_pesanan= date('Y-m-d');

    // 1. Generate ID Pesanan Unik (char 10)
    $id_pesanan = 'ORD' . mt_rand(1000000, 9999999);

    // 2. Insert ke Tabel `pesanan`
    $query_pesanan = "INSERT INTO pesanan (id_pesanan, tanggal_pesanan, total_harga, catatan_khusus, id_user) 
                      VALUES ('$id_pesanan', '$tanggal_pesanan', '$total_harga', '$catatan_khusus', '$id_user')";

    if (mysqli_query($koneksi, $query_pesanan)) {
        
        // 3. Insert ke Tabel `detail_pesanan` untuk setiap item di keranjang
        $berhasil_detail = true;
        foreach ($_SESSION['keranjang'] as $id_menu => $detail) {
            $id_menu_db   = mysqli_real_escape_string($koneksi, $id_menu);
            $jumlah_satuan= (int)$detail['jumlah'];
            $harga_satuan = (int)$detail['harga_satuan'];
            $subtotal     = $harga_satuan * $jumlah_satuan;

            $query_detail = "INSERT INTO detail_pesanan (id_menu, id_pesanan, jumlah_satuan, harga_satuan, subtotal) 
                             VALUES ('$id_menu_db', '$id_pesanan', '$jumlah_satuan', '$harga_satuan', '$subtotal')";

            if (!mysqli_query($koneksi, $query_detail)) {
                $berhasil_detail = false;
                break;
            }
        }

        if ($berhasil_detail) {
            // Kosongkan keranjang setelah berhasil checkout
            unset($_SESSION['keranjang']);
            echo "<script>
                    alert('Pesanan berhasil dibuat! ID Pesanan Anda: $id_pesanan');
                    window.location = 'dashboardClient.php';
                  </script>";
        } else {
            echo "<script>alert('Gagal menyimpan detail pesanan: " . addslashes(mysqli_error($koneksi)) . "'); window.location='keranjang.php';</script>";
        }

    } else {
        echo "<script>alert('Gagal memproses pesanan: " . addslashes(mysqli_error($koneksi)) . "'); window.location='keranjang.php';</script>";
    }
} else {
    header("Location: dashboardClient.php");
    exit;
}
?>