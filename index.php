<?php 
include 'config/db.php'; 
$struktur = mysqli_query($conn, "SELECT * FROM struktur_jabatan ORDER BY urutan ASC");
$qp = mysqli_query($conn, "SELECT * FROM profil_umum WHERE id=1");
$profil = mysqli_fetch_assoc($qp);
$misi = explode(';', $profil['misi']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MANTEP – Kemenag Kota Semarang</title>
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>

<?php include 'partials/navbar.php'; ?>

<section id="hero" class="hero">
  <div class="hero-content">
    <img src="img/logo-hero.png" alt="Mantep" class="logo-hero" />
    <p class="hero-tagline">Kementerian Agama Kota Semarang</p>
    <p class="hero-desc">Portal Layanan Informasi</p>
    <a href="#layanan" class="btn-primary">Lihat Layanan</a>
  </div>
</section>

<section id="tentang" class="tentang">
  <div class="container">
    <h2 class="section-title">Profil</h2>
    <div class="tentang-grid">
      <div class="tentang-text">
        <h3>Apa itu Kemenag?</h3>
        <p><?php echo nl2br($profil['deskripsi']); ?></p>
      </div>
      <div class="tentang-card">
        <div class="card">
          <h4>Visi</h4>
          <p><?php echo nl2br($profil['visi']); ?></p>
        </div>
        <div class="card">
          <h4>Misi</h4>
          <ol>
            <?php foreach ($misi as $m): ?>
              <li><?php echo trim($m); ?></li>
            <?php endforeach; ?>
          </ol>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- STRUKTUR JABATAN -->
<section class="tentang">
  <div class="container">
    <h2 class="section-title">Struktur Jabatan</h2>

    <div class="struktur-grid">
      <?php
      $q = mysqli_query($conn, "SELECT * FROM struktur_jabatan ORDER BY urutan ASC");
      while ($s = mysqli_fetch_assoc($q)) {
        echo "
          <div class='struktur-card'>
            <img src='uploads/{$s['foto']}'>
            <div class='struktur-nama'>{$s['nama']}</div>
            <div class='struktur-jabatan'>{$s['jabatan']}</div>
          </div>
        ";
      }
      ?>
    </div>

  </div>
</section>

<section id="layanan" class="layanan">
  <div class="container">
    <h2 class="section-title">Layanan & Bidang</h2>
    <br><br>

    <div class="layanan-grid">
      <?php
      $q = mysqli_query($conn, "SELECT * FROM bidang ORDER BY urutan ASC");
      while ($b = mysqli_fetch_assoc($q)) {
        echo "
          <a href='bidang.php?id={$b['slug']}' class='layanan-card'>
            <img src='img/icon-bidang/{$b['icon']}' alt='{$b['nama_bidang']}'>
            <span>{$b['nama_bidang']}</span>
          </a>
        ";
      }
      ?>
    </div>
  </div>
</section>

<?php include 'partials/footer.php'; ?>

</body>
</html>
