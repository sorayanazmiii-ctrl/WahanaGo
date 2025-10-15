<?php
session_start();
include 'koneksi.php';

// Cek login
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'pengguna') {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pengguna = $_SESSION['id_pengguna'];
    $id_paket = $_POST['id_paket'];
    $jumlah = $_POST['jumlah'];
    $tanggalKunjungan = $_POST['tanggal'];
    $totalHarga = $_POST['total_harga']; // Dikirim dari form JS
    $tanggalPembelian = date("Y-m-d");
    $jamKedatangan = "09:00:00"; // Default
    $status = "Belum Bayar";

    // Simulasi id_wahana jika belum dinamis
    $id_wahana = 1;

    $query = $koneksi->query("SELECT harga_paket FROM paket_tiket WHERE id_paket = '$id_paket'");
    $hargaDb = $query->fetch_assoc()['harga_paket'];
    $hargaHitung = $hargaDb * $jumlah;

    // Simpan ke riwayat_tiket
    $stmt = $koneksi->prepare("INSERT INTO riwayat_tiket 
        (id_pengguna, id_paket, tanggal_pembelian, tanggal_kunjungan, jam_kedatangan, jumlah_tiket, total_harga, status_pembayaran) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param("iisssids", $id_pengguna, $id_paket, $tanggalPembelian, $tanggalKunjungan, $jamKedatangan, $jumlah, $totalHarga, $status);
    $stmt->execute();

    echo "<script>alert('Tiket berhasil dipesan!'); window.location='tiket.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pemesanan Tiket - WahanaGo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <li class="nav-item"><a class="nav-link active" href="pemesanan.php">Pesan Tiket</a></li>
        <li class="nav-item"><a class="nav-link" href="tiket.php">Tiket Saya</a></li>
        <li class="nav-item"><a class="nav-link" href="riwayat.php">Riwayat</a></li>
        <li class="nav-item"><a class="nav-link" href="ulasan.php">Ulasan</a></li>
        <li class="nav-item"><a class="nav-link" href="profil.php">Profil</a></li>
        <li class="nav-item"><a href="logout.php" class="btn btn-outline-light ms-2">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Formulir -->
<div class="container my-5">
  <h2 class="text-center mb-4 fw-bold text-primary">📝 Formulir Pemesanan Tiket</h2>
  <form method="POST" action="pemesanan.php">
    <div class="mb-3">
      <label for="id_paket" class="form-label">Jenis Tiket</label>
      <select class="form-select" id="id_paket" name="id_paket" required>
        <option value="">-- Pilih Tiket --</option>
        <option value="1">Tiket Reguler - Rp75.000</option>
        <option value="2">Tiket Fast Track - Rp150.000</option>
        <option value="3">Paket Keluarga - Rp270.000</option>
        <option value="4">Tiket Couple - Rp110.000</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="jumlah" class="form-label">Jumlah Tiket</label>
      <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" value="1" required>
    </div>

    <div class="mb-3">
      <label for="tanggal" class="form-label">Tanggal Kunjungan</label>
      <input type="date" class="form-control" id="tanggal" name="tanggal" required>
    </div>

    <!-- Total Harga Tampil -->
    <div class="mb-3">
      <label class="form-label">Total Harga</label>
      <input type="text" class="form-control" id="totalHarga" readonly>
    </div>

    <!-- Hidden input untuk dikirim ke server -->
    <input type="hidden" name="total_harga" id="totalHargaHidden">

    <div class="text-center">
      <button type="submit" class="btn btn-primary btn-lg">🎟️ Pesan Sekarang</button>
    </div>
  </form>
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

<!-- Script Hitung Total -->
<script>
  const idPaketSelect = document.getElementById("id_paket");
  const jumlahInput = document.getElementById("jumlah");
  const totalHargaInput = document.getElementById("totalHarga");
  const totalHargaHidden = document.getElementById("totalHargaHidden");

  const hargaTiket = {
    "1": 75000,
    "2": 150000,
    "3": 270000,
    "4": 110000
  };

  function hitungTotal() {
    const id = idPaketSelect.value;
    const jumlah = parseInt(jumlahInput.value) || 0;
    const harga = hargaTiket[id] || 0;
    const total = harga * jumlah;

    totalHargaInput.value = new Intl.NumberFormat("id-ID", {
      style: "currency",
      currency: "IDR"
    }).format(total);

    totalHargaHidden.value = total;
  }

  idPaketSelect.addEventListener("change", hitungTotal);
  jumlahInput.addEventListener("input", hitungTotal);
  window.addEventListener("load", hitungTotal);
</script>


</body>
</html>
