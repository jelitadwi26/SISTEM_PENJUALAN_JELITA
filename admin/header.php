<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Penjualan | Admin</title>

    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap.js"></script>

<style>

body{
    background: linear-gradient(135deg,#FAF6F1,#F3E9DC);
    min-height:100vh;
}

/* ===== NAVBAR MODERN ===== */
.navbar-custom{
    background: rgba(92,58,33,0.95);
    backdrop-filter: blur(10px);
    border:none;
    box-shadow:0 6px 20px rgba(0,0,0,0.12);
    animation: slideDown .6s ease;
}

/* animasi turun */
@keyframes slideDown{
    from{
        transform:translateY(-70px);
        opacity:0;
    }
    to{
        transform:translateY(0);
        opacity:1;
    }
}

/* BRAND */
.navbar-custom .navbar-brand{
    color:#FFF8F0 !important;
    font-weight:700;
    font-size:22px;
    letter-spacing:.5px;
    transition:.3s;
}

.navbar-custom .navbar-brand:hover{
    text-shadow:0 0 10px rgba(255,255,255,.5);
}

/* MENU */
.navbar-custom .navbar-nav > li > a{
    color:#F5E6D3 !important;
    font-weight:500;
    transition:.25s;
    position:relative;
}

/* garis animasi bawah */
.navbar-custom .navbar-nav > li > a::after{
    content:'';
    position:absolute;
    width:0%;
    height:2px;
    bottom:0;
    left:0;
    background:#FFD8A8;
    transition:.3s;
}

.navbar-custom .navbar-nav > li > a:hover::after{
    width:100%;
}

/* hover naik dikit */
.navbar-custom .navbar-nav > li > a:hover{
    color:#fff !important;
    transform:translateY(-2px);
}

/* menu aktif */
.navbar-custom .navbar-nav > .active > a{
    background:#C08A5D !important;
    color:#fff !important;
    border-radius:8px;
}

/* dropdown */
.dropdown-menu{
    border:none;
    border-radius:12px;
    box-shadow:0 10px 25px rgba(0,0,0,0.1);
}

.dropdown-menu > li > a:hover{
    background:#F1E3D3;
}

/* logout */
.logout-btn{
    color:#FFD6CC !important;
    font-weight:600;
}

.logout-btn:hover{
    background:#A94438 !important;
    color:#fff !important;
    border-radius:8px;
}

/* teks kanan */
.navbar-text{
    color:#FFF8F0 !important;
}

/* ===== CARD DASHBOARD BIAR MODERN ===== */
.card-modern{
    background:#fff;
    border-radius:18px;
    padding:25px;
    margin-top:30px;
    box-shadow:0 10px 30px rgba(0,0,0,0.07);
    animation:fadeUp .7s ease;
}

@keyframes fadeUp{
    from{
        transform:translateY(40px);
        opacity:0;
    }
    to{
        transform:translateY(0);
        opacity:1;
    }
}

</style>

</head>
<body>

<?php
session_start();

if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: ../index.php?pesan=belum_login");
    exit();
}

if ($_SESSION['user_status'] != 1) {
    header("Location: ../index.php?pesan=akses_ditolak");
    exit();
}

$current_page = basename($_SERVER['PHP_SELF']);
?>

<nav class="navbar navbar-default navbar-custom">
  <div class="container-fluid">

    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">
        Dashboard Admin
      </a>
    </div>

    <ul class="nav navbar-nav">

      <li class="<?= ($current_page=='index.php')?'active':'' ?>">
        <a href="index.php">
          <i class="glyphicon glyphicon-home"></i> Dashboard
        </a>
      </li>

      <li class="<?= ($current_page=='barang.php')?'active':'' ?>">
        <a href="barang.php">
          <i class="glyphicon glyphicon-th-large"></i> Barang
        </a>
      </li>

      <li class="<?= ($current_page=='penjualan.php')?'active':'' ?>">
        <a href="penjualan.php">
          <i class="glyphicon glyphicon-shopping-cart"></i> Penjualan
        </a>
      </li>

      <li class="<?= ($current_page=='laporan.php')?'active':'' ?>">
        <a href="laporan.php">
          <i class="glyphicon glyphicon-list-alt"></i> Laporan
        </a>
      </li>

      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <i class="glyphicon glyphicon-cog"></i> Pengaturan 
          <span class="caret"></span>
        </a>

        <ul class="dropdown-menu">
          <li>
            <a href="user.php">
              <i class="glyphicon glyphicon-user"></i> User
            </a>
          </li>

          <li>
            <a href="ganti_password.php">
              <i class="glyphicon glyphicon-lock"></i> Ganti Password
            </a>
          </li>
        </ul>
      </li>

      <li>
        <a href="../logout.php" class="logout-btn">
            <i class="glyphicon glyphicon-log-out"></i> Logout
        </a>
      </li>

    </ul>

    <ul class="nav navbar-nav navbar-right">
      <li>
        <p class="navbar-text">
          Halo, <b><?= $_SESSION['user_nama']; ?></b> (Admin)
        </p>
      </li>
    </ul>

  </div>
</nav>