<?php
include 'koneksi.php';

$id = $_GET['id'];
$hapus = "DELETE FROM pengguna WHERE id_pengguna=$id";

if (mysqli_query($koneksi, $hapus)) {
    header("Location: kelolauser.php");
} else {
    echo "Gagal hapus: " . mysqli_error($koneksi);
}
