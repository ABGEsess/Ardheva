<?php
session_start();

// Inisialisasi keranjang jika belum ada
if (!isset($_SESSION['keranjang'])) {
    $_SESSION['keranjang'] = array();
}

// 1. TAMBAH KE KERANJANG
if (isset($_POST['tambah_keranjang'])) {
    $id_menu      = $_POST['id_menu'];
    $harga_satuan = (int)$_POST['harga_satuan'];
    $jumlah       = (int)$_POST['jumlah'];

    // Jika menu sudah ada di keranjang, tambahkan jumlahnya
    if (isset($_SESSION['keranjang'][$id_menu])) {
        $_SESSION['keranjang'][$id_menu]['jumlah'] += $jumlah;
    } else {
        // Jika belum ada, masukkan data baru
        $_SESSION['keranjang'][$id_menu] = [
            'harga_satuan' => $harga_satuan,
            'jumlah'       => $jumlah
        ];
    }

    echo "<script>alert('Menu berhasil ditambahkan ke keranjang!'); window.location='dashboardClient.php';</script>";
    exit;
}

// 2. HAPUS ITEM DARI KERANJANG
if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
    $id_menu = $_GET['id'];
    unset($_SESSION['keranjang'][$id_menu]);
    
    echo "<script>alert('Item berhasil dihapus dari keranjang.'); window.location='keranjang.php';</script>";
    exit;
}

// 3. UPDATE JUMLAH ITEM
if (isset($_POST['update_keranjang'])) {
    foreach ($_POST['jumlah'] as $id_menu => $jumlah) {
        if ((int)$jumlah <= 0) {
            unset($_SESSION['keranjang'][$id_menu]);
        } else {
            $_SESSION['keranjang'][$id_menu]['jumlah'] = (int)$jumlah;
        }
    }
    echo "<script>alert('Keranjang berhasil diperbarui!'); window.location='keranjang.php';</script>";
    exit;
}
?>