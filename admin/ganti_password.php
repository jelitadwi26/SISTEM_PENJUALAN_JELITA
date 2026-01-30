<?php
include 'header.php';
include '../koneksi.php';

if(isset($_POST['ganti'])){

$id = $_SESSION['user_id'];
$pass_lama = md5($_POST['lama']);
$pass_baru = md5($_POST['baru']);

$cek = mysqli_query($koneksi,"
SELECT * FROM user
WHERE user_id='$id'
AND password='$pass_lama'
");

if(mysqli_num_rows($cek)>0){

mysqli_query($koneksi,"
UPDATE user
SET password='$pass_baru'
WHERE user_id='$id'
");

echo "<script>alert('Password berhasil diganti');location='index.php';</script>";

}else{
echo "<script>alert('Password lama salah!');</script>";
}
}
?>

<style>

/* BACKGROUND SOFT */
.main{
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    background:linear-gradient(135deg,#F5EBDD,#E7D5C5);
}

/* FLOAT ANIMATION */
@keyframes floatUp{
    from{
        opacity:0;
        transform:translateY(40px) scale(.96);
    }
    to{
        opacity:1;
        transform:translateY(0) scale(1);
    }
}

/* GLASS CARD */
.password-card{
    width:100%;
    max-width:520px;
    background:rgba(255,255,255,0.75);
    backdrop-filter:blur(10px);
    padding:40px;
    border-radius:20px;
    box-shadow:0 20px 60px rgba(92,64,51,.15);
    animation:floatUp .6s ease;
}

/* TITLE */
.password-title{
    text-align:center;
    margin-bottom:30px;
    font-weight:800;
    color:#5C4033;
    letter-spacing:.5px;
}

/* INPUT */
.modern-input{
    border-radius:10px;
    padding:12px;
    border:1px solid #E2D3C3;
    transition:.25s;
}

.modern-input:focus{
    border-color:#6B4A3E;
    box-shadow:0 0 0 4px rgba(107,74,62,.12);
}

/* BUTTON */
.btn-modern{
    width:100%;
    background:linear-gradient(135deg,#6B4A3E,#5C4033);
    color:white;
    border:none;
    padding:13px;
    border-radius:12px;
    font-size:16px;
    font-weight:700;
    letter-spacing:.4px;
    transition:.25s;
}

.btn-modern:hover{
    transform:translateY(-4px);
    box-shadow:0 12px 30px rgba(107,74,62,.35);
}

/* LABEL */
label{
    font-weight:600;
    margin-bottom:6px;
}

</style>


<div class="main">

    <div class="password-card">

        <h3 class="password-title">
            🔐 Ganti Password
        </h3>

        <form method="post">

            <div style="margin-bottom:20px;">
                <label>Password Lama</label>
                <input 
                    type="password" 
                    name="lama"
                    class="form-control modern-input"
                    required>
            </div>

            <div style="margin-bottom:28px;">
                <label>Password Baru</label>
                <input 
                    type="password" 
                    name="baru"
                    class="form-control modern-input"
                    required>
            </div>

            <button name="ganti" class="btn-modern">
                Update Password
            </button>

        </form>

    </div>

</div>

<?php include '../footer.php'; ?>