<?php
session_start();

error_reporting(0);

if (empty($_SESSION['username']) and empty($_SESSION['password'])) {
    echo "<center>Untuk akses halaman ini anda harus login</center><br>";
    echo "<center><a href=../../index.php>Silahkan Login</center>";
    include '../../config/database.php';
}
include '../../config/database.php';

if (isset($_POST['tambah_kategori'])) {
    $id_kategori = $_POST['id_kategori'];
    $nama_kategori = $_POST['nama_kategori'];

    //query
    $querytambah = mysqli_query($kon, "INSERT INTO kategori VALUES('$id_kategori' , '$nama_kategori')");

    if ($querytambah) {
        # code redicet setelah insert ke index
        header("Location:../index.php?halaman=kategori&tambah=berhasil");
    } else {
        header("Location:../index.php?halaman=kategori&tambah=gagal");
    }
} elseif ($_GET['halaman'] == 'deletekategori') {
    $id_kategori = $_GET['id_kategori'];

    //query hapus
    $querydelete = mysqli_query($kon, "DELETE FROM kategori WHERE id_kategori = '$id_kategori'");

    if ($querydelete) {
        # redirect ke index.php
        header("Location:../index.php?halaman=kategori&hapus=berhasil");
    } else {
        header("Location:../index.php?halaman=kategori&hapus=gagal");
    }
    mysqli_close($kon);
}
