<?php
session_start();
include '../koneksi.php';

// validasi method
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: penjualan.php");
    exit;
}

// ambil data
$id_barang = isset($_POST['id_barang']) ? (int)$_POST['id_barang'] : 0;
$jumlah    = isset($_POST['jumlah']) ? (int)$_POST['jumlah'] : 1;

// minimal beli 1
if ($jumlah < 1) {
    $jumlah = 1;
}

// ambil barang
$query  = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang='$id_barang'");
$barang = mysqli_fetch_assoc($query);

// jika barang tidak ada
if (!$barang) {
    header("Location: penjualan.php?pesan=barang_tidak_ada");
    exit;
}

// cek stok
if ($barang['stok'] < $jumlah) {
    header("Location: penjualan.php?pesan=stok_kurang");
    exit;
}

// buat cart jika belum ada
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$found = false;

// cek apakah barang sudah ada
foreach ($_SESSION['cart'] as $key => $item) {

    if ($item['id_barang'] == $id_barang) {

        $total_jumlah = $item['jumlah'] + $jumlah;

        // cek stok total
        if ($total_jumlah > $barang['stok']) {
            header("Location: penjualan.php?pesan=stok_kurang");
            exit;
        }

        $_SESSION['cart'][$key]['jumlah'] = $total_jumlah;
        $found = true;
        break;
    }
}

// jika belum ada → tambah
if (!$found) {

    $_SESSION['cart'][] = [
        'id_barang'   => $id_barang,
        'nama_barang' => $barang['nama_barang'],
        'harga'       => $barang['harga_jual'],
        'jumlah'      => $jumlah
    ];
}

// balik ke kasir
header("Location: penjualan.php");
exit;