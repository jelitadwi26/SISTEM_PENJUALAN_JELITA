<?php
include 'header.php';
include '../koneksi.php';

$user_id = $_SESSION['user_id'];
?>

<div class="container py-5">
	<div class="row justify-content-center">
	<div class="col-lg-10">
		<div class="card border-0 shadow-lg">
		<div class="card-body p-4">
            <h3 class="fw-bold text-center mb-4" style="color:#5C3A21;">Laporan Penjualan Saya</h3>

			<div class="table-responsive">
			<table class="table table-bordered table-hover align-middle text-center">
				<thead style="background:#5C3A21;color:white;">
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

	<td>
	<?= date('d M Y', strtotime($d['tgl_jual'])) ?>
	</td>

	<td class="text-start ps-3">
	<?= $d['nama_barang'] ?>
	</td>

	<td class="fw-bold">
	Rp <?= number_format($d['total_harga'],0,',','.') ?>
	</td>
	</tr>

	<?php } ?>

	<tr style="background:#F1E3D3;">
	<td colspan="3" class="text-end fw-bold">
	Total Penjualan
	</td>

	<td class="fw-bold" style="color:#5C3A21;">
	Rp <?= number_format($total_semua,0,',','.') ?>
	</td>
	</tr>

	<?php } else { ?>

	<tr>
	<td colspan="4" class="text-muted">
	Belum ada transaksi
	</td>
	</tr>

<?php } ?>

</tbody>
            </table>

        </div>
    </div>
</div>

</div>
</div>
</div>

<?php include '../footer.php'; ?>
