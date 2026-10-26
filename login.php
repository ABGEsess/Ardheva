<?php
session_start();
include 'koneksi.php';

// Memproses data saat form disubmit
if (isset($_POST['login'])) {
    $email    = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = $_POST['password'];

    // Cari user berdasarkan email
    $query  = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        // Verifikasi password yang di-hash
        if (password_verify($password, $user['password'])) {
            // Simpan data user ke dalam session
            $_SESSION['login']     = true;
            $_SESSION['id_user']   = $user['id_user'];
            $_SESSION['nama_user'] = $user['nama_user'];
            $_SESSION['role']      = $user['role'];

            // Redirect ke halaman utama / dashboard
            echo "<script>
                    alert('Login berhasil! Selamat datang, " . $user['nama_user'] . "');
                    window.location = 'index.php'; // Ubah sesuai halaman utama Anda
                  </script>";
            exit;
        } else {
            echo "<script>alert('Password salah!');</script>";
        }
    } else {
        echo "<script>alert('Email tidak ditemukan!');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - UMKM Catering</title>
</head>
<body>
    <h2>Form Login</h2>
    
    <form action="" method="POST">
        <table>
            <tr>
                <td>Email</td>
                <td><input type="email" name="email" required></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" required></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" name="login">Login</button></td>
            </tr>
        </table>
    </form>
    
    <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
</body>
</html>