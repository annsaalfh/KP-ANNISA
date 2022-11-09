<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login AGEN</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
  </head>

  <style type="text/css">
    body {
      background-image: url(assets/images/ContourLine.svg);
      background-repeat: no-repeat;
      background-size: 100% 100%;
    }
  </style>

  <body class="" id="body">
      <div class="container-fluid d-flex align-items-center justify-content-center vh-100">
          <div class="row justify-content-center">
            <div class="card">
              <div class="card-body p-3">
                <div class="auth-form-light text-left p-3">
                <center><h2>LOGIN</h2></center>
              <?php
                if(isset($_GET['pesan'])){
                  if($_GET['pesan'] == "gagal"){
                    echo "<div class='alert alert-danger'> Username dan password salah.</div>";
                  }else if($_GET['pesan'] == "logout"){
                    echo "<div class='alert alert-warning'> Anda telah berhasil logout</div>";
                  }else if($_GET['pesan'] == "belum_login"){
                    echo "<div class='alert alert-danger'> Anda Harus Login dulu!! </div>";
                  }else if($_GET['pesan'] == "pengguna"){
                    echo "<div class='alert alert-warning'> Tidak ada data pengguna.</div>";
                  }
                }
                ?>
                <form class="pt-3" method="POST" action="cek_login.php">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" name="username" id="exampleInputEmail1" placeholder="Username">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" name="password" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="mt-3">
                    <button type="submit" class="btn btn-block btn-info btn-lg font-weight-medium auth-form-btn">Sign In</button>
                  </div>
                </form>
              </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
  </body>
</html>