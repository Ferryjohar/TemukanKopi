<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Temukan Kopi</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
background:#f5f5f5;
color:#333;
overflow-x:hidden;
}

/* NAVBAR */

.navbar{
display:flex;
justify-content:space-between;
align-items:center;
padding:20px 100px;
background:#f5f5f5;
position:sticky;
top:0;
z-index:1000;
border-bottom:1px solid #ddd;
}

.navbar a{
margin-left:30px;
text-decoration:none;
color:#333;
font-size:14px;
}

.navbar a:hover{
color:#1f5e3b;
}

.logo{
font-weight:600;
}

/* HERO */

.hero{
display:flex;
align-items:center;
justify-content:space-between;
padding:120px 100px;
}

.hero h1{
font-size:60px;
color:#1f5e3b;
line-height:1.1;
}

.hero p{
margin:20px 0;
color:#777;
max-width:420px;
}

.btn{
background:#1f5e3b;
color:white;
padding:12px 26px;
border-radius:30px;
text-decoration:none;
font-size:14px;
transition:.3s;
}

.btn:hover{
transform:scale(1.05);
}

.hero img{
width:380px;
}

/* SECTION */

section{
padding:120px 100px;
position:relative;
}

/* BACKGROUND TEXT */

.bg-title{
position:absolute;
font-size:120px;
font-weight:700;
color:rgba(0,0,0,0.05);
top:40px;
left:100px;
pointer-events:none;
}

/* ABOUT */

.about{
display:flex;
gap:60px;
align-items:center;
}

.about img{
width:340px;
border-radius:12px;
box-shadow:0 20px 40px rgba(0,0,0,0.2);
}

.about h2{
color:#1f5e3b;
margin-bottom:20px;
}

.about p{
line-height:1.7;
color:#666;
}

/* PRODUK */

.center{
text-align:center;
}

.produk-grid{
display:grid;
grid-template-columns:repeat(4,1fr);
gap:25px;
margin-top:40px;
}

.card{
background:white;
border-radius:10px;
overflow:hidden;
box-shadow:0 10px 20px rgba(0,0,0,0.1);
transition:.3s;
position:relative;
}

.card:hover{
transform:translateY(-8px);
}

.badge{
position:absolute;
top:10px;
left:10px;
background:#20c997;
color:white;
padding:4px 8px;
font-size:12px;
border-radius:4px;
}

.card img{
width:100%;
height:220px;
object-fit:cover;
}

.card-body{
padding:15px;
}

.price{
color:#1f5e3b;
font-weight:500;
}

/* TESTIMONI */

.testimoni-grid{
display:flex;
gap:25px;
justify-content:center;
margin-top:40px;
}

.testi{
background:#2f6f54;
color:white;
padding:30px;
border-radius:12px;
width:260px;
}

.testi span{
display:block;
margin-top:15px;
opacity:.8;
font-size:14px;
}

/* PENGIRIMAN */

.pengiriman{
display:flex;
align-items:center;
gap:50px;
background:#e1e7cf;
padding:60px;
border-radius:12px;
}

.pengiriman img{
width:260px;
}

.pengiriman-box{
background:#1f5e3b;
color:white;
padding:30px;
border-radius:10px;
max-width:400px;
}

/* MENGAPA */

.alasan{
display:grid;
grid-template-columns:repeat(3,1fr);
gap:40px;
text-align:center;
margin-top:40px;
}

.icon{
font-size:40px;
color:#1f5e3b;
}

.alasan h3{
margin-top:10px;
}

/* TIPS */

.tips{
background:url('images/kopi3.jpg');
background-size:cover;
background-position:center;
color:white;
position:relative;
}

.tips::before{
content:'';
position:absolute;
background:rgba(0,0,0,0.6);
top:0;
left:0;
width:100%;
height:100%;
}

.tips-content{
position:relative;
z-index:2;
}

.tips-grid{
display:grid;
grid-template-columns:repeat(5,1fr);
gap:20px;
margin-top:40px;
}

.step{
text-align:center;
}

/* GALERI */

.galeri-grid{
display:grid;
grid-template-columns:2fr 1fr 1fr;
grid-template-rows:200px 200px;
gap:15px;
margin-top:40px;
}

.galeri-grid img{
width:100%;
height:100%;
object-fit:cover;
border-radius:12px;
}

/* CONTACT */

.contact-grid{
display:flex;
gap:25px;
justify-content:center;
margin-top:40px;
}

.contact-card{
background:white;
padding:25px;
border-radius:10px;
width:200px;
text-align:center;
box-shadow:0 5px 20px rgba(0,0,0,0.1);
}

.contact-card.green{
background:#1f5e3b;
color:white;
}

/* MAP */

.map img{
width:100%;
border-radius:12px;
margin-top:40px;
}

/* FOOTER */

footer{
background:#0f4c34;
color:white;
padding:80px 100px;
margin-top:80px;
}

.footer-grid{
display:flex;
justify-content:space-between;
}

.copy{
text-align:center;
margin-top:40px;
opacity:.7;
}

/* ANIMATION */

.hidden{
opacity:0;
transform:translateY(60px);
transition:1s;
}

.show{
opacity:1;
transform:translateY(0);
}

</style>
</head>

<body>

<!-- NAVBAR -->

<div class="navbar">
<div class="logo">temukan kopi.</div>

<div>
<a href="#">Home</a>
<a href="#">About me</a>
<a href="#">Produk</a>
<a href="#">Kontak</a>
<a href="#">Galery</a>
</div>
</div>

<!-- HERO -->

<section class="hero hidden">

<div>
<h1>Temukan<br>Kopi</h1>

<p>
Dibuat dari biji kopi Indonesia pilihan untuk pengalaman minum kopi terbaik setiap hari
</p>

<a class="btn">Selengkapnya</a>

</div>

<img src="images/kopi1.png">

</section>

<!-- ABOUT -->

<section>

<div class="bg-title">About</div>

<div class="about hidden">

<img src="images/kopi2.jpg">

<div>

<h2>About Me</h2>

<p>
Temukan Kopi hadir dari keyakinan bahwa setiap biji kopi memiliki cerita dan cita rasa yang layak dinikmati.
</p>

<p>
Kami menghadirkan berbagai pilihan kopi terbaik dari berbagai daerah Indonesia.
</p>

</div>

</div>

</section>

<!-- PRODUK -->

<section>

<div class="center">
<h2>Produk Kami</h2>
<p>Pilihan kopi berkualitas</p>
</div>

<div class="produk-grid hidden">

<div class="card">
<div class="badge">NEW</div>
<img src="images/produk.jpg">
<div class="card-body">
<h4>Arabica</h4>
<div class="price">Rp 60.000 / 250gr</div>
</div>
</div>

<div class="card">
<div class="badge">NEW</div>
<img src="images/produk.jpg">
<div class="card-body">
<h4>Robusta</h4>
<div class="price">Rp 55.000 / 250gr</div>
</div>
</div>

<div class="card">
<div class="badge">NEW</div>
<img src="images/produk.jpg">
<div class="card-body">
<h4>Liberica</h4>
<div class="price">Rp 65.000 / 250gr</div>
</div>
</div>

<div class="card">
<div class="badge">NEW</div>
<img src="images/produk.jpg">
<div class="card-body">
<h4>Toraja</h4>
<div class="price">Rp 70.000 / 250gr</div>
</div>
</div>

</div>

</section>

<!-- TESTIMONI -->

<section>

<div class="bg-title">Testimoni</div>

<div class="center">
<h2>Testimoni Pelanggan</h2>
</div>

<div class="testimoni-grid hidden">

<div class="testi">
"Kopi sangat nikmat dan aromanya kuat."
<span>@dimas</span>
</div>

<div class="testi">
"Pengiriman cepat dan kualitas kopi mantap."
<span>@barista</span>
</div>

<div class="testi">
"Saya selalu membeli kopi di sini."
<span>@kopimania</span>
</div>

</div>

</section>

<!-- PENGIRIMAN -->

<section>

<div class="pengiriman hidden">

<img src="images/kopi4.jpg">

<div class="pengiriman-box">
Kami menyediakan layanan pengiriman kopi lokal dan internasional dengan kemasan terbaik.
</div>

</div>

</section>

<!-- MENGAPA -->

<section>

<div class="bg-title">Mengapa</div>

<div class="center">
<h2>Mengapa memilih kami?</h2>
</div>

<div class="alasan hidden">

<div>
<div class="icon">⭐</div>
<h3>Kualitas Terjamin</h3>
<p>Biji kopi pilihan terbaik</p>
</div>

<div>
<div class="icon">✔</div>
<h3>Pelayanan Terpercaya</h3>
<p>Kami melayani dengan profesional</p>
</div>

<div>
<div class="icon">☕</div>
<h3>Kepuasan Pelanggan</h3>
<p>Kami selalu mengutamakan pelanggan</p>
</div>

</div>

</section>

<!-- GALERI -->

<section>

<div class="bg-title">Kopi</div>

<div class="center">
<h2>Galeri Kopi Kami</h2>
</div>

<div class="galeri-grid hidden">

<img src="images/kopi1.png">
<img src="images/kopi2.jpg">
<img src="images/kopi3.jpg">
<img src="images/kopi4.jpg">
<img src="images/kopi5.jpg">

</div>

</section>

<!-- CONTACT -->

<section>

<div class="center">
<h2>Tim Kami Melayani Anda 24jam</h2>
</div>

<div class="contact-grid hidden">

<div class="contact-card green">
<h4>Location</h4>
<p>Indonesia</p>
</div>

<div class="contact-card">
<h4>Phone</h4>
<p>+62 812345678</p>
</div>

<div class="contact-card">
<h4>Email</h4>
<p>temukankopi@gmail.com</p>
</div>

<div class="contact-card">
<h4>Working Hour</h4>
<p>08:00 - 22:00</p>
</div>

</div>

<div class="map">
<img src="images/map.jpg">
</div>

</section>

<footer>

<div class="footer-grid">

<div>
<h3>temukan kopi.</h3>
<p>Kopi berkualitas dari Indonesia.</p>
</div>

<div>
<h4>Contact Us</h4>
<p>Madiun</p>
<p>+62 812345678</p>
</div>

<div>
<h4>Sosial Media</h4>
<p>Instagram</p>
<p>Facebook</p>
</div>

</div>

<div class="copy">
© Copyright 2025
</div>

</footer>

<script>

const observer = new IntersectionObserver((entries)=>{
entries.forEach(entry=>{
if(entry.isIntersecting){
entry.target.classList.add("show")
}
})
})

document.querySelectorAll(".hidden").forEach(el=>{
observer.observe(el)
})

</script>

</body>
</html>