<?php
session_start();
include '../koneksi.php';

$id_barang = $_POST['barang'];
$total = $_POST['total'];
$user = $_SESSION['user_id'];

mysqli_query($koneksi,"
INSERT INTO penjualan
VALUES(NULL,'$id_barang',NOW(),'$total','$user')
");

header("location:penjualan.php");
