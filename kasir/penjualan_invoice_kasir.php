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

$d = mysqli_fetch_assoc($data);
?>

<!DOCTYPE html>
<html>
<head>
<title>Invoice Kasir</title>

<style>

body{
    font-family:'Segoe UI',sans-serif;
    background:linear-gradient(120deg,#52b788,#95d5b2);
    padding:40px;
}

/* Card Invoice */
.card{
    background:white;
    max-width:550px;
    margin:auto;
    padding:30px;
    border-radius:15px;
    box-shadow:0 12px 30px rgba(0,0,0,0.2);
    animation:fadeUp 0.8s ease;
}

/* Animasi muncul */
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

/* Header */
.header{
    text-align:center;
    margin-bottom:20px;
}

.header h2{
    color:#2d6a4f;
    margin:0;
}

/* Garis */
hr{
    border:none;
    height:1px;
    background:#ddd;
    margin:15px 0;
}

/* Text label */
.label{
    color:#555;
}

/* Value */
.value{
    font-weight:bold;
    color:#1b4332;
}

/* Total */
.total{
    font-size:22px;
    font-weight:bold;
    color:#2d6a4f;
    margin-top:15px;
}

/* Button */
.btn{
    display:inline-block;
    margin-top:20px;
    padding:10px 18px;
    background:#40916c;
    color:white;
    text-decoration:none;
    border-radius:8px;
    transition:0.3s;
}

.btn:hover{
    background:#2d6a4f;
    transform:scale(1.05);
}

/* Print mode */
@media print{
    body{
        background:white;
    }
    .btn{
        display:none;
    }
}

</style>
</head>

<body>

<div class="card">

<div class="header">
<h2>🧾 INVOICE KASIR</h2>
<p style="color:#777;">Jelita Daily</p>
</div>

<p>
<span class="label">No Invoice :</span>
<span class="value">INV-<?= $d['id_jual'] ?></span>
</p>

<p>
<span class="label">Tanggal :</span>
<span class="value"><?= $d['tgl_jual'] ?></span>
</p>

<p>
<span class="label">Kasir :</span>
<span class="value"><?= $d['user_nama'] ?></span>
</p>

<hr>

<p>
<span class="label">Barang :</span>
<span class="value"><?= $d['nama_barang'] ?></span>
</p>

<p>
<span class="label">Harga :</span>
<span class="value">Rp <?= number_format($d['harga_jual']) ?></span>
</p>

<div class="total">
Total Bayar : Rp <?= number_format($d['total_harga']) ?>
</div>

<center>
<a href="penjualan_invoice_cetak_kasir.php?id=<?= $d['id_jual'] ?>"
target="_blank"
class="btn">
🖨 Cetak Invoice
</a>
</center>

</div>

</body>
</html>
