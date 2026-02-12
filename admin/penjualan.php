<?php include 'header.php'; ?>
<?php include '../koneksi.php'; ?>

<style>

/* Background */
body{
    background: linear-gradient(135deg,#f8f5f2,#efe7df);
}

/* Panel Modern */
.panel{
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
    animation:fadeUp .6s ease;
}

/* Header */
.panel-heading{
    background:linear-gradient(135deg,#8B5E3C,#a97957);
    color:white !important;
    padding:15px;
    font-weight:600;
}

/* Table */
.table{
    margin-top:10px;
}

/* Table Head */
.table th{
    background:#8B5E3C;
    color:white;
    text-align:center;
}

/* Hover Row */
.table tbody tr{
    transition:.25s;
}

.table tbody tr:hover{
    background:#f3ebe4;
    transform:scale(1.01);
}

/* Tombol Invoice */
.btn-warning{
    background:linear-gradient(135deg,#8B5E3C,#a97957);
    border:none;
    border-radius:8px;
    transition:.2s;
    color:white;
}

.btn-warning:hover{
    transform:translateY(-2px);
    box-shadow:0 5px 15px rgba(139,94,60,.3);
}

/* Animasi */
@keyframes fadeUp{
    from{
        opacity:0;
        transform:translateY(30px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

</style>

<div class="container" style="margin-top:25px;">

<div class="panel">

<div class="panel-heading">
<h4>📊 Data Penjualan</h4>
</div>

<div class="panel-body">

<table class="table table-bordered table-striped text-center">

<tr>
<th>No</th>
<th>Invoice</th>
<th>Tanggal</th>
<th>Barang</th>
<th>Total</th>
<th>Kasir</th>
<th>Opsi</th>
</tr>

<?php
$data = mysqli_query($koneksi,"
SELECT p.*, b.nama_barang, u.user_nama
FROM penjualan p
JOIN barang b ON p.id_barang = b.id_barang
JOIN user u ON p.user_id = u.user_id
ORDER BY p.id_jual DESC
");

$no = 1;
while($d = mysqli_fetch_array($data)){
?>

<tr>
<td><?= $no++; ?></td>

<td>
<b>INV-<?= $d['id_jual']; ?></b>
</td>

<td>
<?= date('d M Y', strtotime($d['tgl_jual'])); ?>
</td>

<td>
<?= $d['nama_barang']; ?>
</td>

<td class="text-success fw-bold">
Rp <?= number_format($d['total_harga'],0,',','.'); ?>
</td>

<td>
<?= $d['user_nama']; ?>
</td>

<td>
<a href="penjualan_invoice_admin.php?id=<?= $d['id_jual']; ?>" 
class="btn btn-warning btn-sm" target="_blank">
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
