<div class="page-header">
  <h3 class="page-title"> Supplier </h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Data</a></li>
      <li class="breadcrumb-item active" aria-current="page">Supplier</li>
    </ol>
  </nav>
</div>
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <form method="post" action="index.php?halaman=supplier">
        <?php
        if (isset($_GET['tambah'])) {
          //Mengecek nilai variabel tambah
          if ($_GET['tambah'] == 'berhasil') {
            echo "<div class='alert alert-success'><strong>Berhasil!</strong> data telah di tambahkan!
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button></div>";
          } else if ($_GET['tambah'] == 'gagal') {
            echo "<div class='alert alert-dismissible fade show alert-danger' role='alert'><strong>Gagal!</strong> data gagal di tambahkan!
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
            echo "ERROR, data gagal dihapus" . mysqli_error($kon);
          }
        }
        ?>
        <button type="button" class="btn btn-success btn-fw btn-icon-text" data-toggle="modal" data-target="#tambahsupplier"><i class="mdi mdi-plus-circle btn-icon-prepend"></i>Tambah</button>
        <br>
        <br>
        <table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th> ID </th>
              <th> Nama Supplier </th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include '../config/database.php';
            $no = 1;
            $data = mysqli_query($kon, "select * from supplier");
            while ($d = mysqli_fetch_array($data)) {
            ?>
              <tr>
                <td><?php echo $d['id_supplier']; ?></td>
                <td><?php echo $d['nama_supplier']; ?></td>
                <td><button type="button" class="btn btn-info btn-icon" data-toggle="modal" data-target="#ubahsupplier<?php echo $d['id_supplier']; ?>">
                    <i class="mdi mdi-pencil"></i>
                  </button>
                  <?php if ($_SESSION['status'] == '1') { ?><button type="button" class="btn btn-danger btn-icon" data-toggle="modal" data-target="#hapussupplier<?php echo $d['id_supplier']; ?>">
                      <i class="mdi mdi-delete"><?php } ?></i>
                    </button>
                </td>
              </tr>
              <!-- hapus -->
              <div class="modal fade" id="hapussupplier<?php echo $d['id_supplier']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Apakah anda ingin menghapus data dengan nama supplier : "<?php echo $d['nama_supplier']; ?>" ?
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <a href="barang/function_supplier.php?halaman=deletesupplier&id_supplier=<?php echo $d['id_supplier']; ?>" class="btn btn-primary btn-pill">Hapus</a>
                    </div>
                  </div>
                </div>
              </div>

              <!-- ubah -->
              <div class="modal fade" id="ubahsupplier<?php echo $d['id_supplier']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <form method="post" action="barang/function_supplier.php">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                          <label for="iduser">ID User</label>
                          <input type="text" class="form-control" placeholder="<?php echo $d['id_supplier']; ?>" id="iduser" placeholder="<?php echo $kodeuser; ?>" disabled>
                          <input type="text" name="id_supplier" value="<?php echo $d['id_supplier']; ?>" class="form-control" hidden>
                        </div>
                        <div class="form-group">
                          <label for="nuser">Nama Supplier</label>
                          <input type="Text" value="<?php echo $d['nama_supplier']; ?>" class="form-control" name="nama_supplier" id="nuser" placeholder="Nama Supplier">
                        </div>
                        <div class="form-group">
                          <label for="user">Nomor Telepon</label>
                          <input type="tel" onkeypress="return onlyNumberKey(event)" value="<?php echo $d['no_tlpn']; ?>" name="notlpn" class="form-control" id="lblnotlpn" placeholder="081234567890" maxlength="14" required>
                        </div>
                        <div class="form-group">
                          <label for="pass">Alamat</label>
                          <textarea name="alamat" class="form-control" id="" rows="5"><?php echo $d['alamat']; ?></textarea>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="update_supplier" class="btn btn-primary">Simpan</button>
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
<div class="modal fade" id="tambahsupplier" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post" action="barang/function_supplier.php">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Supplier</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php
          // mengambil data admin dengan kode paling besar
          include '../config/database.php';
          $query = mysqli_query($kon, "SELECT max(id_supplier) as kodeTerbesar FROM supplier");
          $data = mysqli_fetch_array($query);
          $id_supplier = $data['kodeTerbesar'];
          $id_supplierurut = (int) substr($id_supplier, 3, 3);
          $id_supplierurut++;
          $huruf = "SUP";
          $kodesupplier = $huruf . sprintf("%03s", $id_supplierurut);
          ?>
          <div class="form-group">
            <label for="iduser">ID Supplier</label>
            <input type="text" class="form-control" placeholder="<?php echo $kodesupplier; ?>" placeholder="<?php echo $kodesupplier; ?>" disabled>
            <input type="text" name="id_supplier" value="<?php echo $kodesupplier; ?>" class="form-control" hidden>
          </div>
          <div class="form-group">
            <label for="nuser">Nama Supplier</label>
            <input type="Text" name="namasupplier" class="form-control" placeholder="Nama Supplier">
          </div>
          <div class="form-group">
            <label for="user">Nomor Telepon</label>
            <input type="text" name="notlpn" onkeypress="return onlyNumberKey(event)" class="form-control" id="lblnotlpn" placeholder="081234567890" maxlength="14" required>
          </div>
          <div class="form-group">
            <label for="pass">Alamat</label>
            <textarea name="alamat" class="form-control" id="" rows="5"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="tambah_supplier" class="btn btn-primary">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>