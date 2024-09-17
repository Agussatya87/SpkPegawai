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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

  <style>
    body {
      background-image: url(../img/galeri/efarina2.jpg);
      background-size: cover;
    }

    .gambar {
      max-width: 70%;
      height: auto;
    }

    .container {
      min-height: calc(100vh - 211px - -60px);
    }

    .transparent-container {
      background-color: rgba(255, 255, 255, 0.7); 
      border-radius: 0.25rem; 
      padding: 20px;
    }

    .col-md-12 {
      padding: 8px;
    }

    .copyright {
      text-align: center;
      color: white;

    }

    a font {
      color: #000;
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
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-link active" href="index.php">
              <font size="4"><b>Home</b></font><span class="sr-only">(current)</span>
            </a>
            <a class="nav-link" href="data_calon_staff.php">
              <font size="4"><b>Data Calon</b></font>
            </a>
            <a class="nav-link" href="laporan.php">
              <font size="4"><b>Laporan</b></font>
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
      <center><b>SELAMAT DATANG HRD</b></center>
    </div>
    <center>
      <font size="5" class="judul"><b>SISTEM PENDUKUNG KEPUTUSAN PENERIMAAN STAFF BARU DI RUMAH SAKIT EFARINA ETAHAM PEMATANGSIANTAR</b></font>
    </center>
    <br><br>
    </div>

  <div class="col-md-12 bg-light">
    <div class="copyright">
      <h6 style = "color:#000;" >Copyright&copy; Fanny Khaliza</h6>
    </div>
</div>


  <!-- 
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script> -->


  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

</body>

</html>