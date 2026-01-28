<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

include '../config/db.php';

$id = $_GET['id'];
mysqli_query($conn, "UPDATE berita SET status='rejected' WHERE id_berita='$id'");

header("Location: berita.php");
exit;
