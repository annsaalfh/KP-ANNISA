<?php
session_start();

if (!$_SESSION["username"]) {
    header('location:../index.php?pesan=belum_login');
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Cetak Struk Pembelian</title>
</head>

<body>
    <style type="text/css">
        p {
            text-align: left;
            font-style: bold;
            font-size: 12px
        }

        h4,
        h1,
        h5,
        h2 {
            text-align: center;
            padding-top: inherit;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        tbody tr:nth-child(odd) {
            background-color: #ccc;
        }
    </style>
    <h2>SARI TIRTA</h2>
    <h5>Jl. Tarian Raya Timur no.10 Rt.10/Rw.10, Pegangsaan Dua</h5>
    <h5>Kec. Kelapa Gading, Jakarta Utara</h5>
    <hr>
    </tr>
    <p align="left">Tanggal: <?php date_default_timezone_set("Asia/Jakarta");
                                echo $date = date('Y-m-d |  H:i:s'); ?> </p>
    <table border="1" cellpadding="" cellspacing="">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Harga</th>
            </tr>
        </thead>
        <?php
        // koneksi database
        include '../../config/database.php';
        if ($_GET['halaman'] == 'cetak') {
            $id_brgkeluar = $_GET['id_brgkeluar'];

            // menampilkan data pegawai
            $data = mysqli_query($kon, "SELECT * FROM barang_keluar INNER JOIN barang on barang.id_barang = barang_keluar.id_barang WHERE id_brgkeluar = '$id_brgkeluar'");
            $no = 1;
            $total = 0;
            $total_byr = 0;
            while ($d = mysqli_fetch_array($data)) {
        ?>
                <tbody>
                    <tr>
                        <td style='text-align: center;'><?php echo $no++ ?></td>
                        <td style='text-align: center;'><?php echo $d['tgl_keluar']; ?></td>
                        <td style='text-align: center;'><?php echo $d['id_brgkeluar']; ?></td>
                        <td style='text-align: center;'><?php echo $d['nama_barang']; ?></td>
                        <td style='text-align: center;'><?php echo $d['jumlah_keluar']; ?></td>
                        <td style='text-align: center;'><?php echo $d['harga']; ?></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5" style='text-align: center;'>Total Harga</td>
                        <td style='text-align: center;'>Rp. <?php echo $d['total_harga']; ?></td>
                    </tr>
                </tfoot>
        <?php
            }
        }
        ?>
    </table>
    <script>
        window.print();
    </script>
</body>

</html>