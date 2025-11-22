<?php
// dashboard.php
include __DIR__ . '/config/koneksi.php';
session_start();
if(!isset($_SESSION['username'])) {
  header('Location: index.php'); exit;
}

/* Ambil ringkasan dari DB */
$emp_count = 0;
$penggajian_count = 0;
$total_gaji = 0;

$res = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM karyawan");
if($res) { $r = mysqli_fetch_assoc($res); $emp_count = intval($r['cnt']); }

$res = mysqli_query($conn, "SELECT COUNT(*) as cnt FROM penggajian");
if($res) { $r = mysqli_fetch_assoc($res); $penggajian_count = intval($r['cnt']); }

$res = mysqli_query($conn, "SELECT COALESCE(SUM(total_gaji),0) as sumgaji FROM penggajian");
if(!$res) {
    die('Query error: ' . mysqli_error($conn));
} else {
    $r = mysqli_fetch_assoc($res);
    $total_gaji = intval($r['sumgaji']);
}
include __DIR__ . '/inc/header.php';
include __DIR__ . '/inc/sidebar.php';
?>
<main class="main">
  <div class="center-wrap">
    <div class="content-box">
      <h1 style="text-align:center; font-size:34px; margin:0 0 8px 0">Selamat Datang, <?= htmlspecialchars($_SESSION['username']) ?></h1>
      <p style="text-align:center; color:var(--muted); margin-top:6px">Ringkasan sistem penggajian.</p>

      <!-- Kotak ringkasan -->
      <div class="cards" role="region" aria-label="Ringkasan">
        <div class="card">
          <h2><?= number_format($emp_count) ?></h2>
          <p>Jumlah Karyawan</p>
        </div>
        <div class="card">
          <h2><?= number_format($penggajian_count) ?></h2>
          <p>Entry Penggajian</p>
        </div>
        <div class="card">
          <h2>Rp <?= number_format($total_gaji,0,',','.') ?></h2>
          <p>Total Gaji (semua entry)</p>
        </div>
      </div>

      <!-- Tombol aksi -->
      <div style="text-align:center; margin-top:20px;">
        <a class="btn" href="pages/karyawan.php">📄 Data Karyawan</a>
        <a class="btn" href="pages/penggajian.php" style="background:var(--accent-2); margin-left:8px">💰 Penggajian</a>
      </div>
    </div>
  </div>
</main>

<?php include __DIR__ . '/inc/footer.php'; ?>
