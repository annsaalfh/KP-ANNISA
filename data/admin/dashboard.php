<div class="page-header">
  <h3 class="page-title"> Dashboard </h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Awal</li>
    </ol>
  </nav>
</div>
<div class="row">
  <?php
  // menghubungkan dengan koneksi database
  include '../config/database.php';
  // mengambil data pada tabel
  $data_barang = mysqli_query($kon, "SELECT * FROM barang");
  $data_masuk = mysqli_query($kon, "SELECT * FROM barang_masuk");
  $data_keluar = mysqli_query($kon, "SELECT * FROM barang_keluar");
  // menghitung data pada tabel
  $jumlah_barang = mysqli_num_rows($data_barang);
  $jumlah_masuk = mysqli_num_rows($data_masuk);
  $jumlah_keluar = mysqli_num_rows($data_keluar);
  ?>
  <div class="col-md-4 stretch-card grid-margin">
    <div class="card bg-danger card-img-holder text-white">
      <div class="card-body">
        <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
        <h4 class="font-weight-normal mb-3">Jumlah Barang <i class="mdi mdi-package-variant-closed mdi-24px float-right"></i>
        </h4>
        <h2 class="mb-5"><?php echo $jumlah_barang; ?></h2>
      </div>
    </div>
  </div>
  <div class="col-md-4 stretch-card grid-margin">
    <div class="card bg-info card-img-holder text-white">
      <div class="card-body">
        <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
        <h4 class="font-weight-normal mb-3">Jumlah Data Masuk <i class="mdi mdi-package-down mdi-24px float-right"></i>
        </h4>
        <h2 class="mb-5"><?php echo $jumlah_masuk; ?></h2>
      </div>
    </div>
  </div>
  <div class="col-md-4 stretch-card grid-margin">
    <div class="card bg-success card-img-holder text-white">
      <div class="card-body">
        <img src="../assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image">
        <h4 class="font-weight-normal mb-3">Jumlah Data Keluar <i class="mdi mdi-package-up mdi-24px float-right"></i>
        </h4>
        <h2 class="mb-5"><?php echo $jumlah_keluar; ?></h2>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-7 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Jumlah Barang Hampir Habis</h4>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th> # </th>
                <th> Nama Barang</th>
                <th> Stock</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include '../config/database.php';
              $no = 1;
              $data = mysqli_query($kon, "SELECT * FROM barang WHERE stock < 10 LIMIT 5");
              while ($d = mysqli_fetch_array($data)) {

              ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $d['nama_barang']; ?></td>
                  <td align="center"><?php echo $d['stock']; ?></td>
                </tr>
              <?php
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- <div class="col-md-5 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Pie chart</h4>
        <canvas id="pieChart" style="height:250px"></canvas>
      </div>

    </div>
  </div> -->
  <!-- <div class="col-md-5 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title text-black">Todo</h4>
        <div class="add-items d-flex">
          <input type="text" class="form-control todo-list-input" placeholder="What do you need to do today?">
          <button class="add btn btn-gradient-primary font-weight-bold todo-list-add-btn" id="add-task">Add</button>
        </div>
        <div class="list-wrapper">
          <ul class="d-flex flex-column-reverse todo-list todo-list-custom">
            <li>
              <div class="form-check">
                <label class="form-check-label">
                  <input class="checkbox" type="checkbox"> Meeting with Alisa <i class="input-helper"></i></label>
              </div>
              <i class="remove mdi mdi-close-circle-outline"></i>
            </li>
            <li class="completed">
              <div class="form-check">
                <label class="form-check-label">
                  <input class="checkbox" type="checkbox" checked=""> Call John <i class="input-helper"></i></label>
              </div>
              <i class="remove mdi mdi-close-circle-outline"></i>
            </li>
            <li>
              <div class="form-check">
                <label class="form-check-label">
                  <input class="checkbox" type="checkbox"> Create invoice <i class="input-helper"></i></label>
              </div>
              <i class="remove mdi mdi-close-circle-outline"></i>
            </li>
            <li>
              <div class="form-check">
                <label class="form-check-label">
                  <input class="checkbox" type="checkbox"> Print Statements <i class="input-helper"></i></label>
              </div>
              <i class="remove mdi mdi-close-circle-outline"></i>
            </li>
            <li class="completed">
              <div class="form-check">
                <label class="form-check-label">
                  <input class="checkbox" type="checkbox" checked=""> Prepare for presentation <i class="input-helper"></i></label>
              </div>
              <i class="remove mdi mdi-close-circle-outline"></i>
            </li>
            <li>
              <div class="form-check">
                <label class="form-check-label">
                  <input class="checkbox" type="checkbox"> Pick up kids from school <i class="input-helper"></i></label>
              </div>
              <i class="remove mdi mdi-close-circle-outline"></i>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="row">

  </div> -->
</div>