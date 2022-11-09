<?php
    $host="localhost";
    $user="root";
    $pass="";
    $db="db_barang";
    $kon = mysqli_connect($host,$user,$pass,$db);
    if (!$kon){
          die("Koneksi gagal:".mysqli_connect_error());
    }
?>