<div class="page-header">
    <h3 class="page-title">Laporan Barang Keluar </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Data</a></li>
            <li class="breadcrumb-item active" aria-current="page">Laporan Barang Keluar</li>
        </ol>
    </nav>
</div>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label>Filter Tanggal</label>
                            <div class="input-group">
                                <input type="text" name="tgl_awal" value="<?= @$_POST['tgl_awal'] ?>" class="form-control tgl_awal datetimepicker-input" placeholder="Tanggal Awal" data-toggle="datetimepicker" data-target=".tgl_awal" autocomplete="off">
                                <div class="input-group-append">
                                    <span class="input-group-text">s/d</span>
                                </div>
                                <input type="text" name="tgl_akhir" value="<?= @$_POST['tgl_akhir'] ?>" class="form-control tgl_akhir datetimepicker-input" placeholder="Tanggal Akhir" data-toggle="datetimepicker" data-target=".tgl_akhir" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <?php
                    // Load file koneksi.php
                    include '../config/database.php';

                    $tgl_awal = @$_POST['tgl_awal']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
                    $tgl_akhir = @$_POST['tgl_akhir']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)

                    if (empty($tgl_awal) or empty($tgl_akhir)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :
                        // Buat query untuk menampilkan semua data transaksi
                        $query = "SELECT * FROM barang_keluar INNER JOIN user on user.id_user = barang_keluar.id_user INNER JOIN barang on barang.id_barang = barang_keluar.id_barang";
                        $url_cetak = "laporan/print_laporankeluar.php";
                        $label = "Semua Data Transaksi";
                    } else { // Jika terisi
                        // Buat query untuk menampilkan data transaksi sesuai periode tanggal
                        $query = "SELECT barang_keluar.*, user.nama, barang.nama_barang FROM barang_keluar INNER JOIN user on user.id_user = barang_keluar.id_user INNER JOIN barang on barang.id_barang = barang_keluar.id_barang WHERE (tgl_keluar BETWEEN '" . $tgl_awal . "' AND '" . $tgl_akhir . "')";
                        $url_cetak = "laporan/print_laporankeluar.php?tgl_awal=" . $tgl_awal . "&tgl_akhir=" . $tgl_akhir . "&filter=true";
                        $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
                        $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
                        $label = 'Periode Tanggal ' . $tgl_awal . ' s/d ' . $tgl_akhir;
                    }
                    ?>
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <h4 style="margin-bottom: 5px;"><b>Data Transaksi</b></h4>
                            <p><?php echo $label ?></p>
                        </div>
                    </div>
                </div>
                <a href="<?php echo $url_cetak ?>" class="btn btn-info">CETAK PDF</a>
                <button type="submit" name="filter" value="true" class="btn btn-primary">TAMPILKAN</button>
                <?php
                if (isset($_POST['filter'])) // Jika user mengisi filter tanggal, maka munculkan tombol untuk reset filter
                    echo '<a href="index.php?halaman=laporan_brgkeluar" class="btn btn-default">RESET</a>';
                ?>
            </form>
            <hr />
            <br>
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" cellspacing="0">
                    <thead>
                        <tr>
                            <th> ID </th>
                            <th> Nama Kasir </th>
                            <th> Nama barang </th>
                            <th> Tanggal Keluar </th>
                            <th> Jumlah Barang Keluar </th>
                            <th> Total Harga </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../config/database.php';
                        $no = 1;
                        $data = mysqli_query($kon, $query);
                        $row = mysqli_num_rows($data);
                        if ($row > 0) {
                            while ($d = mysqli_fetch_array($data)) {
                                $tgl = date('d-m-Y', strtotime($d['tgl_keluar']));
                        ?>
                                <tr>
                                    <td><?php echo $d['id_brgkeluar']; ?></td>
                                    <td><?php echo $d['nama']; ?></td>
                                    <td><?php echo $d['nama_barang']; ?></td>
                                    <td><?php echo $tgl; ?></td>
                                    <td><?php echo $d['jumlah_keluar']; ?></td>
                                    <td><?php echo $d['total_harga']; ?></td>
                                </tr>
                        <?php }
                        } else {
                            echo "<tr><td colspan='6' align='center'><h4>Data tidak ada</h4></td></tr>";
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>