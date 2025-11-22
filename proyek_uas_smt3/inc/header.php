<?php
if (session_status() === PHP_SESSION_NONE) session_start();
// base path - sesuaikan jika proyek bukan /proyek_uas_smt3
$BASE = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
if ($BASE === '') $BASE = '/proyek_uas_smt3';
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Dashboard - Sistem Penggajian</title>
  <link rel="stylesheet" href="<?= $BASE ?>/assets/style-dark.css">
</head>
<body>
<header class="topbar">
  <button id="hamburger" class="hamburger" aria-label="Toggle menu">☰</button>
  <div class="topbar-title">Sistem Informasi Penggajian</div>
  <div class="topbar-right"><?= htmlspecialchars($_SESSION['username'] ?? 'Guest') ?></div>
</header>
<div class="layout">
