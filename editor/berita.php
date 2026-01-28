<?php
session_start();
if (!isset($_SESSION['editor'])) {
  header("Location: login.php");
  exit;
}

include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $judul   = $_POST['judul'] ?? '';
  $isi     = $_POST['isi'] ?? '';
  $tanggal = $_POST['tanggal'] ?? '';
  $bulan   = $_POST['bulan'] ?? '';
  $tahun   = $_POST['tahun'] ?? '';
  $pengirim = $_SESSION['editor'];

  if (trim($isi) == '') {
    die("Isi berita kosong, tidak bisa disimpan.");
  }

  // Amankan input agar tidak merusak SQL
  $judul    = mysqli_real_escape_string($conn, $judul);
  $isi      = mysqli_real_escape_string($conn, $isi);
  $tanggal  = mysqli_real_escape_string($conn, $tanggal);
  $bulan    = mysqli_real_escape_string($conn, $bulan);
  $tahun    = mysqli_real_escape_string($conn, $tahun);
  $pengirim = mysqli_real_escape_string($conn, $pengirim);

  // Upload banyak gambar
  $namaFileGabung = [];

  if (!empty($_FILES['gambar']['name'][0])) {
    foreach ($_FILES['gambar']['tmp_name'] as $i => $tmp) {
      if ($tmp == '') continue;

      $ext = pathinfo($_FILES['gambar']['name'][$i], PATHINFO_EXTENSION);
      $namaFile = time() . '_' . rand(100,999) . '.' . $ext;

      if (move_uploaded_file($tmp, "../img/berita/" . $namaFile)) {
        $namaFileGabung[] = $namaFile;
      }
    }
  }

  // Gabungkan semua nama file
  $namaFile = implode('|', $namaFileGabung);
  $namaFile = mysqli_real_escape_string($conn, $namaFile);

  $sql = "INSERT INTO berita 
          (judul, isi, tanggal, bulan, tahun, gambar, status, pengirim)
          VALUES 
          ('$judul','$isi','$tanggal','$bulan','$tahun','$namaFile','pending','$pengirim')";

  $run = mysqli_query($conn, $sql);

  if (!$run) {
    die("Gagal simpan berita: " . mysqli_error($conn));
  }

  header("Location: berita.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kirim Berita</title>
  <link rel="stylesheet" href="../css/style.css">

<style>
.editor-toolbar {
  display: flex;
  gap: 6px;
  margin-bottom: 8px;
}
.editor-toolbar button {
  padding: 6px 10px;
  border-radius: 6px;
  border: 1px solid #ddd;
  background: #f8f8f8;
  cursor: pointer;
  font-size: 14px;
}
.editor-toolbar button:hover {
  background: #0b5d2a;
  color: #fff;
}
.editor-box {
  border: 1px solid #ccc;
  border-radius: 10px;
  padding: 12px;
  min-height: 240px;
  margin-bottom: 12px;
  font-size: 14px;
  line-height: 1.6;
}
.editor-box:focus {
  outline: none;
  border-color: #d4af37;
  box-shadow: 0 0 0 2px rgba(212,175,55,0.2);
}
</style>
</head>
<body>

<div class="admin-header">
  <div class="container">
    <h3>Kirim Berita</h3>
    <a href="dashboard.php">Kembali</a>
  </div>
</div>

<div class="container" style="padding:40px 0;">
  <form method="post" enctype="multipart/form-data"
        class="admin-box" id="formBerita"
        onsubmit="return syncEditor();">

    <input type="text" name="judul" placeholder="Judul Berita" required>

    <div class="editor-toolbar">
  <button type="button" onclick="cmd('bold')"><b>B</b></button>
  <button type="button" onclick="cmd('italic')"><i>I</i></button>
  <button type="button" onclick="cmd('underline')"><u>U</u></button>
  <button type="button" onclick="cmd('insertUnorderedList')">List</button>

  <!-- Tambahan perataan -->
  <button type="button" onclick="cmd('justifyLeft')">Left</button>
  <button type="button" onclick="cmd('justifyCenter')">Center</button>
  <button type="button" onclick="cmd('justifyRight')">Right</button>
  <button type="button" onclick="cmd('justifyFull')">Justify</button>
</div>

    <div id="editor" class="editor-box" contenteditable="true"></div>

    <textarea name="isi" id="isi" hidden></textarea>

    <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:10px;">
      <input type="number" name="tanggal" placeholder="Tanggal" min="1" max="31" required>
      <input type="number" name="bulan" placeholder="Bulan" min="1" max="12" required>
      <input type="number" name="tahun" placeholder="Tahun" min="2020" required>
    </div>

    <input type="file" name="gambar[]" accept="image/*" multiple required>

    <button class="btn-primary">Kirim</button>
  </form>

<?php
$pengirim = $_SESSION['editor'];
$riwayat = mysqli_query($conn,
  "SELECT * FROM berita 
   WHERE pengirim='$pengirim' 
   ORDER BY tahun DESC, bulan DESC, tanggal DESC");
?>

  <h3 style="margin-top:40px;">Riwayat Berita Saya</h3>

  <table class="admin-table">
    <tr>
      <th>Judul</th>
      <th>Tanggal</th>
      <th>Status</th>
    </tr>

<?php if ($riwayat): ?>
  <?php while ($b = mysqli_fetch_assoc($riwayat)): ?>
    <tr>
      <td><?php echo $b['judul']; ?></td>
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
    </tr>
  <?php endwhile; ?>
<?php else: ?>
  <tr>
    <td colspan="3" style="color:red">
      Query gagal: <?php echo mysqli_error($conn); ?>
    </td>
  </tr>
<?php endif; ?>
  </table>
</div>

<script>
function cmd(command) {
  const editor = document.getElementById('editor');
  editor.focus(); // pastikan fokus kembali ke editor
  document.execCommand(command, false, null);
}

function syncEditor() {
  const isi = document.getElementById('editor').innerHTML.trim();

  if (isi === '') {
    alert('Isi berita masih kosong!');
    return false;
  }

  document.getElementById('isi').value = isi;
  return true;
}
</script>

</body>
</html>
