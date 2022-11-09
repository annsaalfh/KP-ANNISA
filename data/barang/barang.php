<div class="page-header">
  <h3 class="page-title"> Barang </h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Data</a></li>
      <li class="breadcrumb-item active" aria-current="page">Barang</li>
    </ol>
  </nav>
</div>
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <form method="post" action="index.php?halaman=barang">
        <?php
        if (isset($_GET['tambah'])) {
          //Mengecek nilai variabel tambah
          if ($_GET['tambah'] == 'berhasil') {
            echo "<div class='alert alert-success'><strong>Berhasil!</strong> tambah data telah di tambahkan!
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button></div>";
          } else if ($_GET['tambah'] == 'gagal') {
            echo "<div class='alert alert-dismissible fade show alert-danger' role='alert'><strong>Gagal!</strong> data gagal di tambah!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button></div>";
          }
        }
        if (isset($_GET['hapus'])) {
          //Mengecek nilai variabel hapus
          if ($_GET['hapus'] == 'berhasil') {
            echo "<div class='alert alert-success'><strong>Berhasil!</strong> data telah di hapus!
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button></div>";
          } else if ($_GET['hapus'] == 'gagal') {
            echo "<div class='alert alert-dismissible fade show alert-danger' role='alert'><strong>Gagal!</strong> data gagal di hapus!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button></div>";
          }
        }
        if (isset($_GET['ubah'])) {
          //Mengecek nilai variabel hapus
          if ($_GET['ubah'] == 'berhasil') {
            echo "<div class='alert alert-success'><strong>Berhasil!</strong> mengubah data!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button></div>";
          } else if ($_GET['ubah'] == 'gagal') {
            echo "<div class='alert alert-dismissible fade show alert-danger' role='alert'><strong>Gagal!</strong> mengubah data!
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button></div>";
          }
        }
        ?>
        <?php if ($_SESSION['status'] == '1') { ?>
          <button type="button" class="btn btn-success btn-fw btn-icon-text" data-toggle="modal" data-target="#tambahbarang"><i class="mdi mdi-plus-circle btn-icon-prepend"></i>Tambah</button>
        <?php } ?>
        <br>
        <br>
        <table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nama Barang</th>
              <th>Stock</th>
              <th>Harga Jual</th>
              <th>Harga Beli</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include '../config/database.php';
            $no = 1;
            $data = mysqli_query($kon, "select * from barang");
            while ($d = mysqli_fetch_array($data)) {
            ?>
              <tr>
                <td><?php echo $d['id_barang']; ?></td>
                <td><?php echo $d['nama_barang']; ?></td>
                <td><?php echo $d['stock']; ?></td>
                <td><?php echo $d['harga']; ?></td>
                <td><?php echo $d['harga_beli']; ?></td>
                <td><button type="button" class="btn btn-info btn-icon" data-toggle="modal" data-target="#ubahbarang<?php echo $d['id_barang']; ?>">
                    <i class="mdi mdi-pencil"></i>
                  </button>
                  <?php if ($_SESSION['status'] == '1') { ?>
                    <button type="button" class="btn btn-danger btn-icon" data-toggle="modal" data-target="#hapusbarang<?php echo $d['id_barang']; ?>">
                      <i class="mdi mdi-delete"><?php } ?></i>
                    </button>
                </td>
              </tr>
              <!-- Modal -->
              <div class="modal fade" id="hapusbarang<?php echo $d['id_barang']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Apakah anda ingin menghapus data dengan nama Barang : "<?php echo $d['nama_barang']; ?>" ?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <a href="barang/function_barang.php?halaman=deletebarang&id_barang=<?php echo $d['id_barang']; ?>" class="btn btn-primary btn-pill">Hapus</a>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Modal -->
              <div class="modal fade" id="ubahbarang<?php echo $d['id_barang']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <form method="post" action="barang/function_barang.php">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                          <label for="iduser">ID Barang</label>
                          <input type="text" class="form-control" placeholder="<?php echo $d['id_barang']; ?>" disabled>
                          <input type="text" name="idbarang" value="<?php echo $d['id_barang']; ?>" class="form-control" hidden>
                        </div>
                        <div class="form-group">
                          <label for="nuser">Nama Barang</label>
                          <input type="Text" name="namabarang" value="<?php echo $d['nama_barang']; ?>" class="form-control" placeholder="Nama Barang">
                        </div>
                        <div class="form-group">
                          <label for="user">Kategori</label>
                          <select name="idkategori" class="form-control" id="lblkategori">
                            <option> - </option>
                            <?php
                            include '../config/database.php';
                            //Perintah sql untuk menampilkan semua data pada tabel jurusan
                            $sql = "select * from kategori";
                            $hasil = mysqli_query($kon, $sql);
                            $no = 0;
                            $kategori = $d['id_kategori'];
                            while ($ambil = mysqli_fetch_array($hasil)) {
                              $no++;
                              $ket = "";
                              if (isset($d['id_barang'])) {
                                if ($kategori == $ambil['id_kategori']) {
                                  $ket = "selected";
                                }
                              }
                            ?>
                              <option <?php echo $ket; ?> value="<?php echo $ambil['id_kategori']; ?>"><?php echo $ambil['nama_kategori']; ?></option>
                            <?php
                            }
                            ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="user">Satuan</label>
                          <select name="idsatuan" class="form-control" id="lblsatuan">
                            <option> - </option>
                            <?php
                            include '../config/database.php';
                            //Perintah sql untuk menampilkan semua data pada tabel jurusan
                            $sql = "select * from satuan";
                            $hasil = mysqli_query($kon, $sql);
                            $no = 0;
                            $satuan = $d['id_satuan'];
                            while ($ambil = mysqli_fetch_array($hasil)) {
                              $no++;
                              $ket = "";
                              if (isset($d['id_barang'])) {
                                if ($satuan == $ambil['id_satuan']) {
                                  $ket = "selected";
                                }
                              }
                            ?>
                              <option <?php echo $ket; ?> value="<?php echo $ambil['id_satuan']; ?>"><?php echo $ambil['nama_satuan']; ?></option>
                            <?php
                            }
                            ?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="nuser">Stock Barang</label>
                          <input type="Text" name="stock" value="<?php echo $d['stock']; ?>" class="form-control" placeholder="Stock Barang">
                        </div>
                        <div class="form-group">
                          <label for="nuser">Harga Jual</label>
                          <input type="Text" name="harga" value="<?php echo $d['harga']; ?>" class="form-control" placeholder="Harga Jual" <?php echo $sesi == '1' ? '' : 'readonly'; ?>>
                        </div>
                        <div class="form-group">
                          <label for="nuser">Harga Beli</label>
                          <input type="Text" name="harga_beli" value="<?php echo $d['harga_beli']; ?>" class="form-control" placeholder="Harga Beli" <?php echo $sesi == '1' ? '' : 'readonly'; ?>>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="update_barang" class="btn btn-primary">Tambah</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            <?php
            }
            ?>
            <!-- </tbody>
          <tfoot>
            <tr>
              <th>Name</th>
              <th>Position</th>
              <th>Office</th>
              <th>Age</th>
              <th>Start date</th>
            </tr>
          </tfoot> -->
        </table>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tambahbarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post" action="barang/function_barang.php">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php
          // mengambil data admin dengan kode paling besar
          include '../config/database.php';
          $query = mysqli_query($kon, "SELECT max(id_barang) as kodeTerbesar FROM barang");
          $data = mysqli_fetch_array($query);
          $id_barang = $data['kodeTerbesar'];
          $id_barangurut = (int) substr($id_barang, 3, 3);
          $id_barangurut++;
          $huruf = "BRG";
          $kodesupplier = $huruf . sprintf("%03s", $id_barangurut);
          ?>
          <div class="form-group">
            <label for="iduser">ID Barang</label>
            <input type="text" class="form-control" placeholder="<?php echo $kodesupplier; ?>" placeholder="<?php echo $kodesupplier; ?>" disabled>
            <input type="text" name="idbarang" value="<?php echo $kodesupplier; ?>" class="form-control" hidden>
          </div>
          <div class="form-group">
            <label for="nuser">Nama Barang</label>
            <input type="Text" name="namabarang" class="form-control" placeholder="Nama Barang">
          </div>
          <div class="form-group">
            <label for="user">Kategori</label>
            <select name="idkategori" class="form-control" id="lblkategori">
              <option> - </option>
              <?php
              include '../config/database.php';
              $data_kategori = mysqli_query($kon, "SELECT * FROM kategori");
              $jumlah_kategori = mysqli_num_rows($data_kategori);
              while ($d = mysqli_fetch_array($data_kategori)) {
              ?>
                <option value="<?php echo $d['id_kategori']; ?>"><?php echo $d['nama_kategori']; ?></option>
              <?php
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="user">Satuan</label>
            <select name="idsatuan" class="form-control" id="lblsatuan">
              <option> - </option>
              <?php
              include '../config/database.php';
              $data_satuan = mysqli_query($kon, "SELECT * FROM satuan");
              $jumlah_satuan = mysqli_num_rows($data_satuan);
              while ($d = mysqli_fetch_array($data_satuan)) {
              ?>
                <option value="<?php echo $d['id_satuan']; ?>"><?php echo $d['nama_satuan']; ?></option>
              <?php
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="nuser">Stock Barang</label>
            <input type="number" name="stock" class="form-control" placeholder="Stock Barang">
          </div>
          <div class="form-group">
            <label for="nuser">Harga Jual</label>
            <input type="Text" name="harga" class="form-control" placeholder="Harga Jual">
          </div>
          <div class="form-group">
            <label for="nuser">Harga Beli</label>
            <input type="Text" name="harga_beli" class="form-control" placeholder="Harga Beli">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="tambah_barang" class="btn btn-primary">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>