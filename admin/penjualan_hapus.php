<?php
session_start();

// pastikan cart ada
if (!isset($_SESSION['cart'])) {
    header("Location: penjualan.php");
    exit;
}

// pastikan key dikirim
if (isset($_GET['key'])) {

    $key = (int) $_GET['key'];

    // cek item ada di cart
    if (isset($_SESSION['cart'][$key])) {
        unset($_SESSION['cart'][$key]);

        // rapikan index array supaya urut lagi
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}

// kembali ke halaman penjualan
header("Location: penjualan.php");
exit;
