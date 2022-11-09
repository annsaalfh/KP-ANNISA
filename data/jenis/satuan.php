<div class="page-header">
  <h3 class="page-title"> Satuan </h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Data</a></li>
      <li class="breadcrumb-item active" aria-current="page">Satuan</li>
    </ol>
  </nav>
</div>
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <form method="post" action="index.php?halaman=satuan">
        <?php
        if (isset($_GET['tambah'])) {
          //Mengecek nilai variabel tambah
          if ($_GET['tambah'] == 'berhasil') {
            echo "<div class='alert alert-success'><strong>Berhasil!</strong> DATA telah di tambahkan!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span>
                    </button></div>";
          } else if ($_GET['tambah'] == 'gagal') {
            echo "<div class='alert alert-dismissible fade show alert-danger' role='alert'><strong>Gagal!</strong> DATA di tambahkan!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                      </button></div>";
          }
        }
        if (isset($_GET['hapus'])) {
          //Mengecek nilai variabel hapus
          if ($_GET['hapus'] == 'berhasil') {
            echo "<div class='alert alert-success'><strong>Berhasil!</strong> admin telah di hapus!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span>
                    </button></div>";
          } else if ($_GET['hapus'] == 'gagal') {
            echo "<div class='alert alert-dismissible fade show alert-danger' role='alert'><strong>Gagal!</strong> admin gagal di hapus!
                      <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span>
                    </button></div>";
          }
        }
        ?>
        <button type="button" class="btn btn-success btn-fw btn-icon-text" data-toggle="modal" data-target="#tambahsatuan"><i class="mdi mdi-plus-circle btn-icon-prepend"></i>Tambah</button>
        <br>
        <br>
        <table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th> ID </th>
              <th> Nama Satuan </th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include '../config/database.php';
            $no = 1;
            $data = mysqli_query($kon, "select * from satuan");
            while ($d = mysqli_fetch_array($data)) {
            ?>
              <tr>
                <td><?php echo $d['id_satuan']; ?></td>
                <td><?php echo $d['nama_satuan']; ?></td>
                <td><?php if ($_SESSION['status'] == '1') { ?><button type="button" class="btn btn-danger btn-icon" data-toggle="modal" data-target="#deletesatuan<?php echo $d['id_satuan']; ?>">
                      <i class="mdi mdi-delete"><?php } ?></i>
                    </button></td>
              </tr>
              <!-- Modal -->
              <div class="modal fade" id="deletesatuan<?php echo $d['id_satuan']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Delete satuan</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Apakah anda ingin menghapus "<?php echo $d['nama_satuan']; ?>" ?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">Close</button>
                      <a href="jenis/function_satuan.php?halaman=deletesatuan&id_satuan=<?php echo $d['id_satuan']; ?>" class="btn btn-primary btn-pill">Hapus</a>
                    </div>
                  </div>
                </div>
              </div>
            <?php
            }
            ?>
          </tbody>
        </table>
      </form>
    </div>
  </div>
</div>

<!-- Tambah -->
<div class="modal fade" id="tambahsatuan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post" action="jenis/function_satuan.php">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <?php
                  include '../config/database.php';
                  $data_satuan = mysqli_query($kon, "SELECT * FROM satuan ORDER BY id_satuan DESC LIMIT 1");
                  $jumlah_satuan = mysqli_num_rows($data_satuan);
                  $d = mysqli_fetch_array($data_satuan);
                  if ($jumlah_satuan <= 0) {
                    $nobaru = 1;
                  } else {
                    $nobaru = $d['id_satuan'] + 1;
                  }
                  ?>
                  <label for="idj">ID Satuan</label>
                  <input type="text" class="form-control" placeholder="<?php echo $nobaru; ?>" disabled>
                  <input type="text" class="form-control" name="id_satuan" id="idj" value="<?php echo $nobaru; ?>" placeholder="<?php echo $nobaru; ?>" hidden>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="namas">Nama Satuan</label>
                  <input type="Text" class="form-control" name="nama_satuan" id="namas" placeholder="Nama satuan">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" name="tambah_satuan" class="btn btn-primary">tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>