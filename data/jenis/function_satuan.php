<?php
session_start();

error_reporting(0);

if (empty($_SESSION['username']) and empty($_SESSION['password'])) {
    echo "<center>Untuk akses halaman ini anda harus login</center><br>";
    echo "<center><a href=../../index.php>Silahkan Login</center>";
    include '../../config/database.php';
}
include '../../config/database.php';

if (isset($_POST['tambah_satuan'])) {
    $id_satuan = $_POST['id_satuan'];
    $nama_satuan = $_POST['nama_satuan'];

    //query
    $querytambah = mysqli_query($kon, "INSERT INTO satuan VALUES('$id_satuan' , '$nama_satuan')");

    if ($querytambah) {
        # code redicet setelah insert ke index
        header("Location:../index.php?halaman=satuan&tambah=berhasil");
    } else {
        header("Location:../index.php?halaman=satuan&tambah=gagal");
    }
} elseif ($_GET['halaman'] == 'deletesatuan') {
    $id_satuan = $_GET['id_satuan'];

    //query hapus
    $querydelete = mysqli_query($kon, "DELETE FROM satuan WHERE id_satuan = '$id_satuan'");

    if ($querydelete) {
        # redirect ke index.php
        header("Location:../index.php?halaman=satuan&hapus=berhasil");
    } else {
        header("Location:../index.php?halaman=satuan&hapus=gagal");
    }
    mysqli_close($kon);
}
