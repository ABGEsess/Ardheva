<?php
// Pastikan koneksi sudah ada (dipanggil dari dashboard_admin.php)
include 'koneksi.php';

// 1. PROSES TAMBAH MENU
if (isset($_POST['tambah_menu'])) {
    $id_menu       = 'MEN' . mt_rand(1000000, 9999999); 
    $nama_menu     = mysqli_real_escape_string($koneksi, $_POST['nama_menu']);
    $deskripsi     = mysqli_real_escape_string($koneksi, $_POST['deskripsi_menu']);
    $kategori      = mysqli_real_escape_string($koneksi, $_POST['kategori_menu']);
    $harga         = mysqli_real_escape_string($koneksi, $_POST['harga_menu']);

    $nama_file     = $_FILES['gambar_menu']['name'];
    $error         = $_FILES['gambar_menu']['error'];
    $tmp_file      = $_FILES['gambar_menu']['tmp_name'];

    if ($error === 0) {
        $ektensi_diperbolehkan = ['jpg', 'jpeg', 'png', 'gif'];
        $x = explode('.', $nama_file);
        $ekstensi = strtolower(end($x));

        if (in_array($ekstensi, $ektensi_diperbolehkan) === true) {
            $nama_file_baru = uniqid() . '.' . $ekstensi;
            
            if (move_uploaded_file($tmp_file, 'img/' . $nama_file_baru)) {
                $query = "INSERT INTO menu (id_menu, nama_menu, deskripsi_menu, kategori_menu, harga_menu, gambar_menu) 
                          VALUES ('$id_menu', '$nama_menu', '$deskripsi', '$kategori', '$harga', '$nama_file_baru')";
                
                if (mysqli_query($koneksi, $query)) {
                    // Menggunakan hash #tabel-menu agar posisi halaman tetap di area tabel
                    echo "<script>alert('Menu berhasil ditambahkan!'); window.location='dashboard_admin.php?page=menu#tabel-menu';</script>";
                } else {
                    $error_msg = mysqli_error($koneksi);
                    echo "<script>alert('Gagal: " . addslashes($error_msg) . "'); window.location='dashboard_admin.php?page=menu#tabel-menu';</script>";
                }
            } else {
                echo "<script>alert('Gagal mengupload gambar!'); window.location='dashboard_admin.php?page=menu#tabel-menu';</script>";
            }
        } else {
            echo "<script>alert('Ekstensi gambar harus jpg, jpeg, png, atau gif!'); window.location='dashboard_admin.php?page=menu#tabel-menu';</script>";
        }
    } else {
        echo "<script>alert('Harap masukkan gambar menu!'); window.location='dashboard_admin.php?page=menu#tabel-menu';</script>";
    }
}

// 2. PROSES HAPUS MENU
if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
    $id_menu = mysqli_real_escape_string($koneksi, $_GET['id']);

    $query_img = mysqli_query($koneksi, "SELECT gambar_menu FROM menu WHERE id_menu = '$id_menu'");
    $data_img = mysqli_fetch_assoc($query_img);
    
    if ($data_img && !empty($data_img['gambar_menu']) && file_exists('img/' . $data_img['gambar_menu'])) {
        unlink('img/' . $data_img['gambar_menu']);
    }

    $query_hapus = "DELETE FROM menu WHERE id_menu = '$id_menu'";
    if (mysqli_query($koneksi, $query_hapus)) {
        echo "<script>alert('Menu berhasil dihapus!'); window.location='dashboard_admin.php?page=menu#tabel-menu';</script>";
    } else {
        echo "<script>alert('Menu gagal dihapus!'); window.location='dashboard_admin.php?page=menu#tabel-menu';</script>";
    }
}

// 3. PROSES UPDATE MENU
if (isset($_POST['update_menu'])) {
    $id_menu     = mysqli_real_escape_string($koneksi, $_POST['id_menu']);
    $nama_menu   = mysqli_real_escape_string($koneksi, $_POST['nama_menu']);
    $deskripsi   = mysqli_real_escape_string($koneksi, $_POST['deskripsi_menu']);
    $kategori    = mysqli_real_escape_string($koneksi, $_POST['kategori_menu']);
    $harga       = mysqli_real_escape_string($koneksi, $_POST['harga_menu']);

    if (!empty($_FILES['gambar_menu']['name'])) {
        $nama_file   = $_FILES['gambar_menu']['name'];
        $tmp_file    = $_FILES['gambar_menu']['tmp_name'];
        $x           = explode('.', $nama_file);
        $ekstensi    = strtolower(end($x));
        $nama_file_baru = uniqid() . '.' . $ekstensi;

        if (move_uploaded_file($tmp_file, 'img/' . $nama_file_baru)) {
            $query_img = mysqli_query($koneksi, "SELECT gambar_menu FROM menu WHERE id_menu = '$id_menu'");
            $data_img = mysqli_fetch_assoc($query_img);
            if ($data_img && !empty($data_img['gambar_menu']) && file_exists('img/' . $data_img['gambar_menu'])) {
                unlink('img/' . $data_img['gambar_menu']);
            }

            $query = "UPDATE menu SET nama_menu='$nama_menu', deskripsi_menu='$deskripsi', kategori_menu='$kategori', harga_menu='$harga', gambar_menu='$nama_file_baru' WHERE id_menu='$id_menu'";
        }
    } else {
        $query = "UPDATE menu SET nama_menu='$nama_menu', deskripsi_menu='$deskripsi', kategori_menu='$kategori', harga_menu='$harga' WHERE id_menu='$id_menu'";
    }

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Menu berhasil diperbarui!'); window.location='dashboard_admin.php?page=menu#tabel-menu';</script>";
    } else {
        echo "<script>alert('Pembaruan menu gagal!'); window.location='dashboard_admin.php?page=menu#tabel-menu';</script>";
    }
}

// Hitung Statistik Data (Stats Badges)
$total_menu_res = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM menu");
$total_menu = mysqli_fetch_assoc($total_menu_res)['total'] ?? 0;

$kategori_res = mysqli_query($koneksi, "SELECT COUNT(DISTINCT kategori_menu) AS total_kat FROM menu");
$total_kategori = mysqli_fetch_assoc($kategori_res)['total_kat'] ?? 0;
?>

<h2>Manajemen Menu Catering</h2>

<!-- KARTU RINGKASAN DATA (STATS BADGES) -->
<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <td>
            <strong>Total Menu:</strong> <br>
            <?php echo $total_menu; ?>
        </td>
        <td>
            <strong>Total Kategori:</strong> <br>
            <?php echo $total_kategori; ?>
        </td>
    </tr>
</table>

<hr>

<!-- FORM TAMBAH MENU -->
<h3>Tambah Menu Baru</h3>
<form action="dashboard_admin.php?page=menu#tabel-menu" method="POST" enctype="multipart/form-data">
    <table border="0" cellpadding="5" cellspacing="0">
        <tr>
            <td>Nama Menu</td>
            <td><input type="text" name="nama_menu" required></td>
        </tr>
        <tr>
            <td>Kategori Menu</td>
            <td><input type="text" name="kategori_menu" required></td>
        </tr>
        <tr>
            <td>Harga (Rp)</td>
            <td><input type="number" name="harga_menu" required></td>
        </tr>
        <tr>
            <td>Deskripsi Menu</td>
            <td><textarea name="deskripsi_menu" rows="3" required></textarea></td>
        </tr>
        <tr>
            <td>Gambar Menu</td>
            <td>
                <!-- Input dengan event onchange untuk Preview Nama File Upload -->
                <input type="file" name="gambar_menu" id="input_gambar" accept="image/*" required onchange="tampilkanNamaFile(this)">
                <br><small id="nama_file_label" style="color: gray; font-style: italic;">Belum ada file dipilih</small>
            </td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit" name="tambah_menu">Tambah Menu</button></td>
        </tr>
    </table>
</form>

<br><hr><br>

<!-- PENCARIAN LANGSUNG (LIVE SEARCH) -->
<a id="tabel-menu"></a>
<h3>Daftar Menu</h3>
<label>Cari Menu (Nama / Kategori): </label>
<input type="text" id="inputPencarian" onkeyup="cariMenu()" placeholder="Ketik untuk mencari...">
<br><br>

<!-- TABEL DAFTAR MENU -->
<table border="1" cellpadding="8" cellspacing="0" width="100%" id="tabelMenuData">
    <thead>
        <tr bgcolor="#f2f2f2">
            <th>No</th>
            <th>Gambar</th>
            <th>Nama Menu</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $data_menu = mysqli_query($koneksi, "SELECT * FROM menu");
        if (mysqli_num_rows($data_menu) > 0) {
            while ($row = mysqli_fetch_assoc($data_menu)) {
                $is_editing = (isset($_GET['aksi']) && $_GET['aksi'] == 'edit' && $_GET['id'] == $row['id_menu']);
                
                if ($is_editing) {
                    // FORM EDIT DALAM BARIS TABEL
                    echo "<form action='dashboard_admin.php?page=menu#tabel-menu' method='POST' enctype='multipart/form-data'>";
                    echo "<input type='hidden' name='id_menu' value='" . $row['id_menu'] . "'>";
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td><img src='img/" . $row['gambar_menu'] . "' width='50'><br><input type='file' name='gambar_menu' accept='image/*'></td>";
                    echo "<td><input type='text' name='nama_menu' value='" . htmlspecialchars($row['nama_menu']) . "' required></td>";
                    echo "<td><input type='text' name='kategori_menu' value='" . htmlspecialchars($row['kategori_menu']) . "' required></td>";
                    echo "<td><input type='number' name='harga_menu' value='" . $row['harga_menu'] . "' required></td>";
                    echo "<td><textarea name='deskripsi_menu' required>" . htmlspecialchars($row['deskripsi_menu']) . "</textarea></td>";
                    echo "<td>";
                    echo "<button type='submit' name='update_menu'>Selesai Edit</button><br>";
                    echo "<a href='dashboard_admin.php?page=menu#tabel-menu'>Batal</a>";
                    echo "</td>";
                    echo "</tr>";
                    echo "</form>";
                } else {
                    // TAMPILAN BIASA TABEL
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td align='center'>";
                    if (!empty($row['gambar_menu']) && file_exists('img/' . $row['gambar_menu'])) {
                        echo "<img src='img/" . $row['gambar_menu'] . "' width='70' height='70'>";
                    } else {
                        echo "Tidak ada gambar";
                    }
                    echo "</td>";
                    echo "<td>" . htmlspecialchars($row['nama_menu']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['kategori_menu']) . "</td>";
                    echo "<td>Rp " . number_format($row['harga_menu'], 0, ',', '.') . "</td>";
                    echo "<td>" . htmlspecialchars($row['deskripsi_menu']) . "</td>";
                    echo "<td align='center'>";
                    echo "<a href='dashboard_admin.php?page=menu&aksi=edit&id=" . $row['id_menu'] . "#tabel-menu'>Edit</a> | ";
                    echo "<a href='dashboard_admin.php?page=menu&aksi=hapus&id=" . $row['id_menu'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus menu ini?\")'>Hapus</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            }
        } else {
            echo "<tr><td colspan='7' align='center'>Belum ada data menu.</td></tr>";
        }
        ?>
    </tbody>
</table>

<!-- SCRIPT JAVASCRIPT UNTUK FITUR PENCARIAN & PREVIEW NAMA FILE -->
<script>
    // 1. Fungsi Preview Nama File Upload
    function tampilkanNamaFile(input) {
        const label = document.getElementById('nama_file_label');
        if (input.files && input.files[0]) {
            label.textContent = "File dipilih: " + input.files[0].name;
        } else {
            label.textContent = "Belum ada file dipilih";
        }
    }

    // 2. Fungsi Pencarian Langsung (Live Search) pada Tabel
    function cariMenu() {
        let input = document.getElementById('inputPencarian');
        let filter = input.value.toLowerCase();
        let tabel = document.getElementById('tabelMenuData');
        let baris = tabel.getElementsByTagName('tr');

        // Mulai dari i = 1 untuk melewati baris header tabel
        for (let i = 1; i < baris.length; i++) {
            let kolomNama = baris[i].getElementsByTagName('td')[2];
            let kolomKategori = baris[i].getElementsByTagName('td')[3];

            if (kolomNama || kolomKategori) {
                let teksNama = kolomNama ? kolomNama.textContent || kolomNama.innerText : "";
                let teksKategori = kolomKategori ? kolomKategori.textContent || kolomKategori.innerText : "";

                if (teksNama.toLowerCase().indexOf(filter) > -1 || teksKategori.toLowerCase().indexOf(filter) > -1) {
                    baris[i].style.display = "";
                } else {
                    baris[i].style.display = "none";
                }
            }
        }
    }
</script>