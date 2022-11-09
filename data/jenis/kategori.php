<div class="page-header">
  <h3 class="page-title"> Kategori </h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Data</a></li>
      <li class="breadcrumb-item active" aria-current="page">Kategori</li>
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
        <button type="button" class="btn btn-success btn-fw btn-icon-text" data-toggle="modal" data-target="#tambahkategori"><i class="mdi mdi-plus-circle btn-icon-prepend"></i>Tambah</button>
        <br>
        <br>
        <table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th> ID </th>
              <th> Nama Kategori </th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include '../config/database.php';
            $no = 1;
            $data = mysqli_query($kon, "select * from kategori");
            while ($d = mysqli_fetch_array($data)) {
            ?>
              <tr>
                <td><?php echo $d['id_kategori']; ?></td>
                <td><?php echo $d['nama_kategori']; ?></td>
                <td><?php if ($_SESSION['status'] == '1') { ?><button type="button" class="btn btn-danger btn-icon" data-toggle="modal" data-target="#deletekategori<?php echo $d['id_kategori']; ?>">
                      <i class="mdi mdi-delete"><?php } ?></i>
                    </button></td>
              </tr>

              <!-- Modal -->
              <div class="modal fade" id="deletekategori<?php echo $d['id_kategori']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Delete Kategori</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Apakah anda ingin menghapus "<?php echo $d['nama_kategori']; ?>" ?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">Close</button>
                      <a href="jenis/function_kategori.php?halaman=deletekategori&id_kategori=<?php echo $d['id_kategori']; ?>" class="btn btn-primary btn-pill">Hapus</a>
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
<div class="modal fade" id="tambahkategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post" action="jenis/function_kategori.php">
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
                  $data_kategori = mysqli_query($kon, "SELECT * FROM kategori ORDER BY id_kategori DESC LIMIT 1");
                  $jumlah_kategori = mysqli_num_rows($data_kategori);
                  $d = mysqli_fetch_array($data_kategori);
                  if ($jumlah_kategori <= 0) {
                    $nobaru = 1;
                  } else {
                    $nobaru = $d['id_kategori'] + 1;
                  }
                  ?>
                  <label for="idj">ID Kategori</label>
                  <input type="text" class="form-control" placeholder="<?php echo $nobaru; ?>" disabled>
                  <input type="text" class="form-control" name="id_kategori" id="idj" value="<?php echo $nobaru; ?>" placeholder="<?php echo $nobaru; ?>" hidden>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="namas">Nama Kategori</label>
                  <input type="Text" class="form-control" name="nama_kategori" id="namas" placeholder="Nama Kategori">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" name="tambah_kategori" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>