<?php
include 'koneksi.php';

if (isset($_POST['register'])) {
    $nama_user = mysqli_real_escape_string($koneksi, $_POST['nama_user']);
    $email     = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password  = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $alamat    = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $no_talp   = mysqli_real_escape_string($koneksi, $_POST['no_telp']);
    $role      = 'customer'; // Default role untuk pendaftaran umum

    // Membuat id_user unik secara otomatis (karena tipe datanya char)
    $id_user   = 'USR' . time();

    $query = "INSERT INTO users (id_user, nama_user, email, password, alamat, no_telp, role) 
              VALUES ('$id_user', '$nama_user', '$email', '$password', '$alamat', '$no_telp', '$role')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='login.php';</script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register - UMKM Catering</title>
</head>
<body>
    <h2>Form Register</h2>
    <form action="" method="POST">
        <table>
            <tr>
                 <td>Nama Lengkap</td>
                <td><input type="text" name="nama_user" required></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="email" name="email" required></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" required></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><textarea name="alamat" required></textarea></td>
            </tr>
            <tr>
                <td>No Telepon</td>
                <td><input type="text" name="no_telp" required></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" name="register">Register</button></td>
            </tr>
        </table>
    </form>
    <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
</body>
</html>