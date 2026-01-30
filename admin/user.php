<?php
include 'header.php';
include '../koneksi.php';
?>

<style>

/* ===== CARD SCALE ANIMATION ===== */
@keyframes scaleIn{
    from{
        opacity:0;
        transform:scale(.96);
    }
    to{
        opacity:1;
        transform:scale(1);
    }
}

.card-modern{
    background:white;
    padding:30px;
    border-radius:14px;
    box-shadow:0 6px 18px rgba(0,0,0,0.06);
    animation:scaleIn .5s ease;
    transition:.3s;
}

.card-modern:hover{
    box-shadow:0 10px 28px rgba(0,0,0,0.08);
}


/* ===== HEADER ===== */

.header-flex{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:25px;
}


/* ===== BUTTON LIFT EFFECT ===== */

.btn-modern{
    background:#6B4A3E;
    color:white;
    border:none;
    padding:10px 18px;
    border-radius:8px;
    transition:.25s;
}

.btn-modern:hover{
    transform:translateY(-3px);
    box-shadow:0 6px 14px rgba(0,0,0,0.15);
    color:white;
}


/* ===== TABLE ===== */

.table-modern thead{
    background:#6B4A3E;
    color:white;
}

.table-modern tbody tr{
    transition:.25s;
    border-bottom:1px solid #eee;
}

.table-modern tbody tr:hover{
    background:#FAF6F2;
    transform:translateX(4px);
}


/* ===== STATUS BADGE ===== */

@keyframes pulseSoft{
    0%{transform:scale(1);}
    50%{transform:scale(1.05);}
    100%{transform:scale(1);}
}

.badge-admin{
    background:#E6D3C3;
    color:#5A3E36;
    padding:5px 12px;
    border-radius:20px;
    font-weight:600;
    animation:pulseSoft 2.5s infinite;
}

.badge-kasir{
    background:#F3E8DD;
    color:#6B4A3E;
    padding:5px 12px;
    border-radius:20px;
    font-weight:600;
}


/* ===== AKSI BUTTON ===== */

.btn-edit{
    background:#D4A373;
    color:white;
    border:none;
    border-radius:6px;
    transition:.2s;
}

.btn-hapus{
    background:#A47148;
    color:white;
    border:none;
    border-radius:6px;
    transition:.2s;
}

.btn-edit:hover,
.btn-hapus:hover{
    transform:scale(1.08);
    color:white;
}

</style>


<div class="main">

    <!-- CARD -->
    <div class="card-modern">

        <!-- HEADER -->
        <div class="header-flex">

            <h3 style="margin:0;">
                <i class="glyphicon glyphicon-user"></i>
                Data User
            </h3>

            <a href="user_tambah.php" class="btn btn-modern">
                <i class="glyphicon glyphicon-plus"></i>
                Tambah User
            </a>

        </div>


        <!-- TABLE -->
        <table class="table table-modern" style="margin-bottom:0;">
            <thead>
                <tr class="text-center">
                    <th style="width:60px;">No</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Password</th>
                    <th style="width:120px;">Status</th>
                    <th style="width:160px;">Aksi</th>
                </tr>
            </thead>

            <tbody>

            <?php
            $no=1;
            $data=mysqli_query($koneksi,"SELECT * FROM user");

            while($d=mysqli_fetch_assoc($data)){
            ?>

                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= $d['username'] ?></td>
                    <td><?= $d['user_nama'] ?></td>
                    <td><?= $d['password'] ?></td>

                    <!-- STATUS -->
                    <td class="text-center">

                        <?php if($d['user_status']==1){ ?>

                            <span class="badge-admin">
                                Admin
                            </span>

                        <?php }else{ ?>

                            <span class="badge-kasir">
                                Kasir
                            </span>

                        <?php } ?>

                    </td>

                    <!-- AKSI -->
                    <td class="text-center">

                        <a href="user_edit.php?id=<?= $d['user_id'] ?>"
                        class="btn btn-sm btn-edit">
                            Edit
                        </a>

                        <a href="user_hapus.php?id=<?= $d['user_id'] ?>"
                        class="btn btn-sm btn-hapus"
                        onclick="return confirm('Hapus user ini?')">
                            Hapus
                        </a>

                    </td>

                </tr>

            <?php } ?>

            </tbody>
        </table>

    </div>

</div>

<?php include '../footer.php'; ?>