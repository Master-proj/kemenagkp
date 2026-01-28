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
include '../config/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $user = $_POST['username'];
  $pass = md5($_POST['password']);

  $q = mysqli_query($conn, "SELECT * FROM admin WHERE username='$user' AND password='$pass'");
  if (mysqli_num_rows($q) > 0) {
    $_SESSION['admin'] = $user;
    header("Location: dashboard.php");
    exit;
  } else {
    $error = "Username atau Password salah!";
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Admin</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body style="background:#f3eef6;display:flex;align-items:center;justify-content:center;min-height:100vh;">
  <form method="post" style="background:#fff;padding:30px;border-radius:16px;box-shadow:0 12px 30px rgba(0,0,0,0.2);width:320px;">
    <h3 style="text-align:center;margin-bottom:20px;">Login Admin</h3>
    <?php if ($error): ?>
      <p style="color:red;text-align:center;"><?php echo $error; ?></p>
    <?php endif; ?>
    <input type="text" name="username" placeholder="Username" required style="width:100%;padding:10px;margin-bottom:12px;">
    <input type="password" name="password" placeholder="Password" required style="width:100%;padding:10px;margin-bottom:16px;">
    <button class="btn-primary" style="width:100%;">Masuk</button>
  </form>
</body>
</html>
