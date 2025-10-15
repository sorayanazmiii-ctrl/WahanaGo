<?php
include 'koneksi.php';

// Ambil semua ulasan + relasi pengguna & paket
$query = "
  SELECT u.id_ulasan, u.rating, u.komentar, u.tanggal_ulasan, u.status,
         p.nama AS nama_pengguna, pt.nama_paket
  FROM ulasan u
  JOIN pengguna p ON u.id_pengguna = p.id_pengguna
  JOIN paket_tiket pt ON u.id_paket = pt.id_paket
  ORDER BY u.tanggal_ulasan DESC
";
$ulasan = $koneksi->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Ulasan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }
    .sidebar { width: 250px; height: 92vh; background-color: #1e293b; }
    .sidebar a { color: #cbd5e1; text-decoration: none; display: block; padding: 10px 20px; }
    .sidebar a:hover, .sidebar .nav-link.active { background-color: #334155; color: white; }
    header { background-color: #1e293b; }
    h4 { color: #f8fafc; }
    h2 { color: #1e293b;}
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
    <a href="kelolatiket.php" class="nav-link"><i class="bi bi-clock-history me-2"></i> Riwayat Tiket</a>
    <a href="kelolaulasan.php" class="nav-link active"><i class="bi bi-chat-left-text me-2"></i> Ulasan</a>
    <a href="laporan_keuangan.php" class="nav-link"> <i class="bi bi-cash-coin me-2"></i> Laporan Keuangan</a>
    <a href="logout.php" class="nav-link text-danger mt-auto"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
  </nav>

  <main class="flex-fill p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <h2>Kelola Ulasan Pengguna</h2>
    </div>

    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>No</th>
          <th>Nama Pengguna</th>
          <th>Paket</th>
          <th>Rating</th>
          <th>Komentar</th>
          <th>Tanggal</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; while ($row = $ulasan->fetch_assoc()) : ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= htmlspecialchars($row['nama_pengguna']) ?></td>
          <td><?= htmlspecialchars($row['nama_paket']) ?></td>
          <td><?= str_repeat('⭐', $row['rating']) ?></td>
          <td><?= nl2br(htmlspecialchars($row['komentar'])) ?></td>
          <td><?= $row['tanggal_ulasan'] ?></td>
          <td>
            <span class="badge <?= $row['status'] === 'Aktif' ? 'bg-success' : 'bg-secondary' ?>">
              <?= $row['status'] ?>
            </span>
          </td>
          <td>
            <?php if ($row['status'] === 'Aktif'): ?>
              <a href="aksi_ulasan.php?aksi=sembunyikan&id=<?= $row['id_ulasan'] ?>" class="btn btn-warning btn-sm">
                <i class="bi bi-eye-slash"></i> Sembunyikan
              </a>
            <?php else: ?>
              <a href="aksi_ulasan.php?aksi=tampilkan&id=<?= $row['id_ulasan'] ?>" class="btn btn-success btn-sm">
                <i class="bi bi-eye"></i> Tampilkan
              </a>
            <?php endif; ?>
            <a href="aksi_ulasan.php?aksi=hapus&id=<?= $row['id_ulasan'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus ulasan ini?')">
              <i class="bi bi-trash"></i> Hapus
            </a>
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
