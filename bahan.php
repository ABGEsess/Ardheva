<?php
// Pastikan koneksi sudah ada (dipanggil dari dashboard_admin.php)
include 'koneksi.php';

// 1. PROSES TAMBAH BAHAN
if (isset($_POST['tambah_bahan'])) {
    $id_bahan           = 'BHN' . mt_rand(1000000, 9999999); // ID unik otomatis
    $nama_bahan         = mysqli_real_escape_string($koneksi, $_POST['nama_bahan']);
    $kategori_bahan     = mysqli_real_escape_string($koneksi, $_POST['kategori_bahan']);
    $satuan_bahan       = mysqli_real_escape_string($koneksi, $_POST['satuan_bahan']);
    $harga_satuan_bahan = mysqli_real_escape_string($koneksi, $_POST['harga_satuan_bahan']);
    $stok_bahan         = mysqli_real_escape_string($koneksi, $_POST['stok_bahan']);
    $stok_minimal       = mysqli_real_escape_string($koneksi, $_POST['stok_minimal']);

    $query = "INSERT INTO bahan (id_bahan, nama_bahan, kategori_bahan, satuan_bahan, harga_satuan_bahan, stok_bahan, stok_minimal) 
              VALUES ('$id_bahan', '$nama_bahan', '$kategori_bahan', '$satuan_bahan', '$harga_satuan_bahan', '$stok_bahan', '$stok_minimal')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Bahan berhasil ditambahkan!'); window.location='dashboard_admin.php?page=bahan#tabel-bahan';</script>";
    } else {
        $error_msg = mysqli_error($koneksi);
        echo "<script>alert('Gagal: " . addslashes($error_msg) . "'); window.location='dashboard_admin.php?page=bahan#tabel-bahan';</script>";
    }
}

// 2. PROSES HAPUS BAHAN
if (isset($_GET['aksi']) && $_GET['aksi'] == 'hapus') {
    $id_bahan = mysqli_real_escape_string($koneksi, $_GET['id']);

    $query_hapus = "DELETE FROM bahan WHERE id_bahan = '$id_bahan'";
    if (mysqli_query($koneksi, $query_hapus)) {
        echo "<script>alert('Bahan berhasil dihapus!'); window.location='dashboard_admin.php?page=bahan#tabel-bahan';</script>";
    } else {
        echo "<script>alert('Bahan gagal dihapus!'); window.location='dashboard_admin.php?page=bahan#tabel-bahan';</script>";
    }
}

// 3. PROSES UPDATE BAHAN
if (isset($_POST['update_bahan'])) {
    $id_bahan           = mysqli_real_escape_string($koneksi, $_POST['id_bahan']);
    $nama_bahan         = mysqli_real_escape_string($koneksi, $_POST['nama_bahan']);
    $kategori_bahan     = mysqli_real_escape_string($koneksi, $_POST['kategori_bahan']);
    $satuan_bahan       = mysqli_real_escape_string($koneksi, $_POST['satuan_bahan']);
    $harga_satuan_bahan = mysqli_real_escape_string($koneksi, $_POST['harga_satuan_bahan']);
    $stok_bahan         = mysqli_real_escape_string($koneksi, $_POST['stok_bahan']);
    $stok_minimal       = mysqli_real_escape_string($koneksi, $_POST['stok_minimal']);

    $query = "UPDATE bahan SET 
                nama_bahan='$nama_bahan', 
                kategori_bahan='$kategori_bahan', 
                satuan_bahan='$satuan_bahan', 
                harga_satuan_bahan='$harga_satuan_bahan', 
                stok_bahan='$stok_bahan', 
                stok_minimal='$stok_minimal' 
              WHERE id_bahan='$id_bahan'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Bahan berhasil diperbarui!'); window.location='dashboard_admin.php?page=bahan#tabel-bahan';</script>";
    } else {
        echo "<script>alert('Pembaruan bahan gagal!'); window.location='dashboard_admin.php?page=bahan#tabel-bahan';</script>";
    }
}

/// Hitung Statistik Data Bahan
$total_bahan_res = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM bahan");
$total_bahan = mysqli_fetch_assoc($total_bahan_res)['total'] ?? 0;
?>

<h2>Manajemen Bahan Baku Catering</h2>

<!-- KARTU RINGKASAN DATA (STATS BADGES) -->
<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <td>
            <strong>Total Jenis Bahan:</strong> <br>
            <?php echo $total_bahan; ?>
        </td>
    </tr>
</table>

<hr>

<!-- DIAGRAM / GRAFIK BATANG STOK TIAP BAHAN -->
<h3>Diagram Stok Tiap Bahan</h3>
<table border="1" cellpadding="6" cellspacing="0" width="100%">
    <tr bgcolor="#f2f2f2">
        <th width="25%">Nama Bahan</th>
        <th width="55%">Visualisasi Grafik Stok</th>
        <th width="20%">Jumlah Stok</th>
    </tr>
    <?php
    $data_diagram = mysqli_query($koneksi, "SELECT nama_bahan, stok_bahan, satuan_bahan FROM bahan");
    if (mysqli_num_rows($data_diagram) > 0) {
        while ($row_d = mysqli_fetch_assoc($data_diagram)) {
            $nama_d = htmlspecialchars($row_d['nama_bahan']);
            $stok_d = (int)$row_d['stok_bahan'];
            $satuan_d = htmlspecialchars($row_d['satuan_bahan']);

            // Mengatur lebar visualisasi grafik secara proporsional (1 unit stok = 3px, maksimal lebar 300px)
            $lebar_pixel = $stok_d * 3;
            if ($lebar_pixel > 300) {
                $lebar_pixel = 300;
            }
            if ($lebar_pixel < 2 && $stok_d > 0) {
                $lebar_pixel = 2;
            }

            echo "<tr>";
            echo "<td><strong>{$nama_d}</strong></td>";
            echo "<td>";
            if ($stok_d > 0) {
                echo "<div style='background-color: #4CAF50; width: {$lebar_pixel}px; height: 18px;'></div>";
            } else {
                echo "<span style='color: red; font-size: 12px;'>Stok Kosong</span>";
            }
            echo "</td>";
            echo "<td>{$stok_d} {$satuan_d}</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='3' align='center'>Belum ada data untuk ditampilkan dalam diagram.</td></tr>";
    }
    ?>
</table>

<br><hr><br>


<!-- FORM TAMBAH BAHAN -->
<h3>Tambah Bahan Baru</h3>
<form action="dashboard_admin.php?page=bahan#tabel-bahan" method="POST">
    <table border="0" cellpadding="5" cellspacing="0">
        <tr>
            <td>Nama Bahan</td>
            <td><input type="text" name="nama_bahan" required></td>
        </tr>
        <tr>
            <td>Kategori Bahan</td>
            <td><input type="text" name="kategori_bahan" required></td>
        </tr>
        <tr>
            <td>Satuan (cth: kg, liter, pcs)</td>
            <td><input type="text" name="satuan_bahan" required></td>
        </tr>
        <tr>
            <td>Harga Satuan (Rp)</td>
            <td><input type="number" name="harga_satuan_bahan" required></td>
        </tr>
        <tr>
            <td>Stok Awal</td>
            <td><input type="number" name="stok_bahan" required></td>
        </tr>
        <tr>
            <td>Stok Minimal (Batas Aman)</td>
            <td><input type="number" name="stok_minimal" required></td>
        </tr>
        <tr>
            <td></td>
            <td><button type="submit" name="tambah_bahan">Tambah Bahan</button></td>
        </tr>
    </table>
</form>

<br><hr><br>

<!-- PENCARIAN LANGSUNG (LIVE SEARCH) -->
<a id="tabel-bahan"></a>
<h3>Daftar Bahan Baku</h3>
<label>Cari Bahan (Nama / Kategori): </label>
<input type="text" id="inputPencarianBahan" onkeyup="cariBahan()" placeholder="Ketik untuk mencari...">
<br><br>

<!-- TABEL DAFTAR BAHAN -->
<table border="1" cellpadding="8" cellspacing="0" width="100%" id="tabelBahanData">
    <thead>
        <tr bgcolor="#f2f2f2">
            <th>No</th>
            <th>Nama Bahan</th>
            <th>Kategori</th>
            <th>Satuan</th>
            <th>Harga Satuan</th>
            <th>Stok</th>
            <th>Stok Minimal</th>
            <th>Status Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $data_bahan = mysqli_query($koneksi, "SELECT * FROM bahan");
        if (mysqli_num_rows($data_bahan) > 0) {
            while ($row = mysqli_fetch_assoc($data_bahan)) {
                $is_editing = (isset($_GET['aksi']) && $_GET['aksi'] == 'edit' && $_GET['id'] == $row['id_bahan']);
                
                if ($is_editing) {
                    // FORM EDIT DALAM BARIS TABEL
                    echo "<form action='dashboard_admin.php?page=bahan#tabel-bahan' method='POST'>";
                    echo "<input type='hidden' name='id_bahan' value='" . $row['id_bahan'] . "'>";
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td><input type='text' name='nama_bahan' value='" . htmlspecialchars($row['nama_bahan']) . "' required></td>";
                    echo "<td><input type='text' name='kategori_bahan' value='" . htmlspecialchars($row['kategori_bahan']) . "' required></td>";
                    echo "<td><input type='text' name='satuan_bahan' value='" . htmlspecialchars($row['satuan_bahan']) . "' required></td>";
                    echo "<td><input type='number' name='harga_satuan_bahan' value='" . $row['harga_satuan_bahan'] . "' required></td>";
                    echo "<td><input type='number' name='stok_bahan' value='" . $row['stok_bahan'] . "' required></td>";
                    echo "<td><input type='number' name='stok_minimal' value='" . $row['stok_minimal'] . "' required></td>";
                    echo "<td>-</td>";
                    echo "<td>";
                    echo "<button type='submit' name='update_bahan'>Selesai Edit</button><br>";
                    echo "<a href='dashboard_admin.php?page=bahan#tabel-bahan'>Batal</a>";
                    echo "</td>";
                    echo "</tr>";
                    echo "</form>";
                } else {
                    // TAMPILAN BIASA TABEL
                    // Indikator peringatan jika stok kurang dari atau sama dengan stok minimal
                    $peringatan_stok = ($row['stok_bahan'] <= $row['stok_minimal']) 
                        ? "<span style='color: red; font-weight: bold;'>⚠️ Stok Menipis!</span>" 
                        : "<span style='color: green;'>Aman</span>";

                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . htmlspecialchars($row['nama_bahan']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['kategori_bahan']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['satuan_bahan']) . "</td>";
                    echo "<td>Rp " . number_format($row['harga_satuan_bahan'], 0, ',', '.') . "</td>";
                    echo "<td>" . $row['stok_bahan'] . "</td>";
                    echo "<td>" . $row['stok_minimal'] . "</td>";
                    echo "<td align='center'>" . $peringatan_stok . "</td>";
                    echo "<td align='center'>";
                    echo "<a href='dashboard_admin.php?page=bahan&aksi=edit&id=" . $row['id_bahan'] . "#tabel-bahan'>Edit</a> | ";
                    echo "<a href='dashboard_admin.php?page=bahan&aksi=hapus&id=" . $row['id_bahan'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus bahan ini?\")'>Hapus</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            }
        } else {
            echo "<tr><td colspan='9' align='center'>Belum ada data bahan baku.</td></tr>";
        }
        ?>
    </tbody>
</table>

<!-- SCRIPT JAVASCRIPT UNTUK FITUR PENCARIAN BAHAN -->
<script>
    function cariBahan() {
        let input = document.getElementById('inputPencarianBahan');
        let filter = input.value.toLowerCase();
        let tabel = document.getElementById('tabelBahanData');
        let baris = tabel.getElementsByTagName('tr');

        // Mulai dari i = 1 untuk melewati baris header tabel
        for (let i = 1; i < baris.length; i++) {
            let kolomNama = baris[i].getElementsByTagName('td')[1];
            let kolomKategori = baris[i].getElementsByTagName('td')[2];

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