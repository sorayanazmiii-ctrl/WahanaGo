<?php
session_start();
include 'koneksi.php';

// Ambil data paket tiket
$paket = $koneksi->query("SELECT * FROM paket_tiket");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Paket Tiket</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: #f8fafc;
    }
    .sidebar {
      width: 250px;
      height: 92vh;
      background-color: #1e293b;
    }
    .sidebar a {
      color: #cbd5e1;
      text-decoration: none;
      display: block;
      padding: 10px 20px;
    }
    .sidebar a:hover, .sidebar .nav-link.active {
      background-color: #334155;
      color: white;
    }
    header {
      background-color: #1e293b;
    }
    h4 {
      color: #f8fafc;
    }
    h2{
      color: #1e293b;
    }
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
    <a href="laporan_keuangan.php" class="nav-link"> <i class="bi bi-cash-coin me-2"></i> Laporan Keuangan</a>
    <a href="logout.php" class="nav-link text-danger mt-auto"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
  </nav>

  <!-- Konten -->
    <main class="flex-fill p-4">
        <h2 class="mb-4">Daftar paket</h2>
        <a href="tambahpaket.php" class="btn btn-primary mb-3">+ Tambah paket</a>
        <div class="table-responsive">
    <table class="table table-striped table-bordered">
      <thead class="table-dark">
        <tr>
          <th>No</th>
          <th>Nama Paket</th>
          <th>Harga Paket</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; while ($row = $paket->fetch_assoc()) : ?>
          <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['nama_paket']) ?></td>
            <td>Rp <?= number_format($row['harga_paket'], 0, ',', '.') ?></td>
            <td>
              <a href="editpaket.php?id=<?= $row['id_paket'] ?>" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
              <a href="hapuspaket.php?id=<?= $row['id_paket'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus paket ini?')"><i class="bi bi-trash"></i> Hapus</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
