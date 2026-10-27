<?php
session_start();
include 'koneksi.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: form_login.php?pesan=belum_login");
    exit();
}

// Menentukan halaman yang sedang dibuka berdasarkan parameter 'page' di URL
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin UMKM</title>
</head>
<body>

    <!-- Header Dashboard -->
    <h1>Dashboard Admin UMKM</h1>
    <p>Halo, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>! Selamat datang di panel kontrol.</p>
    <hr>

    <!-- Layout Utama -->
    <table width="100%" border="0" cellpadding="10" cellspacing="0">
        <tr>
            <!-- Sidebar Navigasi -->
            <td width="25%" valign="top" bgcolor="#f4f4f4">
                <h3>Navigasi Sidebar</h3>
                <ul>
                    <li><a href="dashboard_admin.php?page=home">🏠 Dashboard Utama</a></li>
                    <li><a href="dashboard_admin.php?page=menu">🍽️ Menu</a></li>
                    <li><a href="dashboard_admin.php?page=feedback">💬 Feedback</a></li>
                    <li><a href="dashboard_admin.php?page=pesanan">📦 Pesanan</a></li>
                    <li><a href="dashboard_admin.php?page=profil">👤 Profil Admin</a></li>
                    <li><a href="dashboard_admin.php?page=bahan">🥬 Bahan</a></li>
                    <li><a href="dashboard_admin.php?page=resep">📖 Resep</a></li>
                    <li><a href="dashboard_admin.php?page=user_client">👥 User Client</a></li>
                    <br>
                    <li><a href="logout.php">🚪 Logout</a></li>
                </ul>
            </td>

            <!-- Area Konten: Memanggil (include) file PHP masing-masing secara langsung -->
            <td width="75%" valign="top">
                <?php
                switch ($page) {
                    case 'menu':
                        include "menu_admin.php";
                        break;

                    case 'feedback':
                        include "feedback_admin.php";
                        break;

                    case 'pesanan':
                        include "pesanan_admin.php";
                        break;

                    case 'profil':
                        include "profil_admin.php";
                        break;

                    case 'bahan':
                        include "bahan.php";
                        break;

                    case 'resep':
                        include "resep.php";
                        break;

                    case 'user_client':
                        include "user_client.php";
                        break;

                    default:
                        echo "<h2>Selamat Datang di Halaman Utama Dashboard</h2>";
                        echo "<p>Silakan klik salah satu menu di sidebar sebelah kiri untuk mengelola sistem UMKM Anda.</p>";
                        break;
                }
                ?>
            </td>
        </tr>
    </table>

</body>
</html>