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

        .navbar {
            display: flex;
            justify-content: space-between;
            padding: 20px 100px;
            background: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .navbar a {
            text-decoration: none;
            color: #333;
            margin-left: 20px;
        }

        .hero {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 80px 100px;
            background-color: #f5f5f5;
        }

        .hero-text {
            max-width: 500px;
            opacity: 0;
            animation: slideLeft 1s ease forwards;
        }

        .hero-text h1 {
            font-size: 48px;
            color: #1f5e3b;
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
            animation: slideRight 1s ease forwards;
            animation-delay: 0.3s;
        }

        .hero-img img {
            width: 350px;
        }

        @keyframes slideLeft {
            from { opacity: 0; transform: translateX(-80px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes slideRight {
            from { opacity: 0; transform: translateX(80px); }
            to { opacity: 1; transform: translateX(0); }
        }
    </style>
</head>

<body>

<div class="navbar">
    <div><b>Temukan Kopi</b></div>
    <div>
        <a href="/">Home</a>
    </div>
</div>

<section class="hero">
    <div class="hero-text">
        <h1>Temukan Kopi</h1>
        <p>Kopi terbaik dari seluruh Indonesia.</p>
        <a href="#" class="btn">Cek Produk</a>
    </div>

    <div class="hero-img">
        <img src="{{ asset('images/biji.png') }}" alt="Biji Kopi">
    </div>
</section>

</body>
</html>