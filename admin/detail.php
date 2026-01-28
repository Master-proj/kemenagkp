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

// Hapus
if (isset($_GET['hapus'])) {
  $id = $_GET['hapus'];
  mysqli_query($conn, "DELETE FROM detail_layanan WHERE id_detail='$id'");
  header("Location: detail.php");
  exit;
}

// Tambah + Upload PDF
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id_profil = $_POST['id_profil'];
  $judul = $_POST['judul'];
  $isi = $_POST['isi'];

  $namaFile = null;

  if (!empty($_FILES['pdf']['name'])) {
    $ext = pathinfo($_FILES['pdf']['name'], PATHINFO_EXTENSION);
    $namaFile = time() . '_' . rand(100,999) . '.' . $ext;
    move_uploaded_file($_FILES['pdf']['tmp_name'], "../uploads/" . $namaFile);
  }

  mysqli_query($conn, "INSERT INTO detail_layanan (id_profil, judul_detail, isi_detail, file_pdf)
                        VALUES ('$id_profil','$judul','$isi','$namaFile')");

  header("Location: detail.php");
  exit;
}

// Ambil profil untuk dropdown
$profil = mysqli_query($conn, "
  SELECT p.id_profil, p.judul, b.nama_bidang 
  FROM profil_bidang p
  JOIN bidang b ON p.id_bidang = b.id_bidang
  ORDER BY b.urutan ASC
");

// Ambil semua detail
$data = mysqli_query($conn, "
  SELECT d.*, p.judul, b.nama_bidang
  FROM detail_layanan d
  JOIN profil_bidang p ON d.id_profil = p.id_profil
  JOIN bidang b ON p.id_bidang = b.id_bidang
  ORDER BY b.urutan ASC
");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Detail Layanan</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="admin-header">
  <div class="container">
    <h3>Detail Layanan</h3>
    <a href="dashboard.php">Kembali</a>
  </div>
</div>

<div class="container" style="padding:40px 0;">

  <form method="post" enctype="multipart/form-data" class="admin-box">
    <h4>Tambah Detail</h4>

    <select name="id_profil" required style="width:100%;padding:10px;margin-bottom:10px;">
      <option value="">Pilih Bidang</option>
      <?php while ($p = mysqli_fetch_assoc($profil)): ?>
        <option value="<?php echo $p['id_profil']; ?>">
          <?php echo $p['nama_bidang']; ?> – <?php echo $p['judul']; ?>
        </option>
      <?php endwhile; ?>
    </select>

    <input type="text" name="judul" placeholder="Judul Detail" required
           style="width:100%;padding:10px;margin-bottom:10px;">

    <textarea name="isi" rows="5" placeholder="Isi Detail" required
              style="width:100%;padding:10px;margin-bottom:10px;"></textarea>

    <!-- Upload PDF -->
    <input type="file" name="pdf" accept="application/pdf"
           style="width:100%;padding:10px;margin-bottom:10px;">

    <button class="btn-primary">Tambah</button>
  </form>

  <table class="admin-table">
    <tr style="background:#f3eef6;">
      <th>Bidang</th>
      <th>Judul Detail</th>
      <th>PDF</th>
      <th>Aksi</th>
    </tr>

    <?php while ($d = mysqli_fetch_assoc($data)): ?>
      <tr style="border-top:1px solid #eee;">
        <td><?php echo $d['nama_bidang']; ?></td>
        <td><?php echo $d['judul_detail']; ?></td>
        <td>
          <?php if ($d['file_pdf']): ?>
            <a href="../uploads/<?php echo $d['file_pdf']; ?>" target="_blank">Lihat</a>
          <?php else: ?>
            -
          <?php endif; ?>
        </td>
        <td>
          <a href="?hapus=<?php echo $d['id_detail']; ?>" onclick="return confirm('Hapus detail ini?')">Hapus</a>
        </td>
      </tr>
    <?php endwhile; ?>
  </table>

</div>

</body>
</html>
