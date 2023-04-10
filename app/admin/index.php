<?php
require('../../database/db.php');
session_start();
if (!isset($_SESSION['admin'])) {
   echo "<script>window.location = '../../login.php'</script>";
}
?>
<img src="" alt="">
<!DOCTYPE html>
<html lang="en">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <title>Admin</title>
   <!-- plugins:css -->
   <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
   <link rel="stylesheet" href="../vendors/feather/feather.css">
   <link rel="stylesheet" href="../vendors/ti-icons/css/themify-icons.css">
   <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
   <!-- endinject -->
   <!-- Plugin css for this page -->
   <link rel="stylesheet" href="../vendors/datatables.net-bs4/dataTables.bootstrap4.css">
   <link rel="stylesheet" href="../vendors/ti-icons/css/themify-icons.css">
   <link rel="stylesheet" type="text/css" href="../js/select.dataTables.min.css">
   <!-- End plugin css for this page -->
   <!-- inject:css -->
   <link rel="stylesheet" href="../css/vertical-layout-light/style.css">
   <!-- endinject -->
   <link rel="shortcut icon" href="../images/favicon.png" />
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
            <a class="navbar-brand brand-logo mr-5" href="index.php"></a>
            <a class="navbar-brand brand-logo-mini" href="index.php"></a>
         </div>
         <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">

            <ul class="navbar-nav navbar-nav-right">
               <li class="nav-item nav-profile"><?php echo $_SESSION['admin']['username'] ?></li>
               <li class="nav-item nav-profile"><a href="logout.php">Logout</a></li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas" id="sidebarToggle" href="#!">
               <span class="icon-menu"></span>
            </button>
         </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
         <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
               <li class="nav-item">
                  <a href="index.php" class="nav-link" style="color:aqua; background-color:#4B49AC;">Kanselor</a>
               </li>
               <li class="nav-item">
                  <a href="akan-datang.php" class="nav-link">Akan Datang</a>
               </li>
               <li class="nav-item">
                  <a href="sesi-berlangsung.php" class="nav-link">Sesi Berlangsung</a>
               </li>
               <li class="nav-item">
                  <a href="riwayat-konsultasi.php" class="nav-link">Riwayat Konsultasi</a>
               </li>
               <li class="nav-item">
                  <a href="statistik.php" class="nav-link">Statistik</a>
               </li>
            </ul>
         </nav>
         <!-- partial -->
         <div class="main-panel">
            <div class="content-wrapper">
               <div class="row">
                  <div class="col-lg-12 grid-margin stretch-card">
                     <div class="card">
                        <div class="card-body">
                           <h4 class="card-title">Daftar Konselor</h4>
                           <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Tambah Konselor</button>

                           <div class="table-responsive">
                              <table class="table table-hover">
                                 <thead>
                                    <tr>
                                       <th>No</th>
                                       <th>Konselor</th>
                                       <th>Nama</th>
                                       <th>Spesialisasi</th>
                                       <th>Aksi</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    $no = 1;
                                    $konselor = mysqli_query($conn, "SELECT * FROM konselor");
                                    if (mysqli_num_rows($konselor) > 0) {
                                       while ($row = mysqli_fetch_array($konselor)) {
                                    ?>
                                          <tr>
                                             <td><?php echo $no++; ?></td>
                                             <td><img src="foto/<?php echo $row['foto_konselor']; ?>" alt="" style="width:100px; height:100px;"></td>
                                             <td><?php echo $row['nama']; ?></td>
                                             <td><?php echo $row['spesialisasi']; ?></td>
                                             <td><a href="hapus-konselor.php?id_konselor=<?php echo $row['id_konselor']; ?>">Hapus</a></td>

                                          </tr>
                                    <?php }
                                    } ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h6>Registrasi Pengguna</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <form method="POST" enctype="multipart/form-data">
                        <div class="modal-body">
                           <div class="mb-1">
                              <input type="text" class="form-control mt-3" id="recipient-name" autocomplete="off" name="nama_baru" placeholder="Nama">
                              <input type="text" class="form-control mt-3" id="recipient-name" autocomplete="off" name="spesialisasi_baru" placeholder="Spesialisasi">
                              <input type="text" class="form-control mt-3" id="recipient-name" autocomplete="off" name="username_baru" placeholder="masukkan username">
                              <input type="text" class="form-control mt-3" id="recipient-name" autocomplete="off" name="password_baru" placeholder="masukkan password">
                              <input type="file" class="form-control mt-3" id="recipient-name" autocomplete="off" name="foto_baru" placeholder="">
                           </div>
                        </div>
                        <div class="modal-footer">
                           <input type="submit" class="btn btn-primary" name="regist" value="Submit">
                        </div>
                     </form>
                     <?php
                     // include_once("db.php");
                     if (isset($_POST["regist"])) {
                        $nama_baru = $_POST['nama_baru'];
                        $spesialisasi_baru = $_POST['spesialisasi_baru'];
                        $username_baru = $_POST['username_baru'];
                        $password_baru = $_POST['password_baru'];
                        $foto_baru = $_POST['foto_baru'];

                        $filename1 = $_FILES['foto_baru']['name'];
                        $tmp_name1 = $_FILES['foto_baru']['tmp_name'];
                        $ukuran1 = $_FILES['foto_baru']['size'];
                        $type1 = explode('.', $filename1); // file kegiatan pembelajaran
                        $type2 = $type1[1];
                        $newname1 = $author . 'foto' . '1' . time() . '.' . $type2;
                        $tipe_diizinkan = array('jpg', 'jpeg', 'png', '');
                        $maxsize = 5120000;

                        if (in_array($type2, $tipe_diizinkan) === true) {
                           if ($ukuran1 < $maxsize) {
                              $cek_regist = mysqli_query($conn, "SELECT * FROM konselor WHERE username = '$username_baru'");
                              if (mysqli_num_rows($cek_regist) < 1) {
                                 $dest = "./foto/" . $_FILES['foto_1']['name'];
                                 move_uploaded_file($tmp_name1, './foto/' . $newname1);
                                 $get_regist = mysqli_query($conn, "INSERT INTO konselor VALUE(
                                    null,
                                    '" . $username_baru . "',
                                    '" . $password_baru . "',
                                    '" . $nama_baru . "',
                                    '" . $spesialisasi_baru . "',
                                    '" . $newname1 . "'
                                 )");
                                 if ($get_regist) {
                                    echo '<script>alert("akun berhasil dibuat")</script>';
                                    echo "<script>window.location='index.php';</script>";
                                 } else {
                                    echo '<script>alert("akun gagal dibuat")</script>';
                                 }
                              } else {
                                 echo '<script>alert("Gagal, akun sudah terdaftar")</script>';
                              }
                           } else {
                              echo '<script>alert("ukuran terlalu besar!")</script>';
                           }
                        } else {
                           echo '<script>alert("tipe file tidak sesuai!")</script>';
                        }
                     }
                     ?>
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
   <script src="../../bootstrap/js/bootstrap.min.js"></script>
   <script src="../vendors/js/vendor.bundle.base.js"></script>
   <!-- endinject -->
   <!-- Plugin js for this page -->
   <script src="../vendors/chart.js/Chart.min.js"></script>
   <script src="../vendors/datatables.net/jquery.dataTables.js"></script>
   <script src="../vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
   <script src="../js/dataTables.select.min.js"></script>

   <!-- End plugin js for this page -->
   <!-- inject:js -->
   <script src="../js/off-canvas.js"></script>
   <script src="../js/hoverable-collapse.js"></script>
   <script src="../js/template.js"></script>
   <script src="../js/settings.js"></script>
   <script src="../js/todolist.js"></script>
   <!-- endinject -->
   <!-- Custom js for this page-->
   <script src="../js/dashboard.js"></script>
   <script src="../js/Chart.roundedBarCharts.js"></script>
   <!-- End custom js for this page-->
</body>

</html>