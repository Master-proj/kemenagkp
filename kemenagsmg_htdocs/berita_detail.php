<?php
include 'config/db.php';

$id = $_GET['id'] ?? 0;
$q = mysqli_query($conn, "SELECT * FROM berita WHERE id_berita='$id'");
$data = mysqli_fetch_assoc($q);

if (!$data) {
  die("Berita tidak ditemukan");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?php echo $data['judul']; ?></title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'partials/navbar.php'; ?>

<section class="tentang">
  <div class="container">

    <div style="background:#fff;padding:30px;border-radius:16px;box-shadow:0 12px 30px rgba(0,0,0,0.12);">

      <h2 class="section-title"><?php echo $data['judul']; ?></h2>
      <p style="text-align:center;color:#777;"><?php echo $data['tanggal']; ?></p>

      <?php if ($data['gambar']): ?>
        <div style="text-align:center;margin:20px 0;">
          <img src="uploads/<?php echo $data['gambar']; ?>" style="max-width:600px;border-radius:12px;">
        </div>
      <?php endif; ?>

      <div style="max-width:800px;margin:0 auto;line-height:1.8;color:#444;">
        <?php echo nl2br($data['isi']); ?>
      </div>

      <div style="text-align:center;margin-top:30px;">
        <a href="bidang.php?id=berita" class="btn-primary" style="background:#222;border-color:#999;">
          Kembali ke Berita
        </a>
      </div>

    </div>

  </div>
</section>

<?php include 'partials/footer.php'; ?>

</body>
</html>
