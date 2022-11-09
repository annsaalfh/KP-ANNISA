<?php
session_start();

error_reporting(0);

if (empty($_SESSION['username']) and empty($_SESSION['password'])) {
    echo "<center>Untuk akses halaman ini anda harus login</center><br>";
    echo "<center><a href=../../index.php>Silahkan Login</center>";
    include '../../config/database.php';
}
include '../../config/database.php';

if (isset($_POST['tambah_brgkeluar'])) {
    $id_brgkeluar = $_POST['id_brgkeluar'];
    $id_user = $_POST['iduser'];
    $id_barang = $_POST['idbarang'];
    $jumlah_keluar = $_POST['jumlah_keluar'];
    $tgl_keluar = $_POST['tgl_keluar'];
    $total_harga = $_POST['total_harga'];

    $cekstock = mysqli_query($kon, "SELECT * FROM barang where id_barang='$id_barang'");
    $ambildata = mysqli_fetch_array($cekstock);

    $stocksekarang = $ambildata['stock'];
    $totalstockskrng = $stocksekarang - $jumlah_keluar;

    //query
    $querytambah = mysqli_query($kon, "INSERT INTO barang_keluar VALUES('$id_brgkeluar' , '$id_user' , '$id_barang' , '$jumlah_keluar' ,'$tgl_keluar' , '$total_harga')");
    $updatestockbarang = mysqli_query($kon, "UPDATE barang set stock='$totalstockskrng' WHERE id_barang='$id_barang'");
    if ($querytambah && $updatestockbarang) {
        # code redicet setelah insert ke index
        header("Location:../index.php?halaman=barang_keluar&tambah=berhasil");
        echo "ERROR, " . mysqli_error($kon);
    } else {
        header("Location:../index.php?halaman=barang_keluar&tambah=gagal");
        echo "ERROR, " . mysqli_error($kon);
    }
} elseif (isset($_POST['update_barang'])) {
    $id_brgkeluar = $_POST['id_brgkeluar'];
    $id_user = $_POST['iduser'];
    $id_barang = $_POST['idbarang'];
    $jumlah_keluar = $_POST['jumlah_keluar'];
    $tgl_keluar = $_POST['tgl_keluar'];
    $total_harga = $_POST['total_harga'];

    $cekstockbrg = mysqli_query($kon, "SELECT * FROM barang where id_barang='$id_barang'");
    $ambildatabrg = mysqli_fetch_array($cekstockbrg);
    $stockbrgskrng = $ambildatabrg['stock'];

    $jmlhskrng = mysqli_query($kon, "select * from barang_keluar where id_brgkeluar='$id_brgkeluar'");
    $jumlhnya = mysqli_fetch_array($jmlhskrng);
    $jmlhskrng = $jumlhnya['jumlah_keluar'];

    if ($jumlah_keluar > $jmlhskrng) {
        $selisih = $jumlah_keluar - $jmlhskrng;
        $kurangin = $stockbrgskrng + $selisih;
        $kuranginstocknya = mysqli_query($kon, "update barang set stock='$kurangin' where id_barang='$id_barang'");
        $updatenya = mysqli_query($kon, "update barang_keluar set id_user='$id_user', id_barang='$id_barang', jumlah_keluar='$jumlah_keluar', tgl_keluar='$tgl_keluar', total_harga='$total_harga'");
        if ($kuranginstocknya && $updatenya) {
            header("Location:../index.php?halaman=barang_keluar&ubah=berhasil");
            echo "ERROR, " . mysqli_error($kon);
        } else {
            header("Location:../index.php?halaman=barang_keluar&ubah=gagal");
            echo "ERROR, " . mysqli_error($kon);
        }
    } else {
        $selisih = $jmlhskrng - $jumlah_keluar;
        $kurangin = $stockbrgskrng - $selisih;
        $kuranginstocknya = mysqli_query($kon, "update barang set stock='$kurangin' where id_barang='$id_barang'");
        $updatenya = mysqli_query($kon, "update barang_keluar set id_user='$id_user', id_barang='$id_barang', jumlah_keluar='$jumlah_keluar', tgl_keluar='$tgl_keluar', total_harga='$total_harga'");
        if ($kuranginstocknya && $updatenya) {
            header("Location:../index.php?halaman=barang_keluar&ubah=berhasil");
            echo "ERROR, " . mysqli_error($kon);
        } else {
            header("Location:../index.php?halaman=barang_keluar&ubah=gagal");
            echo "ERROR, " . mysqli_error($kon);
        }
    }
} elseif ($_GET['halaman'] == 'deletebrgkeluar') {
    $id_brgkeluar = $_GET['id_brgkeluar'];
    $hapusdata = mysqli_query($kon, "DELETE from barang_keluar where id_brgkeluar='$id_brgkeluar'");
    if ($hapusdata) {
        header("Location:../index.php?halaman=barang_keluar&hapus=berhasil");
        echo "ERROR, " . mysqli_error($kon);
    } else {
        header("Location:../index.php?halaman=barang_keluar&hapus=gagal");
        echo "ERROR, " . mysqli_error($kon);
    }
}
