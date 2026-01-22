<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

include '../config/db.php';

// Publish / Unpublish
if (isset($_GET['aksi']) && isset($_GET['id'])) {
  $id = $_GET['id'];
  if ($_GET['aksi'] == 'publish') {
    mysqli_query($conn, "UPDATE berita SET status='publish' WHERE id_berita='$id'");
  } elseif ($_GET['aksi'] == 'unpublish') {
    mysqli_query($conn, "UPDATE berita SET status='pending' WHERE id_berita='$id'");
  }
  header("Location: berita.php");
  exit;
}

// Hapus
if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  mysqli_query($conn, "DELETE FROM berita WHERE id_berita='$id'");
  header("Location: berita.php");
  exit;
}

// Ambil semua berita
$data = mysqli_query($conn, "
  SELECT * FROM berita 
  WHERE status IN ('pending','publish') 
  ORDER BY tanggal DESC
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
    <td><?php echo $b['tanggal']; ?></td>

    <!-- KOLOM STATUS -->
    <td>
      <?php if ($b['status'] == 'pending'): ?>
        <span style="color:#d4af37;font-weight:600;">Pending</span>
      <?php else: ?>
        <span style="color:#0b5d2a;font-weight:600;">Publish</span>
      <?php endif; ?>
    </td>

    <!-- KOLOM AKSI -->
    <td>
      <?php if ($b['status'] == 'pending'): ?>
        <a href="publish.php?id=<?php echo $b['id_berita']; ?>">Publish</a> |
      <?php endif; ?>
      <a href="?hapus=<?php echo $b['id_berita']; ?>" onclick="return confirm('Hapus berita ini?')">Hapus</a>
    </td>
  </tr>
<?php endwhile; ?>
  </table>

</div>

</body>
</html>
