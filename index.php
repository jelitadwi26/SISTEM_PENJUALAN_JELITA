<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login | Sistem Penjualan</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

/* ================= BACKGROUND ================= */
body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    font-family:'Segoe UI', sans-serif;
    overflow:hidden;

    background: linear-gradient(135deg,#e6dfd5,#d6ccc2,#b7a79a);
    background-size:200% 200%;
    animation:bgGerak 12s ease infinite;
}

@keyframes bgGerak{
    0%{background-position:0% 50%;}
    50%{background-position:100% 50%;}
    100%{background-position:0% 50%;}
}


/* ================= FLOATING BUBBLE ================= */
body::before{
    content:'';
    position:absolute;
    width:520px;
    height:520px;
    background:#a1887f;
    border-radius:50%;
    top:-150px;
    left:-150px;
    filter:blur(150px);
    animation:float1 8s ease-in-out infinite;
}

body::after{
    content:'';
    position:absolute;
    width:420px;
    height:420px;
    background:#8d6e63;
    border-radius:50%;
    bottom:-150px;
    right:-150px;
    filter:blur(130px);
    animation:float2 10s ease-in-out infinite;
}

@keyframes float1{
    0%{transform:translateY(0);}
    50%{transform:translateY(50px);}
    100%{transform:translateY(0);}
}

@keyframes float2{
    0%{transform:translateY(0);}
    50%{transform:translateY(-40px);}
    100%{transform:translateY(0);}
}


/* ================= CARD ================= */
.login-card{
    width:400px;
    padding:38px;
    border-radius:22px;

    backdrop-filter: blur(18px);
    background: rgba(255,255,255,.60);

    box-shadow:0 30px 70px rgba(90,60,40,.25);
    position:relative;
    z-index:2;

    animation:cardMasuk .9s ease;
}

@keyframes cardMasuk{
    from{
        opacity:0;
        transform:translateY(60px) scale(.92);
    }
    to{
        opacity:1;
        transform:translateY(0) scale(1);
    }
}


/* ================= LOGO ================= */
.logo-circle{
    width:80px;
    height:80px;
    background:linear-gradient(135deg,#8d6e63,#5d4037);
    border-radius:50%;

    display:flex;
    align-items:center;
    justify-content:center;

    color:white;
    font-size:34px;

    margin:0 auto 18px auto;

    box-shadow:0 12px 25px rgba(0,0,0,.25);

    animation:logoPop 1s ease;
}

@keyframes logoPop{
    0%{transform:scale(0);}
    70%{transform:scale(1.15);}
    100%{transform:scale(1);}
}


/* ================= TEXT ================= */
.login-title{
    font-weight:800;
    color:#4e342e;
    letter-spacing:1px;
}

.login-sub{
    color:#7b6a58;
    margin-bottom:28px;
}


/* ================= INPUT ================= */
.form-control{
    border-radius:12px;
    padding:12px;
    border:1px solid #c7b8a7;
    transition:.25s;
}

.form-control:focus{
    border-color:#8d6e63;
    box-shadow:0 0 0 4px rgba(141,110,99,.15);
    transform:scale(1.02);
}


/* ================= BUTTON ================= */
.btn-login{
    background: linear-gradient(135deg,#8d6e63,#6d4c41);
    border:none;
    padding:12px;
    border-radius:14px;
    font-weight:700;
    letter-spacing:.5px;
    transition:.25s;
}

.btn-login:hover{
    transform:translateY(-5px);
    box-shadow:0 14px 28px rgba(80,50,30,.35);
}

.btn-login:active{
    transform:scale(.97);
}


/* ================= ALERT ================= */
.alert{
    border-radius:12px;
    font-size:14px;
    animation:alertFade .5s ease;
}

@keyframes alertFade{
    from{
        opacity:0;
        transform:translateY(-10px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

</style>
</head>

<body>

<div class="login-card">

    <div class="logo-circle">
        🛍️
    </div>

    <h3 class="text-center login-title">SISTEM PENJUALAN</h3>
    <p class="text-center login-sub">Silakan Login untuk Melanjutkan</p>

<?php
if(isset($_GET['pesan'])){
    if($_GET['pesan']=="gagal"){
        echo "<div class='alert alert-danger text-center'>Username atau Password salah</div>";
    }elseif($_GET['pesan']=="belum_login"){
        echo "<div class='alert alert-warning text-center'>Silakan login dulu</div>";
    }elseif($_GET['pesan']=="logout"){
        echo "<div class='alert alert-success text-center'>Berhasil logout</div>";
    }
}
?>

<form method="post" action="login.php">

    <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>

    <button class="btn btn-login w-100 text-white">
        LOGIN
    </button>

</form>

</div>

</body>
</html>