<?php
session_start();
if (!isset($_SESSION['editor'])) {
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Editor</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="admin-header">
  <div class="container">
    <h3>Panel Editor</h3>
    <a href="logout.php">Logout</a>
  </div>
</div>

<div class="container" style="padding:40px 0;">
  <h2>Halo, <?php echo $_SESSION['editor']; ?></h2>
  <p>Silakan kirim berita untuk ditinjau oleh Admin Kemenag.</p>

  <div style="margin-top:30px;">
    <a href="berita.php" class="btn-primary">Kirim Berita</a>
  </div>
</div>

</body>
</html>
