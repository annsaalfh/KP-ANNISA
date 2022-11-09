<?php
session_start();

error_reporting(0);

if (empty($_SESSION['username']) and empty($_SESSION['password'])) {
    echo "<center>Untuk akses halaman ini anda harus login</center><br>";
    echo "<center><a href=../../index.php>Silahkan Login</center>";
    include '../../config/database.php';
}
include '../../config/database.php';

if (isset($_POST['tambah_barang'])) {
    $id_barang = $_POST['idbarang'];
    $id_kategori = $_POST['idkategori'];
    $id_satuan = $_POST['idsatuan'];
    $nama_barang = $_POST['namabarang'];
    $stock = $_POST['stock'];
    $harga = $_POST['harga'];
    $harga_beli = $_POST['harga_beli'];

    //query
    $querytambah = mysqli_query($kon, "INSERT INTO barang VALUES('$id_barang' , '$nama_barang' , '$stock' , '$harga', '$harga_beli', '$id_kategori' ,'$id_satuan')");

    if ($querytambah) {
        # code redicet setelah insert ke index
        header("Location:../index.php?halaman=barang&tambah=berhasil");
        echo "ERROR, data gagal dihapus" . mysqli_error($kon);
    } else {
        header("Location:../index.php?halaman=barang&tambah=gagal");
        echo "ERROR, data gagal dihapus" . mysqli_error($kon);
    }
} elseif (isset($_POST['update_barang'])) {
    $id_barang = $_POST['idbarang'];
    $id_kategori = $_POST['idkategori'];
    $id_satuan = $_POST['idsatuan'];
    $nama_barang = $_POST['namabarang'];
    $stock = $_POST['stock'];
    $harga = $_POST['harga'];
    $harga_beli = $_POST['harga_beli'];

    //Query input menginput data kedalam tabel anggota
    $dataupdate = "UPDATE barang set nama_barang='$nama_barang', stock='$stock', harga='$harga', harga_beli='$harga_beli', id_kategori='$id_kategori', id_satuan='$id_satuan' where id_barang = '$id_barang'";

    //Mengeksekusi/menjalankan query
    $hasil = mysqli_query($kon, $dataupdate);

    if ($hasil) {
        header("Location:../index.php?halaman=barang&ubah=berhasil");
        echo "ERROR, data gagal dihapus" . mysqli_error($kon);
    } else {
        header("Location:../index.php?halaman=barang&ubah=gagal");
    }
} elseif ($_GET['halaman'] == 'deletebarang') {
    $id_barang = $_GET['id_barang'];

    //query hapus
    $querydelete = mysqli_query($kon, "DELETE FROM barang WHERE id_barang = '$id_barang'");

    if ($querydelete) {
        # redirect ke index.php
        header("Location:../index.php?halaman=barang&hapus=berhasil");
    } else {
        header("Location:../index.php?halaman=barang&hapus=gagal");
    }
    mysqli_close($kon);
}
