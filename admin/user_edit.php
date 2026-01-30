<?php
include 'header.php';
include '../koneksi.php';

$id = $_GET['id'];
$data = mysqli_query($koneksi,"SELECT * FROM user WHERE user_id='$id'");
$d = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

$username = $_POST['username'];
$nama     = $_POST['nama'];
$password   = $_POST['password'];
$status   = $_POST['status'];

mysqli_query($koneksi,"UPDATE user SET
username='$username',
user_nama='$nama',
password='$password',
user_status='$status'
WHERE user_id='$id'
");

header("location:user.php");
}
?>

<style>

/* ===== ANIMASI MASUK ===== */
@keyframes smoothEntry{
    from{
        opacity:0;
        transform:translateY(35px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

/* CARD */
.card-edit{
    max-width:600px;
    margin:auto;
    background:white;
    padding:35px;
    border-radius:20px;
    box-shadow:0 18px 45px rgba(92,64,51,.12);
    animation:smoothEntry .5s ease;
    transition:.3s;
}

.card-edit:hover{
    box-shadow:0 25px 60px rgba(92,64,51,.18);
}


/* JUDUL */
.title-edit{
    text-align:center;
    color:#5C4033;
    font-weight:700;
    margin-bottom:30px;
}


/* LABEL */
.label-modern{
    font-weight:600;
    color:#4B3429;
    margin-bottom:6px;
}


/* INPUT */
.form-control{
    border-radius:12px;
    padding:12px;
    border:1px solid #E5D8CE;
    transition:.25s;
}

.form-control:focus{
    border-color:#6B4A3E;
    box-shadow:0 0 0 4px rgba(107,74,62,.12);
}


/* BUTTON */
.btn-update{
    flex:1;
    background:#6B4A3E;
    color:white;
    border:none;
    padding:12px;
    border-radius:12px;
    font-weight:600;
    transition:.25s;
}

.btn-update:hover{
    background:#5C4033;
    transform:translateY(-2px);
}

.btn-update:active{
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

    <div class="card-edit">

        <h3 class="title-edit">
            ✏️ Edit User
        </h3>

        <form method="post">

            <!-- USERNAME -->
            <div style="margin-bottom:18px;">
                <label class="label-modern">Username</label>
                <input 
                    type="text"
                    name="username"
                    value="<?= $d['username'] ?>"
                    class="form-control"
                    required>
            </div>

            <!-- NAMA -->
            <div style="margin-bottom:18px;">
                <label class="label-modern">Nama</label>
                <input 
                    type="text"
                    name="nama"
                    value="<?= $d['user_nama'] ?>"
                    class="form-control"
                    required>
            </div>

            <!-- PASSWORD -->
            <div style="margin-bottom:18px;">
                <label class="label-modern">Password</label>
                <input 
                    type="text"
                    name="password"
                    value="<?= $d['password'] ?>"
                    class="form-control"
                    required>
            </div>

            <!-- STATUS -->
            <div style="margin-bottom:28px;">
                <label class="label-modern">Status</label>
                <select 
                    name="status"
                    class="form-control"
                >
                    <option value="1" <?= ($d['user_status']==1)?'selected':'' ?>>
                        Admin
                    </option>

                    <option value="2" <?= ($d['user_status']==2)?'selected':'' ?>>
                        Kasir
                    </option>
                </select>
            </div>

            <!-- BUTTON -->
            <div style="display:flex; gap:12px;">
                
                <button 
                    class="btn-update"
                    name="update">
                    Update User
                </button>

                <a href="user.php" class="btn-back">
                    Kembali
                </a>

            </div>

        </form>

    </div>

</div>

<?php include '../footer.php'; ?>