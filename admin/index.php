<?php
include 'header.php';
include '../koneksi.php';
?>

<style>

/* BACKGROUND SOFT */
body{
    background: linear-gradient(135deg,#F5F1EB,#E7DFD6);
}

/* ALERT */
.alert-pink{
    background:linear-gradient(135deg,#C6B29D,#A68A6D);
    color:#3E2C23;
    border:none;
    border-radius:14px;
    box-shadow:0 6px 18px rgba(0,0,0,0.08);
    animation:fadeIn 0.8s ease;
}

/* PANEL MODERN */
.panel{
    border:none;
    border-radius:16px;
    overflow:hidden;
    box-shadow:0 10px 25px rgba(0,0,0,0.06);
    transition:0.3s;
    animation:fadeUp 0.7s ease;
}

.panel:hover{
    transform:translateY(-6px);
    box-shadow:0 18px 35px rgba(0,0,0,0.12);
}

/* HEADING */
.panel-heading{
    border-radius:16px 16px 0 0;
    font-weight:600;
    padding:18px;
}

/* SOFT BROWN COLORS */
.brown-1{ background:linear-gradient(135deg,#E6D3B3,#D2B48C); color:#4B3621;}
.brown-2{ background:linear-gradient(135deg,#C8A27C,#A47551); color:#fff;}
.brown-3{ background:linear-gradient(135deg,#B08968,#8B5E3C); color:#fff;}
.brown-4{ background:linear-gradient(135deg,#8B6B4A,#6F4E37); color:#fff;}

/* TABLE */
.table{
    background:white;
    border-radius:12px;
    overflow:hidden;
}

.table thead{
    background:#8B5E3C;
    color:white;
}

.table tbody tr{
    transition:0.25s;
}

.table tbody tr:hover{
    background:#F3ECE6;
}

/* ANIMATIONS */
@keyframes fadeUp{
    from{
        opacity:0;
        transform:translateY(20px);
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

</style>

<div class="container">

    <div class="alert alert-pink text-center">
        <h4 style="margin-bottom:0">
            <b>Selamat Datang!</b> di Sistem Penjualan Jelita Daily
        </h4>
    </div>

    <!-- ===== KOTAK INFORMASI ===== -->
    <div class="row">

        <!-- JUMLAH BARANG -->
        <div class="col-md-3">
            <div class="panel">
                <div class="panel-heading brown-1">
                    <h2>
                        <i class="glyphicon glyphicon-th-large"></i>
                        <span class="pull-right">
                            <?php
                            $barang = mysqli_query($koneksi,"SELECT * FROM barang");
                            echo mysqli_num_rows($barang);
                            ?>
                        </span>
                    </h2>
                    Jumlah Barang
                </div>
            </div>
        </div>

        <!-- TOTAL TRANSAKSI -->
        <div class="col-md-3">
            <div class="panel">
                <div class="panel-heading brown-2">
                    <h2>
                        <i class="glyphicon glyphicon-shopping-cart"></i>
                        <span class="pull-right">
                            <?php
                            $penjualan = mysqli_query($koneksi,"SELECT * FROM penjualan");
                            echo mysqli_num_rows($penjualan);
                            ?>
                        </span>
                    </h2>
                    Total Transaksi
                </div>
            </div>
        </div>

        <!-- JUMLAH USER -->
        <div class="col-md-3">
            <div class="panel">
                <div class="panel-heading brown-3">
                    <h2>
                        <i class="glyphicon glyphicon-user"></i>
                        <span class="pull-right">
                            <?php
                            $user = mysqli_query($koneksi,"SELECT * FROM user");
                            echo mysqli_num_rows($user);
                            ?>
                        </span>
                    </h2>
                    Jumlah User
                </div>
            </div>
        </div>

        <!-- OMSET -->
        <div class="col-md-3">
            <div class="panel">
                <div class="panel-heading brown-4">
                    <h2>
                        <i class="glyphicon glyphicon-stats"></i>
                        <span class="pull-right">
                            <?php
                            $omset = mysqli_query($koneksi,"SELECT SUM(total_harga) AS total FROM penjualan");
                            $data = mysqli_fetch_assoc($omset);
                            echo "Rp ".number_format($data['total'],0,',','.');
                            ?>
                        </span>
                    </h2>
                    Total Omset
                </div>
            </div>
        </div>

    </div>

    <!-- RIWAYAT PENJUALAN -->
    <div class="panel" style="margin-top:25px;">
        <div class="panel-heading" style="background:#EFE6DD; color:#5C4033;">
            <h4><b>Riwayat Penjualan Terbaru</b></h4>
        </div>

        <div class="panel-body">
            <table class="table table-bordered">

                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Id Jual</th>
                        <th>Tanggal</th>
                        <th>Nama Barang</th>
                        <th>Harga Jual</th>
                        <th>Total Harga</th>
                        <th>Kasir</th>
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
                        p.total_harga,
                        u.user_nama
                    FROM penjualan p
                    JOIN barang b ON p.id_barang = b.id_barang
                    JOIN user u ON p.user_id = u.user_id
                    ORDER BY p.tgl_jual DESC
                ";

                $result = mysqli_query($koneksi, $query);

                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td><?= $row['id_jual']; ?></td>
                        <td><?= $row['tgl_jual']; ?></td>
                        <td><?= $row['nama_barang']; ?></td>
                        <td>Rp <?= number_format($row['harga_jual'],0,',','.'); ?></td>
                        <td>Rp <?= number_format($row['total_harga'],0,',','.'); ?></td>
                        <td><?= $row['user_nama']; ?></td>
                    </tr>
                <?php
                    }
                } else {
                ?>
                    <tr>
                        <td colspan="7" class="text-center">
                            Belum ada data penjualan
                        </td>
                    </tr>
                <?php } ?>
                </tbody>

            </table>
        </div>
    </div>

</div>

<?php include '../footer.php'; ?>