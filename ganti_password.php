<?php
session_start();
include 'koneksi.php';

// Cek login
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'pengguna') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Ganti Password | WahanaGo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #00c6ff, #0072ff);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .card {
      border-radius: 15px;
      padding: 30px;
      max-width: 450px;
      width: 100%;
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
  </style>
</head>
<body>

<div class="card">
  <h4 class="text-center text-primary mb-4">🔒 Ganti Password</h4>
  <form action="proses_ganti_password.php" method="post">
    <div class="mb-3">
      <label for="old_password" class="form-label">Password Lama</label>
      <input type="password" name="old_password" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="new_password" class="form-label">Password Baru</label>
      <input type="password" name="new_password" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="confirm_password" class="form-label">Konfirmasi Password Baru</label>
      <input type="password" name="confirm_password" class="form-control" required>
    </div>
    <div class="d-grid">
      <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
  </form>
  <div class="text-center mt-3">
    <a href="profil.php" class="text-decoration-none">← Kembali ke Profil</a>
  </div>
</div>

</body>
</html>
