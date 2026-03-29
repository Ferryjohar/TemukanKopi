<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Temukan Kopi</title>

<style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: #f7f7f7;
    overflow-x: hidden;
}

/* NAVBAR */
.navbar {
    display: flex;
    justify-content: space-between;
    padding: 20px 100px;
    background: #f5f5f5;
    position: sticky;
    top: 0;
    z-index: 1000;
}

.navbar a {
    text-decoration: none;
    color: #333;
    margin-left: 25px;
}

.navbar a:hover {
    color: #1f5e3b;
}

/* HERO */
.hero {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 100px;
}

.hero-text h1 {
    font-size: 60px;
    color: #1f5e3b;
}

.hero-text p {
    color: #7a8a7a;
    margin: 20px 0;
}

.btn {
    background: #1f5e3b;
    color: white;
    padding: 12px 25px;
    border-radius: 30px;
    text-decoration: none;
    transition: 0.3s;
}

.btn:hover {
    transform: scale(1.05);
}

.hero-img img {
    width: 400px;
}

/* ABOUT */
.about {
    display: flex;
    align-items: center;
    padding: 180px 100px;
    gap: 60px;
    position: relative;
}

/* GAMBAR TURUN */
.about-img {
    transform: translateY(100px);
}

.about-img img {
    width: 350px;
    border-radius: 20px;
    box-shadow: 0 25px 50px rgba(0,0,0,0.2);
}

/* TEXT */
.about-text {
    max-width: 500px;
    position: relative;
    z-index: 2;
}

.about-text h2 {
    font-size: 48px;
    color: #1f5e3b;
}

/* BACKGROUND TEXT + PARALLAX */
.about-bg {
    position: absolute;
    font-size: 180px;
    font-weight: bold;
    color: rgba(31, 94, 59, 0.08);
    z-index: 0;
    left: 60px;
    top: -40px;
    pointer-events: none;
    transition: transform 0.2s linear;
}

/* ANIMATION */
.hidden-left {
    opacity: 0;
    transform: translateX(-120px);
    transition: all 1.2s cubic-bezier(0.25,1,0.5,1);
}

.hidden-right {
    opacity: 0;
    transform: translateX(120px);
    transition: all 1.2s cubic-bezier(0.25,1,0.5,1);
}

.hidden-up {
    opacity: 0;
    transform: translateY(80px);
    transition: all 1.2s cubic-bezier(0.25,1,0.5,1);
}

.show {
    opacity: 1;
    transform: translateX(0) translateY(0);
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .hero, .about {
        flex-direction: column;
        text-align: center;
        padding: 80px 30px;
    }

    .about-img {
        transform: translateY(0);
    }

    .about-bg {
        font-size: 80px;
        left: 20px;
    }

    .navbar {
        flex-direction: column;
        align-items: center;
    }
}
</style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar">
    <div><b>temukan kopi.</b></div>
    <div>
        <a href="#home">Home</a>
        <a href="#tentang">About</a>
        <a href="#produk">Produk</a>
    </div>
</div>

<!-- HERO -->
<section class="hero" id="home">
    <div class="hero-text hidden-left">
        <h1>Temukan Kopi</h1>
        <p>Dibuat dari biji kopi Indonesia pilihan untuk pengalaman terbaik</p>
        <a href="#produk" class="btn">Selengkapnya</a>
    </div>

    <div class="hero-img hidden-right">
        <img src="images/kopi1.png">
    </div>
</section>

<!-- ABOUT -->
<section class="about" id="tentang">

    <div class="about-bg hidden-up" id="parallaxText">About Me</div>

    <div class="about-img hidden-left">
        <img src="images/kopi1.png">
    </div>

    <div class="about-text hidden-right">
        <h2>About Me</h2>
        <p>
            Temukan Kopi lahir dari keyakinan bahwa setiap biji kopi memiliki cerita dan cita rasa yang layak untuk dinikmati. Kami hadir sebagai platform yang menyediakan berbagai pilihan biji kopi berkualitas dari berbagai daerah di Indonesia yang mudah diakses, terpercaya, dan siap menemani setiap momen menikmati kopi Anda.

Dengan pilihan biji kopi terbaik dan kualitas yang terjaga, Temukan Kopi menjadi tempat bagi para pecinta kopi, barista, hingga penikmat kopi rumahan untuk menemukan cita rasa kopi favorit mereka—tanpa ribet, penuh aroma, dan penuh kenikmatan.
        </p>
        <p>
            Dari pecinta kopi hingga barista, semua bisa menemukan rasa favorit di sini.
        </p>
    </div>

</section>

<!-- PRODUK -->
<section class="about" id="produk">
    <div class="about-text hidden-up">
        <h2>Produk</h2>
        <p>Segera hadir produk kopi terbaik kami ☕</p>
    </div>
</section>

<!-- JS -->
<script>
// ANIMASI MASUK + RESET
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add("show");
        } else {
            entry.target.classList.remove("show");
        }
    });
}, { threshold: 0.2 });

document.querySelectorAll('.hidden-left, .hidden-right, .hidden-up')
    .forEach(el => observer.observe(el));


// PARALLAX BACKGROUND TEXT 🔥
window.addEventListener("scroll", function() {
    const text = document.getElementById("parallaxText");
    let scrollY = window.scrollY;

    text.style.transform = "translateY(" + (scrollY * 0.25) + "px)";
});
</script>

</body>
</html>