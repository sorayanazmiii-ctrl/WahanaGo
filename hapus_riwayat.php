<?php
include 'koneksi.php';

$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
    die("ID tidak valid.");
}

$stmt = $koneksi->prepare("DELETE FROM riwayat_tiket WHERE id_tiket = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: kelolatiket.php?status=hapus_sukses");
    exit();
} else {
    echo "Gagal menghapus data: " . $stmt->error;
}
?>
