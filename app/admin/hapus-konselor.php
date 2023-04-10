<?php
require('../../database/db.php');
session_start();
if (!isset($_SESSION['admin'])) {
  echo "<script>window.location = '../../login.php'</script>";
}

if (isset($_GET['id_konselor'])) {
  $sql2 = mysqli_query($conn, "SELECT * FROM konselor WHERE id_konselor = '" . $_GET['id_konselor'] . "'");
  $datafl = mysqli_fetch_assoc($sql2);
  $foto = $datafl['foto_konselor'];
  if (file_exists("./foto/$foto")) {
    unlink("./foto/$foto");
  }
  $delete1 = mysqli_query($conn, "DELETE FROM konselor WHERE id_konselor = '" . $_GET['id_konselor'] . "'");
  echo '<script>window.location="index.php"</script>';
}
