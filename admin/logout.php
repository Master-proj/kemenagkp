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
session_destroy();
header("Location: login.php");
exit;
