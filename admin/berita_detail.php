<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

include '../config/db.php';

$id = $_GET['id'] ?? 0;
$q = mysqli_query($conn, "SELECT * FROM berita WHERE id_berita='$id'");
$data = mysqli_fetch_assoc($q);

if (!$data) {
  die("Berita tidak ditemukan.");
}

$imgs = array_filter(explode(',', $data['gambar']));
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Detail Berita</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="admin-header">
  <div class="container">
    <h3>Detail Berita</h3>
    <a href="berita.php">Kembali</a>
  </div>
</div>

<div class="container" style="padding:40px 0;max-width:900px;">

  <div class="admin-box">
    <h2><?php echo htmlspecialchars($data['judul']); ?></h2>
    <p style="color:#777;font-size:13px;margin-bottom:12px;">
      Tanggal: <?php echo $data['tanggal'].'/'.$data['bulan'].'/'.$data['tahun']; ?><br>
      Pengirim: <?php echo htmlspecialchars($data['pengirim']); ?><br>
      Status: <strong><?php echo $data['status']; ?></strong>
    </p>

    <?php foreach ($imgs as $img): ?>
      <img src="../img/berita/<?php echo $img; ?>"
           style="width:100%;max-height:360px;object-fit:cover;border-radius:12px;margin:12px 0;">
    <?php endforeach; ?>

    <div style="line-height:1.7;margin-top:16px;">
      <?php echo $data['isi']; ?>
    </div>

    <?php if ($data['status'] == 'pending'): ?>
      <div style="margin-top:24px;">
        <a href="publish.php?id=<?php echo $data['id_berita']; ?>" class="btn-primary">Publish</a>
        <a href="reject.php?id=<?php echo $data['id_berita']; ?>"
           onclick="return confirm('Tolak berita ini?')"
           style="margin-left:10px;color:#c0392b;">Tolak</a>
      </div>
    <?php endif; ?>
  </div>

</div>

</body>
</html>
