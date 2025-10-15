<?php
include 'koneksi.php';

$pesan = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_paket'];
    $harga = $_POST['harga_paket'];

    $stmt = $koneksi->prepare("INSERT INTO paket_tiket (nama_paket, harga_paket) VALUES (?, ?)");
    $stmt->bind_param("sd", $nama, $harga);

    if ($stmt->execute()) {
        $pesan = "<div class='alert alert-success'>Paket tiket berhasil ditambahkan.</div>";
    } else {
        $pesan = "<div class='alert alert-danger'>Gagal menambahkan paket: " . $stmt->error . "</div>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Paket Tiket</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
    .sidebar {
      width: 250px; height: 100vh; background-color: #1e293b;
    }
    .sidebar a {
      color: #cbd5e1; text-decoration: none; display: block; padding: 10px 20px;
    }
    .sidebar a:hover, .sidebar .nav-link.active {
      background-color: #334155; color: white;
    }
    header { background-color: #1e293b; }
    h4, h2 { color: #f8fafc; }
  </style>
</head>
<body>
<header class="header d-flex justify-content-between align-items-center p-3">
  <h4 class="m-0">🎡 Wahanago Fantasi Raya</h4>
  <div class="d-flex align-items-center">
    <span class="me-2 text-white">Admin</span>
    <img src="https://i.pravatar.cc/40?img=12" alt="Admin" width="40" height="40" class="rounded-circle">
  </div>
</header>
<div class="d-flex">
  <!-- Sidebar -->
  <nav class="sidebar d-flex flex-column p-3">
    <h4 class="text-white mb-4">Admin Panel</h4>
    <a href="dashboard.php" class="nav-link"><i class="bi bi-house me-2"></i> Dashboard</a>
    <a href="kelolauser.php" class="nav-link"><i class="bi bi-people me-2"></i> Kelola User</a>
    <a href="kelolapaket.php" class="nav-link active"><i class="bi bi-ticket-perforated me-2"></i> Paket Tiket</a>
    <a href="kelolatiket.php" class="nav-link"><i class="bi bi-cart me-2"></i> Pesanan Tiket</a>
    <a href="kelolaulasan.php" class="nav-link"><i class="bi bi-chat-left-text me-2"></i> Ulasan</a>
    <a href="logout.php" class="nav-link text-danger mt-auto"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
  </nav>

  <!-- Konten -->
  <main class="flex-fill p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>Tambah Paket Tiket</h2>
      <a href="kelolapaket.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>

    <?= $pesan ?>

    <form method="POST" action="">
      <div class="mb-3">
        <label for="nama_paket" class="form-label">Nama Paket</label>
        <input type="text" class="form-control" name="nama_paket" id="nama_paket" required>
      </div>
      <div class="mb-3">
        <label for="harga_paket" class="form-label">Harga Paket (Rp)</label>
        <input type="number" class="form-control" name="harga_paket" id="harga_paket" required min="0">
      </div>
      <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
    </form>
  </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
