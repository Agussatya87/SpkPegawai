<?php
session_start();
require '../functions.php';

// JIKA TIDAK DITEMUKAN $_SESSION['status'] MAKA LEMPAR KE HALAMAN LOGIN
if (!isset($_SESSION['status'])) {
  header("Location: ../index.php?pesan=logindahulu");
  exit;
}

$error = ''; // Untuk menyimpan pesan error
$idErrorClass = ''; // Untuk menambahkan class error

// JIKA TOMBOL SIMPAN DITEKAN MAKA JALANKAN
if (isset($_POST['simpan'])) {
  $id_calon = $_POST['id_calon'];

  // Cek apakah id_calon sudah ada di database
  if (cek_id_calon($id_calon)) {
    $error = "ID telah digunakan, silakan masukkan ID lain.";
    $idErrorClass = 'is-invalid'; // Tambahkan class untuk memberi warna merah pada kolom id_calon
  } else {
    // Jika ID belum digunakan, simpan data
    if (tambah_calon($_POST) > 0) {
      echo "<script>
              alert ('Data Berhasil Di Tambah');
              document.location.href='data_calon_staff.php';
            </script>";
    }
  }
}

// Fungsi untuk cek apakah id_calon sudah ada di database
function cek_id_calon($id) {
  global $con;
  $result = mysqli_query($con, "SELECT id_calon FROM calon_staff WHERE id_calon = '$id'");
  return mysqli_num_rows($result) > 0;
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

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
      color: #CDD0D4;
    }

    a font {
      color: whitesmoke;
    }

    .navbar-nav a {
      margin-right: 20px;
    }

    .tooltip-inner {
      max-width: 150px; 
      font-size: 12px;  
      padding: 5px;    
    }

    .tooltip-icon {
      font-size: 14px; 
      margin-left: 3px; 
    }

    .tooltip-arrow {
      display: none;
    }

    .navbar-nav a:hover {
      color: darkblue;
      background-color: lightblue;
      border-radius: 5px;
    }
  </style>

  <title>TAMBAH DATA CALON STAFF</title>
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
              <font size="4"><b style="color:#000;">Hasil Penilaian</b></font>
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
  <div class="container bg-light shadow p-3 mb-5">
    <div class="alert alert-info">
      <center><b>TAMBAH Data Calon</b></center>
    </div>

    <div class="col-md-7">
      <form name="calonForm" method="post" action="" onsubmit="return validateForm()" class="form-group">
        <div class="table-responsive">
          <table class="table">
            <tr>
              <td width="200"><label>Id Calon Staff</label></td>
              <td> : </td>
              <td width="500">
                <input type="text" name="id_calon" class="form-control <?php echo $idErrorClass; ?>" autocomplete="off">
                
                <!-- Icon tanda tanya dengan tooltip -->
                <?php if (!empty($error)): ?>
                  <span class="text-danger"><?php echo $error; ?></span>
                  <i class="bi bi-question-circle-fill text-danger tooltip-icon" data-bs-toggle="tooltip" title="ID telah digunakan dan tersimpan pada database, gunakan ID yang lain"></i>
                <?php endif; ?>
                
              </td>
            </tr>

            <tr>
              <td><label>Nama Calon Staff</label></td>
              <td> : </td>
              <td width="500"><input type="text" name="nama_calon" class="form-control" autocomplete="off"></td>
            </tr>

            <tr>
              <td><label>Nilai Psikotes</label></td>
              <td> : </td>
              <td width="500"><input type="text" name="c1" class="form-control" autocomplete="off"></td>
            </tr>

            <tr>
              <td><label>Verifikasi Ijazah</label><i class="bi bi-question-circle-fill tooltip-icon" data-bs-toggle="tooltip" title="Gunakan angka 1 untuk calon yang memunuhi verifikasi ijazah, gunakan 0 untuk calon yang tidak terverifikasi"></i></td>
              <td> : </td>
              <td width="500"><input type="text" name="c2" class="form-control" autocomplete="off"></td>
            </tr>

            <tr>
              <td><label>Interview</label></td>
              <td> : </td>
              <td width="500"><input type="text" name="c3" class="form-control" autocomplete="off"></td>
            </tr>

            <tr>
              <td><label>Pengalaman</label></td>
              <td> : </td>
              <td width="500"><input type="text" name="c4" class="form-control" autocomplete="off"></td>
            </tr>

            <tr>
              <td><label>Keahlian</label></td>
              <td> : </td>
              <td width="500"><input type="text" name="c5" class="form-control" autocomplete="off"></td>
            </tr>

            <td></td>
            <td></td>
            <td>
              <button type="submit" name="simpan" class="btn btn-success" style="margin-right: 8px;">Simpan</button>
              <a href="data_calon_staff.php" class="btn btn-danger">Batal</a>
            </td>
            </tr>
          </table>
        </div>

      </form>
    </div>

  </div>

  <div class="col-md-12 bg-light">
    <div class="copyright">
      <h6 style="color:#000;">Copyright&copy; Fanny Khaliza</h6>
    </div>
  </div>

  <!-- Script for Bootstrap and Tooltip Initialization -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    // Inisialisasi tooltip
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });
  </script>

</body>
</html>
