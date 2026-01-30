<?php
include 'header.php';
include '../koneksi.php';
?>

<style>

/* BACKGROUND */
body{
    background:#eef2ee;
}


/* ANIMASI HALAMAN */
.container{
    animation:fadeUp .6s ease;
}

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


/* PANEL */
.panel-brown{
    border:none;
    border-radius:14px;
    overflow:hidden;
    transition:.35s;
    box-shadow:0 6px 18px rgba(0,0,0,0.06);
}

/* hover naik dikit */
.panel-brown:hover{
    transform:translateY(-6px);
    box-shadow:0 18px 35px rgba(0,0,0,0.12);
}


/* HEADER PANEL */
.panel-heading-brown{
    background:linear-gradient(135deg,#3F5B4B,#6B5A4A) !important;
    color:white !important;
    font-size:16px;
    letter-spacing:.5px;
}


/* BUTTON */
.btn-brown{
    background:linear-gradient(135deg,#4E6F5D,#6B5A4A);
    color:white;
    border:none;
    border-radius:8px;
    font-weight:600;
    transition:.3s;
}

/* hover tombol */
.btn-brown:hover{
    transform:translateY(-2px);
    box-shadow:0 8px 18px rgba(0,0,0,0.18);
    color:white;
}


/* TABLE */
.table{
    background:white;
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


/* TOTAL */
.total-text{
    color:#3F5B4B;
    font-weight:800;
}


/* PANEL FOOTER */
.panel-footer{
    background:#e6efe9 !important;
}


/* INPUT BIAR MODERN */
.form-control{
    border-radius:8px;
    border:1px solid #d6e0da;
    box-shadow:none;
}

.form-control:focus{
    border-color:#4E6F5D;
    box-shadow:0 0 6px rgba(78,111,93,.2);
}

</style>


<div class="container mt-4">

    <h3 class="mb-4 text-center" style="color:#3F5B4B; font-weight:700;">
        <i class="glyphicon glyphicon-shopping-cart"></i>
        Penjualan Kasir
    </h3>

    <div class="row">

        <!-- ================= FORM PILIH BARANG ================= -->
        <div class="col-md-4">
            <div class="panel panel-default panel-brown">
                <div class="panel-heading panel-heading-brown">
                    <b>Tambah Item</b>
                </div>
                <div class="panel-body">
                    <form method="post" action="penjualan_tambah.php">

                        <label>Barang</label>
                        <select name="id_barang" class="form-control" required>
                            <option value="">-- Pilih Barang --</option>
                            <?php
                            $brg = mysqli_query($koneksi, "SELECT * FROM barang");
                            while($b = mysqli_fetch_assoc($brg)){
                                echo "<option value='{$b['id_barang']}'>
                                    {$b['nama_barang']} - Rp ".number_format($b['harga_jual'])." (Stok {$b['stok']})
                                </option>";
                            }
                            ?>
                        </select>

                        <label style="margin-top:10px;">Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" min="1" value="1" required>

                        <button type="submit" class="btn btn-brown btn-block" style="margin-top:15px;">
                            <i class="glyphicon glyphicon-plus"></i> Tambah ke Keranjang
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- ================= KERANJANG ================= -->
        <div class="col-md-8">
            <div class="panel panel-default panel-brown">
                <div class="panel-heading panel-heading-brown">
                    <b>Keranjang Belanja</b>
                </div>

                <table class="table table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Barang</th>
                            <th width="140">Qty</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

<?php
if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){
    $no = 1;
    $total = 0;

    foreach($_SESSION['cart'] as $key => $value){
        $subtotal = $value['harga'] * $value['jumlah'];
        $total += $subtotal;
?>
                        <tr>
                            <td class="text-center"><?= $no ?></td>
                            <td><?= $value['nama_barang'] ?></td>
                            <td>
                                <form action="penjualan_edit.php" method="post" class="form-inline">
                                    <input type="hidden" name="key" value="<?= $key ?>">
                                    <input type="number" name="jumlah"
                                           value="<?= $value['jumlah'] ?>"
                                           min="1"
                                           class="form-control input-sm"
                                           style="width:70px">

                                    <button class="btn btn-warning btn-sm">
                                        <i class="glyphicon glyphicon-refresh"></i>
                                    </button>
                                </form>
                            </td>
                            <td>Rp <?= number_format($value['harga']) ?></td>
                            <td><b>Rp <?= number_format($subtotal) ?></b></td>
                            <td class="text-center">
                                <a href="penjualan_hapus.php?key=<?= $key ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Hapus item?')">
                                   <i class="glyphicon glyphicon-trash"></i>
                                </a>
                            </td>
                        </tr>
<?php
        $no++;
    }
?>
                        <tr style="background:#e6efe9;">
                            <td colspan="4" class="text-right">
                                <b>Total Bayar</b>
                            </td>
                            <td colspan="2">
                                <h3 class="total-text">
                                    Rp <?= number_format($total) ?>
                                </h3>
                            </td>
                        </tr>
<?php
}else{
    echo "<tr>
        <td colspan='6' class='text-center text-muted'>
            Keranjang masih kosong
        </td>
    </tr>";
}
?>
                    </tbody>
                </table>

                <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){ ?>
                <div class="panel-footer text-right">
                    <form method="post" action="penjualan_simpan.php">
                        <button type="submit" class="btn btn-brown btn-lg">
                            <i class="glyphicon glyphicon-ok-circle"></i>
                            Checkout & Simpan
                        </button>
                    </form>
                </div>
                <?php } ?>

            </div>
        </div>

    </div>
</div>

<?php include '../footer.php'; ?>