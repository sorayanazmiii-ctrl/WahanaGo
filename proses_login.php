<?php
session_start();
include 'koneksi.php';

$email = $_POST['email'];
$password = $_POST['password'];

// Cek ke tabel admin dulu
$queryAdmin = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
$resultAdmin = $koneksi->query($queryAdmin);

if ($resultAdmin->num_rows === 1) {
    $data = $resultAdmin->fetch_assoc();
    $_SESSION['email'] = $data['email'];
    $_SESSION['role'] = 'admin';
    header("Location: dashboard.php");
    exit;
}

// Kalau bukan admin, cek ke tabel pengguna
$queryPengguna = "SELECT * FROM pengguna WHERE email='$email' AND password='$password'";
$resultPengguna = $koneksi->query($queryPengguna);

if ($resultPengguna->num_rows === 1) {
    $data = $resultPengguna->fetch_assoc();
    $_SESSION['email'] = $data['email'];
    $_SESSION['role'] = 'pengguna';
    $_SESSION['id_pengguna'] = $data['id_pengguna'];
    header("Location: index.php");
    exit;
}

// Jika tidak ditemukan di keduanya
echo '<div style="margin: 50px auto; max-width: 400px;" class="alert alert-danger text-center">Login gagal! Email atau password salah. <br><a href="login.php" class="btn btn-sm btn-outline-danger mt-2">Kembali</a></div>';
?>
