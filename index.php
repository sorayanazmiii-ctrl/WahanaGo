<?php
session_start();

// Cek apakah sudah login dan role-nya adalah pengguna
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'pengguna') {
    header("Location: login.php");
    exit;
}

$email = $_SESSION['email']; // bisa digunakan di navbar atau profil
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Beranda - WahanaGo Fantasi Raya</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
  .text-shadow {
    text-shadow: 1px 1px 3px rgba(224, 48, 218, 0.3);
  }
  .carousel-inner img {
    max-height: 400px;
    object-fit: cover;
    border-radius: 15px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
  }
  .text-shadow {
    text-shadow: 1px 1px 3px rgb(234, 255, 2);
  }
  .navbar-brand {
    font-weight: bold;
    font-size: 1.5rem;
  }
</style>
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark shadow" style="background: linear-gradient(to right, #6a11cb, #2575fc);">
  <div class="container">
    <a class="navbar-brand" href="index.php">WahanaGo</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link active" href="index.php">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="pemesanan.php">Pesan Tiket</a></li>
        <li class="nav-item"><a class="nav-link" href="tiket.php">Tiket Saya</a></li>
        <li class="nav-item"><a class="nav-link" href="riwayat.php">Riwayat</a></li>
        <li class="nav-item"><a class="nav-link" href="ulasan.php">Ulasan</a></li>
        <li class="nav-item"><a class="nav-link" href="profil.php">Profil</a></li>
        <li class="nav-item"><a href="logout.php" class="btn btn-outline-light ms-2">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<div class="container-fluid py-5" style="background: linear-gradient(to right, #00fff2, #006aff); color: white;">
  <div class="container text-center">
    <h2 class="fw-bold mb-4">Selamat Datang di <strong>WahanaGo Fantasi Raya!</strong></h2>
    <img src="logo.png" class="img-fluid my-4 shadow-lg rounded" alt="logo" style="max-height: 400px;">
    <p class="lead">Temukan berbagai wahana menarik dan nikmati pengalaman tak terlupakan bersama keluarga dan teman-teman.</p>
    <p><strong>📍 Lokasi:</strong> Cimahi</p>
    <a href="pemesanan.html" class="btn btn-light btn-lg shadow mt-3 px-4 py-2 fw-semibold">
      🎟️ Pesan Tiket Sekarang
    </a>
  </div>
</div>

<!-- Wahana Populer Carousel -->
<div class="container my-5">
  <h2 class="text-center mb-4 text-primary fw-bold text-shadow">🎠 Wahana Populer</h2>
  <div id="wahanaCarousel" class="carousel slide mx-auto text-center" style="max-width: 600px;" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active text-center">
        <img src="wahana (1).jpg" class="d-block mx-auto w-75 rounded shadow" alt="Wahana 1">
      </div>
      <div class="carousel-item text-center">
        <img src="wahana (2).jpg" class="d-block mx-auto w-75 rounded shadow" alt="Wahana 2">
      </div>
      <div class="carousel-item text-center">
        <img src="wahana (3).jpg" class="d-block mx-auto w-75 rounded shadow" alt="Wahana 3">
      </div>
      <div class="carousel-item text-center">
        <img src="wahana (4).jpg" class="d-block mx-auto w-75 rounded shadow" alt="Wahana 4">
      </div>
      <div class="carousel-item text-center">
        <img src="wahana (5).jpg" class="d-block mx-auto w-75 rounded shadow" alt="Wahana 5">
      </div>
      <div class="carousel-item text-center">
        <img src="wahana (6).jpg" class="d-block mx-auto w-75 rounded shadow" alt="Wahana 6">
      </div>
      <div class="carousel-item  text-center">
        <img src="wahana (7).jpg" class="d-block mx-auto w-75 rounded shadow" alt="Wahana 7">
      </div>
      <div class="carousel-item text-center">
        <img src="wahana (8).jpg" class="d-block mx-auto w-75 rounded shadow" alt="Wahana 8">
      </div>
      <div class="carousel-item text-center">
        <img src="wahana (9).jpg" class="d-block mx-auto w-75 rounded shadow" alt="Wahana 9">
      </div>
      <div class="carousel-item text-center">
        <img src="wahana (10).jpg" class="d-block mx-auto w-75 rounded shadow" alt="Wahana 10">
      </div>  
      <div class="carousel-item text-center">
        <img src="wahana (11).jpg" class="d-block mx-auto w-75 rounded shadow" alt="Wahana 11">
      </div>      
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#wahanaCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#wahanaCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>
  <ul class="list-group list-group-flush mt-4">
    <li class="list-group-item">🎢 Roller Coaster - Nikmati sensasi berputar dan meluncur!</li>
    <li class="list-group-item">🚂 Kereta Mini - Seru untuk anak-anak berkeliling taman!</li>
    <li class="list-group-item">🌊 Ombak Banyu - Rasakan ombak buatan yang mengguncang!</li>
    <li class="list-group-item">🎠 Komidi Putar - Wahana klasik penuh nostalgia!</li>
    <li class="list-group-item">🚴 Sepeda Gantung - Gowes di atas rel dengan pemandangan!</li>
    <li class="list-group-item">🦕 Dunia Dino - Petualangan seru di dunia dinosaurus!</li>
    <li class="list-group-item">💦 Seluncur Air - Luncur cepat dan segar di wahana air!</li>
    <li class="list-group-item">🎡 Kincir Raksasa - Putaran lambat dengan panorama indah!</li>
    <li class="list-group-item">👻 Rumah Hantu - Tantang nyali Anda di rumah hantu kami!</li>
    <li class="list-group-item">🎡 Bianglala - Nikmati pemandangan indah dari ketinggian!</li>
  </ul>
<br>
<p><strong>⚠️ Perhatian:</strong> Beberapa wahana memiliki batasan usia minimum 10 tahun. Tidak disarankan untuk pengunjung dengan riwayat penyakit jantung, tekanan darah tinggi, atau kondisi medis serius lainnya.</p>

<!-- Daftar Paket Tiket -->
<div class="container my-5">
  <h2 class="text-center mb-4 fw-bold text-primary">🎫 Daftar Paket Tiket</h2>
  <div class="row g-4">
    
    <!-- Tiket Reguler -->
    <div class="col-md-6">
      <div class="card shadow h-100">
        <div class="card-body">
          <h5 class="card-title fw-bold">Tiket Reguler</h5>
          <p class="card-text">Akses masuk ke seluruh wahana standar. Tidak termasuk wahana premium atau antrean cepat.</p>
          <p class="mb-1"><strong>Harga:</strong> Rp75.000</p>
          <p><strong>Masa Berlaku:</strong> 1 Hari</p>
        </div>
      </div>
    </div>

    <!-- Tiket Fast Track -->
    <div class="col-md-6">
      <div class="card shadow h-100">
        <div class="card-body">
          <h5 class="card-title fw-bold">Tiket Fast Track</h5>
          <p class="card-text">Akses semua wahana termasuk antrean cepat (fast lane) untuk wahana populer.</p>
          <p class="mb-1"><strong>Harga:</strong> Rp150.000</p>
          <p><strong>Masa Berlaku:</strong> 1 Hari</p>
        </div>
      </div>
    </div>

    <!-- Paket Keluarga -->
    <div class="col-md-6">
      <div class="card shadow h-100">
        <div class="card-body">
          <h5 class="card-title fw-bold">Paket Keluarga</h5>
          <p class="card-text">Tiket untuk 4 orang (2 dewasa + 2 anak) dengan harga lebih hemat.</p>
          <p class="mb-1"><strong>Harga:</strong> Rp270.000</p>
          <p><strong>Masa Berlaku:</strong> 1 Hari</p>
        </div>
      </div>
    </div>
    
    <!-- Tiket Couple -->
    <div class="col-md-6">
      <div class="card shadow h-100">
        <div class="card-body">
          <h5 class="card-title fw-bold">Tiket Couple Ceria</h5>
          <p class="card-text">Paket khusus untuk 2 orang dengan harga lebih hemat dibanding beli satuan. Cocok untuk pasangan atau sahabat.</p>
          <p class="mb-1"><strong>Harga:</strong> Rp110.000 <span class="text-success">(hemat Rp20.000)</span></p>
          <p><strong>Ketentuan:</strong> Berlaku untuk 2 orang yang datang bersama</p>
        </div>
      </div>
    </div>

  </div>
</div>

  <div class="text-center mt-4">
  <a href="pemesanan.php" class="btn btn-primary btn-lg">🎟️ Pesan Tiket Sekarang</a>
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
