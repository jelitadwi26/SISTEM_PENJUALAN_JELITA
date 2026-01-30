<?php
session_start();
include '../koneksi.php';

// ambil data
$id_barang = (int) $_POST['id_barang'];
$jumlah    = (int) $_POST['jumlah'];

// validasi jumlah
if ($jumlah < 1) {
    $jumlah = 1;
}

// ambil data barang
$query = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang='$id_barang'");
$barang = mysqli_fetch_assoc($query);

// cek stok
if ($barang['stok'] < $jumlah) {
    header("Location: penjualan.php?pesan=stok_kurang");
    exit;
}

// jika cart belum ada
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// cek apakah barang sudah ada di cart
$found = false;
foreach ($_SESSION['cart'] as $key => $item) {
    if ($item['id_barang'] == $id_barang) {

        // cek stok total
        $total_jumlah = $_SESSION['cart'][$key]['jumlah'] + $jumlah;
        if ($total_jumlah > $barang['stok']) {
            header("Location: penjualan.php?pesan=stok_kurang");
            exit;
        }

        $_SESSION['cart'][$key]['jumlah'] += $jumlah;
        $found = true;
        break;
    }
}

// kalau belum ada di cart → tambahkan
if (!$found) {
    $_SESSION['cart'][] = [
        'id_barang'   => $id_barang,
        'nama_barang' => $barang['nama_barang'],
        'harga'       => $barang['harga_jual'],
        'jumlah'      => $jumlah
    ];
}

header("Location: penjualan.php");
exit;