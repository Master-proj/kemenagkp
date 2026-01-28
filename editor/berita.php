<?php
session_start();
if (!isset($_SESSION['editor'])) {
  header("Location: login.php");
  exit;
}

include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $judul   = $_POST['judul'];
  $isi     = $_POST['isi'];
  $tanggal = $_POST['tanggal'];
  $bulan   = $_POST['bulan'];
  $tahun   = $_POST['tahun'];
  $pengirim = $_SESSION['editor'];

  // Upload gambar
  $namaFile = null;
  if (!empty($_FILES['gambar']['name'])) {
    $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
    $namaFile = time() . '_' . rand(100,999) . '.' . $ext;
    move_uploaded_file($_FILES['gambar']['tmp_name'], "../img/berita/" . $namaFile);
  }

  mysqli_query($conn, "
    INSERT INTO berita (judul, isi, tanggal, bulan, tahun, gambar, status, pengirim)
    VALUES (
      '$judul',
      '$isi',
      '$tanggal',
      '$bulan',
      '$tahun',
      '$namaFile',
      'pending',
      '$pengirim'
    )
  ");

  header("Location: dashboard.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kirim Berita</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="admin-header">
  <div class="container">
    <h3>Kirim Berita</h3>
    <a href="dashboard.php">Kembali</a>
  </div>
</div>

<div class="container" style="padding:40px 0;">
  <form method="post" enctype="multipart/form-data" class="admin-box">
    <input type="text" name="judul" placeholder="Judul Berita" required>

    <textarea name="isi" rows="8" placeholder="Isi Berita Lengkap" required></textarea>

    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:10px;">
      <input type="number" name="tanggal" placeholder="Tanggal" min="1" max="31" required>
      <input type="number" name="bulan" placeholder="Bulan" min="1" max="12" required>
      <input type="number" name="tahun" placeholder="Tahun" min="2020" required>
    </div>

    <input type="file" name="gambar" accept="image/*" required>

    <button class="btn-primary">Kirim</button>
  </form>
</div>

</body>
</html>
