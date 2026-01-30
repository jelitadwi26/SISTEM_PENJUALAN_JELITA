<?php
session_start();
include '../koneksi.php';

// pastikan cart ada
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    header("Location: penjualan.php?pesan=kosong");
    exit;
}

// mulai transaksi
mysqli_begin_transaction($koneksi);

try {

    foreach ($_SESSION['cart'] as $item) {

        $id_barang = (int)$item['id_barang'];
        $jumlah    = (int)$item['jumlah'];
        $harga     = (int)$item['harga'];
        $user_id   = $_SESSION['user_id'];

        if ($jumlah < 1) {
            throw new Exception("Jumlah tidak valid");
        }

        // cek stok barang
        $cek = mysqli_query($koneksi, "SELECT stok FROM barang WHERE id_barang='$id_barang'");
        $data = mysqli_fetch_assoc($cek);

        if ($data['stok'] < $jumlah) {
            throw new Exception("Stok tidak mencukupi");
        }

        $total_harga = $harga * $jumlah;

        // simpan penjualan
        mysqli_query($koneksi, "
            INSERT INTO penjualan (id_barang, tgl_jual, total_harga, user_id)
            VALUES ('$id_barang', NOW(), '$total_harga', '$user_id')
        ");

        // update stok
        mysqli_query($koneksi, "
            UPDATE barang 
            SET stok = stok - $jumlah 
            WHERE id_barang='$id_barang'
        ");
    }

    // commit transaksi
    mysqli_commit($koneksi);

    // kosongkan cart
    unset($_SESSION['cart']);

    header("Location: penjualan.php?pesan=berhasil");
    exit;

} catch (Exception $e) {

    // rollback jika ada error
    mysqli_rollback($koneksi);

    header("Location: penjualan.php?pesan=gagal");
    exit;
}
