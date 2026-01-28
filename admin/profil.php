<style>
table th, table td {
  font-size: 14px;
}
table a {
  color: #0b5d2a;
  text-decoration: none;
  font-weight: 500;
}
table a:hover {
  color: #d4af37;
}
</style>

<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

include '../config/db.php';

// Update data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id = $_POST['id'];
  $judul = $_POST['judul'];
  $desk = $_POST['deskripsi'];
  $detail = isset($_POST['punya_detail']) ? 1 : 0;

  mysqli_query($conn, "UPDATE profil_bidang 
                        SET judul='$judul', deskripsi='$desk', punya_detail='$detail'
                        WHERE id_profil='$id'");

  header("Location: profil.php");
  exit;
}

// Ambil semua profil + nama bidang
$data = mysqli_query($conn, "
  SELECT p.*, b.nama_bidang 
  FROM profil_bidang p
  JOIN bidang b ON p.id_bidang = b.id_bidang
  ORDER BY b.urutan ASC
");

// Mode edit
$edit = null;
if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $q = mysqli_query($conn, "SELECT * FROM profil_bidang WHERE id_profil='$id'");
  $edit = mysqli_fetch_assoc($q);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Profil Bidang</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div style="background:linear-gradient(180deg,#0b5d2a,#063d1c);padding:16px 0;border-bottom:2px solid #d4af37;">
  <div class="container" style="display:flex;justify-content:space-between;align-items:center;">
    <h3 style="color:#fff;margin:0;">Profil Bidang</h3>
    <a href="dashboard.php" style="color:#d4af37;text-decoration:none;">Kembali</a>
  </div>
</div>

<div class="container" style="padding:40px 0;">

  <?php if ($edit): ?>
  <form method="post" style="background:#fff;padding:20px;border-radius:12px;box-shadow:0 6px 14px rgba(0,0,0,0.1);margin-bottom:30px;">
    <h4>Edit Profil</h4>
    <input type="hidden" name="id" value="<?php echo $edit['id_profil']; ?>">

    <input type="text" name="judul" value="<?php echo $edit['judul']; ?>" required
           style="width:100%;padding:10px;margin-bottom:10px;">

    <textarea name="deskripsi" rows="5" required
              style="width:100%;padding:10px;margin-bottom:10px;"><?php echo $edit['deskripsi']; ?></textarea>

    <label>
      <input type="checkbox" name="punya_detail" <?php echo $edit['punya_detail'] ? 'checked' : ''; ?>>
      Punya Detail
    </label>

    <br><br>
    <button class="btn-primary">Simpan</button>
    <a href="profil.php" style="margin-left:10px;">Batal</a>
  </form>
  <?php endif; ?>

  <table width="100%" cellpadding="10" style="background:#fff;border-radius:12px;box-shadow:0 6px 14px rgba(0,0,0,0.1);border-collapse:collapse;">
    <tr style="background:#f3eef6;">
      <th>Bidang</th>
      <th>Judul</th>
      <th>Punya Detail</th>
      <th>Aksi</th>
    </tr>

    <?php while ($p = mysqli_fetch_assoc($data)): ?>
      <tr style="border-top:1px solid #eee;">
        <td><?php echo $p['nama_bidang']; ?></td>
        <td><?php echo $p['judul']; ?></td>
        <td><?php echo $p['punya_detail'] ? 'Ya' : 'Tidak'; ?></td>
        <td>
          <a href="?edit=<?php echo $p['id_profil']; ?>">Edit</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>

</div>

</body>
</html>
