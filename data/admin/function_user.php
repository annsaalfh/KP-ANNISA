<?php

session_start();

error_reporting(0);

if (empty($_SESSION['username']) and empty($_SESSION['password'])) {
    echo "<center>Untuk akses halaman ini anda harus login</center><br>";
    echo "<center><a href=../../index.php>Silahkan Login</center>";
    include '../../config/database.php';
}
include '../../config/database.php';
if (isset($_POST['tambah_user'])) {
    $id_user = $_POST['id_user'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $status = $_POST['status'];

    //query
    $querytambah = mysqli_query($kon, "INSERT INTO user (id_user, nama, username, password, status) VALUES('$id_user', '$nama', '$username', '$password', '$status')");

    if ($querytambah) {
        # code redicet setelah insert ke index
        header("Location:../index.php?halaman=user&tambah=berhasil");
        echo "ERROR, data gagal dihapus" . mysqli_error($kon);
    } else {
        header("Location:../index.php?halaman=user&tambah=gagal");
        echo "ERROR, data gagal dihapus" . mysqli_error($kon);
    }
} elseif (isset($_POST['update_user'])) {
    $id_user = $_POST['id_user'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $status = $_POST['status'];

    $ambil_password = mysqli_query($kon, "SELECT password FROM user WHERE id_user = '$id_user' limit 1");
    $data = mysqli_fetch_array($ambil_password);

    if ($data['password'] == $_POST["password"]) {
        echo "ERROR, data gagal dihapus" . mysqli_error($kon);
        $password = $_POST["password"];
    } else {
        $password = md5($_POST["password"]);
        echo "ERROR, data gagal dihapus" . mysqli_error($kon);
    }

    //Query input menginput data kedalam tabel anggota
    $dataupdate = "UPDATE user set nama='$nama',username='$username', password='$password', status='$status' where id_user = '$id_user'";

    //Mengeksekusi/menjalankan query
    $hasil = mysqli_query($kon, $dataupdate);

    if ($hasil) {
        header("Location:../index.php?halaman=user&ubah=berhasil");
        echo "ERROR, data gagal dihapus" . mysqli_error($kon);
    } else {
        echo "ERROR, data gagal dihapus" . mysqli_error($kon);
        header("Location:../index.php?halaman=user&ubah=gagal");
    }
} elseif ($_GET['halaman'] == 'deleteuser') {
    $id_user = $_GET['id_user'];

    //query hapus
    $querydelete = mysqli_query($kon, "DELETE FROM user WHERE id_user = '$id_user'");

    if ($querydelete) {
        # redirect ke index.php
        header("Location:../index.php?halaman=user&hapus=berhasil");
    } else {
        header("Location:../index.php?halaman=user&hapus=gagal");
    }
    mysqli_close($kon);
}
