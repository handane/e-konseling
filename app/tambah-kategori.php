<?php 
session_start();
require('../koneksi.php');
if (!isset($_SESSION['admin'])) {
   echo "<script>window.location = '../index.php'</script>";
}
   if(isset($_POST['submit'])){
      $nama_kategori = $_POST['nama_kategori'];
      $status = $_POST['status'];

      $tambah = mysqli_query($conn, "INSERT INTO kategori VALUES(
         null,
         '".$nama_kategori."',
         '".$status."'
      )");

      if($tambah){
         echo "<script>window.location='index.php'</script>";
      }else {
      echo "<script>window.location='index.php'</script>";
      }
   }
?>