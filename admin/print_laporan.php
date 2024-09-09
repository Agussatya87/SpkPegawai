<?php

require '../functions.php';

// Cek apakah ada kode laporan yang dikirim melalui URL atau POST
if (isset($_GET['kode'])) {
    $kode = $_GET['kode'];

    // Panggil fungsi untuk mencetak laporan berdasarkan kode
    print_laporan($kode);
} else {
    echo '<script>alert("Kode laporan tidak ditemukan."); window.location.href="laporan.php";</script>';
}