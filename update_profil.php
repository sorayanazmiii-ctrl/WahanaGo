<?php
session_start();
include 'koneksi.php';

// Pastikan user login
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'pengguna') {
    header("Location: login.php");
    exit;
}

// Ambil data dari form
$nama       = $_POST['nama'];
$email_baru = $_POST['email'];
$no_telp    = $_POST['no_telepon'];
$alamat     = $_POST['alamat'];

$email_lama = $_SESSION['email'];

// Update data
$query = "UPDATE pengguna SET 
            nama = '$nama',
            email = '$email_baru',
            no_telepon = '$no_telp',
            alamat = '$alamat'
          WHERE email = '$email_lama'";

if ($koneksi->query($query)) {
    $_SESSION['email'] = $email_baru; // update session
    echo "<script>alert('Profil berhasil diperbarui.'); window.location='profil.php';</script>";
} else {
    echo "<script>alert('Gagal memperbarui profil.'); window.location='profil.php';</script>";
}
?>
