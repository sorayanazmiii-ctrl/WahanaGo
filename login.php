<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  // Ambil data pengguna berdasarkan email
  $stmt = $koneksi->prepare("SELECT id_pengguna, nama, password FROM pengguna WHERE email = ?");
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Bandingkan password langsung (jika belum hashing)
    if ($password === $user['password']) {
      $_SESSION['id_pengguna'] = $user['id_pengguna'];
      $_SESSION['nama_pengguna'] = $user['nama'];

      echo "<script>alert('Login berhasil!'); window.location='ulasan.php';</script>";
      exit;
    }
  }

  echo "<script>alert('Login gagal. Email atau password salah!'); window.location='login.php';</script>";
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Tiket Wahana Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #00c6ff, #0072ff);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }
        .login-card {
            background: #fff;
            padding: 30px 40px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        .login-card h3 {
            margin-bottom: 25px;
            font-weight: bold;
            color: #0072ff;
        }
        .btn-primary {
            background-color: #0072ff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #005fcc;
        }
    </style>
</head>
<body>

<div class="login-card">
    <h3 class="text-center">Login Tiket Wahana</h3>
    <img src="logo.png" alt="Wahanago Fantasy Raya" style="display:block; margin:auto; width:150px; height:auto;">
    <form action="proses_login.php" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Kata Sandi</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password" required>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Masuk</button>
        </div>
        <div class="text-center mt-3">
            Belum punya akun? <a href="register.php">Daftar di sini</a>
        </div>
    </form>
</div>

</body>
</html>
