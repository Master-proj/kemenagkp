<?php
session_start();
include '../config/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $u = $_POST['username'];
  $p = md5($_POST['password']);

  $q = mysqli_query($conn, "SELECT * FROM editor WHERE username='$u' AND password='$p'");
  if (mysqli_num_rows($q) > 0) {
    $data = mysqli_fetch_assoc($q);
    $_SESSION['editor'] = $data['nama'];
    $_SESSION['editor_id'] = $data['id_editor'];
    header("Location: dashboard.php");
    exit;
  } else {
    $error = "Username atau password salah!";
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Editor</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="admin-header">
  <div class="container">
    <h3>Login Editor</h3>
  </div>
</div>

<div class="container" style="padding:60px 0;max-width:420px;">
  <form method="post" class="admin-box">
    <?php if ($error): ?>
      <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>

    <button class="btn-primary" style="width:100%;">Login</button>
  </form>
</div>

</body>
</html>
