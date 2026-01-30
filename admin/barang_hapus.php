<?php
include '../koneksi.php';

$id = $_GET['id'];

// cek apakah barang pernah dijual
$cek = mysqli_query($koneksi, "SELECT * FROM penjualan WHERE id_barang='$id'");

if(mysqli_num_rows($cek) > 0){
    echo "<script>
        alert('Barang tidak bisa dihapus karena sudah pernah terjual!');
        window.location='barang.php';
    </script>";
} else {
    mysqli_query($koneksi, "DELETE FROM barang WHERE id_barang='$id'");
    header("location:barang.php");
}
?>
