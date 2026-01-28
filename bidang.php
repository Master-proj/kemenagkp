<?php
include 'config/db.php';

$slug = $_GET['id'] ?? 'berita';

// ambil bidang dari database
$q = mysqli_query($conn, "SELECT b.*, p.id_profil, p.deskripsi, p.punya_detail
                          FROM bidang b
                          JOIN profil_bidang p ON b.id_bidang = p.id_bidang
                          WHERE b.slug='$slug'");

$data = mysqli_fetch_assoc($q);

if (!$data) {
  $judul = "Bidang Tidak Ditemukan";
  $deskripsi = "Data bidang yang Anda cari tidak tersedia.";
  $punyaDetail = false;
} else {
  $judul = $data['nama_bidang'];
  $deskripsi = $data['deskripsi'];
  $punyaDetail = $data['punya_detail'];
  $idProfil = $data['id_profil'];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?php echo $judul; ?> – Kemenag Kota Semarang</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'partials/navbar.php'; ?>

<div style="background:#f5f5f5;padding:10px 0;">
  <div class="container" style="font-size:14px;color:#666;">
    <a href="index.php" style="color:#0b5d2a;text-decoration:none;">Beranda</a>
    <span> / </span>
    <span><?php echo $judul; ?></span>
  </div>
</div>

<section class="tentang" style="min-height:70vh;">
  <div class="container">
    <h2 class="section-title"><?php echo $judul; ?></h2>

    <div style="max-width:800px;margin:20px auto;text-align:center;color:#444;">
      <?php echo $deskripsi; ?>
    </div>

    <div style="text-align:center; margin-top:30px; display:flex; gap:16px; justify-content:center; flex-wrap:wrap;">
      <a href="index.php#layanan" class="btn-primary" style="background:#222;border-color:#999;">
        Kembali ke Layanan
      </a>

      <?php if ($slug == 'pengaduan'): ?>
        <a href="https://wa.me/+6285169994994" target="_blank" class="btn-primary">
          Hubungi WA SALAMAN
        </a>
      <?php endif; ?>
    </div>

    <div style="margin-top:40px;">
      <?php
      // ================== DETAIL LAYANAN ==================
      if ($punyaDetail && $slug != 'berita') {
        $qd = mysqli_query($conn, "SELECT * FROM detail_layanan WHERE id_profil='$idProfil'");

        if (mysqli_num_rows($qd) > 0) {
          echo "<div style='display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:20px;'>";

          while ($d = mysqli_fetch_assoc($qd)) {
            echo "
              <div style='background:#fff;border-radius:14px;box-shadow:0 8px 18px rgba(0,0,0,0.12);padding:16px;'>
                <h4 style='margin-bottom:10px;'>{$d['judul_detail']}</h4>
                <p style='color:#555;margin-bottom:12px;'>
                  ".substr(strip_tags($d['isi_detail']), 0, 120)."...
                </p>
                <a href='detail_layanan.php?id={$d['id_detail']}'
                   class='btn-primary'
                   style='font-size:13px;padding:6px 14px;'>
                  Lihat Detail
                </a>
              </div>
            ";
          }

          echo "</div>";
        } else {
          echo "<p style='text-align:center;color:#777;'>Belum ada detail layanan.</p>";
        }
      }

      // ================== BERITA ==================
      if ($slug == 'berita') {
        $qb = mysqli_query($conn, "
          SELECT * FROM berita 
          WHERE status='publish' 
          ORDER BY tahun DESC, bulan DESC, tanggal DESC
        ");

        echo "<div style='display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:20px;'>";

        while ($b = mysqli_fetch_assoc($qb)) {

          $tanggal = sprintf('%02d/%02d/%04d', $b['tanggal'], $b['bulan'], $b['tahun']);

          $thumb = '';
          if (!empty($b['gambar'])) {
            $imgs = explode('|', $b['gambar']);
            $thumb = $imgs[0];
          }

          echo "
            <div style='background:#fff;border-radius:14px;box-shadow:0 8px 18px rgba(0,0,0,0.12);overflow:hidden;'>
              ".($thumb ? "<img src='img/berita/$thumb' style='width:100%;height:180px;object-fit:cover;'>" : "")."
              <div style='padding:16px;'>
                <h4 style='margin-bottom:6px;'>{$b['judul']}</h4>
                <small style='color:#777;'>$tanggal</small>
                <p style='margin:10px 0;'>".substr(strip_tags($b['isi']),0,120)."...</p>
                <a href='berita_detail.php?id={$b['id_berita']}'
                   class='btn-primary'
                   style='font-size:13px;padding:6px 14px;'>
                  Baca Selengkapnya
                </a>
              </div>
            </div>
          ";
        }

        echo "</div>";
      }
      ?>
    </div>
  </div>
</section>

<?php include 'partials/footer.php'; ?>

</body>
</html>
