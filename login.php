<?php
session_start();
include "koneksi.php";

$username = $_POST['username'];
$password = md5($_POST['password']);

$sql = "SELECT * FROM user 
        WHERE username='$username' AND password='$password'";
$query = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($query) == 1) {
    $u = mysqli_fetch_assoc($query);

    $_SESSION['status'] = "login";
    $_SESSION['user_id'] = $u['user_id'];
    $_SESSION['username'] = $u['username'];
    $_SESSION['user_nama'] = $u['user_nama'];
    $_SESSION['user_status'] = $u['user_status'];

    // Arahkan sesuai role
    if ($u['user_status'] == 1) {
        header("Location: admin/index.php");
    } else {
        header("Location: kasir/index.php");
    }
} else {
    header("Location: index.php?pesan=gagal");
}
