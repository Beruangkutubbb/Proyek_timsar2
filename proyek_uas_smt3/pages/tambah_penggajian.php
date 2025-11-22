<?php
include('../config/koneksi.php');
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: ../index.php");
  exit();
}

if (isset($_POST['simpan'])) {
  $employee_id = $_POST['employee_id'];
  $bulan = $_POST['bulan'];
  $tahun = $_POST['tahun'];
  $potongan = $_POST['potongan'];

  // ambil total kompensasi dari data karyawan
  $q = mysqli_query($conn, "SELECT total_compensation_idr FROM karyawan WHERE employee_id='$employee_id'");
  $data = mysqli_fetch_assoc($q);
  $total = $data['total_compensation_idr'] - $potongan;

  $insert = mysqli_query($conn, "INSERT INTO penggajian (employee_id, bulan, tahun, potongan, total_gaji) VALUES ('$employee_id','$bulan','$tahun','$potongan','$total')");
  
  if ($insert) {
    echo "<script>alert('Data penggajian berhasil ditambahkan!'); window.location='penggajian.php';</script>";
  } else {
    echo "<script>alert('Gagal menambahkan data!');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Tambah Penggajian</title>
<link rel="stylesheet" href="../assets/style-dark.css">
</head>
<body>
<h2>➕ Tambah Data Penggajian</h2>
<a href="../dashboard.php" style="display:inline-block; background:#6c757d; color:white; padding:8px 12px; border-radius:6px; text-decoration:none; margin-bottom:10px;">🏠 Kembali</a>

<form method="POST">
  <label>Nama Karyawan</label><br>
  <select name="employee_id" required>
    <option value="">-- Pilih Karyawan --</option>
    <?php
    $res = mysqli_query($conn, "SELECT * FROM karyawan");
    while ($r = mysqli_fetch_assoc($res)) {
      echo "<option value='{$r['employee_id']}'>{$r['name']}</option>";
    }
    ?>
  </select><br><br>

  <label>Bulan</label><br>
  <input type="text" name="bulan" placeholder="Contoh: November" required><br><br>

  <label>Tahun</label><br>
  <input type="number" name="tahun" value="2025" required><br><br>

  <label>Potongan</label><br>
  <input type="number" name="potongan" value="0" required><br><br>

  <button type="submit" name="simpan">Simpan</button>
</form>
</body>
</html>
