<div class="page-header">
  <h3 class="page-title"> Barang Keluar </h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Data</a></li>
      <li class="breadcrumb-item active" aria-current="page">Barang Keluar</li>
    </ol>
  </nav>
</div>
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <form method="post" action="index.php?halaman=barang_keluar">
        <?php
        if (isset($_GET['tambah'])) {
          //Mengecek nilai variabel tambah
          if ($_GET['tambah'] == 'berhasil') {
            echo "<div class='alert alert-success'><strong>Berhasil!</strong> tambah data alumni telah di tambahkan!
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
            echo "<div class='alert alert-success'><strong>Berhasil!</strong> mengubah data alumni!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button></div>";
          } else if ($_GET['ubah'] == 'gagal') {
            echo "<div class='alert alert-dismissible fade show alert-danger' role='alert'><strong>Gagal!</strong> mengubah data alumni!
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button></div>";
            echo "ERROR, data gagal dihapus" . mysqli_error($kon);
          }
        }
        ?>
        <?php
        // menghubungkan dengan koneksi database
        include '../config/database.php';
        // mengambil data pada

        $terjual = mysqli_fetch_assoc(mysqli_query($kon, "SELECT SUM(jumlah_keluar) as jmlh FROM barang_keluar"));
        $penjualan = mysqli_fetch_assoc(mysqli_query($kon, "SELECT SUM(barang_keluar.jumlah_keluar*barang.harga_beli) as jual FROM barang_keluar INNER JOIN barang on barang.id_barang = barang_keluar.id_barang"));
        $total_dapat = mysqli_fetch_assoc(mysqli_query($kon, "SELECT SUM(total_harga-barang_keluar.jumlah_keluar*barang.harga_beli) as ttldpt FROM barang_keluar INNER JOIN barang on barang.id_barang = barang_keluar.id_barang"));
        $total = mysqli_fetch_assoc(mysqli_query($kon, "SELECT SUM(total_harga) as ttl FROM barang_keluar"));
        ?>
        <div class="row">
          <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-danger text-white">
              <div class="card-body">
                <p class="font-weight-small mb-2">Terjual</p>
                <h4 class="mb-0"><?php echo ($terjual['jmlh']); ?></h4>
              </div>
            </div>
          </div>
          <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-danger text-white">
              <div class="card-body">
                <p class="font-weight-small mb-2">Pendapatan</p>
                <h4 class="mb-0">Rp.<?php echo ($total_dapat['ttldpt']); ?></h4>
              </div>
            </div>
          </div>
          <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-danger text-white">
              <div class="card-body">
                <p class="font-weight-small mb-2">Penjualan</p>
                <h4 class="mb-0">Rp.<?php echo ($penjualan['jual']); ?></h4>
              </div>
            </div>
          </div>
          <div class="col-md-3 stretch-card grid-margin">
            <div class="card bg-danger text-white">
              <div class="card-body">
                <p class="font-weight-small mb-2">Total</p>
                <h4 class="mb-0">Rp.<?php echo ($total['ttl']); ?></h4>
              </div>
            </div>
          </div>
        </div>
        <button type="button" class="btn btn-success btn-fw btn-icon-text" data-toggle="modal" data-target="#tambahbrgkeluar"><i class="mdi mdi-plus-circle btn-icon-prepend"></i>Tambah</button>
        <br>
        <br>
        <div class="table-responsive">
          <table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th> ID </th>
                <th> Tanggal Keluar </th>
                <th> Nama Barang </th>
                <th> Qty </th>
                <th> Total </th>
                <th> Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include '../config/database.php';
              $no = 1;
              $data = mysqli_query($kon, "SELECT *
          FROM barang_keluar
          INNER JOIN barang on barang.id_barang = barang_keluar.id_barang");
              while ($d = mysqli_fetch_array($data)) {
              ?>
                <tr>
                  <td><?php echo $d['id_brgkeluar']; ?></td>
                  <td><?php echo $d['tgl_keluar']; ?></td>
                  <td><?php echo $d['nama_barang']; ?></td>
                  <td><?php echo $d['jumlah_keluar']; ?></td>
                  <td>Rp.<?php echo $d['total_harga']; ?></td>
                  <td><button type="button" class="btn btn-info btn-icon" data-toggle="modal" data-target="#ubahbrgkeluar<?php echo $d['id_brgkeluar']; ?>">
                      <i class="mdi mdi-pencil"></i>
                    </button>
                    <!-- <a href="barang/cetak_brgkeluar&id_brgkeluar=<?php echo $d['id_brgkeluar']; ?>" type="button" class="btn btn-warning btn-icon"><i class="mdi mdi-printer"></i></a> -->
                    <button type="button" class="btn btn-warning btn-icon" data-toggle="modal" data-target="#cetak<?php echo $d['id_brgkeluar']; ?>">
                      <i class="mdi mdi-printer"></i>
                    </button>
                    <?php if ($_SESSION['status'] == '1') { ?><button type="button" class="btn btn-danger btn-icon" data-toggle="modal" data-target="#hapusbrgkeluar<?php echo $d['id_brgkeluar']; ?>">
                        <i class="mdi mdi-delete"></i>
                      </button><?php } ?>
                  </td>
                </tr>
                <!-- Modal -->
                <div class="modal fade" id="hapusbrgkeluar<?php echo $d['id_brgkeluar']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Apakah anda ingin menghapus data dengan ID Barang Masuk : "<?php echo $d['id_brgkeluar']; ?>" ?
                        <input type="Text" name="idbarang" value="<?php echo $d['id_barang']; ?>" hidden>
                        <input type="Text" name="jumlah_keluar" value="<?php echo $d['jumlah_keluar']; ?>" hidden>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a href="barang/function_brgkeluar.php?halaman=deletebrgkeluar&id_brgkeluar=<?php echo $d['id_brgkeluar']; ?>" class="btn btn-primary btn-pill">Hapus</a>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="cetak<?php echo $d['id_brgkeluar']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cetak</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Apakah anda ingin mencetak data dengan ID Barang Keluar : "<?php echo $d['id_brgkeluar']; ?>" ?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a href="barang/cetak_brgkeluar.php?halaman=cetak&id_brgkeluar=<?php echo $d['id_brgkeluar']; ?>" target="_blank" class="btn btn-primary btn-pill">Cetak</a>
                      </div>
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
<div class="modal fade" id="tambahbrgkeluar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post" name="autoSumForm" action="barang/function_brgkeluar.php">
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
          $query = mysqli_query($kon, "SELECT max(id_brgkeluar) as kodeTerbesar FROM barang_keluar");
          $data = mysqli_fetch_array($query);
          $id_brgkeluar = $data['kodeTerbesar'];
          $id_brgkeluarurut = (int) substr($id_brgkeluar, 3, 3);
          $id_brgkeluarurut++;
          $huruf = "BK";
          $kodesupplier = $huruf . sprintf("%03s", $id_brgkeluarurut);
          ?>
          <div class="form-group">
            <label for="iduser">ID Supplier</label>
            <input type="text" class="form-control" placeholder="<?php echo $kodesupplier; ?>" disabled>
            <input type="text" name="id_brgkeluar" value="<?php echo $kodesupplier; ?>" class="form-control" hidden>
            <input type="text" name="iduser" value="<?php echo $id_user; ?>" class="form-control" hidden>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="user">Barang</label>
                <select name="idbarang" class="form-control" onchange="changeValue(this.value)" name="id_barang" id="id_barang">
                  <option> - </option>
                  <?php
                  include '../config/database.php';
                  $data_barang = mysqli_query($kon, "SELECT * FROM barang");
                  $jsArray = "var prdHarga = new Array();\n";
                  while ($d = mysqli_fetch_array($data_barang)) {
                    echo '<option value="' . $d['id_barang'] . '">' . $d['nama_barang'] . '</option>';
                    $jsArray .= "prdHarga['" . $d['id_barang'] . "'] = {harga:'" . addslashes($d['harga']) . "'};\n";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="namas">Harga barang</label>
                <input type="Text" class="form-control" id="harga" name="harga" onFocus="startCalc();" onBlur="stopCalc();" placeholder="Jumlah" disabled>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="namas">Jumlah Barang Keluar</label>
                <input type="Number" class="form-control" name="jumlah_keluar" onFocus="startCalc();" onBlur="stopCalc();" id="jumlah" placeholder="Jumlah">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="namas">Tanggal Masuk</label>
                <input type="date" class="form-control" value="<?php echo $tgl_skrng; ?>" name="tgl_keluar" id="namas" placeholder="Tanggal">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="namas">Total</label>
                <input type="Number" value="total_harga" class="form-control" name="total_harga" id="total_harga" placeholder="Jumlah" readonly>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="tambah_brgkeluar" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>