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
<title>Invoice Admin</title>

<style>

/* Background */
body{
    font-family:'Segoe UI',sans-serif;
    background:linear-gradient(135deg,#f8f5f2,#efe7df);
    padding:40px;
}

/* Card Invoice */
.invoice{
    max-width:650px;
    margin:auto;
    background:white;
    border-radius:18px;
    padding:30px;
    box-shadow:0 15px 40px rgba(0,0,0,0.08);
    animation:fadeUp .6s ease;
}

/* Header */
.header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}

.logo{
    font-size:22px;
    font-weight:bold;
    color:#5A3D2B;
}

.title{
    font-size:26px;
    font-weight:700;
    color:#8B5E3C;
}

/* Info */
.info{
    margin-bottom:20px;
    line-height:1.8;
}

/* Table */
table{
    width:100%;
    border-collapse:collapse;
    margin-top:15px;
}

th{
    background:#8B5E3C;
    color:white;
    padding:12px;
}

td{
    padding:12px;
    border-bottom:1px solid #eee;
    text-align:center;
}

/* Total Box */
.total{
    margin-top:20px;
    text-align:right;
    font-size:18px;
    font-weight:bold;
    color:#5A3D2B;
}

/* Button */
.btn{
    margin-top:25px;
    display:inline-block;
    padding:10px 20px;
    background:linear-gradient(135deg,#8B5E3C,#a97957);
    color:white;
    border-radius:10px;
    text-decoration:none;
    font-weight:600;
    transition:.3s;
}

.btn:hover{
    transform:translateY(-3px);
    box-shadow:0 8px 18px rgba(139,94,60,.3);
}

/* Animation */
@keyframes fadeUp{
    from{
        opacity:0;
        transform:translateY(25px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

/* Print */
@media print{
    body{
        background:white;
        padding:0;
    }

    .btn{
        display:none;
    }

    .invoice{
        box-shadow:none;
    }
}

</style>
</head>

<body>

<div class="invoice">

<div class="header">
<div class="logo">Jelita Daily</div>
<div class="title">INVOICE ADMIN</div>
</div>

<hr>

<div class="info">
<b>No Invoice :</b> INV-<?= $d['id_jual']; ?><br>
<b>Tanggal :</b> <?= date('d M Y', strtotime($d['tgl_jual'])); ?><br>
<b>Kasir :</b> <?= $d['user_nama']; ?>
</div>

<table>
<tr>
<th>Barang</th>
<th>Harga</th>
<th>Total</th>
</tr>

<tr>
<td><?= $d['nama_barang']; ?></td>
<td>Rp <?= number_format($d['harga_jual'],0,',','.'); ?></td>
<td>Rp <?= number_format($d['total_harga'],0,',','.'); ?></td>
</tr>
</table>

<div class="total">
Total Bayar : Rp <?= number_format($d['total_harga'],0,',','.'); ?>
</div>

<center>
<a href="penjualan_invoice_cetak_admin.php?id=<?= $d['id_jual']; ?>" class="btn">
🖨 Cetak Invoice
</a>
</center>

</div>

</body>
</html>
