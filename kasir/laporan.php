<?php
include 'header.php';
include '../koneksi.php';

$user_id = $_SESSION['user_id'];
?>

<style>

/* Background */
body{
    background:#eef5f1;
}

/* Container full layar */
.laporan-wrapper{
    width:100%;
    margin-top:25px;
    animation:fadeUp .6s ease;
}

/* Card */
.laporan-card{
    border-radius:15px;
    box-shadow:0 8px 22px rgba(0,0,0,0.08);
    overflow:hidden;
}

/* Header */
.judul{
    background:#1b4332;
    color:white;
    padding:15px;
    font-weight:600;
}

/* Table */
.table thead{
    background:#2d6a4f;
    color:white;
}

.table tbody tr:hover{
    background:#e9f5ef;
    transition:.2s;
}

/* Total */
.total-row{
    background:#d8f3dc;
    font-weight:bold;
}

/* Animasi */
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

</style>

<div class="container-fluid laporan-wrapper">

<div class="card laporan-card">

<div class="judul text-center">
📊 Laporan Penjualan Saya
</div>

<div class="card-body">

<div class="table-responsive">

<table class="table table-bordered table-hover text-center">

<thead>
<tr>
<th>No</th>
<th>Tanggal</th>
<th>Barang</th>
<th>Total</th>
</tr>
</thead>

<tbody>

<?php
$no = 1;
$query = mysqli_query($koneksi,"
SELECT p.*, b.nama_barang
FROM penjualan p
JOIN barang b ON p.id_barang=b.id_barang
WHERE p.user_id='$user_id'
ORDER BY p.tgl_jual DESC
");

$total_semua = 0;

if(mysqli_num_rows($query) > 0){

while($d = mysqli_fetch_assoc($query)){

$total_semua += $d['total_harga'];
?>

<tr>
<td><?= $no++ ?></td>

<td><?= date('d M Y', strtotime($d['tgl_jual'])) ?></td>

<td class="text-start">
<?= $d['nama_barang'] ?>
</td>

<td class="fw-bold text-success">
Rp <?= number_format($d['total_harga'],0,',','.') ?>
</td>
</tr>

<?php } ?>

<tr class="total-row">
<td colspan="3" class="text-end">
Total Penjualan
</td>

<td>
Rp <?= number_format($total_semua,0,',','.') ?>
</td>
</tr>

<?php } else { ?>

<tr>
<td colspan="4">Belum ada transaksi</td>
</tr>

<?php } ?>

</tbody>
</table>

</div>
</div>
</div>

</div>

<?php include '../footer.php'; ?>
