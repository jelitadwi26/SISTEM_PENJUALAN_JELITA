<?php
include 'header.php';
include '../koneksi.php';

if(isset($_POST['submit'])){
    $nama = $_POST['nama_barang'];
    $harga_beli = $_POST['harga_beli'];
    $harga_jual = $_POST['harga_jual'];
    $stok = $_POST['stok'];

    mysqli_query($koneksi, "INSERT INTO barang (nama_barang, harga_beli, harga_jual, stok)
    VALUES ('$nama', '$harga_beli', '$harga_jual', '$stok')");

    header("location:barang.php");
}
?>

<style>

:root{
    --coklat-utama:#8b5e3c;
    --coklat-tua:#5a3d2b;
    --coklat-muda:#f7f3ef;
}

/* BACKGROUND BIAR GA POLOS */
body{
    background:linear-gradient(135deg,#fbf8f4,#efe6dd);
}

/* CARD MODERN */
.card-coklat{
    background:white;
    border-radius:16px;
    padding:35px;
    box-shadow:0 10px 30px rgba(0,0,0,0.06);

    animation:fadeUp .7s ease;
    transition:.3s;
}

.card-coklat:hover{
    transform:translateY(-6px);
    box-shadow:0 18px 45px rgba(0,0,0,.08);
}

/* JUDUL */
.judul-coklat{
    color: var(--coklat-tua);
    font-weight:700;
    letter-spacing:.5px;

    animation:fadeDown .6s ease;
}

/* LABEL */
label{
    font-weight:600;
    color: var(--coklat-tua);
    margin-top:10px;
}

/* INPUT MODERN */
.form-control{
    border-radius:10px;
    padding:10px;
    border:1px solid #ddd;
    transition:.25s;
}

.form-control:hover{
    border-color:var(--coklat-utama);
}

.form-control:focus{
    border-color: var(--coklat-utama);
    box-shadow:0 0 8px rgba(139,94,60,0.25);
    transform:scale(1.01);
}

/* TOMBOL SIMPAN */
.btn-coklat{
    background: var(--coklat-utama);
    border:none;
    color:white;
    border-radius:10px;
    padding:10px 18px;
    font-weight:600;
    transition:.25s;
}

.btn-coklat:hover{
    background: var(--coklat-tua);
    transform:translateY(-3px);
    box-shadow:0 8px 20px rgba(139,94,60,.35);
}

/* TOMBOL KEMBALI */
.btn-outline-coklat{
    border:2px solid var(--coklat-utama);
    color: var(--coklat-utama);
    border-radius:10px;
    padding:8px 16px;
    font-weight:600;
    transition:.25s;
}

.btn-outline-coklat:hover{
    background: var(--coklat-utama);
    color:white;
    transform:translateY(-3px);
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

    <div class="card-coklat">

        <h3 class="text-center mb-4 judul-coklat">
            📦 Tambah Barang
        </h3>

        <form method="POST">

            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Harga Beli</label>
                <input type="number" name="harga_beli" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Harga Jual</label>
                <input type="number" name="harga_jual" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control" required>
            </div>

            <button type="submit" name="submit" class="btn btn-coklat mt-3">
                💾 Simpan
            </button>

            <a href="barang.php" class="btn btn-outline-coklat mt-3">
                ← Kembali
            </a>

        </form>

    </div>
</div>

<?php include '../footer.php'; ?>