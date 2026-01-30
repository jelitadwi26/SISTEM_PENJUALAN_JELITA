<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Penjualan | Kasir</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap.js"></script>
</head>

<body style="background:#f7f3ef;"> <!-- cream lembut -->

<?php
session_start();

// proteksi login
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("Location: ../index.php?pesan=belum_login");
    exit();
}

// proteksi role kasir
if ($_SESSION['user_status'] != 2) {
    header("Location: ../index.php?pesan=akses_ditolak");
    exit();
}

$current_page = basename($_SERVER['PHP_SELF']);
?>

<<nav class="navbar navbar-sage">
  <div class="container-fluid">

    <!-- LOGO -->
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">
        🛒 PENJUALAN
      </a>
    </div>

    <!-- MENU -->
    <ul class="nav navbar-nav">

      <li class="<?= ($current_page=='index.php')?'active':'' ?>">
        <a href="index.php">
          <i class="glyphicon glyphicon-home"></i> Dashboard
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

      <li>
        <a href="../logout.php" class="logout">
          <i class="glyphicon glyphicon-log-out"></i> Logout
        </a>
      </li>

    </ul>

    <!-- USER -->
    <ul class="nav navbar-nav navbar-right">
      <li>
        <p class="navbar-text user-text">
          👩‍💼 Kasir: <b><?= $_SESSION['user_nama']; ?></b>
        </p>
      </li>
    </ul>

  </div>
</nav>


<style>

/* 🔥 NAVBAR COLOR */
.navbar-sage{
    background: linear-gradient(90deg,#4E6F5D,#6B8F71,#5A7D6A);
    border:none;
    border-radius:0;
    box-shadow: 0 4px 18px rgba(0,0,0,0.08);

    /* animasi muncul */
    animation: slideDown .7s ease;
}

/* BRAND */
.navbar-sage .navbar-brand{
    color:#f4fbf7 !important;
    font-weight:bold;
    letter-spacing:1px;
    transition:.3s;
}

.navbar-sage .navbar-brand:hover{
    transform: scale(1.05);
}

/* MENU */
.navbar-sage .navbar-nav li a{
    color:#ecf7f1 !important;
    font-weight:500;
    transition:.3s;
}

/* hover glow */
.navbar-sage .navbar-nav li a:hover{
    background: rgba(255,255,255,0.08) !important;
    border-radius:6px;
}

/* ACTIVE MENU */
.navbar-sage .navbar-nav .active a{
    background: rgba(0,0,0,0.15) !important;
    border-radius:6px;
}

/* logout beda dikit */
.logout{
    color:#d7efe4 !important;
    font-weight:bold;
}

.logout:hover{
    background: rgba(0,0,0,0.18) !important;
}

/* user text */
.user-text{
    color:#e6f5ee !important;
}

/* 🔥 animasi turun */
@keyframes slideDown{
    from{
        opacity:0;
        transform:translateY(-40px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

</style>

  </div>
</nav>