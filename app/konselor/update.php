<?php 
session_start();
include('../../database/db.php');
if(!isset($_SESSION['konselor'])){
  echo '<script>window.location="../../login.php"</script>';
}else{
    $id_konsul = $_GET['id'];
    $username_konselor = $_GET['username_konselor'];
    $cek_statistik = mysqli_query($conn, "SELECT * FROM statistik WHERE username_konselor = '$username_konselor'");
    $cek_statistik_2 = mysqli_fetch_array($cek_statistik);
    $berlangsung = $cek_statistik_2['berlangsung'] + 1;
    $kurangi_akan_datang = $cek_statistik_2['akan_datang'] - 1;
    $update = mysqli_query($conn, "UPDATE konsultasi SET 
      status = 'sudah verifikasi'
      WHERE id = '$id_konsul'
    ");
    $update_berlangsung = mysqli_query($conn, "UPDATE statistik SET 
      berlangsung = '$berlangsung'
      WHERE username_konselor = '$username_konselor'
    ");
    $update_akan_datang = mysqli_query($conn, "UPDATE statistik SET 
      akan_datang = '$kurangi_akan_datang'
      WHERE username_konselor = '$username_konselor'
    ");
      if ($update) {
        echo '<script>window.location="index.php"</script>';
      } else {
        echo 'gagal ' . mysqli_error($conn);
      }
    
}
?>