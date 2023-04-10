<?php 
   session_start();
   require('../koneksi.php');
   if(isset($_GET['no_reservasi'])){
      $no_reservasi = $_GET['no_reservasi'];
      $hapus_reservasi = mysqli_query($conn, "DELETE FROM reservasi WHERE no_reservasi = '".$no_reservasi."'");
      if($hapus_reservasi){
         echo "<script>alert('Data Berhasil dihapus');
         window.location='index.php';
         
         </script>";

      }
      else {
         echo "<script>alert('data gagal dihapus');
         window.location='index.php'</script>";
      }
   }
if (isset($_GET['id_komentar'])) {
   $id_komentar = $_GET['id_komentar'];
   $hapus_komentar = mysqli_query($conn, "DELETE FROM komentar WHERE id_komentar = $id_komentar");
   if ($hapus_komentar) {
      echo "<script>alert('komentar berhasil dihapus');
         window.location='komentar.php';
         
         </script>";
   } else {
      echo "<script>
      window.location='index.php';
      alert('gagal dihapus')</script>";
   }
}
if (isset($_GET['id_user'])) {
   $id_user = $_GET['id_user'];
   $hapus_user = mysqli_query($conn, "DELETE FROM user WHERE id = $id_user");
   if ($hapus_user) {
      echo "<script>alert('akun berhasil dihapus');
         window.location='pengguna.php';
         
         </script>";
   } else {
      echo "<script>
      
      alert('akun gagal dihapus');
      window.location='pengguna.php';</script>";
   }
}
?>