<?php
include 'header.php';
include '../koneksi.php';
?>

<div class="container dashboard-wrap" style="margin-top:30px;">

<style>

body{
    background:#eef2ee;
}

/* ANIMASI MUNCUL */
.dashboard-wrap{
    animation:fadeUp .7s ease;
}

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


/* ALERT */
.alert-brown{
    background:linear-gradient(90deg,#4E6F5D,#5A7D6A);
    color:white;
    border:none;
    border-radius:10px;
    box-shadow:0 6px 18px rgba(0,0,0,0.08);
}


/* PANEL */
.panel-brown{
    border:none;
    border-radius:14px;
    overflow:hidden;
    transition:.35s;
}

/* hover naik dikit */
.panel-brown:hover{
    transform:translateY(-6px);
    box-shadow:0 14px 30px rgba(0,0,0,0.12);
}


/* HEADING */
.panel-heading-brown{
    background:linear-gradient(135deg,#3F5B4B,#6B5A4A) !important;
    color:white !important;
    padding:22px;
}


/* ICON BESAR */
.panel-heading h3{
    font-weight:700;
}


/* TABLE */
.table{
    background:white;
    border-radius:12px;
    overflow:hidden;
}

.table thead{
    background:linear-gradient(90deg,#3F5B4B,#6B5A4A);
    color:white;
}

/* hover row */
.table tbody tr{
    transition:.25s;
}

.table tbody tr:hover{
    background:#f3f7f4;
}

</style>


<!-- WELCOME -->
<div class="alert alert-brown text-center">
    <h4 style="margin:0;">
        <b>Selamat Datang!</b> di Sistem Penjualan Jelita Daily
    </h4>
</div>


<div class="row">

<!-- TOTAL TRANSAKSI -->
<div class="col-md-4">
    <div class="panel panel-default panel-brown">
        <div class="panel-heading panel-heading-brown">

            <h3>
                <i class="glyphicon glyphicon-shopping-cart"></i>

                <span class="pull-right">
                <?php
                $trx = mysqli_query($koneksi,"SELECT * FROM penjualan");
                echo mysqli_num_rows($trx);
                ?>
                </span>
            </h3>

            Total Transaksi
        </div>
    </div>
</div>


<!-- TOTAL OMSET -->
<div class="col-md-4">
    <div class="panel panel-default panel-brown">
        <div class="panel-heading panel-heading-brown">

            <h3>
                <i class="glyphicon glyphicon-stats"></i>

                <span class="pull-right">
                <?php
                $omset = mysqli_query($koneksi,"SELECT SUM(total_harga) as total FROM penjualan");
                $d = mysqli_fetch_assoc($omset);
                echo "Rp ".number_format($d['total'] ?? 0);
                ?>
                </span>
            </h3>

            Total Omset
        </div>
    </div>
</div>


<!-- JUMLAH BARANG -->
<div class="col-md-4">
    <div class="panel panel-default panel-brown">
        <div class="panel-heading panel-heading-brown">

            <h3>
                <i class="glyphicon glyphicon-th-large"></i>

                <span class="pull-right">
                <?php
                $barang = mysqli_query($koneksi,"SELECT * FROM barang");
                echo mysqli_num_rows($barang);
                ?>
                </span>
            </h3>

            Jumlah Barang
        </div>
    </div>
</div>

</div>



<!-- ================= TABEL ================= -->

<table class="table table-bordered table-striped">

<thead>
<tr class="text-center">
    <th>No</th>
    <th>Id Jual</th>
    <th>Tanggal</th>
    <th>Nama Barang</th>
    <th>Harga Jual</th>
    <th>Total Harga</th>
</tr>
</thead>

<tbody>

<?php
$no = 1;

$query = "
SELECT 
    p.id_jual,
    p.tgl_jual,
    b.nama_barang,
    b.harga_jual,
    p.total_harga
FROM penjualan p
JOIN barang b 
    ON p.id_barang = b.id_barang
ORDER BY p.tgl_jual DESC
";

$result = mysqli_query($koneksi,$query);

if(mysqli_num_rows($result) > 0){

while($row = mysqli_fetch_assoc($result)){
?>

<tr>
    <td class="text-center"><?= $no++; ?></td>
    <td class="text-center"><?= $row['id_jual']; ?></td>
    <td class="text-center"><?= $row['tgl_jual']; ?></td>
    <td><?= $row['nama_barang']; ?></td>
    <td>Rp <?= number_format($row['harga_jual']); ?></td>
    <td><b>Rp <?= number_format($row['total_harga']); ?></b></td>
</tr>

<?php
}

}else{
?>

<tr>
    <td colspan="6" class="text-center">
        Belum ada transaksi
    </td>
</tr>

<?php } ?>

</tbody>
</table>

</div>

<?php include '../footer.php'; ?>