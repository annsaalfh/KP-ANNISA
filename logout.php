<?php
session_start();
$id_user = $_SESSION['id_user'];
$_SESSION['id_user'] = '';
$_SESSION['nama'] = '';
$_SESSION['username'] = '';
$_SESSION['status'] = '';



unset($_SESSION['id_user']);
unset($_SESSION['nama']);
unset($_SESSION['username']);
unset($_SESSION['status']);

session_unset();
session_destroy();

header('Location:index.php?pesan=logout');
