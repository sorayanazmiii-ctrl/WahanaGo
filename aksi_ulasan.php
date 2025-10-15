<?php
include 'koneksi.php';

$aksi = $_GET['aksi'] ?? '';
$id = $_GET['id'] ?? '';

if (!$id || !is_numeric($id)) {
    die("ID tidak valid.");
}

switch ($aksi) {
    case 'sembunyikan':
        $stmt = $koneksi->prepare("UPDATE ulasan SET status = 'Disembunyikan' WHERE id_ulasan = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        break;

    case 'tampilkan':
        $stmt = $koneksi->prepare("UPDATE ulasan SET status = 'Aktif' WHERE id_ulasan = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        break;

    case 'hapus':
        $stmt = $koneksi->prepare("DELETE FROM ulasan WHERE id_ulasan = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        break;

    default:
        die("Aksi tidak dikenal.");
}

header("Location: kelolaulasan.php");
exit();
