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
scroll-behavior:smooth;
}

body{
background:#f5f5f5;
overflow-x:hidden;
}

/* NAVBAR */
.navbar{
display:flex;
justify-content:space-between;
padding:20px 100px;
background:#f5f5f5;
position:sticky;
top:0;
z-index:1000;
border-bottom:1px solid #ddd;
}

/* ================= COVER ================= */
.cover{
display:flex;
height:100vh;
}

/* LEFT */
.cover-left{
flex:1;
background:#3d4a3f;
color:#f3f3f3;
padding:80px;
display:flex;
flex-direction:column;
justify-content:center;
}

.cover-left h1{
font-size:70px;
}

.cover-left p{
margin:10px 0;
color:#ddd;
}

.badge{
background:#c9a66b;
color:#2d2d2d;
padding:6px 12px;
border-radius:20px;
margin:20px 0;
width:max-content;
}

.cover-left h2{
font-size:40px;
}

.desc{
margin-top:10px;
}

/* RIGHT */
.cover-right{
flex:1;
background:#f5f5f5;
display:flex;
justify-content:center;
align-items:center;
position:relative;
}

.cover-right img{
width:350px;
filter:drop-shadow(0 30px 50px rgba(0,0,0,0.3));
}

/* ================= SECTION ================= */
section{
padding:120px 100px;
position:relative;
}

.bg-title{
position:absolute;
font-size:140px;
color:rgba(0,0,0,0.05);
top:30px;
left:80px;
transition:transform 0.2s linear;
}

/* ABOUT */
.about{
display:flex;
gap:60px;
align-items:center;
}

.about img{
width:350px;
border-radius:15px;
box-shadow:0 20px 40px rgba(0,0,0,0.2);
}

/* PRODUK */
.produk-grid{
display:grid;
grid-template-columns:repeat(4,1fr);
gap:25px;
margin-top:40px;
}

.card{
background:white;
border-radius:12px;
overflow:hidden;
transition:.4s;
box-shadow:0 10px 20px rgba(0,0,0,0.1);
}

.card:hover{
transform:translateY(-10px) scale(1.02);
box-shadow:0 20px 40px rgba(0,0,0,0.2);
}

.card img{
width:100%;
height:220px;
object-fit:cover;
}

/* ANIMATION */
.hidden-left,
.hidden-right,
.hidden-up{
opacity:0;
transition:all 1.2s cubic-bezier(0.25,1,0.5,1);
}

.hidden-left{ transform:translateX(-120px); }
.hidden-right{ transform:translateX(120px); }
.hidden-up{ transform:translateY(80px); }

.show{
opacity:1;
transform:translate(0,0);
}

/* DELAY */
.delay-1{transition-delay:.2s;}
.delay-2{transition-delay:.4s;}
.delay-3{transition-delay:.6s;}

</style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
<div><b>temukan kopi.</b></div>
<div>
<a href="#about">About</a>
<a href="#produk">Produk</a>
</div>
</div>

<!-- COVER -->
<section class="cover">

<div class="cover-left hidden-left">
<h1>TemukanKopi</h1>
<p>Menemukan cita rasa terbaik dalam setiap seduhan</p>

<div class="badge">100% ARABICA</div>

<h2>Arabica Coffee</h2>
<span>Medium Roast | 250g</span>

<p class="desc">Chocolate • Caramel • Nutty</p>
</div>

<div class="cover-right hidden-right">
<img src="images/produk-arabica.png">
</div>

</section>

<!-- ABOUT -->
<section id="about">

<div class="bg-title">About</div>

<div class="about">

<img class="hidden-left" src="images/kopi2.jpg">

<div class="hidden-right">
<h2>About Me</h2>
<p>Temukan Kopi hadir dari keyakinan bahwa setiap biji kopi memiliki cerita.</p>
<p>Kami menghadirkan kopi terbaik dari seluruh Indonesia.</p>
</div>

</div>

</section>

<!-- PRODUK -->
<section id="produk">

<h2 style="text-align:center;">Produk Kami</h2>

<div class="produk-grid">

<div class="card hidden-up delay-1">
<img src="images/produk-arabica.png">
<div style="padding:15px">
<h4>Arabica</h4>
<p>Rp 60.000</p>
</div>
</div>

<div class="card hidden-up delay-2">
<img src="images/produk-arabica.png">
<div style="padding:15px">
<h4>Robusta</h4>
<p>Rp 55.000</p>
</div>
</div>

<div class="card hidden-up delay-3">
<img src="images/produk-arabica.png">
<div style="padding:15px">
<h4>Liberica</h4>
<p>Rp 65.000</p>
</div>
</div>

<div class="card hidden-up delay-1">
<img src="images/produk-arabica.png">
<div style="padding:15px">
<h4>Toraja</h4>
<p>Rp 70.000</p>
</div>
</div>

</div>

</section>

<!-- JS -->
<script>

// ANIMATION
const elements = document.querySelectorAll(
".hidden-left, .hidden-right, .hidden-up"
);

const observer = new IntersectionObserver((entries)=>{
entries.forEach(entry=>{
if(entry.isIntersecting){
entry.target.classList.add("show");
}else{
entry.target.classList.remove("show");
}
});
},{threshold:0.2});

elements.forEach(el=>observer.observe(el));


// PARALLAX
window.addEventListener("scroll", ()=>{
let scroll = window.scrollY;

document.querySelectorAll(".bg-title").forEach(el=>{
el.style.transform = `translateY(${scroll * 0.15}px)`;
});
});

</script>

</body>
</html>