<footer class="footer">

  <!-- GOOGLE FONT -->
  <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500&display=swap" rel="stylesheet">
  <!-- FONT AWESOME -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>

/* ===== FOOTER UTAMA ===== */
.footer {
  background: linear-gradient(135deg,#556B5D,#6F5E4D);
  color: #f4f6f3;
  padding: 40px 20px 18px;
  font-family: 'Segoe UI', sans-serif;
  position: relative;
  overflow: hidden;
}

/* glow background */
.footer::before{
  content:"";
  position:absolute;
  width:500px;
  height:500px;
  background: radial-gradient(circle, rgba(255,255,255,0.08), transparent);
  top:-200px;
  left:-200px;
}

/* container */
.footer-container{
  position:relative;
  z-index:2;
  display:flex;
  flex-wrap:wrap;
  justify-content:space-between;
  max-width:1200px;
  margin:auto;
}

/* column */
.footer-about,
.footer-links,
.footer-contact,
.footer-social{
  flex:1 1 220px;
  margin:15px;
}

/* BRAND */
.footer h3{
  font-family:'Fredoka',sans-serif;
  font-size:26px;
  letter-spacing:1px;
}

.footer h3 span{
  color:#C7B7A3; /* sage latte */
}

/* title */
.footer h4{
  margin-bottom:12px;
  font-weight:600;
  color:#E6EAE5;
}

/* text */
.footer p,
.footer a{
  font-size:14px;
  line-height:1.7;
  color:#e3e7e1;
  text-decoration:none;
  transition:.3s;
}

/* hover link */
.footer a:hover{
  color:#ffffff;
  padding-left:4px;
}

/* list */
.footer-links ul{
  list-style:none;
  padding:0;
}

.footer-links ul li{
  margin-bottom:9px;
  display:flex;
  align-items:center;
}

/* icon */
.footer-links i,
.footer-contact i{
  margin-right:10px;
  color:#C7B7A3;
  width:20px;
  text-align:center;
  transition:.3s;
}

.footer-links li:hover i{
  transform:scale(1.2);
}

/* ===== SOCIAL ICON ===== */
.social-icons{
  display:flex;
  gap:16px;
  margin-top:12px;
}

.footer-social i{
  font-size:20px;
  color:#ffffff;
  background:rgba(255,255,255,0.08);
  padding:10px;
  border-radius:50%;
  transition:.35s;
}

/* ANIMASI HOVER */
.footer-social i:hover{
  background:#C7B7A3;
  color:#3F4A44;
  transform:translateY(-6px) scale(1.15);
  box-shadow:0 6px 18px rgba(0,0,0,0.2);
}

/* ===== FOOTER BOTTOM ===== */
.footer-bottom{
  text-align:center;
  margin-top:28px;
  font-size:13px;
  color:#d6dbd5;
  border-top:1px solid rgba(255,255,255,0.15);
  padding-top:14px;
}

/* ===== RESPONSIVE ===== */
@media(max-width:768px){
  .footer-container{
    flex-direction:column;
    text-align:center;
  }
}

</style>

<div class="footer-container">

  <!-- ABOUT -->
  <div class="footer-about">
    <h3>Jelita<span>Daily</span></h3>
    <p>
      Toko Fashion yang menyediakan kebutuhan busana modern:
      blouse, kemeja, rok, celana, vest, sweater, hoodie, kerudung, dan lainnya.
    </p>
  </div>

  <!-- LINKS -->
  <div class="footer-links">
    <h4>Produk Utama</h4>
    <ul>
      <li><i class="fas fa-shirt"></i> Fashion Pria</li>
      <li><i class="fas fa-person-dress"></i> Fashion Wanita</li>
      <li><i class="fas fa-bag-shopping"></i> Aksesoris</li>
    </ul>
  </div>

  <!-- CONTACT -->
  <div class="footer-contact">
    <h4>Informasi</h4>
    <p><i class="fas fa-store"></i> Jelita Daily</p>
    <p><i class="fas fa-map-marker-alt"></i> Jl. Sudirman No. 12</p>
    <p><i class="fas fa-phone"></i> 0851-3426-7890</p>
  </div>

  <!-- SOCIAL -->
  <div class="footer-social">
    <h4>Sosial Media</h4>
    <div class="social-icons">
      <a href="#"><i class="fab fa-instagram"></i></a>
      <a href="#"><i class="fab fa-facebook-f"></i></a>
      <a href="#"><i class="fab fa-whatsapp"></i></a>
    </div>
  </div>

</div>

<div class="footer-bottom">
  <p>&copy; <?php echo date("Y"); ?> Jelita Daily | All Rights Reserved</p>
</div>

</footer>