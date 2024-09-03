<?php
session_start();
//JIKA TIDAK DITEMUKAN $_SESSION['status'] (USER/ADMIN TIDAK MELIWATI TAHAP LOGIN) MAKA LEMBAR ADMIN/USER KEHALAMAN LOGIN 
if (!isset($_SESSION['status'])) {
  header("Location: ../xml_get_current_byte_index(parser).php?pesan=logindahulu");
  exit;
}
require '../functions.php';




// JIKA TIDAK MENERIMA DATA ID ALTERNATIF MAKA LEMPAR KEMBALI KE data_sepatu_sport.php
if (!isset($_POST['id_alternatif'])) {
  echo "<script>
  alert('Pilih Data Sepatu Dahulu ! ')
  document.location.href='data_sepatu_sport.php'
  </script>";
} else {

  //JIKA MENERIMA DATA ID ALTERNATIF MAKA JALANKAN HALAMAN Penilaian.php

  //BUKA TABLE KRITERIA DAN TAMPILKAN FIELD MEREK
  $datakriteriamerek = mysqli_query($con, "SELECT * FROM kriteria WHERE kriteria = 'merek'");
  $merek = mysqli_fetch_assoc($datakriteriamerek);

  //BUKA TABLE KRITERIA DAN TAMPILKAN FIELD BAHAN
  $datakriteriabahan = mysqli_query($con, "SELECT * FROM kriteria WHERE kriteria = 'bahan'");
  $bahan = mysqli_fetch_assoc($datakriteriabahan);

  //BUKA TABLE KRITERIA DAN TAMPILKAN FIELD BERAT
  $datakriteriaberat = mysqli_query($con, "SELECT * FROM kriteria WHERE kriteria = 'berat'");
  $berat = mysqli_fetch_assoc($datakriteriaberat);

  //BUKA TABLE KRITERIA DAN TAMPILKAN FIELD HARGA
  $datakriteriaharga = mysqli_query($con, "SELECT * FROM kriteria WHERE kriteria = 'harga'");
  $harga = mysqli_fetch_assoc($datakriteriaharga);

  //MEMBUAT KODE OTOMATIS

  //MENGAMBIL DATA BARANG DENGAN KODE PALING BESAR
  $a = mysqli_query($con, "SELECT max(kode) AS kodeterbesar from hasil_akhir");
  $b = mysqli_fetch_array($a);
  $kodebarang = $b['kodeterbesar'];

  //MENGAMBIL ANGKA DARI KODE BARANG TERBESAR MENGGUNAKAN FUNSI substr
  //DAN DIUBAH KE INTEGER (int)

  $urutan = (int) substr($kodebarang, 3, 3);

  //BILANGAN YANG DIAMBIL INI DI TAMBAH 1 UNTUK MENENTUKAN NOMOR URUT BERIKUTNYA
  $urutan++;

  //MEMBENTUK KODE BARU
  //PERINTAH printf("%03s",$urutan); BERGUNA UNTUK MEMBUAT STRING MENJADI 3 KARAKTER
  //MISAL printf("%03s",15); MAKAMENGHASILKAN '015'
  $kodebarang = "k" . sprintf("%03s", $urutan);

  //JIKA TOMBOL SIMPAN DITEKAN MAKA
  if (isset($_POST['simpan'])) {
    if (insert_hasil_perankingan($_POST) > 0) {
      echo "<script>
          alert('data tersimpan')
          document.location.href='laporan.php'
          </script>";
    }
  }







?>
  <!doctype html>
  <html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <style>
      body {
        background-color: #f0f0f0;
      }


      .container {
        min-height: calc(100vh - 211px - -60px);
      }

      .col-md-12 {
        padding: 8px;
      }

      .copyright {
        text-align: center;
      }

      .navbar-nav a {
        margin-right: 20px;
      }

      .navbar-nav a:hover {
        color: darkblue;
        background-color: lightblue; 
        border-radius: 5px; 
      }

      tr:hover {
        -webkit-transform: scale(1.03);
        transform: scale(1.03);
        font-weight: bold;
      }
    </style>

    <title>Penilaian</title>
  </head>

  <body bgcolor="f0f0f0">
    <form method="post" action="Penilaian.php">
      <nav class="navbar navbar-expand-lg navbar-dark bg-light">
        <a class="navbar-brand" href="#"><img src="../img/logo.png" width="50"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav" style="margin: 10px;">
            <a class="nav-link active" href="index.php">
              <font size="4"><b style = "color:#000;">Home</b> </font><span class="sr-only">(current)</span>
            </a>
            <a class="nav-link" href="data_kriteria.php">
              <font size="4"><b style = "color:#000;">Kriteria</b></font>
            </a>
            <a class="nav-link" href="data_sepatu_sport.php">
              <font size="4"><b style = "color:#000;">Data Calon</b></font>
            </a>
            <a class="nav-link" href="#">
            <font size="4"><b style = "color:#000;"><button type="submit" name="Penilaian" class="btn" style="font-size: 18px; margin-top: -6px; padding: 0px 3px 0px 3px;"><b>Penilaian</b></button></b></font>
          </a>
            <a class="nav-link" href="laporan.php">
              <font size="4"><b style = "color:#000;">laporan</b></font>
            </a>
          </div>

          <div class="navbar-nav ms-auto" style="margin: 10px;">
          <a class="log nav-link m-auto" href="../logout.php">
            <font size="4"><b style = "color:#000;">Logout</b></font>
            <img src="../img/logout_new.png" width="20">
          </a>
        </div>
        </div>
      </nav>
    </form>

    <br>
    <div class="container bg-light shadow p-3 mb-5">

      <div class="alert alert-info">
        <center><b>Data Calon TERPILIH</b></center>
      </div>

      <div class="table-responsive p-4">
        <table class="table table-striped shadow">
          <tr class="bg-info">
            <th width="150">Id Alternatif</th>
            <th>Nama Alternatif</th>
            <th>Merek (C1)</th>
            <th>Bahan (C2)</th>
            <th>Berat (C3)</th>
            <th>Harga (C4)</th>
          </tr>

          <?php
          $id_alternatifs = $_POST['id_alternatif'];

          foreach ($id_alternatifs as $id_alternatif) {
            $data = mysqli_query($con, "SELECT * FROM alternatif WHERE id_alternatif = '$id_alternatif' ");
            while ($sepatu = mysqli_fetch_assoc($data)) {
          ?>


              <tr>
                <td><?= $sepatu['id_alternatif']; ?></td>
                <td><?= $sepatu['nama_alternatif']; ?></td>
                <td><?= $sepatu['c1']; ?></td>
                <td><?= $sepatu['c2']; ?></td>
                <td><?= $sepatu['c3']; ?></td>
                <td><?= $sepatu['c4']; ?></td>
              </tr>


          <?php
            }
          }

          ?>

          </form>
        </table>
      </div>


      <br><br>
      <h1 style="border-bottom:3px dodgerblue solid"></h1>
      <br><br>

      <div class="alert alert-info">
        <center><b>NORMALISASI</b></center>
      </div>

      <div class="table-responsive p-4">
        <table class="table table-striped shadow">
          <tr class="bg-info">
            <th width="150">Id Alternatif</th>
            <th>Nama Alternatif</th>
            <th>Merek (C1)</th>
            <th>Bahan (C2)</th>
            <th>Berat (C3)</th>
            <th>Harga (C4)</th>
          </tr>

          <?php

          $pembagi1 = 0;
          $pembagi2 = 0;
          $pembagi3 = 0;
          $pembagi4 = 0;

          $id_alternatifs = $_POST['id_alternatif'];
          foreach ($id_alternatifs as $id_alternatif) {
            $data = mysqli_query($con, "SELECT * FROM alternatif WHERE id_alternatif = '$id_alternatif' ");
            while ($sepatu = mysqli_fetch_assoc($data)) {

              $pembagi1 += pow($sepatu['c1'], 2);
              $akar1 = sqrt($pembagi1);

              $pembagi2 += pow($sepatu['c2'], 2);
              $akar2 = sqrt($pembagi2);

              $pembagi3 += pow($sepatu['c3'], 2);
              $akar3 = sqrt($pembagi3);

              $pembagi4 += pow($sepatu['c4'], 2);
              $akar4 = sqrt($pembagi4);
            }
          }

          ?>



          <?php
          $id_alternatifs = $_POST['id_alternatif'];
          foreach ($id_alternatifs as $id_alternatif) {
            $data = mysqli_query($con, "SELECT * FROM alternatif WHERE id_alternatif = '$id_alternatif' ");
            while ($sepatu = mysqli_fetch_assoc($data)) {

          ?>


              <tr>
                <td><?= $sepatu['id_alternatif']; ?></td>
                <td><?= $sepatu['nama_alternatif']; ?></td>
                <!-- -----------C1----------- -->
                <td>
                  <?php $c1 = $sepatu['c1'] / $akar1;
                  echo round($c1, 4); ?>
                </td>
                <!-- -----------C2----------- -->
                <td>
                  <?php $c2 = $sepatu['c2'] / $akar2;
                  echo round($c2, 4); ?>
                </td>
                <!-- -----------C3----------- -->
                <td>
                  <?php $c3 = $sepatu['c3'] / $akar3;
                  echo round($c3, 4); ?>
                </td>
                <!-- -----------C4----------- -->
                <td><?php $c4 = $sepatu['c4'] / $akar4;
                    echo round($c4, 4); ?>
                </td>
              </tr>


          <?php

            }
          }
          ?>
        </table>
      </div>


      <br><br>
      <h1 style="border-bottom:3px dodgerblue solid"></h1>
      <br><br>

      <div class="alert alert-info">
        <center><b>TERBOBOT</b></center>
      </div>

      <div class="table-responsive p-4">
        <table class="table table-striped shadow">
          <tr class="bg-info">
            <th width="150">Id Alternatif</th>
            <th>Nama Alternatif</th>
            <th>Merek (C1)</th>
            <th>Bahan (C2)</th>
            <th>Berat (C3)</th>
            <th>Harga (C4)</th>
          </tr>

          <?php
          $id_alternatifs = $_POST['id_alternatif'];
          foreach ($id_alternatifs as $id_alternatif) {
            $data = mysqli_query($con, "SELECT * FROM alternatif WHERE id_alternatif = '$id_alternatif' ");
            while ($sepatu = mysqli_fetch_assoc($data)) {

          ?>

              <tr>
                <td><?= $sepatu['id_alternatif']; ?></td>
                <td><?= $sepatu['nama_alternatif']; ?></td>
                <!-- -----------C1----------- -->
                <td>
                  <?php $c1 = $sepatu['c1'] / $akar1;
                  $merek1 = $merek['bobot'] * $c1;
                  // echo $merek['bobot'] . " * " . round($c1, 6) . " = " . round($merek1, 6);
                  echo round($merek1, 4);
                  ?>
                </td>
                <!-- -----------C2----------- -->
                <td>
                  <?php $c2 = $sepatu['c2'] / $akar2;
                  $bahan1 = $bahan['bobot'] * $c2;
                  // echo $bahan['bobot'] . " * " . round($c2, 6) . " = " . round($bahan1, 6);
                  echo round($bahan1, 4);
                  ?>
                </td>
                <!-- -----------C3----------- -->
                <td>
                  <?php $c3 = $sepatu['c3'] / $akar3;
                  $berat1 = $berat['bobot'] * $c3;
                  // echo $berat['bobot'] . " * " . round($c3, 6) . " = " . round($berat1, 6);
                  echo round($berat1, 4);
                  ?>
                </td>
                <!-- -----------C4----------- -->
                <td>
                  <?php $c4 = $sepatu['c4'] / $akar4;
                  $harga1 = $harga['bobot'] * $c4;
                  // echo $harga['bobot'] . " * " . round($c4, 6) . " = " . round($harga1, 6);
                  echo round($harga1, 4);
                  ?>
                </td>
              </tr>

          <?php
            }
          }

          ?>

        </table>
      </div>


      <br><br>
      <h1 style="border-bottom:3px dodgerblue solid"></h1>
      <br><br>

      <div class="alert alert-info">
        <center><b>HASIL AKHIR</b></center>
      </div>

      <div class="table-responsive p-4">
        <table class="table table-striped shadow">
          <tr class="bg-info">
            <th width="150">Id Alternatif</th>
            <th>Nama Alternatif</th>
            <th>Total</th>
          </tr>



          <?php
          $id_alternatifs = $_POST['id_alternatif'];
          foreach ($id_alternatifs as $id_alternatif) {
            $data = mysqli_query($con, "SELECT * FROM alternatif WHERE id_alternatif = '$id_alternatif' ");
            while ($sepatu = mysqli_fetch_assoc($data)) {

          ?>


              <?php $sepatu['id_alternatif']; ?>
              <?php $sepatu['nama_alternatif']; ?>
              <!-- -----------C1----------- -->

              <?php $c1 = $sepatu['c1'] / $akar1;
              $merek1 = $merek['bobot'] * $c1;
              // echo $merek['bobot'] . " * " . round($c1, 6) . " = " . round($merek1, 6);
              round($merek1, 4);
              ?>
              <!-- -----------C2----------- -->
              <?php $c2 = $sepatu['c2'] / $akar2;
              $bahan1 = $bahan['bobot'] * $c2;
              // echo $bahan['bobot'] . " * " . round($c2, 6) . " = " . round($bahan1, 6);
              round($bahan1, 4);
              ?>
              <!-- -----------C3----------- -->
              <?php $c3 = $sepatu['c3'] / $akar3;
              $berat1 = $berat['bobot'] * $c3;
              // echo $berat['bobot'] . " * " . round($c3, 6) . " = " . round($berat1, 6);
              round($berat1, 4);
              ?>
              <!-- -----------C4----------- -->
              <?php $c4 = $sepatu['c4'] / $akar4;
              $harga1 = $harga['bobot'] * $c4;
              // echo $harga['bobot'] . " * " . round($c4, 6) . " = " . round($harga1, 6);
              round($harga1, 4);
              ?>

              <form action="" method="POST" class="form-group">
                <tr>
                  <input type="hidden" name="kode" value="<?= $kodebarang; ?>">
                  <!-- --------------ID ALTERNATIF-------------- -->
                  <input type="hidden" name="id_alternatif[]" value="<?= $sepatu['id_alternatif'] ?>">
                  <td><?= $sepatu['id_alternatif']; ?></td>
                  <!-- --------------NAMA ALTERNATIF-------------- -->
                  <input type="hidden" name="nama_alternatif[]" value="<?= $sepatu['nama_alternatif'] ?>">
                  <td><?= $sepatu['nama_alternatif']; ?></td>
                  <!-- --------------TOTAL HASIL-------------- -->
                  <td>
                    <?php
                    $totalll = $merek1 + $bahan1 + $berat1 - $harga1;
                    echo round($totalll, 4);
                    ?>
                    <input type="hidden" name="total_hasil[]" value="<?= round($totalll, 4); ?>">
                  </td>
                </tr>


            <?php
            }
          }

            ?>

            <button type="submit" name="simpan" class="btn btn-success" style="float: right;">Simpan</button>
            <br><br>
              </form>

        </table>
      </div>


    </div>
    <div class="col-md-12 bg-light">
      <div class="copyright">
        <h6 style = "color:#000;">Copyright&copy; Fanny Khaliza</h6>
      </div>
    </div>
    </div>
  <?php   } ?>
  <!-- 
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
       -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

  </body>

  </html>