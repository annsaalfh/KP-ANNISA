<?php
session_start();

if (!$_SESSION["username"]) {
  header('location:login.php?pesan=belum_login');
}

$id_user = $_SESSION["id_user"];
$username = $_SESSION["username"];
$nama = $_SESSION["nama"];
$sesi = $_SESSION["status"];
$tgl_skrng = date("Y-m-d");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Halaman Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" type="text/css" href="../assets/datatables/DataTables-1.11.5/css/dataTables.bootstrap4.css">
  <!-- End plugin css for this page -->

  <!-- Include library Bootstrap Datepicker -->
  <link href="../assets/libraries/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet">
  <!-- Include library Font Awesome (Dibutuhkan Datepicker) -->
  <link href="../assets/libraries/fontawesome/css/all.min.css" rel="stylesheet">
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <!-- Include File jQuery -->
  <script src="../assets/js/jquery.min.js"></script>
  <!-- End layout styles -->
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" style="height: 80px;" href="#"><img style="height: 80px;" src="../assets/images/1STlogo.svg" alt="logo"></a>
        <!-- <a class="navbar-brand" style="height: 40px;" rel="home" href="#" title="Buy Sell Rent Everyting">
          <img style="max-width:1000px; margin-top: 10px;" src="../assets/images/1STlogo.svg">
        </a> -->
        <!-- <a class="navbar-brand" href="#">
          <img src="../assets/images/STlogo.png">
        </a> -->
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <div class="nav-profile-text">
                <p class="mb-1 text-black"><?php echo $nama; ?> <?php echo $sesi == '1' ? '( Owner )' : '( Staff )'; ?></p>
              </div>
            </a>
            <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" data-toggle="modal" data-target="#ubahuser<?php echo $id_user; ?>">
                <!-- ubah -->
                <!-- <div class="modal fade" id="ubahuser<?php echo $id_user; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <form method="post" action="admin/function_user.php">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form method="post" action="admin/function_user.php">
                            <div class="form-group">
                              <label for="iduser">ID User</label>
                              <input type="text" class="form-control" placeholder="<?php echo $d['id_user']; ?>" id="iduser" placeholder="<?php echo $kodeuser; ?>" disabled>
                              <input type="text" name="id_user" value="<?php echo $d['id_user']; ?>" class="form-control" hidden>
                            </div>
                            <div class="form-group">
                              <label for="nuser">Nama User</label>
                              <input type="Text" value="<?php echo $d['nama']; ?>" class="form-control" name="nama" id="nuser" placeholder="Nama User">
                            </div>
                            <div class="form-group">
                              <label for="user">Username</label>
                              <input type="Text" value="<?php echo $d['username']; ?>" class="form-control" name="username" id="user" placeholder="Username">
                            </div>
                            <div class="form-group">
                              <label for="pass">Password</label>
                              <input type="password" value="<?php echo $d['password']; ?>" class="form-control" name="password" id="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                              <label for="nstatus">Status</label>
                              <select name="status" class="form-control" id="nstatus" required>
                                <option> -Pilih- </option>
                                <option value="1" <?php if ($d['status'] == '1') echo "selected"; ?>>Admin</option>
                                <option value="2" <?php if ($d['status'] == '2') echo "selected"; ?>>Owner</option>
                              </select>
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" name="update_user" class="btn btn-primary">Simpan</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div> -->
                <i class="mdi mdi-account mr-2 text-success"></i> Profil
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="../logout.php">
                <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
            </div>
          </li>
        </ul>
        <ul></ul>
        <ul></ul>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php?halaman=dashboard">
              <span class="menu-title">Dashboard</span>
              <i class="mdi mdi-home menu-icon"></i>
            </a>
          </li>
          <?php if ($_SESSION['status'] == '1') { ?>
            <li class="nav-item">
              <a class="nav-link" href="index.php?halaman=kategori">
                <span class="menu-title">Kategori</span>
                <i class="mdi mdi-file-tree menu-icon"></i>
              </a>
            </li>
          <?php } ?>
          <?php if ($_SESSION['status'] == '1') { ?>
            <li class="nav-item">
              <a class="nav-link" href="index.php?halaman=satuan">
                <span class="menu-title">Satuan</span>
                <i class="mdi mdi-cube menu-icon"></i>
              </a>
            </li>
          <?php } ?>
          <li class="nav-item">
            <a class="nav-link collapsed" data-toggle="collapse" data-target="#ui-basic" href="#ui-basic" aria-expanded="true" aria-controls="ui-basic">
              <span class="menu-title">Data</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-database menu-icon"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link " href="index.php?halaman=barang">Barang</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="index.php?halaman=supplier">Supplier</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="index.php?halaman=user">User</a>
                </li>
              </ul>
            </div>
          </li>
          <!-- <?php if ($_SESSION['status'] == '2') { ?>
            <li class="nav-item">
              <a class="nav-link" href="index.php?halaman=user">
                <span class="menu-title">User</span>
                <i class="mdi mdi-account menu-icon"></i>
              </a>
            </li>
          <?php } ?> -->
          <li class="nav-item">
            <a class="nav-link" href="index.php?halaman=barang_masuk">
              <span class="menu-title">Barang Masuk</span>
              <i class="mdi mdi-package-down menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php?halaman=barang_keluar">
              <span class="menu-title">Barang Keluar</span>
              <i class="mdi mdi-package-up menu-icon"></i>
            </a>
          </li>
          <?php if ($_SESSION['status'] == '1') { ?>
            <li class="nav-item">
              <a class="nav-link collapsed" data-toggle="collapse" data-target="#ui-basic" href="#ui-basic" aria-expanded="true" aria-controls="ui-basic">
                <span class="menu-title">Laporan Barang</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-file-document menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link " href="index.php?halaman=laporan_brgkeluar">Laporan Barang Keluar</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="index.php?halaman=laporan_brgmasuk">Laporang Barang Masuk</a>
                  </li>
                </ul>
              </div>
            </li>
          <?php } ?>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <?php
          if (isset($_GET['halaman'])) {
            $halaman = $_GET['halaman'];
            switch ($halaman) {
              case 'user':
                include "admin/user.php";
                break;
              case 'barang':
                include "barang/barang.php";
                break;
              case 'kategori':
                include "jenis/kategori.php";
                break;
              case 'supplier':
                include "barang/supplier.php";
                break;
              case 'barang_masuk':
                include "barang/barang_masuk.php";
                break;
              case 'barang_keluar':
                include "barang/barang_keluar.php";
                break;
              case 'satuan':
                include "jenis/satuan.php";
                break;
              case 'laporan_brgkeluar':
                include "laporan/lap_brgkel.php";
                break;
              case 'laporan_brgmasuk':
                include "laporan/lap_brgmsk.php";
                break;
              default:
                echo '<script language="javascript">';
                echo 'alert("Maaf. Halaman tidak di temukan !")';
                echo '</script>';
              case 'dashboard';
                include "admin/dashboard.php";
                break;
            }
          } else {
            include "admin/dashboard.php";
          }
          ?>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2020</span>
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
  <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
  <script type="text/javascript" src="../assets/datatables/DataTables-1.11.5/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="../assets/datatables/DataTables-1.11.5/js/dataTables.bootstrap.js"></script>
  <script type="text/javascript" src="../assets/datatables/DataTables-1.11.5/js/dataTables.bootstrap4.min.js"></script>
  <script type="text/javascript" src="../assets/library/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../assets/vendors/chart.js/Chart.min.js"></script>
  <script src="../assets/js/chart.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../assets/js/off-canvas.js"></script>
  <script src="../assets/js/hoverable-collapse.js"></script>
  <script src="../assets/js/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <script src="../assets/js/dashboard.js"></script>
  <script src="../assets/js/todolist.js"></script>

  <!-- Include library Moment (Dibutuhkan untuk Datepicker) -->
  <script src="../assets/libraries/moment/moment.min.js"></script>
  <!-- Include library Bootstrap Datepicker -->
  <script src="../assets/libraries/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Include File JS Custom (untuk fungsi Datepicker) -->
  <script src="../assets/js/custom.js"></script>
  <!-- End custom js for this page -->


  <script>
    $(document).ready(function() {
      setDateRangePicker(".tgl_awal", ".tgl_akhir")
    })
  </script>
  <script>
    $(document).ready(function() {
      $('#example').DataTable();
    });
  </script>
  <script>
    function onlyNumberKey(evt) {

      // Only ASCII character in that range allowed
      var ASCIICode = (evt.which) ? evt.which : evt.keyCode
      if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false;
      return true;
    }
  </script>
  <script>
    function startCalc() {

      interval = setInterval("calc()", 1);
    }

    function calc() {

      one = document.autoSumForm.harga.value;

      two = document.autoSumForm.jumlah.value;

      document.autoSumForm.total_harga.value = one * two;
    }

    function stopCalc() {

      clearInterval(interval);
    }
  </script>
  <script type="text/javascript">
    <?php echo $jsArray; ?>

    function changeValue(x) {
      document.getElementById('harga').value = prdHarga[x].harga;
    };
  </script>
</body>

</html>