<?php
include 'koneksi.php';

// Ambil data dari form
$nama = $_POST['nama'];
$email = $_POST['email'];
$password = $_POST['password']; // bisa di-hash nanti
$no_telepon = $_POST['no_telepon'];
$alamat = $_POST['alamat'];
$tanggal_daftar = date('Y-m-d');

// Cek apakah email sudah terdaftar
$cek = $koneksi->query("SELECT * FROM pengguna WHERE email='$email'");
if ($cek->num_rows > 0) {
    echo "<script>alert('Email sudah terdaftar!'); window.location='register.php';</script>";
    exit;
}

// Simpan data ke tabel pengguna
$query = "INSERT INTO pengguna (nama, email, password, no_telepon, alamat, tanggal_daftar) 
          VALUES ('$nama', '$email', '$password', '$no_telepon', '$alamat', '$tanggal_daftar')";

if ($koneksi->query($query)) {
    echo "<script>alert('Pendaftaran berhasil! Silakan login.'); window.location='login.php';</script>";
} else {
    echo "<script>alert('Pendaftaran gagal!'); window.location='register.php';</script>";
}
?>
