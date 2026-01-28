<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $deskripsi = $_POST['deskripsi'];
  $visi = $_POST['visi'];
  $misi = $_POST['misi'];

  mysqli_query($conn, "UPDATE profil_umum SET deskripsi='$deskripsi', visi='$visi', misi='$misi' WHERE id=1");
  header("Location: profil_umum.php");
  exit;
}

$q = mysqli_query($conn, "SELECT * FROM profil_umum WHERE id=1");
$p = mysqli_fetch_assoc($q);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Profil Kemenag</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="admin-header">
  <div class="container">
    <h3>Kelola Profil Kemenag</h3>
    <a href="dashboard.php">Kembali</a>
  </div>
</div>

<div class="container" style="padding:40px 0;">
  <form method="post" class="admin-box">
    <h4>Profil Umum</h4>

    <label>Deskripsi</label>
    <textarea name="deskripsi" rows="5" required><?php echo $p['deskripsi']; ?></textarea>

    <label>Visi</label>
    <textarea name="visi" rows="3" required><?php echo $p['visi']; ?></textarea>

    <label>Misi (pisahkan dengan tanda ; )</label>
    <textarea name="misi" rows="4" required><?php echo $p['misi']; ?></textarea>

    <button class="btn-primary">Simpan Perubahan</button>
  </form>
</div>

</body>
</html>
