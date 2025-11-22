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
<title>Penggajian</title>
<link rel="stylesheet" href="../assets/style-dark.css">
</head>
<body>
<h2>💰 Data Penggajian</h2>
<a href="../dashboard.php" style="display:inline-block; background:#6c757d; color:white; padding:8px 12px; border-radius:6px; text-decoration:none; margin-bottom:10px;">🏠 Kembali</a>
<a href="tambah_penggajian.php" style="display:inline-block; background:#007bff; color:white; padding:8px 12px; border-radius:6px; text-decoration:none; margin-bottom:10px; margin-left:10px;">➕ Tambah Penggajian</a>

<table border="1" cellpadding="8" cellspacing="0" style="width:100%; margin-top:12px; border-collapse:collapse;">
  <tr style="background:#111; color:#fff;">
    <th>Nama</th><th>Bulan</th><th>Tahun</th><th>Potongan</th><th>Total Gaji</th><th>Aksi</th>
  </tr>
<?php
$res = mysqli_query($conn, "SELECT p.*, k.name FROM penggajian p JOIN karyawan k ON p.employee_id = k.employee_id ORDER BY p.tahun DESC, p.bulan DESC");
if (!$res) {
  echo "<tr><td colspan='6'>Terjadi kesalahan query: " . mysqli_error($conn) . "</td></tr>";
} else {
  if (mysqli_num_rows($res) == 0) {
    echo "<tr><td colspan='6' style='text-align:center; padding:18px;'>Belum ada data penggajian.</td></tr>";
  } else {
    while ($row = mysqli_fetch_assoc($res)) {
      // safe output
      $id = (int)$row['id'];
      $name = htmlspecialchars($row['name']);
      $bulan = htmlspecialchars($row['bulan']);
      $tahun = htmlspecialchars($row['tahun']);
      $potongan = number_format($row['potongan']);
      $total = number_format($row['total_gaji']);
      echo "<tr>
        <td>{$name}</td>
        <td style='text-align:center;'>{$bulan}</td>
        <td style='text-align:center;'>{$tahun}</td>
        <td style='text-align:right;'>Rp {$potongan}</td>
        <td style='text-align:right;'>Rp {$total}</td>
        <td style='text-align:center;'>
          <a href='slip_gaji.php?id={$id}' target='_blank' style='margin-right:8px;'>🧾 Cetak Slip</a>
          <a href='hapus_penggajian.php?id={$id}' onclick=\"return confirm('Yakin ingin menghapus data penggajian untuk {$name} (Bulan: {$bulan} {$tahun})?');\" style='color:#c0392b;'>🗑 Hapus</a>
        </td>
      </tr>";
    }
  }
}
?>
</table>
</body>
</html>
