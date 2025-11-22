<?php
include('../config/koneksi.php');
if (!isset($_GET['id'])) die('ID slip tidak ditemukan');
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT p.*, k.name, k.job_level, k.location FROM penggajian p JOIN karyawan k ON p.employee_id = k.employee_id WHERE p.id = '$id'");
$data = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Slip Gaji - <?= $data['name'] ?></title>
<style>
body { font-family: Arial; margin: 40px; }
h2 { text-align: center; }
table { width: 60%; margin: auto; border-collapse: collapse; }
td { padding: 8px; }
</style>
</head>
<body onload="window.print()">
<h2>Slip Gaji Karyawan</h2>
<table border="1">
<tr><td>Nama</td><td><?= $data['name'] ?></td></tr>
<tr><td>Jabatan</td><td><?= $data['job_level'] ?></td></tr>
<tr><td>Lokasi</td><td><?= $data['location'] ?></td></tr>
<tr><td>Bulan</td><td><?= $data['bulan'] ?> <?= $data['tahun'] ?></td></tr>
<tr><td>Total Gaji</td><td>Rp <?= number_format($data['total_gaji']) ?></td></tr>
</table>
</body>
</html>