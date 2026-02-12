<?php
include '../koneksi.php';

$id=$_GET['id'];

$data=mysqli_query($koneksi,"
SELECT p.*, b.nama_barang, b.harga_jual, u.user_nama
FROM penjualan p
JOIN barang b ON p.id_barang=b.id_barang
JOIN user u ON p.user_id=u.user_id
WHERE p.id_jual='$id'
");

$d=mysqli_fetch_array($data);
?>

<html>
<body onload="window.print()">

<h2>INVOICE ADMIN</h2>

<p>No : INV-<?= $d['id_jual']; ?></p>
<p>Tanggal : <?= $d['tgl_jual']; ?></p>
<p>Kasir : <?= $d['user_nama']; ?></p>

<hr>

<p>Barang : <?= $d['nama_barang']; ?></p>
<p>Total : Rp <?= number_format($d['total_harga']); ?></p>

</body>
</html>
