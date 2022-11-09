<?php

use Spipu\Html2Pdf\Html2Pdf;

session_start();
ob_start(); ?>
<html>

<head>
    <title>Cetak PDF Barang Masuk</title>
    <style>
        .tabel2 {
            border-collapse: collapse;
        }

        .tabel2 th,
        .tabel2 td {
            padding: 5px 5px;
            border: 1px solid #000;
        }

        .tandatangan {

            text-align: center;
            margin-left: 445px;
        }
    </style>
</head>

<body>
    <?php
    // Load file koneksi.php
    include '../../config/database.php';
    $tgl_awal = @$_GET['tgl_awal']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
    $tgl_akhir = @$_GET['tgl_akhir']; // Ambil data tgl_awal sesuai input (kalau tidak ada set kosong)
    if (empty($tgl_awal) or empty($tgl_akhir)) { // Cek jika tgl_awal atau tgl_akhir kosong, maka :
        // Buat query untuk menampilkan semua data transaksi
        $query = "SELECT * FROM barang_masuk INNER JOIN supplier on supplier.id_supplier = barang_masuk.id_supplier INNER JOIN barang on barang.id_barang = barang_masuk.id_barang";
        $label = "Semua Data Transaksi";
    } else { // Jika terisi
        // Buat query untuk menampilkan data transaksi sesuai periode tanggal
        $query = "SELECT barang_masuk.*, supplier.nama_supplier, barang.nama_barang FROM barang_masuk INNER JOIN supplier on supplier.id_supplier = barang_masuk.id_supplier INNER JOIN barang on barang.id_barang = barang_masuk.id_barang WHERE (tgl_masuk BETWEEN '" . $tgl_awal . "' AND '" . $tgl_akhir . "')";
        $tgl_awal = date('d-m-Y', strtotime($tgl_awal)); // Ubah format tanggal jadi dd-mm-yyyy
        $tgl_akhir = date('d-m-Y', strtotime($tgl_akhir)); // Ubah format tanggal jadi dd-mm-yyyy
        $label = 'Periode Tanggal ' . $tgl_awal . ' s/d ' . $tgl_akhir;
    }
    ?>

    <table>
        <tr>
            <th rowspan="4"><img src="../../assets/images/logost.png" style="width:140px;height:100px;" /></th>
            <td align="center" style="width: 500px;">
                <font style="font-size: 18px"><br><b>SARI TIRTA</b></font>
                <br><br>Jl. Tarian Raya Timur no.10 Rt.10/Rw.10, Pegangsaan Dua
                <br><br>Kec. Kelapa Gading, Jakarta Utara
                <br><br>021-4504890
            </td>
        </tr>
    </table>
    <hr>
    <br>
    <h4 style="margin-bottom: 5px;">Laporan Barang Masuk</h4>
    <p> <?php echo $label ?></p>
    <table class="tabel2">
        <tr>
            <th> ID </th>
            <th> Tanggal Masuk </th>
            <th> Nama Supplier </th>
            <th> Nama barang </th>
            <th> Jumlah Barang </th>
        </tr>
        <?php
        $sql = mysqli_query($kon, $query); // Eksekusi/Jalankan query dari variabel $query
        $row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql
        if ($row > 0) { // Jika jumlah data lebih dari 0 (Berarti jika data ada)
            while ($data = mysqli_fetch_array($sql)) { // Ambil semua data dari hasil eksekusi $sql
                $tgl = date('d-m-Y', strtotime($data['tgl_masuk'])); // Ubah format tanggal jadi dd-mm-yyyy
        ?>
                <tr>
                    <td><?php echo $data['id_brgmasuk']; ?></td>
                    <td><?php echo $tgl; ?></td>
                    <td><?php echo $data['nama_supplier']; ?></td>
                    <td><?php echo $data['nama_barang']; ?></td>
                    <td><?php echo $data['jmlh_masuk']; ?></td>
                </tr>
        <?php
            }
        } else { // Jika data tidak ada
            echo "<tr><td colspan='5'>Data tidak ada</td></tr>";
        }
        ?>
    </table>
    <br>
    <?php

    $tanggalskrng = date("d F Y");
    include '../../config/database.php';
    ?>
    <br>
    <div class="tandatangan">

        <p>Jakarta, <?php echo $tanggalskrng; ?></p>
        <br>
        <br>
        <p>
            ( <?php echo $_SESSION['nama']; ?> )
        </p>
    </div>
</body>

</html>
<?php
$html = ob_get_contents();
ob_end_clean();
require '../../assets/libraries/html2pdf/autoload.php';
$pdf = new HTML2PDF('P', 'A4', 'en', false, 'UTF-8', array(20, 0, 20, 0));
$pdf->pdf->SetDisplayMode('fullpage');
$pdf->WriteHTML($html);
$pdf->Output('Data Barang Masuk.pdf', 'I');
?>