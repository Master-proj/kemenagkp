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
  $q = mysqli_query($conn, "SELECT foto FROM struktur_jabatan WHERE id='$id'");
  $d = mysqli_fetch_assoc($q);
  if ($d && file_exists("../uploads/" . $d['foto'])) {
    unlink("../uploads/" . $d['foto']);
  }
  mysqli_query($conn, "DELETE FROM struktur_jabatan WHERE id='$id'");
  header("Location: struktur.php");
  exit;
}

// Tambah data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nama = $_POST['nama'];
  $jabatan = $_POST['jabatan'];
  $urutan = $_POST['urutan'];

  $foto = null;
  if (!empty($_FILES['foto']['name'])) {
    $ext = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $foto = time() . '_' . rand(100,999) . '.' . $ext;
    move_uploaded_file($_FILES['foto']['tmp_name'], "../uploads/" . $foto);
  }

  mysqli_query($conn, "INSERT INTO struktur_jabatan (nama, jabatan, foto, urutan)
                        VALUES ('$nama','$jabatan','$foto','$urutan')");

  header("Location: struktur.php");
  exit;
}

$data = mysqli_query($conn, "SELECT * FROM struktur_jabatan ORDER BY urutan ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Struktur Jabatan</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="admin-header">
  <div class="container">
    <h3>Kelola Struktur Jabatan</h3>
    <a href="dashboard.php">Kembali</a>
  </div>
</div>

<div class="container" style="padding:40px 0;">

  <form method="post" enctype="multipart/form-data" class="admin-box">
    <h4>Tambah Pegawai</h4>
    <input type="text" name="nama" placeholder="Nama" required>
    <input type="text" name="jabatan" placeholder="Jabatan" required>
    <input type="number" name="urutan" placeholder="Urutan Tampil" required>
    <input type="file" name="foto" accept="image/*" required>
    <button class="btn-primary">Simpan</button>
  </form>

  <table class="admin-table">
    <tr>
      <th>Foto</th>
      <th>Nama</th>
      <th>Jabatan</th>
      <th>Urutan</th>
      <th>Aksi</th>
    </tr>

    <?php while ($s = mysqli_fetch_assoc($data)): ?>
      <tr>
        <td>
          <img src="../uploads/<?php echo $s['foto']; ?>" style="width:60px;border-radius:8px;">
        </td>
        <td><?php echo $s['nama']; ?></td>
        <td><?php echo $s['jabatan']; ?></td>
        <td><?php echo $s['urutan']; ?></td>
        <td>
          <a href="?hapus=<?php echo $s['id']; ?>" onclick="return confirm('Hapus data ini?')">Hapus</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>

</div>

</body>
</html>
