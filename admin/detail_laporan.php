<?php
session_start();
//JIKA TIDAK DITEMUKAN $_SESSION['status'] (USER/ADMIN TIDAK MELIWATI TAHAP LOGIN) MAKA LEMBAR ADMIN/USER KEHALAMAN LOGIN 
if (!isset($_SESSION['status'])) {
  header("Location: ../index.php?pesan=logindahulu");
  exit;
}


require '../functions.php';

//MENGAMBIL DATA YG DI KLIK  DARI laporan
$kode = $_GET['kode'];


//TAMPILKAN SEMUA DATA DIMANA YANG kode_hasil NYA BERDASARKAN DARI $kode 
$data = query("SELECT * FROM nilai WHERE kode_hasil = '$kode' ORDER BY total DESC ");

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

  <title>laporan</title>
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
            <img src="../img/logout.png" width="30">
          </a>
        </div>
    </nav>
  </form>

  <br>
  <div class="container bg-light shadow p-3 mb-5">
    <div class="alert alert-info">
      <center><b>DETAIL laporan</b></center>
    </div>

    <a href="laporan.php" class="btn btn-light mb-3">Kembali</a>

    <div class="table-responsive p-4">

      <table class="table table-striped shadow">
        <tr class="bg-info">
          <th>Kode</th>
          <th>Id Alternatif</th>
          <th>Nama Alternatif</th>
          <th>Total</th>
          <th>Rank</th>
        </tr>

        <?php $i = 1; ?>
        <?php foreach ($data as $detail_data) { ?>
          <tr>
            <td><?= $detail_data['kode_hasil']; ?></td>
            <td><?= $detail_data['id_alternatif']; ?></td>
            <td><?= $detail_data['nama_alternatif']; ?></td>
            <td><?= $detail_data['total']; ?></td>
            <td><?= $i++ ?></td>
          </tr>
        <?php } ?>
      </table>

    </div>


  </div>

  <div class="col-md-12 bg-light">
    <div class="copyright">
      <h6 style = "color:#000;">Copyright&copy; Fanny Khaliza</h6>
    </div>
  </div>

  <!-- 
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
 -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>

</body>

</html>