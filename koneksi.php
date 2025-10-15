<?php
$koneksi = new mysqli("sql204.infinityfree.com", "if0_39188833", "FIyY02iUWZT9skF", "if0_39188833_tiket_wahana_online");
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
?>
