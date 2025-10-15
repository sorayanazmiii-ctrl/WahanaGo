<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id_pengguna'])) {
  echo "<script>alert('Anda harus login terlebih dahulu untuk mengirim ulasan!'); window.location='login.php';</script>";
  exit;
}

// Simpan jika form dikirim
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $id_pengguna = $_SESSION['id_pengguna'];
  $nama = trim($_POST['nama']);
  $id_paket = $_POST['id_paket'];
  $rating = $_POST['rating'];
  $komentar = trim($_POST['komentar']);
  $tanggal_ulasan = date("Y-m-d");

  // Simpan ke database sebagai tamu (id_pengguna = NULL)
  $stmt = $koneksi->prepare("
    INSERT INTO ulasan (id_pengguna, id_paket, rating, komentar, tanggal_ulasan)
    VALUES (?, ?, ?, ?, ?)
  ");
  $stmt->bind_param("iiiss", $id_pengguna, $id_paket, $rating, $komentar, $tanggal_ulasan);
  $stmt->execute();

  echo "<script>alert('Ulasan Anda berhasil dikirim!'); window.location='ulasan.php';</script>";
  exit;
}

// Ambil data paket tiket untuk pilihan dropdown
$paket = $koneksi->query("SELECT id_paket, nama_paket FROM paket_tiket");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Ulasan - WahanaGo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark shadow" style="background: linear-gradient(to right, #6a11cb, #2575fc);">
  <div class="container">
    <a class="navbar-brand" href="index.php">WahanaGo</a>
    <ul class="navbar-nav ms-auto">
      <li class="nav-item"><a class="nav-link" href="ulasan.php">Kembali ke Ulasan</a></li>
    </ul>
  </div>
</nav>

<div class="container my-5">
  <h2 class="text-center text-primary fw-bold mb-4">📝 Berikan Ulasan Anda</h2>

  <form method="POST" class="mx-auto" style="max-width: 500px;">
    <div class="mb-3">
      <label for="nama" class="form-label">Nama Anda</label>
      <input type="text" name="nama" class="form-control" required>
    </div>
    <div class="mb-3">
      <label for="id_paket" class="form-label">Paket Tiket</label>
      <select name="id_paket" class="form-select" required>
        <option value="">-- Pilih Paket --</option>
        <?php while ($p = $paket->fetch_assoc()): ?>
          <option value="<?= $p['id_paket'] ?>"><?= htmlspecialchars($p['nama_paket']) ?></option>
        <?php endwhile; ?>
      </select>
    </div>
    <div class="mb-3">
      <label for="rating" class="form-label">Rating</label>
      <select name="rating" class="form-select" required>
        <option value="">-- Pilih Rating --</option>
        <?php for ($i = 5; $i >= 1; $i--): ?>
          <option value="<?= $i ?>"><?= str_repeat("⭐", $i) ?></option>
        <?php endfor; ?>
      </select>
    </div>
    <div class="mb-3">
      <label for="komentar" class="form-label">Komentar</label>
      <textarea name="komentar" class="form-control" rows="4" required></textarea>
    </div>
    <button type="submit" class="btn btn-success w-100">Kirim Ulasan</button>
  </form>

</div>
</body>
</html>
