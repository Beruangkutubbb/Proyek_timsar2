<?php
include('../config/koneksi.php');
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: ../index.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Karyawan</title>
<link rel="stylesheet" href="../assets/style-dark.css">
</head>
<body>
<h2>📋 Data Karyawan</h2>
<a href="../dashboard.php" style="display:inline-block; background:#6c757d; color:white; padding:8px 12px; border-radius:6px; text-decoration:none; margin-bottom:10px;">🏠 Kembali</a>
<table border="1" cellpadding="8" cellspacing="0">
<tr>
<th>ID</th><th>Nama</th><th>Sektor</th><th>Jabatan</th><th>Pengalaman</th>
<th>Gaji Pokok</th><th>Tunjangan</th><th>Lembur</th><th>Total</th><th>Lokasi</th>
</tr>
<?php
$result = mysqli_query($conn, "SELECT * FROM karyawan ORDER BY employee_id ASC");
while ($row = mysqli_fetch_assoc($result)) {
  echo "<tr>
    <td>{$row['employee_id']}</td>
    <td>{$row['name']}</td>
    <td>{$row['sector']}</td>
    <td>{$row['job_level']}</td>
    <td>{$row['experience_years']}</td>
    <td>".number_format($row['basic_salary_idr'])."</td>
    <td>".number_format($row['allowance_idr'])."</td>
    <td>".number_format($row['overtime_idr'])."</td>
    <td>".number_format($row['total_compensation_idr'])."</td>
    <td>{$row['location']}</td>
  </tr>";
}
?>
</table>
</body>
</html>