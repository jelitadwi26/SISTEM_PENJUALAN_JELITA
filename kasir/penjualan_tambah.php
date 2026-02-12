<?php include 'header.php'; ?>
<?php include '../koneksi.php'; ?>

<div class="container">
<div class="panel">
<div class="panel-heading">
<h4>Tambah Penjualan</h4>
</div>

<div class="panel-body">

<form action="penjualan_simpan.php" method="POST">

<label>Barang</label>
<select name="id_barang" class="form-control" required>
<option value="">Pilih Barang</option>

<?php
$b = mysqli_query($koneksi,"SELECT * FROM barang");
while($bb=mysqli_fetch_assoc($b)){
?>
<option value="<?= $bb['id_barang'] ?>">
<?= $bb['nama_barang'] ?> - Rp <?= number_format($bb['harga_jual']) ?>
</option>
<?php } ?>

</select>

<br>

<label>Total Harga</label>
<input type="number" name="total_harga" class="form-control" required>

<br>

<button class="btn btn-success">Simpan</button>

</form>

</div>
</div>
</div>
