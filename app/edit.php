<?php
require('../koneksi.php');
session_start();
if (!isset($_SESSION['admin'])) {
   echo "<script>window.location = '../login.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Rechipe Admin</title>
   <!-- plugins:css -->
   <link rel="stylesheet" href="vendors/feather/feather.css">
   <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
   <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
   <!-- endinject -->
   <!-- Plugin css for this page -->
   <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
   <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
   <link rel="stylesheet" type="text/css" href="js/select.dataTables.min.css">
   <!-- End plugin css for this page -->
   <!-- inject:css -->
   <link rel="stylesheet" href="css/vertical-layout-light/style.css">
   <!-- endinject -->
   <link rel="shortcut icon" href="images/favicon.png" />
   <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

      * {
         font-family: 'Poppins', sans-serif;
      }
   </style>
</head>

<body>
   <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
         <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo mr-5" href="index.php"><img src="../imagefrom/Logo2.png" class="mr-2" alt="logo" /></a>
            <a class="navbar-brand brand-logo-mini" href="index.php"></a>
         </div>
         <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">

            <ul class="navbar-nav navbar-nav-right">
               <li class="nav-item nav-profile"><?php echo $_SESSION['admin']['name'] ?></li>
               <li class="nav-item nav-profile dropdown">
                  <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                     <img src="images/faces/face28.jpg" alt="profile" />
                  </a>
                  <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">

                     <a href="logout.php" class="dropdown-item">
                        <i class="ti-power-off text-primary"></i>
                        Logout
                     </a>
                  </div>
               </li>
               <li class="nav-item nav-settings d-none d-lg-flex">
                  <a class="nav-link" href="#">
                     <i class="icon-ellipsis"></i>
                  </a>
               </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
               <span class="icon-menu"></span>
            </button>
         </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
         <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
               <li class="nav-item">
                  <a href="index.php" class="nav-link" style="color:aqua;">Dashboard</a>
               </li>
               <!-- <li class="nav-item">
                  <a href="komentar.php" class="nav-link">Komentar</a>
               </li> -->
               <li class="nav-item">
                  <a href="pengguna.php" class="nav-link">Daftar Pengguna</a>
               </li>
               <li class="nav-item">
                  <a href="ubah-password.php" class="nav-link" >Data Admin</a>
               </li>
            </ul>
         </nav>
         <!-- partial -->
         <div class="main-panel">
            <div class="content-wrapper">
               <div class="row">
                  <div class="col-lg-8 grid-margin stretch-card">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="card-title">Edit Status</h4>
                           <form class="forms-sample" method="POST">
                              <?php 
                                 $no_reservasi = $_GET['no_reservasi'];
                                 $reservasi= mysqli_query($conn, "SELECT * FROM reservasi WHERE no_reservasi = '$no_reservasi'");
                                 if(mysqli_num_rows($reservasi)){
                                    while($row = mysqli_fetch_array($reservasi)){
                                 ?>
                              <div class="form-group">
                                 <label for="exampleInputName1">No. Reservasi</label>
                                 <input type="text" class="form-control" id="exampleInputName1" name="no_reservasi" value="<?php echo $row['no_reservasi'] ?>" readonly>
                              </div>
                              <div class="form-group">
                                 <label for="exampleInputName1">Nama</label>
                                 <input type="text" class="form-control" id="exampleInputName1" name="nama" value="<?php echo $row['nama_lengkap'] ?>" readonly>
                              </div>
                              <div class="form-group">
                                 <label for="exampleInputName1">Tanggal</label>
                                 <input type="text" class="form-control" id="exampleInputName1" name="tanggal" value="<?php echo $row['tanggal'] ?>" readonly>
                              </div>
                              <div class="form-group">
                                 <label for="exampleInputName1">Jam</label>
                                 <input type="text" class="form-control" id="exampleInputName1" name="jam" value="<?php echo $row['jam'] ?>" readonly>
                              </div>
                              <div class="form-group">
                                 <label for="exampleInputName1">Status</label>
                                 <select name="status" id="" class="form-control">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                 </select>
                              </div>
                              <?php }} ?>
                              <button type="submit" name="submit" class="btn btn-success mr-2">Simpan</button>
                           </form>
                           <?php 
                           if(isset($_POST['submit'])){
                              $status = $_POST['status'];

                              $update = mysqli_query($conn, "UPDATE reservasi SET 
                              status = '$status' WHERE no_reservasi = '$no_reservasi'
                              ");
                              if($update){
                                 echo "<script>alert('perubahan berhasil disimpan');
                                 window.location='index.php'</script>";

                              }else {
                                 echo "<script>alert('perubahan gagal disimpan')</script>";
                              }
                           }
                           ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
               <div class="d-sm-flex justify-content-center justify-content-sm-between">
                  <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021. Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
                  <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
               </div>
            </footer>
            <!-- partial -->
         </div>
         <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
   </div>
   <!-- container-scroller -->

   <!-- plugins:js -->
   <script src="vendors/js/vendor.bundle.base.js"></script>
   <!-- endinject -->
   <!-- Plugin js for this page -->
   <script src="vendors/chart.js/Chart.min.js"></script>
   <script src="vendors/datatables.net/jquery.dataTables.js"></script>
   <script src="vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
   <script src="js/dataTables.select.min.js"></script>

   <!-- End plugin js for this page -->
   <!-- inject:js -->
   <script src="js/off-canvas.js"></script>
   <script src="js/hoverable-collapse.js"></script>
   <script src="js/template.js"></script>
   <script src="js/settings.js"></script>
   <script src="js/todolist.js"></script>
   <!-- endinject -->
   <!-- Custom js for this page-->
   <script src="js/dashboard.js"></script>
   <script src="js/Chart.roundedBarCharts.js"></script>
   <!-- End custom js for this page-->
</body>

</html>