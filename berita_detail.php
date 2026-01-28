<?php
include 'config/db.php';

$id = $_GET['id'] ?? 0;
$q = mysqli_query($conn, "SELECT * FROM berita WHERE id_berita='$id' AND status='publish'");
$b = mysqli_fetch_assoc($q);

if (!$b) {
  die("Berita tidak ditemukan.");
}

$tanggal = sprintf('%02d/%02d/%04d', $b['tanggal'], $b['bulan'], $b['tahun']);
$imgs = !empty($b['gambar']) ? explode('|', $b['gambar']) : [];
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?php echo $b['judul']; ?></title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'partials/navbar.php'; ?>

<section class="tentang" style="min-height:70vh;">
  <div class="container" style="max-width:900px;">
    <h2 class="section-title"><?php echo $b['judul']; ?></h2>
    <p style="text-align:center;color:#777;"><?php echo $tanggal; ?></p>

    <?php foreach ($imgs as $img): ?>
  <?php if ($img != ''): ?>
    <img src="img/berita/<?php echo $img; ?>" 
         style="
           width:100%;
           max-height:420px;
           object-fit:cover;
           border-radius:12px;
           margin:16px 0;
           background:#eee;
         ">
  <?php endif; ?>
<?php endforeach; ?>

    <div style="line-height:1.8;color:#333;margin-top:20px;">
      <?php echo $b['isi']; ?>
    </div>

    <div style="margin-top:40px;">
      <a href="bidang.php?id=berita" class="btn-primary">Kembali ke Berita</a>
    </div>
  </div>
</section>

<?php include 'partials/footer.php'; ?>
</body>
</html>
