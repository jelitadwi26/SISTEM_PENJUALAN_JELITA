<?php
include 'header.php';
include '../koneksi.php';

if(isset($_POST['simpan'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $nama     = $_POST['nama'];
    $alamat   = $_POST['alamat'];
    $status   = $_POST['status'];

    mysqli_query($koneksi,"INSERT INTO user VALUES(
    NULL,
    '$username',
    '$password',
    '$nama',
    '$alamat',
    '$status'
    )");

header("location:user.php");
}
?>

<style>

/* ===== FLOAT IN ANIMATION ===== */
@keyframes floatIn{
    from{
        opacity:0;
        transform:translateY(30px) scale(.97);
        filter:blur(6px);
    }
    to{
        opacity:1;
        transform:translateY(0) scale(1);
        filter:blur(0);
    }
}

.card-modern{
    max-width:650px;
    margin:auto;
    background:white;
    padding:35px;
    border-radius:18px;
    box-shadow:0 15px 40px rgba(92,64,51,.12);
    animation:floatIn .6s ease;
    transition:.3s;
}

.card-modern:hover{
    box-shadow:0 20px 55px rgba(92,64,51,.18);
}


/* ===== TITLE ===== */
.title-modern{
    text-align:center;
    color:#5C4033;
    font-weight:700;
    margin-bottom:30px;
}


/* ===== INPUT ===== */
.form-control{
    border-radius:10px;
    padding:12px;
    border:1px solid #E0D6CD;
    transition:.25s;
}

.form-control:focus{
    border-color:#6B4A3E;
    box-shadow:0 0 0 4px rgba(107,74,62,.12);
}


/* ===== LABEL ===== */
.label-modern{
    font-weight:600;
    margin-bottom:6px;
    color:#4B3429;
}


/* ===== BUTTON ===== */

.btn-save{
    flex:1;
    background:#6B4A3E;
    color:white;
    border:none;
    padding:12px;
    border-radius:12px;
    font-weight:600;
    transition:.25s;
}

.btn-save:hover{
    background:#5C4033;
    transform:translateY(-2px);
}

.btn-save:active{
    transform:scale(.97);
}


.btn-back{
    flex:1;
    background:#D6C2B0;
    color:#5C4033;
    padding:12px;
    border-radius:12px;
    font-weight:600;
    text-align:center;
    transition:.25s;
}

.btn-back:hover{
    background:#cbb39e;
    transform:translateY(-2px);
}

</style>


<div class="main">

    <div class="card-modern">

        <h3 class="title-modern">
            👤 Tambah User Baru
        </h3>

        <form method="post">

            <!-- USERNAME -->
            <div style="margin-bottom:18px;">
                <label class="label-modern">Username</label>
                <input 
                    type="text"
                    name="username"
                    class="form-control"
                    required>
            </div>

            <!-- PASSWORD -->
            <div style="margin-bottom:18px;">
                <label class="label-modern">Password</label>
                <input 
                    type="password"
                    name="password"
                    class="form-control"
                    required>
            </div>

            <!-- NAMA -->
            <div style="margin-bottom:18px;">
                <label class="label-modern">Nama Lengkap</label>
                <input 
                    type="text"
                    name="nama"
                    class="form-control"
                    required>
            </div>

            <!-- ALAMAT -->
            <div style="margin-bottom:18px;">
                <label class="label-modern">Alamat</label>
                <input 
                    type="text"
                    name="alamat"
                    class="form-control"
                    required>
            </div>

            <!-- STATUS -->
            <div style="margin-bottom:28px;">
                <label class="label-modern">Status User</label>
                <select 
                    name="status"
                    class="form-control">
                    <option value="1">Admin</option>
                    <option value="2">Kasir</option>
                </select>
            </div>

            <!-- BUTTON -->
            <div style="display:flex; gap:12px;">
                
                <button 
                    class="btn-save"
                    name="simpan">
                    Simpan User
                </button>

                <a href="user.php" class="btn-back">
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>

<?php include '../footer.php'; ?>