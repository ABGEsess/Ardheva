<?php
// Mulai session di awal baris
session_start();

if (isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validasi login (Contoh statis, sesuaikan dengan database Anda nanti)
    if ($username === 'admin' && $password === 'admin123') {
        // Set session bahwa user sudah login
        $_SESSION['status'] = "login";
        $_SESSION['username'] = $username;

        // Redirect langsung ke halaman dashboard.php
        header("Location: dashboard_admin.php");
        exit();
    } else {
        // Jika salah, arahkan kembali ke form login dengan pesan error (opsional) atau tampilkan pesan
        // Di sini kita arahkan kembali ke form login
        header("Location: form_login.php?pesan=gagal");
        exit();
    }
} else {
    // Jika diakses langsung tanpa POST, kembalikan ke form login
    header("Location: login.php");
    exit();
}
?>