<?php
include 'koneksi.php'; 

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

$pesan = "";
$id_pengguna = $_GET['id'] ?? null;

if (!$id_pengguna) {
    die("ID pengguna tidak valid.");
}

// Ambil data pengguna lama
$sql = "SELECT * FROM pengguna WHERE id_pengguna = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("i", $id_pengguna);
$stmt->execute();
$result = $stmt->get_result();
$pengguna = $result->fetch_assoc();

if (!$pengguna) {
    die("Pengguna tidak ditemukan.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $no_telepon = $_POST['no_telepon'];
    $alamat = $_POST['alamat'];

    $sql_update = "UPDATE pengguna SET nama=?, email=?, password=?, no_telepon=?, alamat=? WHERE id_pengguna=?";
    $stmt_update = $koneksi->prepare($sql_update);
    $stmt_update->bind_param("sssssi", $nama, $email, $password, $no_telepon, $alamat, $id_pengguna);

    if ($stmt_update->execute()) {
        $pesan = "<div class='alert alert-success'>Data pengguna berhasil diperbarui.</div>";
    } else {
        $pesan = "<div class='alert alert-danger'>Gagal memperbarui: " . $stmt_update->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-warning text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Edit Data Pengguna</h4>
        </div>
        <div class="card-body">
            <?= $pesan ?>
            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($pengguna['nama']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($pengguna['email']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="text" name="password" class="form-control" value="<?= htmlspecialchars($pengguna['password']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">No Telepon</label>
                    <input type="text" name="no_telepon" class="form-control" value="<?= htmlspecialchars($pengguna['no_telepon']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3" required><?= htmlspecialchars($pengguna['alamat']) ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="kelolauser.php" class="btn btn-light btn-sm">← Kembali</a>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
