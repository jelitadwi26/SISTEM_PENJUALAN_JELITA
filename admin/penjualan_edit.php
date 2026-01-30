<?php
session_start();

// pastikan cart ada
if (!isset($_SESSION['cart'])) {
    header("Location: penjualan.php");
    exit;
}

// pastikan data dikirim
if (isset($_POST['key'], $_POST['jumlah'])) {

    $key = (int) $_POST['key'];
    $jumlah = (int) $_POST['jumlah'];

    // validasi jumlah
    if ($jumlah < 1) {
        $jumlah = 1;
    }

    // cek item ada di cart
    if (isset($_SESSION['cart'][$key])) {
        $_SESSION['cart'][$key]['jumlah'] = $jumlah;
    }
}

// kembali ke halaman penjualan
header("Location: penjualan.php");
exit;
