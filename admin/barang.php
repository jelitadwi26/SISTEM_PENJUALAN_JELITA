<?php
include 'header.php';
include '../koneksi.php';
?>

<style>

/* ===== COLOR SYSTEM (SOFT BROWN MODERN) ===== */
:root{
    --brown:#8B5E3C;
    --brown-dark:#5A3D2B;
    --brown-light:#F6F1EB;
}

/* Background biar tidak polos */
body{
    background: linear-gradient(135deg,#f8f5f2,#efe7df);
}

/* Container jadi card besar */
.container{
    margin-top:30px;
    background:white;
    padding:30px;
    border-radius:18px;
    box-shadow:0 10px 35px rgba(0,0,0,.07);
    animation:fadeUp .7s ease;
}

/* Judul */
.judul-halaman{
    color:var(--brown-dark);
    font-weight:700;
    letter-spacing:.5px;
    animation:fadeDown .7s ease;
}

/* Tombol modern */
.btn-coklat{
    background:linear-gradient(135deg,var(--brown),#a97957);
    border:none;
    color:white;
    padding:10px 18px;
    border-radius:10px;
    font-weight:600;
    transition:.25s;
}

.btn-coklat:hover{
    transform:translateY(-3px);
    box-shadow:0 8px 18px rgba(139,94,60,.3);
}

/* tombol edit */
.btn-warning{
    border:none;
    border-radius:8px;
    transition:.2s;
}

.btn-warning:hover{
    transform:translateY(-2px);
}

/* tombol hapus */
.btn-danger{
    border:none;
    border-radius:8px;
    transition:.2s;
}

.btn-danger:hover{
    transform:translateY(-2px);
}

/* TABLE MODERN */
.table{
    border-radius:12px;
    overflow:hidden;
    margin-top:10px;
}

/* header tabel */
.table thead{
    background:linear-gradient(90deg,var(--brown),#a97957);
    color:white;
}

/* row */
.table tbody tr{
    transition:.25s;
}

/* hover row */
.table tbody tr:hover{
    background:#f3ebe4;
    transform:scale(1.01);
}

/* zebra soft */
.table-striped > tbody > tr:nth-of-type(odd){
    background:#fcfaf8;
}

/* search box */
.search-box{
    width:260px;
    border-radius:10px;
    padding:8px 12px;
    border:1px solid #ddd;
    transition:.2s;
}

.search-box:focus{
    border-color:var(--brown);
    box-shadow:0 0 0 3px rgba(139,94,60,.15);
    outline:none;
}

/* ===== ANIMATIONS ===== */

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


<div class="container">

    <h3 class="text-center mb-4 judul-halaman">
        Data Barang
    </h3>

    <!-- tombol + search -->
    <div class="d-flex justify-content-between align-items-center mb-3">

        <a href="barang_tambah.php" class="btn btn-coklat">
            <i class="glyphicon glyphicon-plus"></i> Tambah Barang
        </a>

        <input 
            type="text" 
            id="search"
            class="search-box"
            placeholder="Cari barang..."
        >

    </div>
    <table class="table table-bordered table-striped shadow-sm" id="tabelBarang">
        <thead class="text-center">
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        <?php
        $no = 1;
        $query = "SELECT * FROM barang ORDER BY id_barang DESC";
        $result = mysqli_query($koneksi, $query);

        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>
                        <td class='text-center'>{$no}</td>
                        <td>{$row['nama_barang']}</td>
                        <td>Rp ".number_format($row['harga_beli'],0,',','.')."</td>
                        <td>Rp ".number_format($row['harga_jual'],0,',','.')."</td>
                        <td class='text-center'>{$row['stok']}</td>
                        <td class='text-center'>
                            <a href='barang_edit.php?id={$row['id_barang']}' class='btn btn-warning btn-sm'>
                                <i class='glyphicon glyphicon-pencil'></i>
                            </a>
                            <a href='barang_hapus.php?id={$row['id_barang']}' 
                               class='btn btn-danger btn-sm'
                               onclick='return confirm(\"Yakin ingin menghapus?\");'>
                                <i class='glyphicon glyphicon-trash'></i>
                            </a>
                        </td>
                      </tr>";
                $no++;
            }
        } else {
            echo "<tr>
                    <td colspan='6' class='text-center'>
                        Belum ada data barang
                    </td>
                  </tr>";
        }
        ?>
        </tbody>
    </table>

</div>


<!-- SEARCH JS (SUPER RINGAN) -->
<script>
document.getElementById("search").addEventListener("keyup", function() {

    let value = this.value.toLowerCase();
    let rows = document.querySelectorAll("#tabelBarang tbody tr");

    rows.forEach(row => {
        row.style.display =
        row.innerText.toLowerCase().includes(value)
        ? ""
        : "none";
    });

});
</script>

<?php include '../footer.php'; ?>