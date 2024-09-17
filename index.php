<?php
session_start();
require 'functions.php';

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if (login($_POST) > 0) {
    $login = mysqli_query($con, "SELECT * FROM login WHERE username = '$username' AND password = '$password'");
    $user = mysqli_fetch_assoc($login);

    if ($user['level'] == 'admin') {
      $_SESSION['status'] = "log_in";
      echo "<script>alert('Selamat Datang Admin'); document.location.href='admin/index.php';</script>";
    } else if ($user['level'] == 'user') {
      $_SESSION['status'] = "log_in";
      echo "<script>alert('Selamat Datang User'); document.location.href='konsumen/index.php';</script>";
    }
  } else {
    echo "<script>document.location.href='login.php?pesan=username/passwordsalah';</script>";
  }
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f0f0f0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      background: url('img/your-background.jpg') no-repeat center center fixed;
      background-size: cover;
    }

    .login-container {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px); /* Safari */
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
      max-width: 400px;
      width: 100%;  /* Container will now take up 100% width up to max-width */
      box-sizing: border-box; /* Ensure padding doesn't affect the width */
      border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .login-header {
      margin-bottom: 30px;
      text-align: center;
    }

    .login-header h1 {
      font-size: 24px;
      font-weight: 600;
      color: #333;
    }

    .form-control {
      border-radius: 50px;
      padding: 15px;
      font-size: 16px;
      background-color: rgba(255, 255, 255, 0.7);
      border: 1px solid #ccc;
      width: 100%; /* Ensure input fields fill the width of the container */
      box-sizing: border-box; /* Ensure padding doesn't overflow the width */
    }

    .btn-custom {
      background-color: #1e90ff;
      color: #fff;
      border-radius: 50px;
      padding: 12px;
      font-size: 16px;
      font-weight: 600;
      width: 100%; /* Ensure the button also fills the container width */
      transition: background-color 0.3s ease;
    }

    .btn-custom:hover {
      background-color: #007bff;
    }

    .alert {
      font-size: 14px;
      width: 100%; /* Ensure alert width matches container */
    }

    .form-group {
      margin-bottom: 20px;
      width: 100%; /* Make form group 100% width */
    }

    .form-footer {
      text-align: center;
      margin-top: 20px;
      font-size: 14px;
    }

    .form-footer a {
      color: #007bff;
      text-decoration: none;
    }

    .login-logo {
      width: 100px; /* Sesuaikan ukuran logo */
      height: auto;
      margin-bottom: 5px; /* Beri jarak antara logo dan teks */
    }


    .form-footer a:hover {
      text-decoration: underline;
    }
  </style>

  <title>Login</title>
</head>

<body>

  <div class="login-container">
    <div class="login-header">
    <img src="img/logo.png" alt="Logo" class="login-logo">
    </div>

    <!-- Pesan Error -->
    <?php if (isset($_GET['pesan'])): ?>
      <?php if ($_GET['pesan'] == "username/passwordsalah"): ?>
        <div class="alert alert-danger">Username atau password salah!</div>
      <?php elseif ($_GET['pesan'] == "logoutberhasil"): ?>
        <div class="alert alert-info">Logout berhasil!</div>
      <?php elseif ($_GET['pesan'] == "logindahulu"): ?>
        <div class="alert alert-warning">Anda harus login terlebih dahulu!</div>
      <?php endif; ?>
    <?php endif; ?>

    <!-- Form Login -->
    <form method="post">
      <div class="form-group">
        <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
      </div>
      <div class="form-group">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
      </div>
      <button type="submit" name="login" class="btn btn-custom">Login</button>
    </form>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
