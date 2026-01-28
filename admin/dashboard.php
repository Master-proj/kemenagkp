<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Admin</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="admin-header">
  <div class="container">
    <h3>ADMIN PANEL – Kemenag Kota Semarang</h3>
    <a href="logout.php">Logout</a>
  </div>
</div>

<div class="container" style="padding:40px 0;">
  <h2>Dashboard</h2>
  <p>Selamat datang, <strong><?php echo $_SESSION['admin']; ?></strong></p>

  <!-- GANTI BAGIAN GRID LAMA DENGAN INI -->
  <div class="admin-grid">
    <a href="profil_umum.php" class="admin-card">Kelola Profil Kemenag</a>
    <a href="struktur.php" class="admin-card">Kelola Struktur Jabatan</a>
    <a href="bidang.php" class="admin-card">Kelola Bidang</a>
    <a href="profil.php" class="admin-card">Kelola Profil Bidang</a>
    <a href="detail.php" class="admin-card">Kelola Detail Layanan</a>
    <a href="berita.php" class="admin-card">Kelola Berita</a>
    <a href="editor.php" class="admin-card">Kelola Editor Berita</a>
  </div>
</div>

</body>
</html>
