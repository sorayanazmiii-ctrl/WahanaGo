<?php
include 'koneksi.php';

// Ambil filter tanggal dari form
$start = $_GET['start'] ?? '';
$end = $_GET['end'] ?? '';

// Query transaksi berdasarkan tanggal jika disaring
$filter = "";
if ($start && $end) {
    $filter = "WHERE tanggal_pembelian BETWEEN '$start' AND '$end'";
}

// Ambil data
$sql = "
    SELECT rt.*, p.nama AS nama_pengguna, pt.nama_paket
    FROM riwayat_tiket rt
    JOIN pengguna p ON rt.id_pengguna = p.id_pengguna
    JOIN paket_tiket pt ON rt.id_paket = pt.id_paket
    $filter
    ORDER BY tanggal_pembelian DESC
";
$data = $koneksi->query($sql);

// Hitung total pendapatan
$totalQuery = "
    SELECT SUM(total_harga) AS total 
    FROM riwayat_tiket
    WHERE status_pembayaran = 'Sudah Bayar' " . ($filter ? "AND tanggal_pembelian BETWEEN '$start' AND '$end'" : "");
$totalPendapatan = $koneksi->query($totalQuery)->fetch_assoc()['total'] ?? 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Keuangan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    @media print {
    .no-print, nav, footer, header {
        display: none !important;
    }
    body {
        font-size: 12pt;
        background: white;
    }
    .table td, .table th {
        padding: 6px;
    }
    }
    </style>
</head>
<body class="bg-light">
<div class="container mt-5">
<div class="d-flex justify-content-between mb-4 no-print">
  <h2>Laporan Keuangan</h2>
    <button onclick="window.print()" class="btn btn-danger no-print">🖨 Cetak</button>
</div>

  <form class="row g-3 mb-4" method="get">
    <div class="col-md-4">
      <label>Tanggal Mulai</label>
      <input type="date" name="start" class="form-control" value="<?= $start ?>">
    </div>
    <div class="col-md-4">
      <label>Tanggal Akhir</label>
      <input type="date" name="end" class="form-control" value="<?= $end ?>">
    </div>
    <div class="col-md-4 align-self-end">
      <button class="btn btn-primary no-print" type="submit">Tampilkan</button>
    </div>
  </form>

  <div class="mb-3">
    <h5>Total Pendapatan: <span class="text-success">Rp <?= number_format($totalPendapatan, 0, ',', '.') ?></span></h5>
  </div>

  <table class="table table-bordered">
    <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Nama Pengguna</th>
        <th>Paket</th>
        <th>Tanggal</th>
        <th>Jumlah Tiket</th>
        <th>Total Harga</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; while($row = $data->fetch_assoc()): ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= htmlspecialchars($row['nama_pengguna']) ?></td>
        <td><?= htmlspecialchars($row['nama_paket']) ?></td>
        <td><?= $row['tanggal_pembelian'] ?></td>
        <td><?= $row['jumlah_tiket'] ?></td>
        <td>Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
        <td>
          <span class="badge <?= $row['status_pembayaran'] == 'Sudah Bayar' ? 'bg-success' : 'bg-warning text-dark' ?>">
            <?= $row['status_pembayaran'] ?>
          </span>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
  <a href="dashboard.php" class="btn btn-secondary no-print"><i class="bi bi-arrow-left"></i> Kembali</a>
</div>
</body>
</html>
