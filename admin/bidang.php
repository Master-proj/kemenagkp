<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

include '../config/db.php';

// Hapus data
if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  mysqli_query($conn, "DELETE FROM bidang WHERE id_bidang='$id'");
  header("Location: bidang.php");
  exit;
}

// Tambah / Update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $slug = $_POST['slug'];
  $nama = $_POST['nama'];
  $urut = $_POST['urutan'];

  // Upload icon jika ada
  $iconName = null;
  if (!empty($_FILES['icon']['name'])) {
    $ext = pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION);
    $iconName = $slug . '.' . $ext;
    $target = "../img/icon-bidang/" . $iconName;
    move_uploaded_file($_FILES['icon']['tmp_name'], $target);
  }

  if ($_POST['mode'] == 'tambah') {
    mysqli_query($conn, "INSERT INTO bidang (slug, nama_bidang, icon, urutan)
                          VALUES ('$slug','$nama','$iconName','$urut')");
  } else {
    $id = $_POST['id'];

    if ($iconName) {
      mysqli_query($conn, "UPDATE bidang 
        SET slug='$slug', nama_bidang='$nama', icon='$iconName', urutan='$urut'
        WHERE id_bidang='$id'");
    } else {
      mysqli_query($conn, "UPDATE bidang 
        SET slug='$slug', nama_bidang='$nama', urutan='$urut'
        WHERE id_bidang='$id'");
    }
  }

  header("Location: bidang.php");
  exit;
}

// Mode edit
$edit = null;
if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $q = mysqli_query($conn, "SELECT * FROM bidang WHERE id_bidang='$id'");
  $edit = mysqli_fetch_assoc($q);
}

// Ambil semua bidang
$data = mysqli_query($conn, "SELECT * FROM bidang ORDER BY urutan ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Bidang</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="admin-header">
  <div class="container">
    <h3>Bidang/Layanan</h3>
    <a href="dashboard.php">Kembali</a>
  </div>
</div>

<div class="container" style="padding:40px 0;">

  <form method="post" enctype="multipart/form-data" class="admin-box">
    <h4><?php echo $edit ? 'Edit Bidang' : 'Tambah Bidang'; ?></h4>

    <input type="hidden" name="mode" value="<?php echo $edit ? 'edit' : 'tambah'; ?>">
    <?php if ($edit): ?>
      <input type="hidden" name="id" value="<?php echo $edit['id_bidang']; ?>">
    <?php endif; ?>

    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:10px;margin-top:10px;">
      <input type="text" name="slug" placeholder="Slug (contoh: bimas-islam)" required
        value="<?php echo $edit['slug'] ?? ''; ?>">

      <input type="text" name="nama" placeholder="Nama Bidang" required
        value="<?php echo $edit['nama_bidang'] ?? ''; ?>">

      <input type="file" name="icon" <?php echo $edit ? '' : 'required'; ?>>

      <input type="number" name="urutan" placeholder="Urutan" required
        value="<?php echo $edit['urutan'] ?? ''; ?>">
    </div>

    <?php if ($edit && $edit['icon']): ?>
      <p style="margin-top:8px;">Icon saat ini: <strong><?php echo $edit['icon']; ?></strong></p>
    <?php endif; ?>

    <button class="btn-primary" style="margin-top:14px;">
      <?php echo $edit ? 'Simpan Perubahan' : 'Tambah Bidang'; ?>
    </button>
  </form>

  <table class="admin-table">
    <tr style="background:#f3eef6;">
      <th>ID</th>
      <th>Slug</th>
      <th>Nama</th>
      <th>Icon</th>
      <th>Urutan</th>
      <th>Aksi</th>
    </tr>
    <?php while ($b = mysqli_fetch_assoc($data)): ?>
      <tr style="border-top:1px solid #eee;">
        <td><?php echo $b['id_bidang']; ?></td>
        <td><?php echo $b['slug']; ?></td>
        <td><?php echo $b['nama_bidang']; ?></td>
        <td><?php echo $b['icon']; ?></td>
        <td><?php echo $b['urutan']; ?></td>
        <td>
          <a href="?edit=<?php echo $b['id_bidang']; ?>">Edit</a> |
          <a href="?hapus=<?php echo $b['id_bidang']; ?>" onclick="return confirm('Hapus data ini?')">Hapus</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>

</div>

</body>
</html>
