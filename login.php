<?php
session_start();
require_once 'koneksi.php';

// Jika user sudah login, langsung alihkan sesuai role
if (isset($_SESSION['login'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: dashboardAdmin.php");
        exit;
    } else {
        header("Location: dashboardClient.php");
        exit;
    }
}

$error = '';

// Proses ketika tombol login ditekan
if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $error = "Silakan isi username dan password!";
    } else {
        // Mencegah SQL Injection dengan prepared statements
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = mysqli_prepare($koneksi, $query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            // Cek password (mendukung password_hash() dan teks biasa jika untuk testing)
            if (password_verify($password, $row['password']) || $password === $row['password']) {
                // Set data session
                $_SESSION['login'] = true;
                $_SESSION['id_user'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['role'] = $row['role']; // 'admin' atau 'customer'

                // PENGALIHAN HALAMAN BERDASARKAN ROLE
                if ($row['role'] === 'admin') {
                    header("Location: admin/index.php");
                    exit;
                } else if ($row['role'] === 'customer') {
                    header("Location: index.html");
                    exit;
                } else {
                    $error = "Role akun tidak valid!";
                }
            } else {
                $error = "Password yang Anda masukkan salah!";
            }
        } else {
            $error = "Username tidak terdaftar!";
        }
        mysqli_stmt_close($stmt);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Ardheva Food & Snack</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {
            background: #ffffff;
            width: 100%;
            max-width: 420px;
            padding: 35px 30px;
            border-radius: 14px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        .login-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .login-header h2 {
            color: #d84315;
            font-size: 26px;
            font-weight: 700;
        }

        .login-header p {
            color: #757575;
            font-size: 14px;
            margin-top: 5px;
        }

        .alert-error {
            background-color: #ffebee;
            color: #c62828;
            padding: 12px 14px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 20px;
            border-left: 4px solid #ef5350;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #424242;
        }

        .form-group input {
            width: 100%;
            padding: 12px 14px;
            border: 1.5px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s ease;
            outline: none;
        }

        .form-group input:focus {
            border-color: #ff7043;
            box-shadow: 0 0 0 3px rgba(255, 112, 67, 0.15);
        }

        .btn-login {
            width: 100%;
            background-color: #ff5722;
            color: #ffffff;
            border: none;
            padding: 12px;
            font-size: 15px;
            font-weight: 600;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.2s ease;
            margin-top: 10px;
        }

        .btn-login:hover {
            background-color: #e64a19;
        }

        .login-footer {
            margin-top: 25px;
            text-align: center;
            font-size: 14px;
            color: #616161;
        }

        .login-footer a {
            color: #ff5722;
            text-decoration: none;
            font-weight: 600;
        }

        .login-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-header">
            <h2>🍱 Ardheva</h2>
            <p>Silakan masuk ke akun Anda</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert-error">
                <?= htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Masukkan username" required autocomplete="username">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password" required autocomplete="current-password">
            </div>

            <button type="submit" name="login" class="btn-login">Masuk</button>
        </form>

        <div class="login-footer">
            Belum punya akun? <a href="register.php">Daftar sekarang</a>
        </div>
    </div>

</body>
</html>

