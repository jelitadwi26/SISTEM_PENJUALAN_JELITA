<?php
include '../koneksi.php';

$id = $_GET['id'];

$data = mysqli_query($koneksi,"
SELECT p.*, b.nama_barang, b.harga_jual, u.user_nama
FROM penjualan p
JOIN barang b ON p.id_barang=b.id_barang
JOIN user u ON p.user_id=u.user_id
WHERE p.id_jual='$id'
");

$d = mysqli_fetch_array($data);
?>

<!DOCTYPE html>
<html>
<head>
<title>Cetak Invoice Kasir</title>

<style>

body{
    font-family:Courier New, monospace;
    background:white;
    text-align:center;
}

/* Struk Box */
.struk{
    width:300px;
    margin:auto;
    padding:15px;
    border:1px dashed #2e7d32;
}

/* Header */
.judul{
    font-size:18px;
    font-weight:bold;
    color:#2e7d32;
}

/* Garis */
.garis{
    border-top:1px dashed #2e7d32;
    margin:10px 0;
}

/* Text */
.text-left{
    text-align:left;
}

.text-right{
    text-align:right;
}

</style>
</head>

<body onload="window.print()">

<div class="struk">

<div class="judul">
JELITA DAILY
</div>

<small>Invoice Kasir</small>

<div class="garis"></div>

<div class="text-left">
No Invoice : INV-<?= $d['id_jual']; ?><br>
Tanggal : <?= date('d-m-Y', strtotime($d['tgl_jual'])); ?><br>
Kasir : <?= $d['user_nama']; ?>
</div>

<div class="garis"></div>

<table width="100%">
<tr>
<td><?= $d['nama_barang']; ?></td>
<td class="text-right">
Rp <?= number_format($d['harga_jual'],0,',','.'); ?>
</td>
</tr>
</table>

<div class="garis"></div>

<table width="100%">
<tr>
<td><b>TOTAL</b></td>
<td class="text-right">
<b>Rp <?= number_format($d['total_harga'],0,',','.'); ?></b>
</td>
</tr>
</table>

<div class="garis"></div>

<small>
Terima kasih sudah berbelanja 💚
</small>

</div>

</body>
</html>
