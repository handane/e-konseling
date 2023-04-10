<?php 
session_start();
include('../../database/db.php');
if(!isset($_SESSION['konselor'])){
  echo '<script>window.location="../../login.php"</script>';
}else{
    $id_konsul = $_GET['id'];
    $update = mysqli_query($conn, "UPDATE konsultasi SET 
      status = 'selesai'
      WHERE id = '$id_konsul'
    ");
  if ($update) {
    echo '<script>window.location="sesi-berlangsung.php"</script>';
  } else {
    echo 'gagal ' . mysqli_error($conn);
  }
}
