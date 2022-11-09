<?php
session_start();

error_reporting(0);

if (empty($_SESSION['username']) and empty($_SESSION['password'])) {
    echo "<center>Untuk akses halaman ini anda harus login</center><br>";
    echo "<center><a href=../../index.php>Silahkan Login</center>";
    include '../../config/database.php';
}
include '../../config/database.php';

if (isset($_POST['tambah_brgmasuk'])) {
    $id_brgmasuk = $_POST['idbrgmasuk'];
    $id_supplier = $_POST['idsupplier'];
    $id_user = $_POST['iduser'];
    $id_barang = $_POST['idbarang'];
    $jmlh_masuk = $_POST['jmlh_msk'];
    $tgl_masuk = $_POST['tgl_masuk'];

    $cekstock = mysqli_query($kon, "SELECT * FROM barang where id_barang='$id_barang'");
    $ambildata = mysqli_fetch_array($cekstock);

    $stocksekarang = $ambildata['stock'];
    $totalstockskrng = $stocksekarang + $jmlh_masuk;

    //query
    $querytambah = mysqli_query($kon, "INSERT INTO barang_masuk VALUES('$id_brgmasuk' , '$id_supplier' , '$id_user' , '$id_barang' , '$jmlh_masuk' ,'$tgl_masuk')");
    $updatestockbarang = mysqli_query($kon, "UPDATE barang set stock='$totalstockskrng' WHERE id_barang='$id_barang'");
    if ($querytambah && $updatestockbarang) {
        # code redicet setelah insert ke index
        header("Location:../index.php?halaman=barang_masuk&tambah=berhasil");
        echo "ERROR, data gagal dihapus" . mysqli_error($kon);
    } else {
        header("Location:../index.php?halaman=barang_masuk&tambah=gagal");
        echo "ERROR, data gagal dihapus" . mysqli_error($kon);
    }
} elseif (isset($_POST['update_brgmasuk'])) {
    $id_brgmasuk = $_POST['id_brgmasuk'];
    $id_supplier = $_POST['idsupplier'];
    $id_user = $_POST['iduser'];
    $id_barang = $_POST['idbarang'];
    $jmlh_masuk = $_POST['jmlh_masuk'];
    $tgl_masuk = $_POST['tgl_masuk'];

    $cekstockbrg = mysqli_query($kon, "SELECT * FROM barang where id_barang='$id_barang'");
    $ambildatabrg = mysqli_fetch_array($cekstockbrg);
    $stockbrgskrng = $ambildatabrg['stock'];

    $jmlhskrng = mysqli_query($kon, "select * from barang_masuk where id_brgmasuk='$id_brgmasuk'");
    $jumlhnya = mysqli_fetch_array($jmlhskrng);
    $jmlhskrng = $jumlhnya['jmlh_masuk'];

    if ($jmlh_masuk > $jmlhskrng) {
        $selisih = $jmlh_masuk - $jmlhskrng;
        $kurangin = $stockbrgskrng - $selisih;
        $kuranginstocknya = mysqli_query($kon, "update barang set stock='$kurangin' where id_barang='$id_barang'");
        $updatenya = mysqli_query($kon, "update barang_masuk set id_supplier='$id_supplier', id_user='$id_user', id_barang='$id_barang', jmlh_masuk='$jmlh_masuk', tgl_masuk='$tgl_masuk' where id_brgmasuk='$id_brgmasuk'");
        if ($kuranginstocknya && $updatenya) {
            header("Location:../index.php?halaman=barang_masuk&ubah=berhasil");
            echo "ERROR, " . mysqli_error($kon);
        } else {
            header("Location:../index.php?halaman=barang_masuk&ubah=gagal");
            echo "ERROR, " . mysqli_error($kon);
        }
    } else {
        $selisih = $jmlhskrng - $jmlh_masuk;
        $kurangin = $stockbrgskrng + $selisih;
        $kuranginstocknya = mysqli_query($kon, "update barang set stock='$kurangin' where id_barang='$id_barang'");
        $updatenya = mysqli_query($kon, "update barang_masuk set id_supplier='$id_supplier', id_user='$id_user', id_barang='$id_barang', jmlh_masuk='$jmlh_masuk', tgl_masuk='$tgl_masuk' where id_brgmasuk='$id_brgmasuk'");
        if ($kuranginstocknya && $updatenya) {
            header("Location:../index.php?halaman=barang_masuk&ubah=berhasil");
            echo "ERROR, " . mysqli_error($kon);
        } else {
            header("Location:../index.php?halaman=barang_masuk&ubah=gagal");
            echo "ERROR, " . mysqli_error($kon);
        }
    }
} elseif ($_GET['halaman'] == 'deletebrgmasuk') {
    $id_brgmasuk = $_GET['id_brgmasuk'];

    $hapusdata = mysqli_query($kon, "DELETE from barang_masuk where id_brgmasuk='$id_brgmasuk'");
    if ($hapusdata) {
        header("Location:../index.php?halaman=barang_masuk&hapus=berhasil");
        echo "ERROR, " . mysqli_error($kon);
    } else {
        header("Location:../index.php?halaman=barang_masuk&hapus=gagal");
        echo "ERROR, " . mysqli_error($kon);
    }
}
