<?php
include "../config/database.php";
$dbarang = mysqli_fetch_array(mysqli_query($kon, "select * from barang where id_barang='$_GET[id_barang]'"));
$data_barang = array('harga'      =>  $dbarang['harga'],);
echo json_encode($data_barang);
