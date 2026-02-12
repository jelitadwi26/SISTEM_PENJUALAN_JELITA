<?php include 'header.php'; ?>
<?php include '../koneksi.php'; ?>

<style>

/* Background */
body{
    background: linear-gradient(120deg,#2d6a4f,#344e41);
}

/* Container Panel */
.panel{
    border-radius:15px;
    box-shadow:0 10px 25px rgba(0,0,0,0.3);
    animation: fadeIn 0.8s ease;
}

/* Animasi muncul */
@keyframes fadeIn{
    from{
        opacity:0;
        transform:translateY(20px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

/* Header */
.panel-heading{
    background:#1b4332 !important;
    color:white !important;
    border-radius:15px 15px 0 0;
    padding:15px;
}

.panel-heading h4{
    margin:0;
    font-weight:bold;
}

/* Tombol */
.btn-success{
    background:#40916c;
    border:none;
    border-radius:8px;
    transition:0.3s;
}

.btn-success:hover{
    background:#2d6a4f;
    transform:scale(1.05);
}

.btn-warning{
    background:#d4a373;
    border:none;
    border-radius:6px;
    color:white;
    transition:0.3s;
}

.btn-warning:hover{
    background:#b08968;
    transform:scale(1.05);
}

/* Table */
.table{
    border-radius:12px;
    overflow:hidden;
}

.table th{
    background:#1b4332;
    color:white;
    text-align:center;
}

.table td{
    text-align:center;
    vertical-align:middle;
}

/* Hover baris */
.table-striped tbody tr:hover{
    background:#d8f3dc;
    transition:0.3s;
}

</style>

<div class="container">
<div class="panel">
<div class="panel-heading">
<h4>Penjualan Kasir</h4>
</div>

<div class="panel-body">

<a href="penjualan_tambah.php" class="btn btn-success pull-right">
➕ Transaksi Baru
</a>

<br><br>

<table class="table table-bordered table-striped">

<tr>
<th>No</th>
<th>Invoice</th>
<th>Tanggal</th>
<th>Barang</th>
<th>Total</th>
<th>Opsi</th>
</tr>

<?php
$data = mysqli_query($koneksi,"
SELECT p.*, b.nama_barang
FROM penjualan p
JOIN barang b ON p.id_barang=b.id_barang
ORDER BY p.id_jual DESC
");

$no=1;
while($d=mysqli_fetch_assoc($data)){
?>

<tr>
<td><?= $no++ ?></td>
<td><b style="color:#2d6a4f;">INV-<?= $d['id_jual'] ?></b></td>
<td><?= $d['tgl_jual'] ?></td>
<td><?= $d['nama_barang'] ?></td>
<td style="color:#1b4332;font-weight:bold;">
Rp <?= number_format($d['total_harga']) ?>
</td>

<td>

<a href="penjualan_invoice_kasir.php?id=<?= $d['id_jual'] ?>"
class="btn btn-warning btn-sm">
🧾 Invoice
</a>

</td>
</tr>

<?php } ?>

</table>
</div>
</div>
</div>

<?php include '../footer.php'; ?>
