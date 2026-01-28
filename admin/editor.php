<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

include '../config/db.php';

// Hapus editor
if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  mysqli_query($conn, "DELETE FROM editor WHERE id_editor='$id'");
  header("Location: editor.php");
  exit;
}

// Tambah / Update editor
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $nama = $_POST['nama'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $mode = $_POST['mode'];

  if ($mode == 'tambah') {
    $pass = md5($password);
    mysqli_query($conn, "INSERT INTO editor (nama, username, password)
                          VALUES ('$nama','$username','$pass')");
  } else {
    $id = $_POST['id'];
    if (!empty($password)) {
      $pass = md5($password);
      mysqli_query($conn, "UPDATE editor SET nama='$nama', username='$username', password='$pass'
                            WHERE id_editor='$id'");
    } else {
      mysqli_query($conn, "UPDATE editor SET nama='$nama', username='$username'
                            WHERE id_editor='$id'");
    }
  }

  header("Location: editor.php");
  exit;
}

// Mode edit
$edit = null;
if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $q = mysqli_query($conn, "SELECT * FROM editor WHERE id_editor='$id'");
  $edit = mysqli_fetch_assoc($q);
}

// Ambil semua editor
$data = mysqli_query($conn, "SELECT * FROM editor ORDER BY nama ASC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Editor Berita</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="admin-header">
  <div class="container">
    <h3>Editor Berita</h3>
    <a href="dashboard.php">Kembali</a>
  </div>
</div>

<div class="container" style="padding:40px 0;">

  <form method="post" class="admin-box">
    <h4><?php echo $edit ? 'Edit Editor' : 'Tambah Editor'; ?></h4>

    <input type="hidden" name="mode" value="<?php echo $edit ? 'edit' : 'tambah'; ?>">
    <?php if ($edit): ?>
      <input type="hidden" name="id" value="<?php echo $edit['id_editor']; ?>">
    <?php endif; ?>

    <input type="text" name="nama" placeholder="Nama Instansi / Editor" required
           value="<?php echo $edit['nama'] ?? ''; ?>">

    <input type="text" name="username" placeholder="Username" required
           value="<?php echo $edit['username'] ?? ''; ?>">

    <input type="password" name="password"
           placeholder="<?php echo $edit ? 'Kosongkan jika tidak ganti password' : 'Password'; ?>">

    <button class="btn-primary">
      <?php echo $edit ? 'Simpan Perubahan' : 'Tambah Editor'; ?>
    </button>
  </form>

  <table class="admin-table">
    <tr>
      <th>Nama</th>
      <th>Username</th>
      <th>Aksi</th>
    </tr>

    <?php while ($e = mysqli_fetch_assoc($data)): ?>
      <tr>
        <td><?php echo $e['nama']; ?></td>
        <td><?php echo $e['username']; ?></td>
        <td>
          <a href="?edit=<?php echo $e['id_editor']; ?>">Edit</a> |
          <a href="?hapus=<?php echo $e['id_editor']; ?>" onclick="return confirm('Hapus editor ini?')">Hapus</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>

</div>

</body>
</html>
