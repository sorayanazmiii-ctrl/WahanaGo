<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'pengguna') {
    header("Location: login.php");
    exit;
}

$email = $_SESSION['email'];

$old_password = $_POST['old_password'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];

// Ambil password saat ini dari DB
$query = "SELECT password FROM pengguna WHERE email = '$email'";
$result = $koneksi->query($query);
$data = $result->fetch_assoc();

if ($data['password'] !== $old_password) {
    echo "<script>alert('Password lama salah!'); window.location='ganti_password.php';</script>";
    exit;
}

if ($new_password !== $confirm_password) {
    echo "<script>alert('Konfirmasi password tidak cocok!'); window.location='ganti_password.php';</script>";
    exit;
}

// Simpan password baru
$update = "UPDATE pengguna SET password = '$new_password' WHERE email = '$email'";
if ($koneksi->query($update)) {
    echo "<script>alert('Password berhasil diubah.'); window.location='profil.php';</script>";
} else {
    echo "<script>alert('Gagal mengubah password.'); window.location='ganti_password.php';</script>";
}
?>
