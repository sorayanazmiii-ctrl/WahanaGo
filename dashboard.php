<?php
session_start();
include 'koneksi.php';

// Cek apakah sudah login dan perannya admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Ambil data dari database
$jumlah_pengguna = $koneksi->query("SELECT COUNT(*) AS total FROM pengguna")->fetch_assoc()['total'];
$jumlah_tiket = $koneksi->query("SELECT COUNT(*) AS total FROM riwayat_tiket")->fetch_assoc()['total'];
$jumlah_tiket_terbayar = $koneksi->query("SELECT COUNT(*) AS total FROM riwayat_tiket WHERE status_pembayaran = 'Sudah Bayar'")->fetch_assoc()['total'];
$total_pendapatan = $koneksi->query("SELECT SUM(total_harga) AS total FROM riwayat_tiket WHERE status_pembayaran = 'Sudah Bayar'")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard Admin - Wahanago Fantasi Raya</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
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
    header{
      background-color: #1e293b;
    }
    h4 {
      color: #f8fafc;
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
    <a href="dashboard.php" class="nav-link active"><i class="bi bi-house me-2"></i> Dashboard</a>
    <a href="kelolauser.php" class="nav-link"><i class="bi bi-people me-2"></i> Kelola User</a>
    <a href="kelolapaket.php" class="nav-link"><i class="bi bi-ticket-perforated me-2"></i> Paket Tiket</a>
    <a href="kelolatiket.php" class="nav-link"><i class="bi bi-cart me-2"></i> Pesanan Tiket</a>
    <a href="kelolaulasan.php" class="nav-link"><i class="bi bi-chat-left-text me-2"></i> Ulasan</a>
    <a href="laporan_keuangan.php" class="nav-link"> <i class="bi bi-cash-coin me-2"></i> Laporan Keuangan</a>
    <a href="logout.php" class="nav-link text-danger mt-auto"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
  </nav>

  <!-- Konten Dashboard -->
  <main class="flex-fill p-4">
    <h2 class="mb-4">Dashboard Overview</h2>
    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="card p-4 text-center shadow-sm">
          <h5>Jumlah Pengguna</h5>
          <p class="fs-3 fw-bold text-primary"><?= $jumlah_pengguna ?></p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="card p-4 text-center shadow-sm">
          <h5>Tiket Terjual</h5>
          <p class="fs-3 fw-bold text-primary"><?= $jumlah_tiket ?></p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="card p-4 text-center shadow-sm">
          <h5>Tiket Dibayar</h5>
          <p class="fs-3 fw-bold text-success"><?= $jumlah_tiket_terbayar ?></p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="card p-4 text-center shadow-sm">
          <h5>Total Pendapatan</h5>
          <p class="fs-4 fw-bold text-dark">Rp <?= number_format($total_pendapatan, 0, ',', '.') ?></p>
        </div>
      </div>
    </div>
  </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
session_start();
include 'koneksi.php';

// Cek apakah sudah login dan perannya admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Ambil data dari database
$jumlah_pengguna = $koneksi->query("SELECT COUNT(*) AS total FROM pengguna")->fetch_assoc()['total'];
$jumlah_tiket = $koneksi->query("SELECT COUNT(*) AS total FROM riwayat_tiket")->fetch_assoc()['total'];
$jumlah_tiket_terbayar = $koneksi->query("SELECT COUNT(*) AS total FROM riwayat_tiket WHERE status_pembayaran = 'Sudah Bayar'")->fetch_assoc()['total'];
$total_pendapatan = $koneksi->query("SELECT SUM(total_harga) AS total FROM riwayat_tiket WHERE status_pembayaran = 'Sudah Bayar'")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard Admin - Wahanago Fantasi Raya</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
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
    header{
      background-color: #1e293b;
    }
    h4 {
      color: #f8fafc;
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
    <a href="dashboard.php" class="nav-link active"><i class="bi bi-house me-2"></i> Dashboard</a>
    <a href="kelolauser.php" class="nav-link"><i class="bi bi-people me-2"></i> Kelola User</a>
    <a href="kelolapaket.php" class="nav-link"><i class="bi bi-ticket-perforated me-2"></i> Paket Tiket</a>
    <a href="kelolatiket.php" class="nav-link"><i class="bi bi-cart me-2"></i> Pesanan Tiket</a>
    <a href="kelolaulasan.php" class="nav-link"><i class="bi bi-chat-left-text me-2"></i> Ulasan</a>
    <a href="laporan_keuangan.php" class="nav-link"> <i class="bi bi-cash-coin me-2"></i> Laporan Keuangan</a>
    <a href="logout.php" class="nav-link text-danger mt-auto"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
  </nav>

  <!-- Konten Dashboard -->
  <main class="flex-fill p-4">
    <h2 class="mb-4">Dashboard Overview</h2>
    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="card p-4 text-center shadow-sm">
          <h5>Jumlah Pengguna</h5>
          <p class="fs-3 fw-bold text-primary"><?= $jumlah_pengguna ?></p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="card p-4 text-center shadow-sm">
          <h5>Tiket Terjual</h5>
          <p class="fs-3 fw-bold text-primary"><?= $jumlah_tiket ?></p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="card p-4 text-center shadow-sm">
          <h5>Tiket Dibayar</h5>
          <p class="fs-3 fw-bold text-success"><?= $jumlah_tiket_terbayar ?></p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="card p-4 text-center shadow-sm">
          <h5>Total Pendapatan</h5>
          <p class="fs-4 fw-bold text-dark">Rp <?= number_format($total_pendapatan, 0, ',', '.') ?></p>
        </div>
      </div>
    </div>
  </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
