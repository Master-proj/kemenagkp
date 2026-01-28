<?php
include 'config/db.php';

$id = $_GET['id'] ?? 0;

$q = mysqli_query($conn, "
  SELECT d.*, p.judul, b.nama_bidang
  FROM detail_layanan d
  JOIN profil_bidang p ON d.id_profil = p.id_profil
  JOIN bidang b ON p.id_bidang = b.id_bidang
  WHERE d.id_detail = '$id'
");

$data = mysqli_fetch_assoc($q);

if (!$data) {
  die("Detail tidak ditemukan");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?php echo $data['judul_detail']; ?></title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'partials/navbar.php'; ?>

<section class="tentang">
  <div class="container">

    <h2 class="section-title"><?php echo $data['judul_detail']; ?></h2>
    <p style="text-align:center;color:#666;margin-bottom:30px;">
      <?php echo $data['nama_bidang']; ?>
    </p>

    <div class="admin-box">
      <?php echo nl2br($data['isi_detail']); ?>

      <?php if ($data['file_pdf']): ?>
        <div style="margin-top:20px;">
          <a href="uploads/detail_layanan/pdf/<?php echo $data['file_pdf']; ?>" 
             class="btn-primary" target="_blank">
            Unduh PDF
          </a>
        </div>
      <?php endif; ?>
    </div>

    <div style="margin-top:30px;text-align:center;">
      <a href="javascript:history.back()" class="btn-primary">
        Kembali
      </a>
    </div>

  </div>
</section>

<?php include 'partials/footer.php'; ?>

</body>
</html>
