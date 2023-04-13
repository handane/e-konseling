<?php
require('../../database/db.php');
session_start();
if (!isset($_SESSION['konseling'])) {
  echo "<script>window.location = '../../login.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>E-Konseling | Pengguna</title>
  <!-- plugins:css -->
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
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center" style="background-color: rgba(255,245,0,1); border-bottom: solid grey">

        <h3 style="color:rgba(2,11,133,1);">Konseling</h3>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end" style="background-color: rgba(2,11,133,1);">

        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile" style="color: white;"><?php echo $_SESSION['konseling']['nama_pengguna'] ?></li>
          <li class="nav-item nav-profile"><a href="logout.php" style="color: rgba(241,255,25,1)">Logout</a></li>
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
            <a href="index.php" class="nav-link" style="color:yellow; background-color:#4B49AC;">Pengajuan</a>
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
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Jadwal Konsultasi</h4>
                  <form class="forms-sample" method="POST">
                    <?php
                    $id_konselor = $_GET['id_konselor'];
                    $konsultasi = mysqli_query($conn, "SELECT * FROM konselor WHERE id_konselor = '$id_konselor'");
                    if (mysqli_num_rows($konsultasi)) {
                      while ($row = mysqli_fetch_array($konsultasi)) {
                    ?>
                        <div class="form-group">
                          <input type="hidden" name="username_konselor" value="<?php echo $row['username_konselor']; ?>">
                          <label for="exampleInputName1">Nama Konselor</label>
                          <input type="text" class="form-control" id="exampleInputName1" name="nama_konselor" value="<?php echo $row['nama'] ?>" readonly>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">Jenis Konsultasi</label>
                          <select name="jenis_konsultasi" class="form-control" id="">
                            <option value="individu (1 orang)">Individu (1 orang)</option>
                            <option value="kelompok">Kelompok</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">Tanggal Konsultasi</label>
                          <input type="date" class="form-control" id="exampleInputName1" name="tanggal_konsul">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">Jam</label>
                          <input type="time" class="form-control" id="exampleInputName1" name="jam">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">No WhatsApp</label>
                          <input type="number" class="form-control" id="exampleInputName1" name="no_wa">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">Permasalahan yang Dihadapi</label>
                          <input type="text" class="form-control" id="exampleInputName1" name="permasalahan">
                        </div>
                    <?php }
                    } ?>
                    <button type="submit" name="submit" class="btn btn-success mr-2">Ajukan</button>
                  </form>
                  <?php
                  if (isset($_POST['submit'])) {
                    $id_konseling = $_SESSION['konseling']['id_konseling'];
                    $jenis_konsul = $_POST['jenis_konsultasi'];
                    $tanggal = $_POST['tanggal_konsul'];
                    $no_wa = $_POST['no_wa'];
                    $jam = $_POST['jam'];
                    $permasalahan = $_POST['permasalahan'];
                    $status = "menunggu verifikasi";
                    $username_konselor = $_POST['username_konselor'];

                    $cek_reservasi = mysqli_query($conn, "SELECT * FROM konsultasi WHERE tanggal = '$tanggal' AND status = 'menunggu verifikasi'");
                    if (mysqli_num_rows($cek_reservasi) == 1) {
                      echo "
            <script>
            alert('konsultasi untuk tanggal " . $tanggal . " telah terisi mohon ganti tanggal lain');
            </script>";
                    } else {
                      $set_user = mysqli_query($conn, "INSERT INTO konsultasi VALUES(
               null,
               '" . $id_konselor . "',
               '" . $id_konseling . "',
               '" . $jenis_konsul . "',
               '" . $tanggal . "',
               '" . $jam . "',
               '" . $no_wa . "',
               '" . $permasalahan . "',
               '" . $status . "'
            )");

                      $cek_statistik = mysqli_query($conn, "SELECT * FROM statistik WHERE username_konselor = '$username_konselor'");
                      $cek_statistik_2 = mysqli_fetch_array($cek_statistik);
                      $akan_datang = $cek_statistik_2['akan_datang'] + 1;

                      $set_akan_datang = mysqli_query($conn, "UPDATE statistik SET 
                      akan_datang = '$akan_datang' 
                      WHERE username_konselor = '$username_konselor'");

                      if ($set_user) {
                        echo "<script>
               alert('pendaftaran konsultasi berhasil');
               window.location='akan-datang.php';
               </script>";
                      } else {
                        echo "<script>alert('gagal apply')</script>";
                      }
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
            <!-- <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021. Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span> -->
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