<?php
include 'header.php';
include '../koneksi.php';
?>

<style>

:root{
    --coklat-utama:#8b5e3c;
    --coklat-tua:#5a3d2b;
    --coklat-soft:#f6f1eb;
}

/* BACKGROUND BIAR GA FLAT */
body{
    background:linear-gradient(135deg,#fbf8f4,#efe6dd);
}

/* JUDUL */
.judul{
    color:var(--coklat-tua);
    font-weight:700;
    animation:fadeDown .6s ease;
}

/* PANEL MODERN */
.panel-custom{
    border:none;
    border-radius:16px;
    box-shadow:0 10px 30px rgba(0,0,0,0.06);
    overflow:hidden;

    transition:.35s;
    animation:fadeUp .7s ease;
}

.panel-custom:hover{
    transform:translateY(-6px);
    box-shadow:0 18px 45px rgba(0,0,0,.08);
}

/* HEADING */
.panel-custom .panel-heading{
    background:linear-gradient(90deg,#8b5e3c,#a47551);
    color:white;
    font-weight:700;
    letter-spacing:.5px;
}

/* TABLE */
.table thead{
    background:var(--coklat-soft);
}

.table tbody tr{
    transition:.25s;
}

.table tbody tr:hover{
    background:#f1e6dc;
    transform:scale(1.01);
}

/* INPUT */
.form-control{
    border-radius:10px;
    transition:.25s;
}

.form-control:focus{
    border-color:var(--coklat-utama);
    box-shadow:0 0 8px rgba(139,94,60,0.25);
}

/* TOMBOL UTAMA */
.btn-coklat{
    background:var(--coklat-utama);
    color:white;
    border:none;
    border-radius:10px;
    font-weight:600;
    transition:.25s;
}

.btn-coklat:hover{
    background:var(--coklat-tua);
    transform:translateY(-3px);
    box-shadow:0 8px 20px rgba(139,94,60,.35);
}

/* UPDATE */
.btn-warning{
    background:#a47551;
    border:none;
    color:white;
    border-radius:8px;
    transition:.25s;
}

.btn-warning:hover{
    background:var(--coklat-tua);
    transform:scale(1.1);
}

/* DELETE */
.btn-danger{
    border-radius:8px;
    transition:.25s;
}

.btn-danger:hover{
    transform:scale(1.1);
}

/* TOTAL */
.total-text{
    color:var(--coklat-tua);
    font-weight:800;
}

/* CHECKOUT AREA */
.panel-footer{
    border-top:none;
}

/* ANIMASI */
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

@keyframes fadeDown{
    from{
        opacity:0;
        transform:translateY(-20px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

</style>


<div class="container mt-4">

    <h3 class="mb-4 judul">
        🛒 Transaksi Penjualan
    </h3>


    <!-- ===== TAMBAH BARANG ===== -->
    <div class="panel panel-custom">
        <div class="panel-heading">Tambah Barang</div>

        <div class="panel-body">
            <form method="post" action="penjualan_tambah.php">
                <div class="row">

                    <div class="col-md-6">
                        <label>Nama Barang</label>
                        <select name="id_barang" class="form-control" required>
                            <option value="">-- Pilih Barang --</option>
                            <?php
                            $brg = mysqli_query($koneksi, "SELECT * FROM barang");
                            while($b = mysqli_fetch_assoc($brg)){
                                echo "<option value='{$b['id_barang']}'>
                                        {$b['nama_barang']} 
                                        (Rp ".number_format($b['harga_jual']).") 
                                        | Stok: {$b['stok']}
                                      </option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label>Jumlah</label>
                        <input type="number" name="jumlah" class="form-control" min="1" value="1" required>
                    </div>

                    <div class="col-md-3">
                        <label>&nbsp;</label>
                        <button type="submit" class="btn btn-coklat btn-block">
                            ➕ Tambah
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>


    <!-- ===== KERANJANG ===== -->
    <div class="panel panel-custom mt-4">
        <div class="panel-heading">Keranjang Belanja</div>

        <div class="panel-body p-0">
            <table class="table table-striped table-bordered mb-0">
                <thead>
                    <tr>
                        <th width="40">No</th>
                        <th>Nama Barang</th>
                        <th width="160">Jumlah</th>
                        <th width="120">Harga</th>
                        <th width="140">Subtotal</th>
                        <th width="130">Aksi</th>
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
    <td><?= $no ?></td>
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
                ✏️
            </button>
        </form>
    </td>

    <td>Rp <?= number_format($value['harga']) ?></td>
    <td><b>Rp <?= number_format($subtotal) ?></b></td>

    <td class="text-center">
        <a href="penjualan_hapus.php?key=<?= $key ?>"
           class="btn btn-danger btn-sm"
           onclick="return confirm('Hapus barang ini?')">
           🗑️
        </a>
    </td>
</tr>

<?php
        $no++;
    }
?>

<tr style="background:var(--coklat-soft)">
    <td colspan="4" class="text-right"><b>Total Bayar</b></td>
    <td colspan="2">
        <h4 class="total-text">
            Rp <?= number_format($total) ?>
        </h4>
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
        </div>


        <!-- CHECKOUT -->
        <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0){ ?>
        <div class="panel-footer text-right" style="background:#fff;">
            <form method="post" action="penjualan_simpan.php">
                <button type="submit" class="btn btn-coklat btn-lg">
                    ✅ Simpan Transaksi
                </button>
            </form>
        </div>
        <?php } ?>

    </div>
</div>

<?php include '../footer.php'; ?>