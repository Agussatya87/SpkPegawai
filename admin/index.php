<?php

session_start();
//JIKA TIDAK DITEMUKAN $_SESSION['status'] (USER/ADMIN TIDAK MELIWATI TAHAP LOGIN) MAKA LEMBAR ADMIN/USER KEHALAMAN LOGIN 
if (!isset($_SESSION['status'])) {
  header("Location: ../index.php?pesan=logindahulu");
  exit;
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
      background-image: url(../img/efarina2.jpg);
      background-size: cover;
    }

    .gambar {
      max-width: 70%;
      height: auto;
    }

    .copyright {
      text-align: center;
    }

    .container {
      min-height: calc(100vh - 211px - -60px);
    }

    .transparent-container {
      background-color: rgba(255, 255, 255, 0.7); /* Warna putih dengan transparansi 70% */
      border-radius: 0.25rem; /* Tambahkan border-radius jika ingin sudut melengkung */
      padding: 20px; /* Sesuaikan padding agar konten tetap rapi */
    }

    .col-md-12 {
      padding: 8px;
    }

    .navbar-nav a {
      margin-right: 20px;
    }

    .navbar-nav a:hover {
    color: darkblue;
    background-color: lightblue; 
    border-radius: 5px; 
    }

    @media (max-width: 1000px) {
      .judul {
        font-size: 3vh;
      }
    }
  </style>

  <title>Home</title>
</head>

<body bgcolor="f0f0f0">
  <form method="post" action="perhitungan.php">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="../img/logo.png" width="50"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <div class="navbar-nav" style="margin: 10px;">
            <a class="nav-link active" href="index.php">
              <font size="4"><b style="color:#000;">Home</b></font><span class="sr-only">(current)</span>
            </a>
            <a class="nav-link" href="data_kriteria.php">
              <font size="4"><b style="color:#000;">Kriteria</b></font>
            </a>
            <a class="nav-link" href="data_calon_staff.php">
              <font size="4"><b style="color:#000;">Data Calon</b></font>
            </a>
            <a class="nav-link" href="#">
              <font size="4"><b style="color:#000;">
                <button type="submit" name="perhitungan" class="btn" style="font-size: 18px; padding: 0px 3px 0px 0px;"><b>Penilaian</b></button>
              </b></font>
            </a>
            <a class="nav-link" href="laporan.php">
              <font size="4"><b style="color:#000;">Hasil Penilaian</b></font
            </a>
          </div>
          <div class="navbar-nav ms-auto" style="margin: 10px;">
            <a class="log nav-link m-auto" href="../logout.php">
              <font size="4"><b style="color:#000;">Logout</b></font>
              <img src="../img/logout_new.png" width="20">
            </a>
          </div>
        </div>
      </div>
    </nav>
  </form>

  <br>
  <div class="container p-3 mb-5 shadow transparent-container">
  <div class="alert alert-info">
    <center><b>SELAMAT DATANG ADMIN</b></center>
  </div>
  <br>
  <center>
    <font size="5" class="judul"><b>SISTEM PENDUKUNG KEPUTUSAN PENERIMAAN STAFF BARU DI RUMAH SAKIT EFARINA ETAHAM PEMATANGSIANTAR</b></font>
  </center>
  <br><br>
</div>


  <div class="col-md-12 bg-light">
    <div class="copyright">
      <h6 style = "color:#000;">Copyright&copy; Fanny Khaliza</h6>
    </div>
  </div>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>