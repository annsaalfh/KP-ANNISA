<div class="page-header">
  <h3 class="page-title"> Barang Masuk </h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Data</a></li>
      <li class="breadcrumb-item active" aria-current="page">Barang Masuk</li>
    </ol>
  </nav>
</div>
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <form method="post" action="index.php?halaman=barang_masuk">
        <?php
        if (isset($_GET['tambah'])) {
          //Mengecek nilai variabel tambah
          if ($_GET['tambah'] == 'berhasil') {
            echo "<div class='alert alert-success'><strong>Berhasil!</strong> tambah data telah di Tambah!
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button></div>";
          } else if ($_GET['tambah'] == 'gagal') {
            echo "<div class='alert alert-dismissible fade show alert-danger' role='alert'><strong>Gagal!</strong> data gagal di Tambah!
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
        <button type="button" class="btn btn-success btn-fw btn-icon-text" data-toggle="modal" data-target="#tambahbrgmasuk"><i class="mdi mdi-plus-circle btn-icon-prepend"></i>Tambah</button>
        <br>
        <br>
        <div class="table-responsive">
          <table id="example" class="table table-striped table-bordered" cellspacing="0">
            <thead>
              <tr>
                <th> ID </th>
                <th> Tanggal Masuk </th>
                <th> Nama Supplier </th>
                <th> Nama barang </th>
                <th> Jumlah Barang Masuk </th>
                <th> Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include '../config/database.php';
              $no = 1;
              $data = mysqli_query($kon, "SELECT * FROM barang_masuk INNER JOIN supplier on supplier.id_supplier = barang_masuk.id_supplier INNER JOIN barang on barang.id_barang = barang_masuk.id_barang");
              while ($d = mysqli_fetch_array($data)) {
              ?>
                <tr>
                  <td><?php echo $d['id_brgmasuk']; ?></td>
                  <td><?php echo $d['tgl_masuk']; ?></td>
                  <td><?php echo $d['nama_supplier']; ?></td>
                  <td><?php echo $d['nama_barang']; ?></td>
                  <td><?php echo $d['jmlh_masuk']; ?></td>
                  <td><button type="button" class="btn btn-info btn-icon" data-toggle="modal" data-target="#ubahbrgmasuk<?php echo $d['id_brgmasuk']; ?>">
                      <i class="mdi mdi-pencil"></i>
                    </button>
                    <?php if ($_SESSION['status'] == '1') { ?><button type="button" class="btn btn-danger btn-icon" data-toggle="modal" data-target="#hapusbrgmasuk<?php echo $d['id_brgmasuk']; ?>">
                        <i class="mdi mdi-delete"><?php } ?></i>
                      </button>
                  </td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="hapusbrgmasuk<?php echo $d['id_brgmasuk']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Apakah anda ingin menghapus data dengan ID Barang Masuk : "<?php echo $d['id_brgmasuk']; ?>" ?
                        <input type="Text" name="idbarang" value="<?php echo $d['id_barang']; ?>" hidden>
                        <input type="Text" name="jmlh_msk" value="<?php echo $d['jmlh_masuk']; ?>" hidden>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a href="barang/function_brgmasuk.php?halaman=deletebrgmasuk&id_brgmasuk=<?php echo $d['id_brgmasuk']; ?>" class="btn btn-primary btn-pill">Hapus</a>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="ubahbrgmasuk<?php echo $d['id_brgmasuk']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <form method="post" action="barang/function_brgmasuk.php">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Ubah Barang Masuk</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                            <label for="iduser">ID Supplier</label>
                            <input type="text" class="form-control" placeholder="<?php echo $d['id_brgmasuk']; ?>" placeholder="<?php echo $kodesupplier; ?>" disabled>
                            <input type="text" name="id_brgmasuk" value="<?php echo $d['id_brgmasuk']; ?>" class="form-control" hidden>
                            <input type="text" name="iduser" value="<?php echo $id_user; ?>" class="form-control" hidden>
                          </div>
                          <div class="form-group">
                            <label for="user">Supplier</label>
                            <select name="idsupplier" class="form-control" id="lblkategori">
                              <option> - </option>
                              <?php
                              include '../config/database.php';
                              //Perintah sql untuk menampilkan semua data pada tabel jurusan
                              $sql = "select * from supplier";
                              $hasil = mysqli_query($kon, $sql);
                              $no = 0;
                              $supplier = $d['id_supplier'];
                              while ($ambil = mysqli_fetch_array($hasil)) {
                                $no++;
                                $ket = "";
                                if (isset($d['id_brgmasuk'])) {
                                  if ($supplier == $ambil['id_supplier']) {
                                    $ket = "selected";
                                  }
                                }
                              ?>
                                <option <?php echo $ket; ?> value="<?php echo $ambil['id_supplier']; ?>"><?php echo $ambil['nama_supplier']; ?></option>
                              <?php
                              }
                              ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="user">Barang</label>
                            <select name="idbarang" class="form-control" id="lblkategori">
                              <option> - </option>
                              <?php
                              include '../config/database.php';
                              //Perintah sql untuk menampilkan semua data pada tabel jurusan
                              $sql = "select * from barang";
                              $hasil = mysqli_query($kon, $sql);
                              $no = 0;
                              $barang = $d['id_barang'];
                              while ($ambil = mysqli_fetch_array($hasil)) {
                                $no++;
                                $ket = "";
                                if (isset($d['id_brgmasuk'])) {
                                  if ($barang == $ambil['id_barang']) {
                                    $ket = "selected";
                                  }
                                }
                              ?>
                                <option <?php echo $ket; ?> value="<?php echo $ambil['id_barang']; ?>"><?php echo $ambil['nama_barang']; ?></option>
                              <?php
                              }
                              ?>
                            </select>
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="namas">Jumlah Barang Masuk</label>
                                <input type="Number" class="form-control" value="<?php echo $d['jmlh_masuk']; ?>" name="jmlh_masuk" id="namas" placeholder="Jumlah">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="namas">Tanggal Masuk</label>
                                <input type="date" class="form-control" value="<?php echo $d['tgl_masuk']; ?>" name="tgl_masuk" id="namas" placeholder="Tanggal">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" name="update_brgmasuk" class="btn btn-primary">Update</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="tambahbrgmasuk" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post" action="barang/function_brgmasuk.php">
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
          $query = mysqli_query($kon, "SELECT max(id_brgmasuk) as kodeTerbesar FROM barang_masuk");
          $data = mysqli_fetch_array($query);
          $id_brgmasuk = $data['kodeTerbesar'];
          $id_brgmasukurut = (int) substr($id_brgmasuk, 3, 3);
          $id_brgmasukurut++;
          $huruf = "BM";
          $kodesupplier = $huruf . sprintf("%03s", $id_brgmasukurut);
          ?>
          <div class="form-group">
            <label for="iduser">ID Supplier</label>
            <input type="text" class="form-control" placeholder="<?php echo $kodesupplier; ?>" placeholder="<?php echo $kodesupplier; ?>" disabled>
            <input type="text" name="idbrgmasuk" value="<?php echo $kodesupplier; ?>" class="form-control" hidden>
            <input type="text" name="iduser" value="<?php echo $id_user; ?>" class="form-control" hidden>
          </div>
          <div class="form-group">
            <label for="user">Supplier</label>
            <select name="idsupplier" class="form-control" id="lblkategori">
              <option> - </option>
              <?php
              include '../config/database.php';
              $data_supplier = mysqli_query($kon, "SELECT * FROM supplier");
              $jumlah_supplier = mysqli_num_rows($data_supplier);
              while ($d = mysqli_fetch_array($data_supplier)) {
              ?>
                <option value="<?php echo $d['id_supplier']; ?>"><?php echo $d['nama_supplier']; ?></option>
              <?php
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label for="user">Barang</label>
            <select name="idbarang" class="form-control" id="lblkategori">
              <option> - </option>
              <?php
              include '../config/database.php';
              $data_barang = mysqli_query($kon, "SELECT * FROM barang");
              $jumlah_barang = mysqli_num_rows($data_barang);
              while ($d = mysqli_fetch_array($data_barang)) {
              ?>
                <option value="<?php echo $d['id_barang']; ?>"><?php echo $d['nama_barang']; ?></option>
              <?php
              }
              ?>
            </select>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="namas">Jumlah Barang Masuk</label>
                <input type="Number" class="form-control" name="jmlh_msk" id="namas" placeholder="Jumlah">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="namas">Tanggal Masuk</label>
                <input type="date" class="form-control" name="tgl_masuk" id="tgl_skrng" placeholder="Tanggal">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="tambah_brgmasuk" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>