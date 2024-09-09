<?php

require '../functions.php';

//AMBIL DATA YG DIKLIK HAPUS DI HALAMAN data_calon_staff.php TADI 
$id_calon = $_GET['id_calon'];

//JALANKAN FUNGSI HAPUS
if (hapus_sepatu($id_calon)) {
    echo "<script>
          alert ('Data Berhasil Di Hapus')
          document.location.href='data_calon_staff.php'
          </script>";
}
