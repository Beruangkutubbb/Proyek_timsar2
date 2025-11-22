<?php
// contact.php
session_start();
if(!isset($_SESSION['username'])) {
  header('Location: /proyek_uas_smt3/index.php');
  exit;
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Contact Person - Sistem Penggajian</title>
  <link rel="stylesheet" href="/proyek_uas_smt3/assets/style-dark.css">
</head>
<body>
<?php include __DIR__ . '/inc/header.php'; ?>
<?php include __DIR__ . '/inc/sidebar.php'; ?>

<main class="main" style="padding:36px">
  <h1>Contact Person</h1>
  <p>Hubungi bagian HR / Admin untuk informasi lebih lanjut:</p>
  <ul>
    <li>Nama: Pratama Wahyu Wijaya</li>
    <li>Email: ptrm.wahyu@gmail.com</li>
    <li>Telepon: 082315807132</li>
  </ul>
</main>

<?php include __DIR__ . '/inc/footer.php'; ?>
</body>
</html>
