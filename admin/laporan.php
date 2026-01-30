<?php
include 'header.php';
include '../koneksi.php';
?>

<style>

/* ===== ANIMATIONS ===== */

@keyframes fadeSlideUp{
    from{
        opacity:0;
        transform:translateY(30px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

@keyframes fadeIn{
    from{opacity:0;}
    to{opacity:1;}
}

/* Card muncul smooth */
.card-animate{
    animation:fadeSlideUp .7s ease;
}

/* Table muncul sedikit delay */
.table-animate{
    animation:fadeIn 1.1s ease;
}

/* ===== HOVER EFFECT ===== */

.table-hover tbody tr{
    transition:.25s;
}

.table-hover tbody tr:hover{
    background:#faf6f2;
    transform:scale(1.002);
}

/* ===== TOTAL GLOW ===== */

.total-glow{
    color:#5C3A21;
    font-weight:700;
    letter-spacing:.5px;
}

/* ===== JUDUL ===== */

.judul-anim{
    color:#5C3A21;
    display:inline-block;
    position:relative;
}

/* garis animasi bawah judul */
.judul-anim::after{
    content:'';
    width:0%;
    height:3px;
    background:#8b5e3c;
    position:absolute;
    left:0;
    bottom:-6px;
    border-radius:10px;
    transition:.4s;
}

.judul-anim:hover::after{
    width:100%;
}

/* ===== CARD ===== */

.card-modern{
    border-radius:14px;
    border:none;
    overflow:hidden;
}

/* Header table */
.table thead{
    background:#5C3A21;
    color:white;
}

</style>


<div class="container mt-4">

<div class="card card-modern shadow-sm card-animate">
<div class="card-body">

<h3 class="mb-4 judul-anim">
<i class="glyphicon glyphicon-list-alt"></i>
Laporan Penjualan
</h3>

<div class="table-responsive table-animate">

<table class="table table-bordered table-hover align-middle">

<thead>
<tr class="text-center">
<th width="5%">No</th>
<th width="20%">Tanggal</th>
<th>Barang</th>
<th width="20%">Total</th>
</tr>
</thead>

<tbody>

<?php
$no=1;

$query=mysqli_query($koneksi,"
SELECT p.*, b.nama_barang
FROM penjualan p
JOIN barang b ON p.id_barang=b.id_barang
ORDER BY p.tgl_jual DESC
");

$total_semua=0;

if(mysqli_num_rows($query) > 0){

while($d=mysqli_fetch_assoc($query)){

$total_semua += $d['total_harga'];
?>

<tr>
<td class="text-center"><?= $no++ ?></td>

<td class="text-center">
<?= date('d M Y', strtotime($d['tgl_jual'])) ?>
</td>

<td><?= $d['nama_barang'] ?></td>

<td>
<b>Rp <?= number_format($d['total_harga'],0,',','.') ?></b>
</td>
</tr>

<?php } ?>

<tr style="background:#F1E3D3;">
<td colspan="3" class="text-end">
<b>Total Semua</b>
</td>

<td>
<b class="total-glow">
Rp <?= number_format($total_semua,0,',','.') ?>
</b>
</td>
</tr>

<?php } else { ?>

<tr>
<td colspan="4" class="text-center text-muted">
Belum ada data penjualan
</td>
</tr>

<?php } ?>

</tbody>
</table>

</div>
</div>
</div>

</div>

<?php include '../footer.php'; ?>