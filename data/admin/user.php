            <div class="page-header">
              <h3 class="page-title"> User </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Data</a></li>
                  <li class="breadcrumb-item active" aria-current="page">User</li>
                </ol>
              </nav>
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <form method="post" action="index.php?halaman=user">
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
                        echo "<div class='alert alert-success'><strong>Berhasil!</strong> DATA telah di hapus!
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                      <span aria-hidden='true'>&times;</span>
                    </button></div>";
                      } else if ($_GET['hapus'] == 'gagal') {
                        echo "<div class='alert alert-dismissible fade show alert-danger' role='alert'><strong>Gagal!</strong> DATA gagal di hapus!
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
                      <button type="button" class="btn btn-gradient-success btn-icon-text" data-toggle="modal" data-target="#tambahuser"><i class="mdi mdi-plus-circle btn-icon-prepend"></i>Tambah</button>
                    <?php } ?>
                    <br>
                    <br>
                    <table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th> ID </th>
                          <th> Nama </th>
                          <th> Username </th>
                          <th> Status </th>
                          <th> Action </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        include '../config/database.php';

                        $data = mysqli_query($kon, "select * from user");
                        while ($d = mysqli_fetch_array($data)) {
                        ?>
                          <tr>
                            <td><?php echo $d['id_user']; ?></td>
                            <td><?php echo $d['nama']; ?></td>
                            <td><?php echo $d['username']; ?></td>
                            <td><?php echo $d['status'] == '1' ? '<div class="mb-2 mr-2 badge badge-pill badge-success">Owner</div>' : '<div class="mb-2 mr-2 badge-pill badge badge-info">Staff</div>'; ?></td>
                            <td><?php if ($_SESSION['status'] == '1') { ?><button type="button" class="btn btn-info btn-icon" data-toggle="modal" data-target="#ubahuser<?php echo $d['id_user']; ?>">
                                  <i class="mdi mdi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-icon" data-toggle="modal" data-target="#hapususer<?php echo $d['id_user']; ?>">
                                  <i class="mdi mdi-delete"><?php } ?></i>
                                </button>
                            </td>
                          </tr>
                          <!-- hapus -->
                          <div class="modal fade" id="hapususer<?php echo $d['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  Apakah anda ingin menghapus data dengan nama username : "<?php echo $d['username']; ?>" ?
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <a href="admin/function_user.php?halaman=deleteuser&id_user=<?php echo $d['id_user']; ?>" class="btn btn-primary btn-pill">Hapus</a>
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- ubah -->
                          <div class="modal fade" id="ubahuser<?php echo $d['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                          <option value="1" <?php if ($d['status'] == '1') echo "selected"; ?>>Owner</option>
                                          <option value="2" <?php if ($d['status'] == '2') echo "selected"; ?>>Staff</option>
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

            <!-- tambah -->
            <div class="modal fade" id="tambahuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <form method="post" action="admin/function_user.php">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <?php
                      // mengambil data admin dengan kode paling besar
                      include '../config/database.php';
                      $query = mysqli_query($kon, "SELECT max(id_user) as kodeTerbesar FROM user");
                      $data = mysqli_fetch_array($query);
                      $id_user = $data['kodeTerbesar'];
                      $id_userurut = (int) substr($id_user, 3, 3);
                      $id_userurut++;
                      $huruf = "U";
                      $kodeuser = $huruf . sprintf("%03s", $id_userurut);
                      ?>
                      <div class="form-group">
                        <label for="iduser">ID User</label>
                        <input type="text" class="form-control" placeholder="<?php echo $kodeuser; ?>" placeholder="<?php echo $kodeuser; ?>" disabled>
                        <input type="text" name="id_user" value="<?php echo $kodeuser; ?>" class="form-control" hidden>
                      </div>
                      <div class="form-group">
                        <label for="nuser">Nama User</label>
                        <input type="Text" class="form-control" name="nama" placeholder="Nama User">
                      </div>
                      <div class="form-group">
                        <label for="user">Username</label>
                        <input type="Text" class="form-control" name="username" placeholder="Username">
                      </div>
                      <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                      </div>
                      <div class="form-group">
                        <label for="nstatus">Status</label>
                        <select name="status" class="form-control" required>
                          <option> -Pilih- </option>
                          <option value="1">Owner</option>
                          <option value="2">Staff</option>
                        </select>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" name="tambah_user" class="btn btn-primary">Tambah</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>