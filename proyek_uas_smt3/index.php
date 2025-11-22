<?php
session_start();
include('config/koneksi.php');

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = md5($_POST['password']);
  $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");
  if (mysqli_num_rows($query) == 1) {
    $_SESSION['username'] = $username;
    header("Location: dashboard.php");
    exit();
  } else {
    $error = "Username atau password salah!";
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login - Sistem Penggajian</title>
<link rel="stylesheet" href="assets/style-dark.css">
</head>
<body class="login-page">
<form method="post" class="login-box">
<h2>Login Sistem Penggajian</h2>
<?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<button type="submit" name="login">Masuk</button>
</form>
</body>
</html>