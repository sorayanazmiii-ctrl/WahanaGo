<?php
session_start();
include 'koneksi.php';
$query = mysqli_query($koneksi, "SELECT * FROM pengguna ORDER BY id_pengguna ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengguna - Admin</title>
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
        <a href="dashboard.php" class="nav-link"><i class="bi bi-house me-2"></i> Dashboard</a>
        <a href="kelolauser.php" class="nav-link active"><i class="bi bi-people me-2"></i> Kelola User</a>
        <a href="kelolapaket.php" class="nav-link"><i class="bi bi-ticket-perforated me-2"></i> Paket Tiket</a>
        <a href="kelolatiket.php" class="nav-link"><i class="bi bi-cart me-2"></i> Pesanan Tiket</a>
        <a href="kelolaulasan.php" class="nav-link"><i class="bi bi-chat-left-text me-2"></i> Ulasan</a>
        <a href="laporan_keuangan.php" class="nav-link"> <i class="bi bi-cash-coin me-2"></i> Laporan Keuangan</a>
        <a href="logout.php" class="nav-link text-danger mt-auto"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
    </nav>

    <!-- Konten -->
    <main class="flex-fill p-4">
        <h2 class="mb-4">Daftar Pengguna</h2>
        <a href="tambah_pengguna.php" class="btn btn-primary mb-3">+ Tambah Pengguna</a>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No Telepon</th>
                        <th>Alamat</th>
                        <th>Tanggal Daftar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($query)): ?>
                    <tr>
                        <td><?= $row['id_pengguna']; ?></td>
                        <td><?= $row['nama']; ?></td>
                        <td><?= $row['email']; ?></td>
                        <td><?= $row['no_telepon']; ?></td>
                        <td><?= $row['alamat']; ?></td>
                        <td><?= $row['tanggal_daftar']; ?></td>
                        <td>
                            <a href="edit_pengguna.php?id=<?= $row['id_pengguna']; ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="hapus_pengguna.php?id=<?= $row['id_pengguna']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
