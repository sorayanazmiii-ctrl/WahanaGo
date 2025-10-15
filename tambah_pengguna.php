<?php
include 'koneksi.php'; 

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$pesan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $no_telepon = $_POST['no_telepon'];
    $alamat = $_POST['alamat'];
    $tanggal_daftar = date('Y-m-d');

    $sql = "INSERT INTO pengguna (nama, email, password, no_telepon, alamat, tanggal_daftar)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ssssss", $nama, $email, $password, $no_telepon, $alamat, $tanggal_daftar);

    if ($stmt->execute()) {
        $pesan = "<div class='alert alert-success'>Pengguna berhasil ditambahkan.</div>";
    } else {
        $pesan = "<div class='alert alert-danger'>Gagal menambahkan pengguna: " . $stmt->error . "</div>";
    }

    $stmt->close();
}

$koneksi->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pengguna</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Form Tambah Pengguna</h4>
        </div>
        <div class="card-body">
            <?= $pesan ?>
            <form method="POST" action="">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" id="nama" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <div class="mb-3">
                    <label for="no_telepon" class="form-label">No Telepon</label>
                    <input type="text" class="form-control" name="no_telepon" id="no_telepon" required>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea class="form-control" name="alamat" id="alamat" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Pengguna</button>
                <a href="kelolauser.php" class="btn btn-light btn-sm">← Kembali</a>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS (opsional, jika butuh interaksi JS) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
