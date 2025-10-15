<?php
include 'koneksi.php';

$id = $_GET['id'] ?? null;
$pesan = "";

if (!$id || !is_numeric($id)) {
    die("ID tidak valid.");
}

// Ambil data yang akan diedit
$stmt = $koneksi->prepare("
  SELECT * FROM riwayat_tiket WHERE id_tiket = ?
");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    die("Data tidak ditemukan.");
}

// Ambil data pengguna dan paket
$pengguna = $koneksi->query("SELECT * FROM pengguna");
$paket = $koneksi->query("SELECT * FROM paket_tiket");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_pengguna = $_POST['id_pengguna'];
    $id_paket = $_POST['id_paket'];
    $tanggal_kunjungan = $_POST['tanggal_kunjungan'];
    $jam_kedatangan = $_POST['jam_kedatangan'];
    $jumlah_tiket = $_POST['jumlah_tiket'];
    $status = $_POST['status_pembayaran'];

    $harga = $koneksi->query("SELECT harga_paket FROM paket_tiket WHERE id_paket = $id_paket")->fetch_assoc()['harga_paket'];
    $total_harga = $harga * $jumlah_tiket;

    $update = $koneksi->prepare("
        UPDATE riwayat_tiket 
        SET id_pengguna=?, id_paket=?, tanggal_kunjungan=?, jam_kedatangan=?, jumlah_tiket=?, total_harga=?, status_pembayaran=?
        WHERE id_tiket=?
    ");
    $update->bind_param("iissidsi", $id_pengguna, $id_paket, $tanggal_kunjungan, $jam_kedatangan, $jumlah_tiket, $total_harga, $status, $id);

    if ($update->execute()) {
        $pesan = "<div class='alert alert-success'>Riwayat tiket berhasil diperbarui.</div>";
        $data = array_merge($data, $_POST); // Perbarui data di form
        $data['total_harga'] = $total_harga;
    } else {
        $pesan = "<div class='alert alert-danger'>Gagal mengedit: " . $update->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Riwayat Tiket</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
    .sidebar { width: 250px; height: 100vh; background-color: #1e293b; }
    .sidebar a { color: #cbd5e1; text-decoration: none; display: block; padding: 10px 20px; }
    .sidebar a:hover, .sidebar .nav-link.active { background-color: #334155; color: white; }
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
  <nav class="sidebar d-flex flex-column p-3">
    <h4 class="text-white mb-4">Admin Panel</h4>
    <a href="dashboard.php" class="nav-link"><i class="bi bi-house me-2"></i> Dashboard</a>
    <a href="kelolauser.php" class="nav-link"><i class="bi bi-people me-2"></i> Kelola User</a>
    <a href="paket_tiket.php" class="nav-link"><i class="bi bi-ticket me-2"></i> Paket Tiket</a>
    <a href="kelolatiket.php" class="nav-link active"><i class="bi bi-clock-history me-2"></i> Riwayat Tiket</a>
    <a href="kelolaulasan.php" class="nav-link"><i class="bi bi-chat-left-text me-2"></i> Ulasan</a>
    <a href="logout.php" class="nav-link text-danger mt-auto"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
  </nav>

  <main class="flex-fill p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>Edit Riwayat Tiket</h2>
      <a href="kelolatiket.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
    </div>

    <?= $pesan ?>

    <form method="POST" action="">
      <div class="mb-3">
        <label class="form-label">Nama Pengguna</label>
        <select name="id_pengguna" class="form-select" required>
          <?php while($p = $pengguna->fetch_assoc()): ?>
            <option value="<?= $p['id_pengguna'] ?>" <?= $p['id_pengguna'] == $data['id_pengguna'] ? 'selected' : '' ?>>
              <?= $p['nama'] ?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Paket Tiket</label>
        <select name="id_paket" class="form-select" required>
          <?php $paket->data_seek(0); while($pt = $paket->fetch_assoc()): ?>
            <option value="<?= $pt['id_paket'] ?>" <?= $pt['id_paket'] == $data['id_paket'] ? 'selected' : '' ?>>
              <?= $pt['nama_paket'] ?> - Rp <?= number_format($pt['harga_paket'], 0, ',', '.') ?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Tanggal Kunjungan</label>
        <input type="date" name="tanggal_kunjungan" class="form-control" value="<?= $data['tanggal_kunjungan'] ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Jam Kedatangan</label>
        <input type="time" name="jam_kedatangan" class="form-control" value="<?= $data['jam_kedatangan'] ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Jumlah Tiket</label>
        <input type="number" name="jumlah_tiket" class="form-control" min="1" value="<?= $data['jumlah_tiket'] ?>" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Status Pembayaran</label>
        <select name="status_pembayaran" class="form-select" required>
          <option value="Sudah Bayar" <?= $data['status_pembayaran'] == 'Sudah Bayar' ? 'selected' : '' ?>>Sudah Bayar</option>
          <option value="Belum Bayar" <?= $data['status_pembayaran'] == 'Belum Bayar' ? 'selected' : '' ?>>Belum Bayar</option>
        </select>
      </div>

      <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan Perubahan</button>
    </form>
  </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
