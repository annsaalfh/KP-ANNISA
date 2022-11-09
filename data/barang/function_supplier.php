<?php
session_start();

error_reporting(0);

if (empty($_SESSION['username']) and empty($_SESSION['password'])) {
    echo "<center>Untuk akses halaman ini anda harus login</center><br>";
    echo "<center><a href=../../index.php>Silahkan Login</center>";
    include '../../config/database.php';
}
include '../../config/database.php';

if (isset($_POST['tambah_supplier'])) {
    $id_supplier = $_POST['id_supplier'];
    $nama_supplier = $_POST['namasupplier'];
    $no_tlpn = $_POST['notlpn'];
    $alamat = $_POST['alamat'];

    //query
    $querytambah = mysqli_query($kon, "INSERT INTO supplier VALUES('$id_supplier' , '$nama_supplier' ,'$no_tlpn' , '$alamat')");

    if ($querytambah) {
        # code redicet setelah insert ke index
        header("Location:../index.php?halaman=supplier&tambah=berhasil");
        echo "ERROR, data gagal dihapus" . mysqli_error($kon);
    } else {
        header("Location:../index.php?halaman=supplier&tambah=gagal");
        echo "ERROR, data gagal dihapus" . mysqli_error($kon);
    }
} elseif (isset($_POST['update_supplier'])) {
    $id_supplier = $_POST['id_supplier'];
    $nama_supplier = $_POST['nama_supplier'];
    $no_tlpn = $_POST['no_tlpn'];
    $alamat = $_POST['alamat'];

    //Query input menginput data kedalam tabel anggota
    $dataupdate = "UPDATE supplier set nama_supplier='$nama_supplier', no_tlpn='$no_tlpn', alamat='$alamat' where id_supplier = '$id_supplier'";

    //Mengeksekusi/menjalankan query
    $hasil = mysqli_query($kon, $dataupdate);

    if ($hasil) {
        header("Location:../index.php?halaman=supplier&ubah=berhasil");
    } else {
        header("Location:../index.php?halaman=supplier&ubah=gagal");
    }
} elseif ($_GET['halaman'] == 'deletesupplier') {
    $id_supplier = $_GET['id_supplier'];

    //query hapus
    $querydelete = mysqli_query($kon, "DELETE FROM supplier WHERE id_supplier = '$id_supplier'");

    if ($querydelete) {
        # redirect ke index.php
        header("Location:../index.php?halaman=supplier&hapus=berhasil");
    } else {
        header("Location:../index.php?halaman=supplier&hapus=gagal");
    }
    mysqli_close($kon);
}
