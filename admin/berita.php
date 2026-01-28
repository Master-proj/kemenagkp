<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

include '../config/db.php';

// Hapus berita
if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  mysqli_query($conn, "DELETE FROM berita WHERE id_berita='$id'");
  header("Location: berita.php");
  exit;
}

// Ambil semua berita (termasuk pending, publish, rejected)
$data = mysqli_query($conn, "
  SELECT * FROM berita
  ORDER BY tahun DESC, bulan DESC, tanggal DESC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Moderasi Berita</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="admin-header">
  <div class="container">
    <h3>Moderasi Berita</h3>
    <a href="dashboard.php">Kembali</a>
  </div>
</div>

<div class="container" style="padding:40px 0;">

  <table class="admin-table">
    <tr>
      <th>Judul</th>
      <th>Pengirim</th>
      <th>Tanggal</th>
      <th>Status</th>
      <th>Aksi</th>
    </tr>

    <?php while ($b = mysqli_fetch_assoc($data)): ?>
  <tr>
    <td><?php echo $b['judul']; ?></td>
    <td><?php echo $b['pengirim']; ?></td>
    <td><?php echo $b['tanggal'].'/'.$b['bulan'].'/'.$b['tahun']; ?></td>

    <td>
      <?php if ($b['status'] == 'pending'): ?>
        <span style="color:#d4af37;font-weight:600;">Pending</span>
      <?php elseif ($b['status'] == 'publish'): ?>
        <span style="color:#0b5d2a;font-weight:600;">Publish</span>
      <?php else: ?>
        <span style="color:#c0392b;font-weight:600;">Ditolak</span>
      <?php endif; ?>
    </td>

    <td>
      <a href="berita_detail.php?id=<?php echo $b['id_berita']; ?>">Lihat</a> |

      <td>

  <?php if ($b['status'] == 'pending'): ?>
    <a href="publish.php?id=<?php echo $b['id_berita']; ?>">Publish</a> |
    <a href="reject.php?id=<?php echo $b['id_berita']; ?>"
       onclick="return confirm('Tolak berita ini?')">Tolak</a> |
  <?php endif; ?>

  <a href="?hapus=<?php echo $b['id_berita']; ?>"
     onclick="return confirm('Hapus berita ini?')">Hapus</a>
</td>
  </tr>
<?php endwhile; ?>

  </table>

</div>

</body>
</html>
