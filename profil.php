<?php
session_start();
include 'koneksi.php';

// Cek login
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'pengguna') {
    header("Location: login.php");
    exit;
}

$email = $_SESSION['email'];
$query = "SELECT * FROM pengguna WHERE email = '$email'";
$result = $koneksi->query($query);
$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Profil - WahanaGo Fantasi Raya</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    .text-shadow { text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3); }
    .navbar-brand { font-weight: bold; font-size: 1.5rem; }
    .card { border-radius: 15px; }
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
        <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="pemesanan.php">Pesan Tiket</a></li>
        <li class="nav-item"><a class="nav-link" href="tiket.php">Tiket Saya</a></li>
        <li class="nav-item"><a class="nav-link" href="riwayat.php">Riwayat</a></li>
        <li class="nav-item"><a class="nav-link" href="ulasan.php">Ulasan</a></li>
        <li class="nav-item"><a class="nav-link active" href="profil.php">Profil</a></li>
        <li class="nav-item"><a href="logout.php" class="btn btn-outline-light ms-2">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Profil -->
<div class="container py-5">
  <h2 class="text-center fw-bold text-primary mb-4">👤 Profil Saya</h2>
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card shadow p-4">
        <form action="update_profil.php" method="post">
          <div class="mb-3">
            <label class="form-label fw-bold">Nama Lengkap:</label>
            <input type="text" name="nama" class="form-control" value="<?php echo htmlspecialchars($data['nama']); ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold">Email:</label>
            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($data['email']); ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold">Nomor Telepon:</label>
            <input type="text" name="no_telepon" class="form-control" value="<?php echo htmlspecialchars($data['no_telepon']); ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label fw-bold">Alamat:</label>
            <textarea name="alamat" class="form-control" required><?php echo htmlspecialchars($data['alamat']); ?></textarea>
          </div>
          <a href="ganti_password.php" class="btn btn-outline-secondary mt-3">Ganti Password</a>
          <div class="text-end">
            <button type="submit" class="btn btn-primary">💾 Simpan Perubahan</button>
          </div>
        </form>
      </div>
    </div>
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
</a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
