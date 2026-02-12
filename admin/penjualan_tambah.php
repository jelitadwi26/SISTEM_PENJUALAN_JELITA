<?php include 'header.php'; ?>
<?php include '../koneksi.php'; ?>

<div class="container">
<div class="panel">
<div class="panel-heading">
<h4>Tambah Penjualan</h4>
</div>

<div class="panel-body">

<form method="post" action="penjualan_simpan.php">

<div class="form-group">
<label>Barang</label>
<select name="barang" class="form-control" required>

<option value="">-- Pilih Barang --</option>

<?php
$b = mysqli_query($koneksi,"SELECT * FROM barang");
while($br = mysqli_fetch_array($b)){
?>
<option value="<?= $br['id_barang']; ?>">
<?= $br['nama_barang']; ?>
</option>
<?php } ?>

</select>
</div>

<div class="form-group">
<label>Total Harga</label>
<input type="number" name="total" class="form-control" required>
</div>

<button class="btn btn-success">Simpan</button>

</form>

</div>
</div>
</div>
