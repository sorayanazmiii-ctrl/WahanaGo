<?php
session_start();
include 'koneksi.php';
$id_pengguna = $_SESSION['id_pengguna'];

if (!isset($_SESSION['id_pengguna'])) {
    header("Location: login.php");
    exit;
}

$id_pengguna = $_SESSION['id_pengguna'];
$hari_ini = date("Y-m-d");

$query = "
  SELECT rt.id_tiket, p.nama AS nama_pengguna, pt.nama_paket, rt.tanggal_kunjungan, 
        rt.jumlah_tiket, rt.status_pembayaran
  FROM riwayat_tiket rt
  JOIN paket_tiket pt ON rt.id_paket = pt.id_paket
  JOIN pengguna p ON rt.id_pengguna = p.id_pengguna
     WHERE rt.id_pengguna = $id_pengguna 
      AND rt.tanggal_kunjungan < '$hari_ini'
      AND rt.status_pembayaran = 'Sudah Bayar'
  ORDER BY rt.id_tiket DESC;
";

$result = $koneksi->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Riwayat Tiket - WahanaGo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .card-riwayat {
      border-left: 6px solid #0072ff;
      background-color: #f8f9fa;
    }
    .ticket-card { position: relative; }
    .print-btn { position: absolute; top: 10px; right: 10px; }
    .qr { max-width: 120px; }
    @media print {
      body * { visibility: hidden; }
      .print-area, .print-area * { visibility: visible; }
      .print-area { position: absolute; left: 0; top: 0; }
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark shadow" style="background: linear-gradient(to right, #6a11cb, #2575fc);">
  <div class="container">
    <a class="navbar-brand" href="index.php">WahanaGo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="pemesanan.php">Pesan Tiket</a></li>
        <li class="nav-item"><a class="nav-link" href="tiket.php">Tiket Saya</a></li>
        <li class="nav-item"><a class="nav-link active" href="riwayat.php">Riwayat</a></li>
        <li class="nav-item"><a class="nav-link" href="ulasan.php">Ulasan</a></li>
        <li class="nav-item"><a class="nav-link" href="profil.php">Profil</a></li>
        <li class="nav-item"><a href="logout.php" class="btn btn-outline-light ms-2">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
>

<div class="container my-5">
  <h2 class="text-center text-success fw-bold mb-4">✔️ Riwayat Tiket - Sudah Bayar</h2>
  <div class="row g-4">
    <?php if ($result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="col-md-6">
          <div class="card shadow ticket-card" id="tiket<?= $row['id_tiket'] ?>">
            <div class="card-body print-area">
              <h5 class="card-title"><?= htmlspecialchars($row['nama_paket']) ?></h5>
              <p class="card-text">Nama: <?= htmlspecialchars($row['nama_pengguna']) ?></p>
              <p class="card-text">Tanggal Kunjungan: <?= $row['tanggal_kunjungan'] ?></p>
              <p class="card-text">Jumlah Tiket: <?= $row['jumlah_tiket'] ?></p>
              <p class="card-text">Status: <?= $row['status_pembayaran'] ?></p>
            </div>
            <button class="btn btn-outline-primary print-btn" onclick="printTicket('tiket<?= $row['id_tiket'] ?>')">🖨️ Cetak</button>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p class="text-center text-muted">Belum ada tiket yang sudah dibayar dan lewat masa kunjungannya.</p>
    <?php endif; ?>
  </div>
</div>
<!-- Footer -->
<footer class="bg-dark text-light pt-5 pb-3 mt-5">
  <div class="container">
    <div class="row text-start">
      <div class="col-md-3 mb-3">
        <h5>Tentang Kami</h5>
        <p>WahanaGo Fantasi Raya adalah destinasi hiburan keluarga di Unjani, Cimahi.</p>
      </div>
      <div class="col-md-3 mb-3">
        <h5>Layanan</h5>
        <ul class="list-unstyled">
          <li><a href="pemesanan.php" class="text-white">Pesan Tiket</a></li>
          <li><a href="tiket.php" class="text-white">Tiket Saya</a></li>
          <li><a href="riwayat.php" class="text-white">Riwayat</a></li>
          <li><a href="ulasan.php" class="text-white">Ulasan</a></li>
        </ul>
      </div>
      <div class="col-md-3 mb-3">
        <h5>Bantuan</h5>
        <ul class="list-unstyled">
          <li><a href="#" class="text-white">FAQ</a></li>
          <li><a href="#" class="text-white">Syarat & Ketentuan</a></li>
          <li><a href="#" class="text-white">Kebijakan Privasi</a></li>
        </ul>
      </div>
      <div class="col-md-3 mb-3">
        <h5>Kontak</h5>
        <p>Lokasi: Jl. Terusan Jend. Sudirman, Cimahi</p>
        <p>Email: info@wahanago.id</p>
        <p>WhatsApp: <a href="https://wa.me/6285320305737" class="text-white">+62 812-3456-7890</a></p>
      </div>
    </div>
    <hr>
    <p class="text-center mb-0">&copy; 2025 WahanaGo Fantasi Raya. Semua hak dilindungi.</p>
  </div>
</footer>

<!-- WhatsApp Floating Button -->
<a href="https://wa.me/6285320305737" target="_blank" class="position-fixed bottom-0 end-0 m-4">
  <img src="https://img.icons8.com/color/48/000000/whatsapp--v1.png" alt="WhatsApp Chat" width="48" height="48">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
