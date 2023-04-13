<?php
require('database/db.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>

<body>
  <section class="vh-100" style="background-color: rgba(2,11,133,1);">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <a href="index.html" style="color:white;"> << kembali</a>
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">
                <img src="images/logo-UNJ.png" alt="" class="align-center" width="150px">

              <h3 class="mb-5">Login</h3>

              <form action="" method="POST">
                <div class="form-outline mb-4">
                  <input type="username" id="typeEmailX-2" class="form-control form-control-lg" name="username" placeholder="username" required />
                </div>

                <div class="form-outline mb-4">
                  <input type="password" id="typePasswordX-2" class="form-control form-control-lg" name="password" placeholder="password" required />
                </div>

                <div class="login">
                  <button class="btn btn-warning btn-lg btn-block" name="submit" type="submit">Masuk</button><br>
                </div>
                <button type="button" style="background: none;border:none;" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">Daftar</button>
              </form>
              <!-- tanggapan -->
              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h6>Registrasi Pengguna</h6>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST">
                      <div class="modal-body">
                        <div class="mb-3">
                          <label for="recipient-name" class="col-form-label"></label>
                          <input type="text" class="form-control mt-3" id="recipient-name" autocomplete="off" name="nama_baru" placeholder="Nama">
                          <input type="text" class="form-control mt-3" id="recipient-name" autocomplete="off" name="telp_baru" placeholder="Nomor HP">
                          <input type="text" class="form-control mt-3" id="recipient-name" autocomplete="off" name="username_baru" placeholder="masukkan username">
                          <input type="text" class="form-control mt-3" id="recipient-name" autocomplete="off" name="password_baru" placeholder="masukkan password">
                        </div>
                      </div>
                      <div class="modal-footer">
                        <input type="submit" class="btn btn-primary" name="regist" value="registrasi">
                      </div>
                    </form>
                    <?php
                    // include_once("db.php");
                    if (isset($_POST["regist"])) {
                      $nama_baru = $_POST['nama_baru'];
                      $no_telp = $_POST['telp_baru'];
                      $username_baru = $_POST['username_baru'];
                      $password_baru = $_POST['password_baru'];
                      $cek_regist = mysqli_query($conn, "SELECT * FROM pengguna_konseling WHERE username = '$username_baru'");
                      if (mysqli_num_rows($cek_regist) < 1) {
                        $get_regist = mysqli_query($conn, "INSERT INTO pengguna_konseling VALUE(
                                null,
                                '" . $username_baru . "',
                                '" . $password_baru . "',
                                '" . $nama_baru . "',
                                '" . $no_telp . "'
                            )");
                        if ($get_regist) {
                          echo '<script>alert("akun berhasil dibuat")</script>';
                        } else {
                          echo '<script>alert("akun gagal dibuat")</script>';
                        }
                      } else {
                        echo '<script>alert("Gagal, akun sudah terdaftar")</script>';
                      }
                    }
                    ?>
                  </div>
                </div>
              </div>
              <?php
              if (isset($_POST["submit"])) {
                $username = $_POST['username'];
                $password = $_POST['password'];

                if ($username != "" && $password != "") {
                  $ambil_admin = mysqli_query($conn, "SELECT * FROM admin WHERE username = '$username' AND password = '$password'");
                  $ambil_konseling = mysqli_query($conn, "SELECT * FROM pengguna_konseling WHERE username = '$username' AND password = '$password'");
                  $ambil_konselor = mysqli_query($conn, "SELECT * FROM konselor WHERE username_konselor = '$username' AND password = '$password'");
                  $akunadmin = mysqli_num_rows($ambil_admin);
                  $akunkonseling = mysqli_num_rows($ambil_konseling);
                  $akunkonselor = mysqli_num_rows($ambil_konselor);
                  if ($akunadmin == 1) {
                    $admin = $ambil_admin->fetch_assoc();
                    $_SESSION["admin"] = $admin;
                    echo "<script>location='app/admin/index.php';</script>";
                  } elseif ($akunkonseling == 1) {
                    $konseling = $ambil_konseling->fetch_assoc();
                    $_SESSION["konseling"] = $konseling;
                    echo "<script>location='app/pengguna_konseling/index.php';</script>";
                  } elseif ($akunkonselor == 1) {
                    $konselor = $ambil_konselor->fetch_assoc();
                    $_SESSION["konselor"] = $konselor;
                    echo "<script>location='app/konselor/index.php';</script>";
                  } else {
              ?>

                    <div class="alert alert-danger alert-dismissible alert-atas"><img src="icons/exclamation-circle-fill.svg" alt="" style="margin-bottom: 3px;"> tidak dapat login, Email atau password salah
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="close"></button>
                    </div>

              <?php
                  }
                }
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="js/bootstrap.min.js"></script>
</body>

</html>