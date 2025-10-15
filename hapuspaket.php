<?php
include 'koneksi.php';

$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
    die("ID tidak valid.");
}

// Hapus data
$stmt = $koneksi->prepare("DELETE FROM paket_tiket WHERE id_paket = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: kelolapaket.php?status=hapus_sukses");
    exit();
} else {
    echo "Gagal menghapus paket: " . $stmt->error;
}
?>
