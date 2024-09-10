<?php
session_start();
//JIKA TIDAK DITEMUKAN $_SESSION['status'] (USER/ADMIN TIDAK MELIWATI TAHAP LOGIN) MAKA LEMBAR ADMIN/USER KEHALAMAN LOGIN 
if (!isset($_SESSION['status'])) {
  header("Location: ../xml_get_current_byte_index(parser).php?pesan=logindahulu");
  exit;
}
require '../functions.php';




// JIKA TIDAK MENERIMA DATA ID ALTERNATIF MAKA LEMPAR KEMBALI KE data_calon_staff.php
if (!isset($_POST['id_calon'])) {
  echo "<script>
  alert('Pilih Data Calon Staff Dahulu ! ')
  document.location.href='data_calon_staff.php'
  </script>";
} else {

  //JIKA MENERIMA DATA ID ALTERNATIF MAKA JALANKAN HALAMAN perhitungan.php

  //BUKA TABLE KRITERIA DAN TAMPILKAN FIELD PSIKOTES
  $datakriteriPsikotes = mysqli_query($con, "SELECT * FROM kriteria WHERE kriteria = 'Nilai Psikotes'");
  $psikotes = mysqli_fetch_assoc($datakriteriPsikotes);

  //BUKA TABLE KRITERIA DAN TAMPILKAN FIELD VERIFIKASI Ijasah
  $datakriteriaIjazah = mysqli_query($con, "SELECT * FROM kriteria WHERE kriteria = 'Verifikasi Ijazah'");
  $ijazah = mysqli_fetch_assoc($datakriteriaIjazah);

  //BUKA TABLE KRITERIA DAN TAMPILKAN FIELD INTERVIEW
  $datakriteriaInterview = mysqli_query($con, "SELECT * FROM kriteria WHERE kriteria = 'Interview'");
  $interview = mysqli_fetch_assoc($datakriteriaInterview);

  //BUKA TABLE KRITERIA DAN TAMPILKAN FIELD PENGALAMAN
  $datakriteriaPengalaman = mysqli_query($con, "SELECT * FROM kriteria WHERE kriteria = 'Pengalaman'");
  $pengalaman = mysqli_fetch_assoc($datakriteriaPengalaman);  

  //BUKA TABLE KRITERIA DAN TAMPILKAN FIELD KEAHLIAN
  $datakriteriaKeahlian = mysqli_query($con, "SELECT * FROM kriteria WHERE kriteria = 'Keahlian'");
  $keahlian = mysqli_fetch_assoc($datakriteriaKeahlian);    

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

    <title>Perhitungan</title>
  </head>

  <body bgcolor="f0f0f0">
    <form method="post" action="perhitungan.php">
      <nav class="navbar navbar-expand-lg navbar-dark bg-light">
        <div class="container-fluid">
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
              <a class="nav-link" href="data_calon_staff.php">
                <font size="4"><b style = "color:#000;">Data Calon</b></font>
              </a>
              <a class="nav-link" href="#">
                <font size="4"><b style = "color:#000;"><button type="submit" name="perhitungan" class="btn" style="font-size: 18px; padding: 0px 3px 0px 0px;"><b>Penilaian</b></button></b></font>
              </a>
              <a class="nav-link" href="laporan.php">
                <font size="4"><b style = "color:#000;">Hasil Penilaian</b></font>
              </a>
            </div>
            
            <div class="navbar-nav ms-auto" style="margin: 10px;">
              <a class="log nav-link m-auto" href="../logout.php">
                <font size="4"><b style = "color:#000;">Logout</b></font>
                <img src="../img/logout_new.png" width="20">
              </a>
            </div>
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
            <th width="150">Id Calon</th>
            <th>Nama Calon</th>
            <th>Nilai Psikotes</th>
            <th>Verifikasi ijazah</th>
            <th>Interview</th>
            <th>Pengalaman</th>
            <th>Keahlian</th>
          </tr>

          <?php
          $id_calons = $_POST['id_calon'];

          foreach ($id_calons as $id_calon) {
            $data = mysqli_query($con, "SELECT * FROM calon_staff WHERE id_calon = '$id_calon' ");
            while ($staff = mysqli_fetch_assoc($data)) {
          ?>


              <tr>
                <td><?= $staff['id_calon']; ?></td>
                <td><?= $staff['nama_calon']; ?></td>
                <td><?= $staff['c1']; ?></td>
                <td><?= $staff['c2']; ?></td>
                <td><?= $staff['c3']; ?></td>
                <td><?= $staff['c4']; ?></td>
                <td><?= $staff['c5']; ?></td>
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
            <th width="150">Id Calon</th>
            <th>Nama Calon</th>
            <th>Nilai Psikotes</th>
            <th>Verifikasi ijazah</th>
            <th>Interview</th>
            <th>Pengalaman</th>
            <th>Keahlian</th>
          </tr>

          <?php

          $pembagi1 = 0;
          $pembagi2 = 0;
          $pembagi3 = 0;
          $pembagi4 = 0;
          $pembagi5 = 0;

          $id_calons = $_POST['id_calon'];
          foreach ($id_calons as $id_calon) {
            $data = mysqli_query($con, "SELECT * FROM calon_staff WHERE id_calon = '$id_calon' ");
            while ($staff = mysqli_fetch_assoc($data)) {

              $pembagi1 += pow($staff['c1'], 2);
              $akar1 = sqrt($pembagi1);

              $pembagi2 += pow($staff['c2'], 2);
              $akar2 = sqrt($pembagi2);

              $pembagi3 += pow($staff['c3'], 2);
              $akar3 = sqrt($pembagi3);

              $pembagi4 += pow($staff['c4'], 2);
              $akar4 = sqrt($pembagi4);

              $pembagi5 += pow($staff['c5'], 2);
              $akar5 = sqrt($pembagi5);
            }
          }

          ?>



          <?php
          $id_calons = $_POST['id_calon'];
          foreach ($id_calons as $id_calon) {
            $data = mysqli_query($con, "SELECT * FROM calon_staff WHERE id_calon = '$id_calon' ");
            while ($staff = mysqli_fetch_assoc($data)) {

          ?>


              <tr>
                <td><?= $staff['id_calon']; ?></td>
                <td><?= $staff['nama_calon']; ?></td>
                <!-- -----------C1----------- -->
                <td>
                  <?php $c1 = $staff['c1'] / $akar1;
                  echo round($c1, 4); ?>
                </td>
                <!-- -----------C2----------- -->
                <td>
                  <?php $c2 = $staff['c2'] / $akar2;
                  echo round($c2, 4); ?>
                </td>
                <!-- -----------C3----------- -->
                <td>
                  <?php $c3 = $staff['c3'] / $akar3;
                  echo round($c3, 4); ?>
                </td>
                <!-- -----------C4----------- -->
                <td><?php $c4 = $staff['c4'] / $akar4;
                    echo round($c4, 4); ?>
                </td>
                <!-- -----------C5----------- -->
                <td><?php $c5 = $staff['c5'] / $akar5;
                    echo round($c5, 4); ?>
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
            <th width="150">Id Calon</th>
            <th>Nama Calon</th>
            <th>Nilai Psikotes</th>
            <th>Verifikasi ijazah</th>
            <th>Interview</th>
            <th>Pengalaman</th>
            <th>Keahlian</th>
          </tr>

          <?php
          $id_calons = $_POST['id_calon'];
          foreach ($id_calons as $id_calon) {
            $data = mysqli_query($con, "SELECT * FROM calon_staff WHERE id_calon = '$id_calon' ");
            while ($staff = mysqli_fetch_assoc($data)) {

          ?>

              <tr>
                <td><?= $staff['id_calon']; ?></td>
                <td><?= $staff['nama_calon']; ?></td>
                <!-- -----------C1----------- -->
                <td>
                  <?php $c1 = $staff['c1'] / $akar1;
                  $psikotes1 = $psikotes['bobot'] * $c1;
                  // echo $psikotes['bobot'] . " * " . round($c1, 6) . " = " . round($psikotes1, 6);
                  echo round($psikotes1, 4);
                  ?>
                </td>
                <!-- -----------C2----------- -->
                <td>
                  <?php $c2 = $staff['c2'] / $akar2;
                  $ijazah1 = $ijazah['bobot'] * $c2;
                  // echo $ijazah['bobot'] . " * " . round($c2, 6) . " = " . round($ijazah1, 6);
                  echo round($ijazah1, 4);
                  ?>
                </td>
                <!-- -----------C3----------- -->
                <td>
                  <?php $c3 = $staff['c3'] / $akar3;
                  $interview1 = $interview['bobot'] * $c3;
                  // echo $interview['bobot'] . " * " . round($c3, 6) . " = " . round($interview1, 6);
                  echo round($interview1, 4);
                  ?>
                </td>
                <!-- -----------C4----------- -->
                <td>
                  <?php $c4 = $staff['c4'] / $akar4;
                  $pengalaman1 = $pengalaman['bobot'] * $c4;
                  // echo $pengalaman['bobot'] . " * " . round($c4, 6) . " = " . round($pengalaman1, 6);
                  echo round($pengalaman1, 4);
                  ?>
                </td>
                <!-- -----------C5----------- -->
                <td>
                  <?php $c5 = $staff['c5'] / $akar5;
                  $keahlian1 = $keahlian['bobot'] * $c5;
                  // echo $keahlian['bobot'] . " * " . round($c4, 6) . " = " . round($keahlian1, 6);
                  echo round($keahlian1, 4);
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
            <th width="150">Id Calon</th>
            <th>Nama Calon</th>
            <th>Total</th>
          </tr>



          <?php
          $id_calons = $_POST['id_calon'];
          foreach ($id_calons as $id_calon) {
            $data = mysqli_query($con, "SELECT * FROM calon_staff WHERE id_calon = '$id_calon' ");
            while ($staff = mysqli_fetch_assoc($data)) {

          ?>


              <?php $staff['id_calon']; ?>
              <?php $staff['nama_calon']; ?>
              <!-- -----------C1----------- -->

              <?php $c1 = $staff['c1'] / $akar1;
              $psikotes1 = $psikotes['bobot'] * $c1;
              // echo $psikotes['bobot'] . " * " . round($c1, 6) . " = " . round($psikotes1, 6);
              round($psikotes1, 4);
              ?>
              <!-- -----------C2----------- -->
              <?php $c2 = $staff['c2'] / $akar2;
              $ijazah1 = $ijazah['bobot'] * $c2;
              // echo $ijazah['bobot'] . " * " . round($c2, 6) . " = " . round($ijazah1, 6);
              round($ijazah1, 4);
              ?>
              <!-- -----------C3----------- -->
              <?php $c3 = $staff['c3'] / $akar3;
              $interview1 = $interview['bobot'] * $c3;
              // echo $interview['bobot'] . " * " . round($c3, 6) . " = " . round($interview1, 6);
              round($interview1, 4);
              ?>
              <!-- -----------C4----------- -->
              <?php $c4 = $staff['c4'] / $akar4;
              $pengalaman1 = $pengalaman['bobot'] * $c4;
              // echo $pengalaman['bobot'] . " * " . round($c4, 6) . " = " . round($pengalaman1, 6);
              round($pengalaman1, 4);
              ?>
              <!-- -----------C4----------- -->
              <?php $c5 = $staff['c5'] / $akar5;
              $keahlian1 = $keahlian['bobot'] * $c5;
              // echo $keahlian['bobot'] . " * " . round($c4, 6) . " = " . round($keahlian1, 6);
              round($keahlian1, 4);
              ?>

              <form action="" method="POST" class="form-group">
                <tr>
                  <input type="hidden" name="kode" value="<?= $kodebarang; ?>">
                  <!-- --------------ID ALTERNATIF-------------- -->
                  <input type="hidden" name="id_calon[]" value="<?= $staff['id_calon'] ?>">
                  <td><?= $staff['id_calon']; ?></td>
                  <!-- --------------NAMA ALTERNATIF-------------- -->
                  <input type="hidden" name="nama_calon[]" value="<?= $staff['nama_calon'] ?>">
                  <td><?= $staff['nama_calon']; ?></td>
                  <!-- --------------TOTAL HASIL-------------- -->
                  <td>
                    <?php
                    $totalll = $psikotes1 + $ijazah1 + $interview1 + $pengalaman1 + $keahlian1;
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