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
            background-color: #f7f7f7;
        }

        /* ================= NAVBAR ================= */
        .navbar {
            display: flex;
            justify-content: space-between;
            padding: 20px 100px;
            background: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            position: sticky;
            top: 0;
        }

        .navbar a {
            text-decoration: none;
            color: #333;
            margin-left: 20px;
            font-weight: 500;
        }

        .navbar a:hover {
            color: #1f5e3b;
        }

        /* ================= HERO ================= */
        .hero {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 80px 100px;
            background-color: #f5f5f5;
            overflow: hidden;
        }

        .hero-text {
            max-width: 500px;
            opacity: 0;
            transform: translateX(-100px);
            animation: slideLeft 1.2s ease forwards;
        }

        .hero-text h1 {
            font-size: 48px;
            color: #1f5e3b;
        }

        .hero-text p {
            margin: 20px 0;
        }

        .btn {
            background-color: #1f5e3b;
            color: white;
            padding: 12px 25px;
            border-radius: 25px;
            text-decoration: none;
        }

        .hero-img {
            opacity: 0;
            transform: translateX(100px);
            animation: slideRight 1.2s ease forwards;
            animation-delay: 0.5s;
        }

        .hero-img img {
            width: 350px;
        }

        /* ================= SECTION ================= */
        .section {
            padding: 80px 100px;
            text-align: center;
        }

        .section h2 {
            color: #1f5e3b;
            margin-bottom: 20px;
        }

        /* ================= ANIMATION ================= */
        @keyframes slideLeft {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideRight {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* ================= RESPONSIVE ================= */
        @media (max-width: 768px) {
            .hero {
                flex-direction: column;
                text-align: center;
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
    <div><b>Temukan Kopi</b></div>
    <div>
        <a href="#home">Home</a>
        <a href="#beranda">Beranda</a>
        <a href="#tentang">Tentang Kami</a>
        <a href="#produk">Produk</a>
    </div>
</div>

<!-- HERO -->
<section class="hero" id="home">
    <div class="hero-text">
        <h1>Temukan Kopi</h1>
        <p>Kopi terbaik dari seluruh Indonesia dengan cita rasa premium.</p>
        <a href="#produk" class="btn">Cek Produk</a>
    </div>

    <div class="hero-img">
        <img src="{{ asset('images/biji.png') }}" alt="Biji Kopi">
    </div>
</section>

<!-- BERANDA -->
<section class="section" id="beranda">
    <h2>Beranda</h2>
    <p>Kami menyediakan berbagai jenis kopi pilihan dari petani lokal Indonesia.</p>
</section>

<!-- TENTANG -->
<section class="section" id="tentang">
    <h2>Tentang Kami</h2>
    <p>Temukan Kopi adalah platform untuk menemukan kopi terbaik dari seluruh nusantara.</p>
</section>

<!-- PRODUK -->
<section class="section" id="produk">
    <h2>Produk</h2>
    <p>Segera hadir produk kopi terbaik kami ☕</p>
</section>

</body>
</html>