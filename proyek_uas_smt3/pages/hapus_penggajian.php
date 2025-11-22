<?php
include('../config/koneksi.php');
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: ../index.php");
  exit();
}

if (!isset($_GET['id'])) {
  die("ID penggajian tidak ditemukan.");
}

$id = (int) $_GET['id']; // cast ke int untuk keamanan

// Optional: cek apakah record ada (bisa menampilkan nama sebelum hapus)
$check = mysqli_query($conn, "SELECT p.*, k.name FROM penggajian p LEFT JOIN karyawan k ON p.employee_id = k.employee_id WHERE p.id = $id LIMIT 1");
if (!$check) {
  die("Query error: " . mysqli_error($conn));
}
if (mysqli_num_rows($check) == 0) {
  echo "<script>alert('Data penggajian tidak ditemukan.'); window.location='penggajian.php';</script>"; exit;
}

// hapus
$query = "DELETE FROM penggajian WHERE id = $id";
if (mysqli_query($conn, $query)) {
  echo "<script>alert('Data penggajian berhasil dihapus.'); window.location='penggajian.php';</script>";
  exit;
} else {
  echo "Gagal menghapus data: " . mysqli_error($conn);
}
?>
