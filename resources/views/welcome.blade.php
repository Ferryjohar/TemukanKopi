<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Temukan Kopi</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,400;1,700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300&display=swap" rel="stylesheet">

<style>
*, *::before, *::after {
  margin: 0; padding: 0; box-sizing: border-box;
}

:root {
  --hijau:     #1f5e3b;
  --hijau-tua: #143d27;
  --hijau-mid: #2f7a52;
  --hijau-muda:#e1e7cf;
  --krem:      #f5f5f0;
  --krem2:     #f0ece4;
  --putih:     #ffffff;
  --teks:      #222;
  --teks-mid:  #555;
  --teks-soft: #888;
  --shadow-lg: 0 24px 60px rgba(0,0,0,0.13);
  --radius:    14px;
}

html { scroll-behavior: smooth; }

body {
  font-family: 'Poppins', sans-serif;
  background: var(--krem);
  color: var(--teks);
  overflow-x: hidden;
}

.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 18px 100px;
  background: rgba(245,245,240,0.96);
  backdrop-filter: blur(14px);
  -webkit-backdrop-filter: blur(14px);
  position: sticky;
  top: 0;
  z-index: 1000;
  border-bottom: 1px solid rgba(0,0,0,0.07);
  transition: box-shadow .35s;
}
.navbar.scrolled { box-shadow: 0 6px 30px rgba(0,0,0,0.09); }

.logo {
  font-family: 'Playfair Display', serif;
  font-weight: 700;
  font-size: 21px;
  color: var(--hijau-tua);
  letter-spacing: -.3px;
}

.nav-links { display: flex; gap: 0; }
.nav-links a {
  margin-left: 32px;
  text-decoration: none;
  color: var(--teks-mid);
  font-size: 13.5px;
  font-weight: 500;
  position: relative;
  transition: color .3s;
}
.nav-links a::after {
  content: '';
  position: absolute;
  left: 0; bottom: -3px;
  width: 0; height: 2px;
  background: var(--hijau);
  border-radius: 2px;
  transition: width .3s;
}
.nav-links a:hover { color: var(--hijau); }
.nav-links a:hover::after { width: 100%; }

.nav-hamburger {
  display: none;
  flex-direction: column;
  gap: 5px;
  background: none;
  border: none;
  cursor: pointer;
  padding: 4px;
  z-index: 1100;
}
.nav-hamburger span {
  display: block;
  width: 24px; height: 2px;
  background: var(--hijau-tua);
  border-radius: 2px;
  transition: all .3s;
}
.nav-hamburger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
.nav-hamburger.open span:nth-child(2) { opacity: 0; }
.nav-hamburger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

@media (max-width: 768px) {
  .nav-hamburger { display: flex; }
  .nav-links {
    display: none;
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(245,245,240,0.97);
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 32px;
    z-index: 1050;
  }
  .nav-links.open { display: flex; }
  .nav-links a { font-size: 18px; margin-left: 0; }
}

.img-container { position: relative; overflow: hidden; }
.card-add-btn {
  position: absolute; bottom: 10px; right: 10px;
  width: 36px; height: 36px;
  background: var(--hijau); color: #fff; border: none;
  border-radius: 50%; cursor: pointer;
  display: flex; align-items: center; justify-content: center;
  opacity: 0; transform: translateY(8px);
  transition: opacity .25s, transform .25s, background .2s;
  box-shadow: 0 4px 12px rgba(0,0,0,0.18);
  z-index: 5;
}
.card:hover .card-add-btn { opacity: 1; transform: translateY(0); }
.card-add-btn:hover { background: var(--hijau-tua); }
.card-add-btn svg { width: 16px; height: 16px; stroke: currentColor; fill: none; stroke-width: 2.5; stroke-linecap: round; }

.modal-overlay {
  position: fixed; inset: 0;
  background: rgba(0,0,0,0.5);
  z-index: 1100; display: none;
  align-items: center; justify-content: center;
  padding: 20px;
}
.modal-overlay.open { display: flex; }
.modal {
  background: var(--putih); border-radius: 18px;
  padding: 32px; width: 100%; max-width: 500px;
  max-height: 90vh; overflow-y: auto;
  box-shadow: 0 30px 80px rgba(0,0,0,0.2);
  animation: fadeUp .4s both;
}
.modal-title { font-family: 'Playfair Display', serif; font-size: 22px; font-weight: 900; color: var(--teks); margin-bottom: 4px; }
.modal-subtitle { font-size: 13px; color: var(--teks-soft); margin-bottom: 20px; }
.modal-order-list { margin-bottom: 20px; }
.modal-order-item { display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid rgba(0,0,0,0.06); font-size: 13px; }
.modal-order-item:last-child { border-bottom: none; }
.item-name { font-weight: 600; color: var(--teks); }
.item-detail { color: var(--teks-soft); font-size: 12px; }
.item-subtotal { font-weight: 700; color: var(--hijau); white-space: nowrap; }
.form-group { margin-bottom: 14px; }
.form-group label { display: block; font-size: 12px; font-weight: 600; color: var(--teks-mid); margin-bottom: 6px; text-transform: uppercase; letter-spacing: .5px; }
.form-group input, .form-group textarea { width: 100%; border: 1.5px solid #e0e0e0; border-radius: 9px; padding: 11px 14px; font-size: 13.5px; font-family: 'Poppins', sans-serif; outline: none; transition: border-color .2s; resize: none; }
.form-group input:focus, .form-group textarea:focus { border-color: var(--hijau); }
.form-group textarea { min-height: 72px; }
.total-box { display: flex; justify-content: space-between; align-items: center; background: var(--krem2); border-radius: 10px; padding: 14px 18px; margin: 18px 0; }
.total-label { font-size: 13px; font-weight: 600; color: var(--teks-mid); }
.total-value { font-size: 20px; font-weight: 800; color: var(--hijau); }
.btn-bayar { width: 100%; background: var(--hijau); color: #fff; border: none; border-radius: 10px; padding: 14px; font-size: 14px; font-weight: 700; cursor: pointer; transition: all .3s; margin-bottom: 10px; }
.btn-bayar:hover { background: var(--hijau-tua); transform: translateY(-2px); box-shadow: 0 8px 22px rgba(31,94,59,.3); }
.btn-bayar:disabled { background: #ccc; cursor: not-allowed; transform: none; box-shadow: none; }
.btn-kembali { width: 100%; background: transparent; color: var(--teks-soft); border: 1.5px solid #e0e0e0; border-radius: 10px; padding: 12px; font-size: 13px; font-weight: 500; cursor: pointer; transition: all .2s; }
.btn-kembali:hover { border-color: var(--teks-mid); color: var(--teks); }

.toast {
  position: fixed; bottom: 24px; left: 50%; transform: translateX(-50%) translateY(80px);
  background: #1a1a1a; color: #fff;
  padding: 12px 22px; border-radius: 50px;
  font-size: 13px; font-weight: 500;
  display: flex; align-items: center; gap: 8px;
  z-index: 2000; opacity: 0;
  transition: all .35s cubic-bezier(.23,.88,.34,1.05);
  white-space: nowrap; pointer-events: none;
}
.toast.show { opacity: 1; transform: translateX(-50%) translateY(0); }
.toast svg { width: 16px; height: 16px; stroke: #2ecc71; fill: none; stroke-width: 2.5; stroke-linecap: round; stroke-linejoin: round; }

@keyframes fadeUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

.hero {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 100px 100px 80px;
  min-height: 90vh;
  position: relative;
  overflow: hidden;
  background: var(--krem);
}

.hero::before {
  content: '';
  position: absolute;
  right: -80px; top: -80px;
  width: 560px; height: 560px;
  background: radial-gradient(circle, rgba(31,94,59,.09) 0%, transparent 68%);
  border-radius: 50%;
  pointer-events: none;
  animation: blobPulse 7s ease-in-out infinite;
}
.hero::after {
  content: '';
  position: absolute;
  left: -60px; bottom: -60px;
  width: 400px; height: 400px;
  background: radial-gradient(circle, rgba(31,94,59,.06) 0%, transparent 68%);
  border-radius: 50%;
  pointer-events: none;
  animation: blobPulse 9s ease-in-out infinite reverse;
}

@keyframes blobPulse {
  0%,100% { transform: scale(1) translate(0,0); }
  50%      { transform: scale(1.12) translate(10px,-10px); }
}

.hero-left { position: relative; z-index: 2; }

.hero-pill {
  display: inline-flex;
  align-items: center;
  gap: 7px;
  background: rgba(31,94,59,.1);
  border: 1px solid rgba(31,94,59,.18);
  color: var(--hijau);
  padding: 5px 16px;
  border-radius: 50px;
  font-size: 11.5px;
  font-weight: 600;
  letter-spacing: .9px;
  text-transform: uppercase;
  margin-bottom: 26px;
  opacity: 0;
  animation: fadeUp .75s .1s forwards;
}

.hero h1 {
  font-family: 'Playfair Display', serif;
  font-size: 76px;
  color: var(--hijau);
  line-height: 1.0;
  font-weight: 900;
  opacity: 0;
  animation: fadeUp .75s .25s forwards;
}
.hero h1 em {
  font-style: italic;
  color: var(--hijau-mid);
}

.hero p {
  margin: 24px 0 36px;
  color: var(--teks-soft);
  max-width: 400px;
  font-size: 14.5px;
  line-height: 1.85;
  opacity: 0;
  animation: fadeUp .75s .4s forwards;
}

.hero-btns {
  display: flex;
  gap: 14px;
  opacity: 0;
  animation: fadeUp .75s .55s forwards;
}

.btn {
  display: inline-block;
  background: var(--hijau);
  color: var(--putih);
  padding: 13px 30px;
  border-radius: 50px;
  text-decoration: none;
  font-size: 13.5px;
  font-weight: 600;
  letter-spacing: .3px;
  transition: all .3s;
  box-shadow: 0 8px 22px rgba(31,94,59,.28);
  cursor: pointer;
}
.btn:hover {
  background: var(--hijau-tua);
  transform: translateY(-3px);
  box-shadow: 0 14px 36px rgba(31,94,59,.32);
}
.btn-ghost {
  background: transparent;
  border: 2px solid var(--hijau);
  color: var(--hijau);
  box-shadow: none;
}
.btn-ghost:hover {
  background: var(--hijau);
  color: var(--putih);
  box-shadow: 0 10px 28px rgba(31,94,59,.25);
}

.hero-img-wrap {
  position: relative;
  z-index: 2;
  flex-shrink: 0;
  opacity: 0;
  animation: fadeLeft .85s .35s forwards;
}

.hero-img-wrap img {
  width: 600px;
  filter: drop-shadow(0 28px 52px rgba(31,94,59,.22));
  animation: float 4.5s ease-in-out infinite;
}

@keyframes float {
  0%,100% { transform: translateY(0px); }
  50%      { transform: translateY(-20px); }
}

.hero-stats {
  display: flex;
  gap: 44px;
  margin-top: 56px;
  opacity: 0;
  animation: fadeUp .75s .72s forwards;
}
.hero-stats .stat strong {
  display: block;
  font-family: 'Playfair Display', serif;
  font-size: 30px;
  font-weight: 700;
  color: var(--hijau);
}
.hero-stats .stat span {
  font-size: 11.5px;
  color: var(--teks-soft);
  font-weight: 500;
}

section { padding: 110px 100px; position: relative; overflow: hidden; }

.section-tag {
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 3px;
  text-transform: uppercase;
  color: var(--hijau-mid);
  margin-bottom: 10px;
  display: block;
}

.section-title {
  font-family: 'Playfair Display', serif;
  font-size: 46px;
  color: var(--hijau-tua);
  font-weight: 800;
  line-height: 1.15;
  margin-bottom: 18px;
}

.bg-title {
    overflow: hidden;
    position: absolute;
    top: 5px;
    left: 40px;
    font-size: 140px;
    font-weight: bold;
    color: transparent;
    -webkit-text-stroke: 1px #1f4d3a;
    opacity: 0.2;
    z-index: 0;
    white-space: nowrap;
}

.content {
    position: relative;
    z-index: 2;
}

.content h2 {
    font-size: 36px;
    color: #1f4d3a;
}

.bg-title1 {
    overflow: hidden;
    position: absolute;
    top: 5px;
    right: 80px;
    left: auto;
    transform: none;
    font-size: 140px;
    font-weight: bold;
    color: transparent;
    -webkit-text-stroke: 1px #1f4d3a;
    opacity: 0.2;
    z-index: 0;
    white-space: nowrap;
}

.about-section { background: var(--putih); }

.about {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 80px;
  align-items: center;
}

.about-img-wrap {
  position: relative;
}
.about-img-wrap img {
  width: 100%;
  border-radius: var(--radius);
  box-shadow: var(--shadow-lg);
  display: block;
  object-fit: cover;
  height: 440px;
}
.about-badge {
  position: absolute;
  bottom: -18px; right: -18px;
  background: var(--hijau);
  color: var(--putih);
  padding: 18px 22px;
  border-radius: 12px;
  text-align: center;
  box-shadow: 0 10px 28px rgba(31,94,59,.3);
  line-height: 1.3;
}
.about-badge strong { font-size: 26px; font-family:'Playfair Display',serif; display:block; }
.about-badge small  { font-size: 11px; opacity: .85; }

.about-text h2 { color: var(--hijau); margin-bottom: 20px; }

.about-text p {
  line-height: 1.9;
  color: var(--teks-mid);
  font-size: 14.5px;
  margin-bottom: 16px;
}

.about-checklist {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px;
  margin-top: 28px;
}
.about-checklist li {
  list-style: none;
  display: flex;
  align-items: center;
  gap: 9px;
  font-size: 13px;
  font-weight: 500;
  color: var(--teks);
}
.about-checklist li::before {
  content: '✓';
  background: rgba(31,94,59,.1);
  color: var(--hijau);
  width: 22px; height: 22px;
  border-radius: 50%;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 10px;
  font-weight: 700;
  flex-shrink: 0;
}

.produk-section { background: var(--krem); }

.produk-header { text-align: center; margin-bottom: 56px; }
.produk-header p { color: var(--teks-soft); font-size: 14px; }

.produk-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 26px;
  margin-bottom: 48px;
}

.card {
  background: var(--putih);
  border-radius: var(--radius);
  overflow: hidden;
  box-shadow: 0 6px 22px rgba(0,0,0,0.08);
  transition: transform .4s cubic-bezier(.23,.88,.34,1.05), box-shadow .4s;
  position: relative;
  cursor: pointer;
}
.card::after {
  content: '';
  position: absolute;
  inset: 0;
  border: 2px solid transparent;
  border-radius: var(--radius);
  transition: border-color .35s;
  pointer-events: none;
}
.card:hover { transform: translateY(-11px); box-shadow: 0 22px 55px rgba(31,94,59,.14); }
.card:hover::after { border-color: rgba(31,94,59,.2); }

.badge {
  position: absolute;
  top: 12px; left: 12px;
  background: var(--hijau);
  color: var(--putih);
  padding: 4px 12px;
  font-size: 10px;
  font-weight: 700;
  letter-spacing: 1px;
  border-radius: 50px;
  text-transform: uppercase;
  z-index: 1;
}

.card img {
  width: 100%; height: 220px;
  object-fit: cover;
  transition: transform .55s ease;
  display: block;
}
.card:hover img { transform: scale(1.07); }

.card-body { padding: 18px; }
.card-body h4 { font-size: 15px; font-weight: 600; margin-bottom: 6px; }
.card-stars { color: #f5a200; font-size: 12px; margin-bottom: 7px; letter-spacing: 1px; }
.price { color: var(--hijau); font-weight: 600; font-size: 14px; }

.produk-cta { text-align: center; }

a.card {
  text-decoration: none;
  color: inherit;
  display: block;
}

.testi-section {
  background: #0d0d0d;
  position: relative;
  overflow: hidden;
}

.testi-section .bg-title {
  -webkit-text-stroke: 1px rgba(255,255,255,0.08);
  opacity: 1;
  top: 20px;
  left: 40px;
  font-size: 160px;
}

.testi-header { text-align: center; margin-bottom: 56px; position: relative; z-index: 2; }
.testi-header p { color: rgba(255,255,255,.45); font-size: 14px; }

.testi-section .section-tag  { color: rgba(255,255,255,.45); }
.testi-section .section-title {
  color: #ffffff;
  font-size: 52px;
}
.testi-section .section-title em {
  font-style: italic;
  color: rgba(255,255,255,.55);
}

.testimoni-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 26px;
  justify-content: center;
  position: relative;
  z-index: 2;
}

.testi {
  background: #1a1a1a;
  border: 1px solid rgba(255,255,255,0.08);
  color: var(--putih);
  padding: 36px 32px;
  border-radius: 18px;
  position: relative;
  overflow: hidden;
  transition: transform .35s, border-color .35s, box-shadow .35s;
}
.testi::before {
  content: '"';
  position: absolute;
  top: -8px; left: 18px;
  font-family: 'Playfair Display', serif;
  font-size: 110px;
  color: rgba(255,255,255,0.05);
  line-height: 1;
  pointer-events: none;
}
.testi:hover {
  transform: translateY(-8px);
  border-color: rgba(255,255,255,0.16);
  box-shadow: 0 20px 60px rgba(0,0,0,0.5);
}

.testi-stars {
  color: #f5a200;
  font-size: 14px;
  letter-spacing: 2px;
  margin-bottom: 16px;
  position: relative;
  z-index: 1;
}

.testi p {
  font-size: 14px;
  line-height: 1.8;
  position: relative;
  z-index: 1;
  margin-bottom: 22px;
  color: rgba(255,255,255,0.82);
  font-style: italic;
}

.testi-author { display: flex; align-items: center; gap: 12px; position: relative; z-index: 1; }
.testi-avatar {
  width: 42px; height: 42px;
  background: rgba(31,94,59,0.5);
  border: 1px solid rgba(31,94,59,0.7);
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-weight: 700; font-size: 16px;
  color: #fff;
  flex-shrink: 0;
}
.testi-name  { font-weight: 600; font-size: 14px; display: block; color: #fff; }
.testi-handle{ font-size: 11.5px; color: rgba(255,255,255,.45); display: block; margin-top: 2px; }

.pengiriman-section {
  background: rgba(31,94,59,0.5);
  min-height: 100vh;
  display: flex;
  align-items: center;
  padding: 0;
  position: relative;
  overflow: hidden;
}

.pengiriman-section::after {
  content: '';
  position: absolute; inset: 0;
  background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='1'/%3E%3C/svg%3E");
  opacity: 0.035;
  pointer-events: none;
  z-index: 0;
}

.delivery-side-dots {
  position: absolute;
  left: 32px; top: 50%;
  transform: translateY(-50%);
  display: flex; flex-direction: column;
  gap: 16px; z-index: 10;
}
.delivery-dot {
  width: 9px; height: 9px;
  border-radius: 50%;
  background: rgba(255,255,255,0.45);
}
.delivery-dot.hollow {
  background: transparent;
  border: 2px solid rgba(255,255,255,0.7);
  width: 11px; height: 11px;
}

.pengiriman {
  display: grid;
  grid-template-columns: 1fr 1fr;
  width: 100%;
  min-height: 100vh;
  align-items: center;
  position: relative; z-index: 2;
}

.pengiriman-content {
  background: transparent;
  padding: 100px 80px 100px 120px;
  display: flex; flex-direction: column;
  justify-content: center;
  color: #fff;
}

.peng-sublabel {
  font-family: 'Poppins', sans-serif;
  font-size: 13px;
  font-weight: 400;
  letter-spacing: 0.5px;
  color: rgba(255,255,255,0.55);
  margin-bottom: 12px;
  display: block;
}

.peng-title {
  font-family: 'Raleway', sans-serif;
  font-size: clamp(64px, 8vw, 105px);
  font-weight: 200;
  line-height: 0.95;
  color: #ffffff;
  text-transform: uppercase;
  letter-spacing: 8px;
  margin: 0 0 36px 0;
}

.peng-para {
  font-family: 'Poppins', sans-serif;
  font-size: 15px;
  font-weight: 400;
  line-height: 1.75;
  color: rgba(255,255,255,0.7);
  max-width: 380px;
  margin-bottom: 40px;
}

.peng-btn {
  display: inline-block;
  border: 1.5px solid rgba(255,255,255,0.85);
  color: #fff;
  background: transparent;
  padding: 13px 28px;
  font-family: 'Poppins', sans-serif;
  font-size: 14px;
  font-weight: 600;
  letter-spacing: 0.3px;
  text-decoration: none;
  cursor: pointer;
  transition: all 0.3s;
  width: fit-content;
}
.peng-btn:hover {
  background: #fff;
  color: #2b3d47;
}

.pengiriman-img {
  position: relative;
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: flex-end;
  overflow: visible;
}

.pengiriman-img img {
  width: 100%;
  max-width: 660px;
  height: 680px;
  object-fit: cover;
  display: block;
  position: relative;
  z-index: 2;
  clip-path: path('M 40 0 C 220 0, 440 50, 480 200 C 520 340, 510 470, 420 570 C 330 660, 180 680, 70 630 C -20 590, -20 490, 10 360 C 40 230, -60 90, 40 0 Z');
  transition: transform 0.7s ease;
}
.pengiriman:hover .pengiriman-img img { transform: scale(1.02); }

.pengiriman-img::before {
  content: '';
  position: absolute;
  z-index: 1;
  width: 100%;
  max-width: 660px;
  height: 680px;
  right: 0;
  border: 2px solid rgba(255,255,255,0.3);
  clip-path: path('M 40 0 C 220 0, 440 50, 480 200 C 520 340, 510 470, 420 570 C 330 660, 180 680, 70 630 C -20 590, -20 490, 10 360 C 40 230, -60 90, 40 0 Z');
  transform: translate(22px, 22px);
  pointer-events: none;
}

@media (max-width: 1024px) {
  .pengiriman-section { min-height: auto; }
  .pengiriman { grid-template-columns: 1fr; min-height: auto; }
  .pengiriman-content { padding: 80px 40px 60px 70px; order: 2; }
  .pengiriman-img { min-height: 460px; order: 1; justify-content: center; }
  .pengiriman-img img { max-width: 100%; height: 460px; }
  .pengiriman-img::before { max-width: 100%; height: 460px; right: auto; }
}
@media (max-width: 768px) {
  .pengiriman-content { padding: 60px 24px 50px 56px; }
  .peng-title { font-size: clamp(48px, 12vw, 72px); letter-spacing: -2px; }
  .pengiriman-img { min-height: 360px; }
  .pengiriman-img img { height: 360px; }
  .pengiriman-img::before { height: 360px; }
  .delivery-side-dots { left: 14px; }
}

.pengiriman-img {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: auto;
}

.pengiriman-img img {
  width: 100%;
  max-width: 580px;
  height: 600px;
  object-fit: cover;
  display: block;
  clip-path: path('M 50 0 C 200 0, 380 40, 420 160 C 460 280, 460 380, 380 480 C 300 560, 180 580, 80 540 C 0 510, -10 420, 10 300 C 30 180, -40 80, 50 0 Z');
  transition: transform 0.6s ease;
}
.pengiriman:hover .pengiriman-img img { transform: scale(1.03); }

.pengiriman-img::before {
  content: '';
  position: absolute;
  width: calc(100% - 20px);
  max-width: 560px;
  height: 590px;
  border: 2px solid rgba(255,255,255,0.25);
  clip-path: path('M 50 0 C 200 0, 380 40, 420 160 C 460 280, 460 380, 380 480 C 300 560, 180 580, 80 540 C 0 510, -10 420, 10 300 C 30 180, -40 80, 50 0 Z');
  transform: translate(18px, 18px);
  pointer-events: none;
}

.peng-side-dots {
  position: absolute;
  left: 28px;
  top: 50%;
  transform: translateY(-50%);
  display: flex;
  flex-direction: column;
  gap: 14px;
  z-index: 5;
}
.peng-side-dot {
  width: 8px; height: 8px;
  border-radius: 50%;
  background: rgba(255,255,255,0.3);
  transition: all 0.3s;
}
.peng-side-dot.active {
  background: #fff;
  width: 10px; height: 10px;
}

@media (max-width: 1100px) {
  .pengiriman-section { padding: 80px 40px; min-height: auto; }
  .pengiriman { gap: 50px; }
  .pengiriman-content .section-title { font-size: 56px; }
}

@media (max-width: 768px) {
  .pengiriman-section { padding: 40px 15px !important; }
  .pengiriman { grid-template-columns: 1fr !important; margin: 0 auto; width: 100%; overflow: hidden; }
  .pengiriman-content { padding: 30px 20px !important; width: 100% !important; }
  .pengiriman-content .section-title { font-size: 24px !important; line-height: 1.3; word-wrap: break-word; }
  .pengiriman-img { height: 250px !important; min-height: 250px !important; order: 1; }
  .pengiriman-content { order: 2; }
  .pengiriman-img img { height: 100%; width: 100%; object-fit: cover; }
}

.mengapa-section { background: var(--putih); }

.mengapa-header { text-align: center; margin-bottom: 56px; }

.alasan {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 36px;
}

.alasan-card {
  text-align: center;
  padding: 46px 32px;
  border-radius: 18px;
  background: var(--krem);
  border: 1px solid rgba(31,94,59,.07);
  position: relative;
  overflow: hidden;
  transition: all .4s;
}
.alasan-card::after {
  content: '';
  position: absolute;
  bottom: 0; left: 0;
  width: 100%; height: 3px;
  background: linear-gradient(90deg, var(--hijau), var(--hijau-mid));
  transform: scaleX(0);
  transform-origin: left;
  transition: transform .4s;
}
.alasan-card:hover {
  transform: translateY(-9px);
  background: var(--putih);
  box-shadow: 0 18px 46px rgba(31,94,59,.1);
}
.alasan-card:hover::after { transform: scaleX(1); }

.icon {
  font-size: 38px;
  color: var(--hijau);
  display: block;
  margin-bottom: 18px;
  transition: transform .4s;
}
.alasan-card:hover .icon { transform: scale(1.18) rotate(-5deg); }

.alasan-card h3 {
  font-family: 'Playfair Display', serif;
  font-size: 18px;
  color: var(--hijau-tua);
  margin-bottom: 10px;
}
.alasan-card p { color: var(--teks-mid); font-size: 13.5px; line-height: 1.75; }

.tips {
  position: relative;
  overflow: hidden;
  padding: 100px 80px;
  color: #fff;
}

.tips::before {
  content: '';
  position: absolute; inset: 0;
  background: url('images/tips.png') center center / cover no-repeat;
  z-index: 0;
}
.tips::after {
  content: '';
  position: absolute; inset: 0;
  background: rgba(0, 0, 0, 0.55);
  backdrop-filter: blur(2px);
  z-index: 1;
}

.tips-header {
  text-align: center;
  margin-bottom: 70px;
  position: relative;
  z-index: 2;
}

.tips-header .section-title {
  font-family: 'Raleway', sans-serif;
  font-size: clamp(36px, 5vw, 58px);
  font-weight: 200;
  letter-spacing: 12px;
  text-transform: uppercase;
  color: #ffffff;
}

.tips-content { position: relative; z-index: 2; }

.tips-grid {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 0;
}

.step {
  background: transparent;
  border: none;
  border-radius: 0;
  padding: 0 24px 0 0;
  text-align: left;
  position: relative;
}

.step-num-circle {
  width: 36px; height: 36px;
  border-radius: 50%;
  background: rgba(255,255,255,0.12);
  border: 1px solid rgba(255,255,255,0.5);
  display: flex; align-items: center; justify-content: center;
  font-size: 12px; font-weight: 600;
  color: #fff;
  margin-bottom: 16px;
  position: relative;
  z-index: 1;
}

.step:not(:last-child)::after {
  content: '';
  position: absolute;
  top: 18px;
  left: 36px;
  right: 0;
  height: 1px;
  background: rgba(255,255,255,0.35);
  z-index: 0;
}

.step h4 {
  font-size: 13.5px;
  font-weight: 700;
  color: #ffffff;
  margin-bottom: 10px;
}
.step p {
  font-size: 12px;
  color: rgba(255,255,255,0.65);
  line-height: 1.75;
}

@media (max-width: 768px) {
  .tips { padding: 60px 24px; }
  .tips-header .section-title { letter-spacing: 6px; }
  .tips-grid {
    grid-template-columns: 1fr 1fr;
    gap: 32px 20px;
  }
  .step { padding: 0; }
  .step:not(:last-child)::after { display: none; }
}

@media (max-width: 480px) {
  .tips-grid { grid-template-columns: 1fr; gap: 28px; }
}

.galeri-section {
  background: #000000;
  padding: 80px 0 100px;
  overflow: hidden;
}

.galeri-header {
  text-align: center;
  margin-bottom: 60px;
  padding: 0 40px;
}
.galeri-header .section-tag { color: rgba(255,255,255,0.4); }
.galeri-header .section-title { color: #fff; }

.fan-stage {
  position: relative;
  height: 480px;
  perspective: 1400px;
  display: flex;
  align-items: center;
  justify-content: center;
  user-select: none;
}

.fan-card {
  position: absolute;
  width: 220px;
  height: 360px;
  border-radius: 18px;
  overflow: hidden;
  cursor: pointer;
  transition: all 0.6s cubic-bezier(0.23, 0.88, 0.34, 1.05);
  box-shadow: 0 24px 60px rgba(0,0,0,0.7);
}
.fan-card img {
  width: 100%; height: 100%;
  object-fit: cover;
  display: block;
  pointer-events: none;
  transition: transform 0.5s ease;
}
.fan-card:hover img { transform: scale(1.05); }

.fan-caption {
  position: absolute; inset: 0;
  background: linear-gradient(to top, rgba(0,0,0,0.75) 0%, transparent 55%);
  display: flex; flex-direction: column; justify-content: flex-end;
  padding: 24px 20px;
  opacity: 0;
  transition: opacity 0.35s;
}
.fan-card.fc-active .fan-caption { opacity: 1; }
.fan-cap-tag {
  font-size: 9px; font-weight: 700;
  letter-spacing: 3px; text-transform: uppercase;
  color: #c8a96e; margin-bottom: 5px;
}
.fan-cap-title {
  font-family: 'Playfair Display', serif;
  font-size: 18px; font-weight: 700;
  color: #fff; line-height: 1.3;
}
.fan-cap-sub {
  font-size: 11px; color: rgba(255,255,255,0.6);
  margin-top: 5px; font-style: italic;
}

.fan-card[data-pos="0"] {
  transform: translateX(0) translateZ(0) rotateY(0deg) scale(1);
  z-index: 10; filter: brightness(1);
}
.fan-card[data-pos="1"] {
  transform: translateX(280px) translateZ(-120px) rotateY(-22deg) scale(0.92);
  z-index: 8; filter: brightness(0.6);
}
.fan-card[data-pos="-1"] {
  transform: translateX(-280px) translateZ(-120px) rotateY(22deg) scale(0.92);
  z-index: 8; filter: brightness(0.6);
}
.fan-card[data-pos="2"] {
  transform: translateX(510px) translateZ(-260px) rotateY(-38deg) scale(0.8);
  z-index: 6; filter: brightness(0.35);
}
.fan-card[data-pos="-2"] {
  transform: translateX(-510px) translateZ(-260px) rotateY(38deg) scale(0.8);
  z-index: 6; filter: brightness(0.35);
}
.fan-card[data-pos="3"],
.fan-card[data-pos="-3"] {
  transform: translateX(700px) translateZ(-400px) rotateY(-55deg) scale(0.65);
  z-index: 2; filter: brightness(0.15); pointer-events: none;
}
.fan-card[data-pos="-3"] {
  transform: translateX(-700px) translateZ(-400px) rotateY(55deg) scale(0.65);
}

.fan-nav {
  position: absolute; top: 50%; width: 100%;
  transform: translateY(-50%);
  display: flex; justify-content: space-between;
  padding: 0 30px; z-index: 20; pointer-events: none;
}
.fan-btn {
  width: 46px; height: 46px; border-radius: 50%;
  background: rgba(255,255,255,0.1);
  border: 1px solid rgba(255,255,255,0.18);
  backdrop-filter: blur(8px);
  display: flex; align-items: center; justify-content: center;
  color: #fff; cursor: pointer; pointer-events: all;
  transition: all 0.3s;
}
.fan-btn:hover { background: #1f5e3b; border-color: #1f5e3b; transform: scale(1.1); }
.fan-btn svg { width: 18px; height: 18px; stroke: currentColor; fill: none; stroke-width: 2; stroke-linecap: round; stroke-linejoin: round; }

.fan-dots {
  display: flex; justify-content: center; gap: 8px;
  margin-top: 40px;
}
.fan-dot {
  width: 6px; height: 6px; border-radius: 50%;
  background: rgba(255,255,255,0.2); cursor: pointer;
  transition: all 0.35s;
}
.fan-dot.active { background: #c8a96e; width: 22px; border-radius: 3px; }

@media (max-width: 768px) {
  .fan-stage { height: 380px; }
  .fan-card { width: 170px; height: 280px; }
  .fan-card[data-pos="1"]  { transform: translateX(200px) translateZ(-100px) rotateY(-22deg) scale(0.88); }
  .fan-card[data-pos="-1"] { transform: translateX(-200px) translateZ(-100px) rotateY(22deg) scale(0.88); }
  .fan-card[data-pos="2"]  { transform: translateX(360px) translateZ(-220px) rotateY(-38deg) scale(0.72); }
  .fan-card[data-pos="-2"] { transform: translateX(-360px) translateZ(-220px) rotateY(38deg) scale(0.72); }
  .fan-nav { padding: 0 10px; }
}

.contact-section { background: var(--putih); text-align: center; }

.contact-header { margin-bottom: 54px; }

.contact-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 22px;
  justify-content: center;
  margin-bottom: 50px;
}

.contact-card {
  padding: 34px 22px;
  border-radius: var(--radius);
  background: var(--krem);
  border: 1px solid rgba(31,94,59,.1);
  transition: all .3s;
}
.contact-card:hover {
  transform: translateY(-6px);
  box-shadow: 0 14px 36px rgba(31,94,59,.1);
}
.contact-card.green {
  background: linear-gradient(135deg, var(--hijau), var(--hijau-mid));
  color: var(--putih);
  border-color: transparent;
}

.contact-icon { font-size: 26px; display: block; margin-bottom: 14px; }
.contact-card h4 {
  font-size: 11px; font-weight: 700;
  letter-spacing: 2px; text-transform: uppercase;
  margin-bottom: 8px;
  color: var(--teks-soft);
}
.contact-card.green h4 { color: rgba(255,255,255,.65); }
.contact-card p { font-size: 13.5px; font-weight: 600; color: var(--teks); }
.contact-card.green p { color: var(--putih); }

.map {
  border-radius: var(--radius);
  overflow: hidden;
  box-shadow: 0 8px 30px rgba(0,0,0,.1);
}
.map img { width: 100%; display: block; border-radius: var(--radius); }

.footer-col iframe{
  width:100%;
  height:300px;
  border-radius:10px;
}

footer {
  background: #0b3320;
  color: var(--putih);
  padding: 80px 100px 40px;
  margin-top: 0;
}

.footer-grid {
  display: grid;
  grid-template-columns: 2fr 1fr 1fr;
  gap: 60px;
  padding-bottom: 50px;
  border-bottom: 1px solid rgba(255,255,255,.08);
}

.footer-brand .logo { color: var(--putih); display: block; font-size: 22px; margin-bottom: 14px; }
.footer-brand > p { color: rgba(255,255,255,.5); font-size: 13px; line-height: 1.8; max-width: 260px; }

.footer-socials { display: flex; gap: 10px; margin-top: 22px; }
.soc-btn {
  width: 36px; height: 36px;
  background: rgba(255,255,255,.1);
  border-radius: 8px;
  display: inline-flex; align-items: center; justify-content: center;
  font-size: 16px;
  text-decoration: none;
  transition: background .3s;
  cursor: pointer;
}
.soc-btn:hover { background: var(--hijau); }

.footer-col h4 {
  font-size: 11.5px; font-weight: 700;
  letter-spacing: 2px; text-transform: uppercase;
  color: rgba(255,255,255,.45); margin-bottom: 22px;
}
.footer-col p, 
.footer-col a {
  display: block;
  color: rgba(255,255,255,.7);
  font-size: 13px; line-height: 1.6;
  margin-bottom: 10px;
  text-decoration: none;
  transition: color .3s;
}
.footer-col a:hover { color: var(--putih); }

.footer-social-icons{
  display:flex;
  gap:15px;
  margin-right: 12px;
}
.footer-social-icons a i{
  font-size: 35px;
  transition: transform 0.3s;
}
.footer-social-icons a:hover i{
  transform: scale(1.2);
}

.copy {
  text-align: center;
  padding-top: 36px;
  color: rgba(255,255,255,.38);
  font-size: 12px;
}

@keyframes fadeUp {
  from { opacity: 0; transform: translateY(38px); }
  to   { opacity: 1; transform: translateY(0); }
}
@keyframes fadeLeft {
  from { opacity: 0; transform: translateX(60px); }
  to   { opacity: 1; transform: translateX(0px); }
}

.reveal {
  opacity: 0;
  transform: translateY(46px);
  transition: opacity .75s ease, transform .75s ease;
}
.reveal.from-left  { transform: translateX(-50px); }
.reveal.from-right { transform: translateX(50px); }
.reveal.visible    { opacity: 1; transform: translate(0); }

.stagger > * {
  opacity: 0;
  transform: translateY(36px);
  transition: opacity .6s ease, transform .6s ease;
}
.stagger.visible > * {
  opacity: 1;
  transform: none;
  transition-delay: .1s; 
}

@media (max-width: 1100px) {
  .navbar, section, footer { padding-left: 40px; padding-right: 40px; }
  .hero { padding: 80px 40px; flex-direction: column; text-align: center; gap: 50px; }
  .hero-left { order: 2; }
  .hero-img-wrap { order: 1; }
  .hero h1 { font-size: 52px; }
  .hero-img-wrap img { width: 100%; max-width: 450px; }
  .hero-stats { justify-content: center; }
  .produk-grid, .alasan, .testimoni-grid { grid-template-columns: repeat(2, 1fr); }
  .footer-grid { grid-template-columns: 1fr 1fr; }
}

@media (max-width: 768px) {
  .navbar { padding: 15px 20px; }
  
  .hero h1 { font-size: 42px; }
  .hero p { margin-left: auto; margin-right: auto; }
  .hero-btns { flex-direction: column; width: 100%; }
  .btn { width: 100%; text-align: center; }
  
  section { padding: 60px 20px; }
  .section-title { font-size: 32px; }
  .bg-title, .bg-title1 { font-size: 80px; top: 10px; }
  
  .produk-grid, .alasan, .testimoni-grid, .tips-grid, .contact-grid { 
    grid-template-columns: 1fr; 
  }

  .testi-section .section-title { font-size: 36px; }
  
  .about { grid-template-columns: 1fr; gap: 40px; }
  .about-img-wrap img { height: 300px; }
  .about-checklist { grid-template-columns: 1fr; }

  .galeri-grid {
    grid-template-columns: 1fr;
    grid-template-rows: auto;
  }
  .g-item:first-child { grid-row: auto; }
  .g-item { height: 250px; }

  .footer-grid { grid-template-columns: 1fr; gap: 40px; text-align: center; }
  .footer-brand > p { margin-left: auto; margin-right: auto; }
  .footer-social-icons { justify-content: center; }
}

.hidden-product {
    max-height: 0;
    opacity: 0;
    transform: translateY(-20px);
    overflow: hidden;
    transition: all 0.4s ease-in-out;
    pointer-events: none;
    margin-top: 0 !important;
}
.hidden-product.show-active {
    max-height: 600px;
    opacity: 1;
    transform: translateY(0);
    pointer-events: auto;
    margin-top: 20px !important;
}
</style>
</head>
<body>

<div class="navbar" id="navbar">
  <div class="logo">temukan kopi.</div>
  <div class="nav-links" id="navLinks">
    <a href="#Home">Home</a>
    <a href="#About">About me</a>
    <a href="#Produk">Produk</a>
    <a href="#Kontak">Kontak</a>
    <a href="#Galery">Galery</a>
  </div>
  <button class="nav-hamburger" id="navHamburger" aria-label="Buka menu">
    <span></span><span></span><span></span>
  </button>
</div>


<section id="Home" class="hero">
  <div class="hero-left">
    <div class="hero-pill">Premium Indonesian Coffee</div>
    <h1>Temukan<br><em>Kopi</em></h1>
    <p>Dibuat dari biji kopi Indonesia pilihan untuk pengalaman minum kopi terbaik setiap hari.</p>
    <div class="hero-btns">
      <a class="btn" href="#About">Selengkapnya</a>
      <a class="btn btn-ghost" href="#Produk">Lihat Produk</a>
    </div>
    <div class="hero-stats">
      <div class="stat">
        <strong><span class="counter" data-target="50">0</span>+</strong>
        <span>Varian Kopi</span>
      </div>
      <div class="stat">
        <strong><span class="counter" data-target="10">0</span>K+</strong>
        <span>Pelanggan</span>
      </div>
      <div class="stat">
        <strong>5★</strong>
        <span>Rating</span>
      </div>
    </div>
  </div>
  <div class="hero-img-wrap">
    <img src="images/biji.png" alt="Kopi Premium">
  </div>
</section>


<section id="About" class="about-section"> 
  <div class="bg-title1">About</div>
  <div class="about">
    <div class="about-img-wrap reveal from-left">
      <img src="images/kopi1.png" alt="About Temukan Kopi" loading="lazy">
      <div class="about-badge">
        <strong>7+</strong>
        <small>Tahun<br>Pengalaman</small>
      </div>
    </div>
    <div class="reveal from-right">
      <span class="section-tag">Tentang Kami</span>
      <h2 class="section-title">About Me</h2>
      <p>Temukan Kopi hadir dari keyakinan bahwa setiap biji kopi memiliki cerita dan cita rasa yang layak dinikmati dengan sepenuh hati.</p>
      <p>Kami menghadirkan berbagai pilihan kopi terbaik dari berbagai daerah Indonesia, diproses dengan standar terbaik untuk menghadirkan cita rasa autentik di setiap seduhan.</p>
      <ul class="about-checklist">
        <li>Biji kopi pilihan</li>
        <li>Proses alami</li>
        <li>Pengiriman cepat</li>
        <li>Kemasan premium</li>
      </ul>
    </div>
  </div>
</section>


<section id="Produk">
  <div class="produk-header reveal" style="text-align: center; margin-bottom: 50px;">
      <span class="section-tag">Koleksi Kami</span>
      <h2 class="section-title">Menu Kopi Unggulan</h2>
  </div>

  <div class="produk-grid stagger">
    @forelse($produk as $p)
    <a class="card {{ $loop->index > 3 ? 'hidden-product' : '' }}" 
       href="{{ url('/checkout?id_produk='.$p->id_produk) }}">
      
      <div class="badge">PREMIUM</div>
      
      <div class="img-container" style="position: relative; overflow: hidden;">
          <img src="{{ $p->foto_produk ? asset('storage/produk/'.$p->foto_produk) : asset('images/default.png') }}" 
            alt="{{ $p->nama_produk }}"
            loading="lazy"
            onerror="this.src='{{ asset('images/default.png') }}'">
          <button class="card-add-btn"
                  data-id="{{ $p->id_produk }}"
                  data-nama="{{ $p->nama_produk }}"
                  data-harga="{{ $p->harga_produk }}"
                  data-kategori="{{ $p->nama_kategori }}"
                  data-jenis="{{ $p->nama_jenis }}"
                  data-foto="{{ $p->foto_produk ? asset('storage/produk/'.$p->foto_produk) : asset('images/default.png') }}"
                  title="Tambah ke keranjang"
                  onclick="event.preventDefault(); addToCart(this)">
            <svg viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          </button>
      </div>
      
      <div class="card-body">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
            <div class="card-stars" style="margin-bottom: 0;">★★★★★</div>
            <span style="font-size: 11px; font-weight: 700; color: #1f5e3b; text-transform: uppercase; letter-spacing: 0.5px;">
                ● Tersedia
            </span>
        </div>
        <h4 style="text-transform: capitalize; color: #1a1a1a; margin-bottom: 8px;">{{ $p->nama_produk }}</h4>
        <div class="price" style="color: #1f5e3b; font-weight: 700; font-size: 1.1rem;">
            Rp {{ number_format($p->harga_produk, 0, ',', '.') }}
        </div>
        <div style="margin-top: 10px; padding-top: 10px; border-top: 1px dashed #eee;">
            <p style="font-size: 11px; color: #888; line-height: 1.5;">
                Kategori: <b>{{ $p->nama_kategori }}</b><br>
                Jenis: {{ $p->nama_jenis }}
            </p>
        </div>
      </div>
    </a>
    @empty
    <div style="grid-column: 1 / -1; text-align: center; padding: 100px 20px; color: #888; background: #fff; border-radius: 20px;">
        <span style="font-size: 50px;"></span>
        <p style="margin-top: 15px; font-style: italic;">Maaf, katalog produk sedang dalam pembaruan.</p>
    </div>
    @endforelse
  </div>

  <div class="produk-cta reveal" style="margin-top: 60px;">
      <a class="btn" id="btnToggleProduk" href="javascript:void(0)">LIHAT SEMUA MENU</a>
  </div>
</section>


<section id="Testimoni" class="testi-section">
  <div class="bg-title">Testimoni</div>
  <div class="testi-header reveal">
    <span class="section-tag">Apa Kata Mereka</span>
    <h2 class="section-title">Suara <em>Pelanggan</em></h2>
    <p>Kata Mereka Kepada Temukan Kopi</p>
  </div>
  <div class="testimoni-grid stagger">

    <div class="testi">
      <div class="testi-stars">★★★★★</div>
      <p>"Kopi sangat nikmat dan aromanya kuat sekali. Setiap pagi tidak pernah mengecewakan."</p>
      <div class="testi-author">
        <div class="testi-avatar">D</div>
        <div>
          <span class="testi-name">Dimas</span>
          <span class="testi-handle">@dimas · Pelanggan Setia</span>
        </div>
      </div>
    </div>

    <div class="testi">
      <div class="testi-stars">★★★★★</div>
      <p>"Pengiriman cepat dan kualitas kopi mantap. Kemasan aman, produk sampai sempurna!"</p>
      <div class="testi-author">
        <div class="testi-avatar">B</div>
        <div>
          <span class="testi-name">Barista</span>
          <span class="testi-handle">@barista · Profesional</span>
        </div>
      </div>
    </div>

    <div class="testi">
      <div class="testi-stars">★★★★★</div>
      <p>"Saya selalu membeli kopi di sini. Sudah langganan lebih dari 3 tahun, tidak pernah kecewa!"</p>
      <div class="testi-author">
        <div class="testi-avatar">K</div>
        <div>
          <span class="testi-name">Kopimania</span>
          <span class="testi-handle">@kopimania · 3 Tahun Bersama</span>
        </div>
      </div>
    </div>

  </div>
</section>

<section class="pengiriman-section">

  <div class="delivery-side-dots">
    <div class="delivery-dot"></div>
    <div class="delivery-dot"></div>
    <div class="delivery-dot hollow"></div>
    <div class="delivery-dot"></div>
    <div class="delivery-dot"></div>
  </div>

  <div class="pengiriman reveal">
    <div class="pengiriman-content">
      <span class="peng-sublabel">Layanan pengiriman untuk</span>
      <h3 class="peng-title">LOKAL<br>& INTER-<br>NASIONAL</h3>
      <p class="peng-para">Masa depan kopi tidak akan ada tanpa layanan terbaik yang menjaga kualitasnya.
         Kami berupaya menghadirkan kopi segar langsung ke tangan Anda dengan kemasan vakum premium yang memperbarui,
          memupuk, dan melindungi cita rasa asli setiap biji kopi pilihan nusantara.</p>
      <a href="#Produk" class="peng-btn">Pesan Sekarang</a>
    </div>
    <div class="pengiriman-img">
      <img src="images/Galer4.png" alt="Pengiriman Kopi" loading="lazy">
    </div>
  </div>

</section>


<section class="tips">
  <div class="tips-header reveal">
    <h2 class="section-title">Tips Penyajian</h2>
  </div>

  <div class="tips-content">
    <div class="tips-grid stagger">

      <div class="step">
        <div class="step-num-circle">1</div>
        <h4>Timbang Kopi</h4>
        <p>Gunakan timbangan dapur untuk mengukur biji kopi dengan tepat. Rasio ideal adalah 1:15 (kopi : air).</p>
      </div>

      <div class="step">
        <div class="step-num-circle">2</div>
        <h4>Panaskan Air</h4>
        <p>Panaskan air hingga suhu 90–96°C. Hindari air mendidih penuh agar rasa kopi tidak pahit berlebihan.</p>
      </div>

      <div class="step">
        <div class="step-num-circle">3</div>
        <h4>Giling Kopi</h4>
        <p>Giling biji kopi sesuai metode seduh. Kasar untuk French Press, medium untuk Pour Over, halus untuk Espresso.</p>
      </div>

      <div class="step">
        <div class="step-num-circle">4</div>
        <h4>Seduh Kopi</h4>
        <p>Tuang air perlahan melingkar di atas bubuk kopi. Biarkan bloom 30 detik agar CO₂ keluar merata.</p>
      </div>

      <div class="step">
        <div class="step-num-circle">5</div>
        <h4>Nikmati</h4>
        <p>Sajikan segera selagi hangat. Hirup aromanya terlebih dahulu sebelum meneguk untuk pengalaman terbaik.</p>
      </div>

    </div>
  </div>
</section>

<section class="mengapa-section">
  <div class="bg-title1">Mengapa</div>
  <div class="mengapa-header reveal">
    <span class="section-tag">Keunggulan Kami</span>
    <h2 class="section-title">Mengapa memilih kami?</h2>
  </div>
  <div class="alasan stagger">
    <div class="alasan-card">
      <h3>Kualitas Terjamin</h3>
      <p>Biji kopi pilihan terbaik yang diseleksi langsung dari kebun-kebun terbaik di Indonesia.</p>
    </div>
    <div class="alasan-card">
      <h3>Pelayanan Terpercaya</h3>
      <p>Kami melayani dengan profesional dan penuh dedikasi untuk kepuasan setiap pelanggan.</p>
    </div>
    <div class="alasan-card">
      <h3>Kepuasan Pelanggan</h3>
      <p>Kami selalu mengutamakan kepuasan pelanggan di atas segalanya dengan jaminan kualitas.</p>
    </div>
  </div>
</section>


<section id="Galery" class="galeri-section">
  <div class="bg-title1">Galeri</div>
  <div class="galeri-header reveal">
    <span class="section-tag">Koleksi Foto</span>
    <h2 class="section-title">Galeri Kopi Kami</h2>
  </div>

  <div class="fan-stage" id="fanStage">
    <div class="fan-nav">
      <button class="fan-btn" id="fanPrev">
        <svg viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
      </button>
      <button class="fan-btn" id="fanNext">
        <svg viewBox="0 0 24 24"><polyline points="9 6 15 12 9 18"/></svg>
      </button>
    </div>

    <div class="fan-card fc-active" data-pos="0" data-index="0">
      <img src="images/Galer1.jpg" alt="Kopi Pilihan" loading="lazy"
           onerror="this.src='https://placehold.co/220x360/1f5e3b/ffffff?text=Kopi'">
      <div class="fan-caption">
        <div class="fan-cap-tag">Galeri Kopi</div>
        <div class="fan-cap-title">Kopi Pilihan</div>
        <div class="fan-cap-sub">Dari kebun terbaik nusantara</div>
      </div>
    </div>
    <div class="fan-card" data-pos="1" data-index="1">
      <img src="images/Galer2.jpg" alt="Arabika Premium" loading="lazy"
           onerror="this.src='https://placehold.co/220x360/1f5e3b/ffffff?text=Kopi'">
      <div class="fan-caption">
        <div class="fan-cap-tag">Galeri Kopi</div>
        <div class="fan-cap-title">Arabika Premium</div>
        <div class="fan-cap-sub">Cita rasa kelas dunia</div>
      </div>
    </div>
    <div class="fan-card" data-pos="2" data-index="2">
      <img src="images/Galer3.jpg" alt="Proses Alami" loading="lazy"
           onerror="this.src='https://placehold.co/220x360/1f5e3b/ffffff?text=Kopi'">
      <div class="fan-caption">
        <div class="fan-cap-tag">Galeri Kopi</div>
        <div class="fan-cap-title">Proses Alami</div>
        <div class="fan-cap-sub">Tanpa bahan pengawet</div>
      </div>
    </div>
    <div class="fan-card" data-pos="-1" data-index="3">
      <img src="images/Galer4.png" alt="Kemasan Premium" loading="lazy"
           onerror="this.src='https://placehold.co/220x360/1f5e3b/ffffff?text=Kopi'">
      <div class="fan-caption">
        <div class="fan-cap-tag">Galeri Kopi</div>
        <div class="fan-cap-title">Kemasan Premium</div>
        <div class="fan-cap-sub">Vakum tahan lama</div>
      </div>
    </div>
    <div class="fan-card" data-pos="-2" data-index="4">
      <img src="images/Galer5.jpg" alt="Nikmati Setiap Tegukan" loading="lazy"
           onerror="this.src='https://placehold.co/220x360/1f5e3b/ffffff?text=Kopi'">
      <div class="fan-caption">
        <div class="fan-cap-tag">Galeri Kopi</div>
        <div class="fan-cap-title">Nikmati Setiap Tegukan</div>
        <div class="fan-cap-sub">Pengalaman kopi terbaik</div>
      </div>
    </div>
  </div>

  <div class="fan-dots" id="fanDots">
    <div class="fan-dot active" data-idx="0"></div>
    <div class="fan-dot" data-idx="1"></div>
    <div class="fan-dot" data-idx="2"></div>
    <div class="fan-dot" data-idx="3"></div>
    <div class="fan-dot" data-idx="4"></div>
  </div>
</section>


<section id="Kontak" class="contact-section">
  <div class="contact-header reveal">
    <span class="section-tag">Hubungi Kami</span>
    <h2 class="section-title">Tim Kami Melayani Anda 24jam</h2>
  </div>
  <div class="contact-grid stagger">
    <div class="contact-card green">
      <span class="contact-icon">📍</span>
      <h4>Location</h4>
      <p>Indonesia</p>
    </div>
    <div class="contact-card">
      <span class="contact-icon">📞</span>
      <h4>Phone</h4>
      <p>+62 8133135510</p>
    </div>
    <div class="contact-card green">
      <span class="contact-icon">✉️</span>
      <h4>Email</h4>
      <p>temukankopi01@gmail.com</p>
    </div>
    <div class="contact-card">
      <span class="contact-icon">🕐</span>
      <h4>Working Hour</h4>
      <p>08:00 - 22:00</p>
    </div>
  </div>
  <div class="footer-col">
    <iframe src="https://www.google.com/maps/embed?pb=!1m13!1m8!1m3!1d7909.403897813672!2d111.517852!3d-7.607377!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zN8KwMzYnMjYuNiJTIDExMcKwMzEnMTMuNSJF!5e0!3m2!1sid!2sid!4v1778424558013!5m2!1sid!2sid" 
      width="600" 
      height="450" 
      style="border:0;" 
      allowfullscreen="" 
      loading="lazy" 
      referrerpolicy="no-referrer-when-downgrade">
    </iframe>
  </div>
</section>


<footer>
  <div class="footer-grid">
    <div class="footer-brand">
      <span class="logo">temukan kopi.</span>
      <p>Kopi berkualitas dari bumi Indonesia. Setiap tegukan membawa cerita dari tanah terbaik nusantara.</p>
    </div>
    <div class="footer-col">
      <h4>Contact Us</h4>
      <p>Madiun, Jawa Timur</p>
      <p>+62 812345678</p>
      <p>temukankopi@gmail.com</p>
    </div>
    <div class="footer-col">
      <h4>Sosial Media</h4>
      <div class="footer-social-icons">
        <a href="https://www.facebook.com/awa.udin.984" target="_blank"><i class="fab fa-facebook"></i></a>
        <a href="https://www.instagram.com/awa_ilhq/" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="https://wa.me/62882003668995/" target="_blank"><i class="fab fa-whatsapp"></i></a>
      </div>
    </div>
  </div>
  <div class="copy">© Copyright 2025 Temukan Kopi. All rights reserved.</div>
</footer>


<div class="modal-overlay" id="modalOverlay">
  <div class="modal" id="modalBox">
    <div class="modal-title">Form Pemesanan</div>
    <div class="modal-subtitle" id="modalSubtitle">0 produk dipilih</div>
    <div class="modal-order-list" id="modalOrderList"></div>
    <div class="form-group">
      <label>Nama Customer:</label>
      <input type="text" id="namaInput" placeholder="Masukan Nama Anda">
    </div>
    <div class="form-group">
      <label>No. Whatsapp:</label>
      <input type="tel" id="waInput" placeholder="Contoh: 08876425610">
    </div>
    <div class="form-group">
      <label>Alamat Lengkap:</label>
      <textarea id="alamatInput" placeholder="Jalan, RT/RW, Kec./
Kota, Kodepos"></textarea>
    </div>
    <div class="form-group">
      <label>Catatan Tambahan:</label>
      <textarea id="cttnInput" placeholder="Tambahkan catatan tertentu"></textarea>
    </div>
    <div class="form-group">
      <label>Tanggal Pesan:</label>
      <input type="text" id="tglInput" readonly>
    </div>
    <div class="total-box">
      <span class="total-label">Total Harga</span>
      <span class="total-value" id="modalTotal">Rp 0</span>
    </div>
    <button class="btn-bayar" id="btnBayar"><span>Bayar Sekarang</span></button>
    <button class="btn-kembali" id="btnKembali">Kembali</button>
  </div>
</div>

<div class="toast" id="toast">
  <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
  <span id="toastMsg">Produk ditambahkan</span>
</div>

<script>
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
  navbar.classList.toggle('scrolled', window.scrollY > 40);
}, { passive: true });

const hamburger = document.getElementById('navHamburger');
const navLinks  = document.getElementById('navLinks');
hamburger.addEventListener('click', () => {
  hamburger.classList.toggle('open');
  navLinks.classList.toggle('open');
});
navLinks.querySelectorAll('a').forEach(a => {
  a.addEventListener('click', () => {
    hamburger.classList.remove('open');
    navLinks.classList.remove('open');
  });
});

const io = new IntersectionObserver((entries) => {
  entries.forEach(e => {
    if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); }
  });
}, { threshold: 0.12, rootMargin: '0px 0px -36px 0px' });
document.querySelectorAll('.reveal, .stagger').forEach(el => io.observe(el));

function runCounter(el) {
  const target = parseInt(el.dataset.target, 10);
  const dur = 1800, start = performance.now();
  const tick = now => {
    const p = Math.min((now - start) / dur, 1);
    el.textContent = Math.round(p < 1 ? target * (1 - Math.pow(1 - p, 3)) : target);
    if (p < 1) requestAnimationFrame(tick);
  };
  requestAnimationFrame(tick);
}
const cntIo = new IntersectionObserver((entries) => {
  entries.forEach(e => {
    if (e.isIntersecting) { e.target.querySelectorAll('.counter').forEach(runCounter); cntIo.unobserve(e.target); }
  });
}, { threshold: 0.5 });
document.querySelectorAll('.hero-stats').forEach(el => cntIo.observe(el));

function fmt(n) { return 'Rp ' + n.toLocaleString('id-ID'); }

function showToast(msg) {
  const t = document.getElementById('toast');
  document.getElementById('toastMsg').textContent = msg;
  t.classList.add('show');
  setTimeout(() => t.classList.remove('show'), 2500);
}

function closeModal() { document.getElementById('modalOverlay').classList.remove('open'); }
document.getElementById('btnKembali').addEventListener('click', closeModal);
document.getElementById('modalOverlay').addEventListener('click', e => {
  if (e.target === document.getElementById('modalOverlay')) closeModal();
});

document.getElementById('btnToggleProduk').addEventListener('click', function() {
    const hiddenProducts = document.querySelectorAll('.hidden-product');
    const isShowingAll = this.getAttribute('data-status') === 'open';

    if (!isShowingAll) {
        hiddenProducts.forEach((product, index) => {
            setTimeout(() => {
                product.classList.add('show-active');
            }, index * 80);
        });
        this.textContent = 'LIHAT LEBIH SEDIKIT';
        this.setAttribute('data-status', 'open');
    } else {
        hiddenProducts.forEach(product => {
            product.classList.remove('show-active');
        });
        this.textContent = 'LIHAT SEMUA MENU';
        this.setAttribute('data-status', 'closed');
        setTimeout(() => {
            document.getElementById('Produk').scrollIntoView({ behavior: 'smooth' });
        }, 200);
    }
});

(function() {
  const cards   = Array.from(document.querySelectorAll('.fan-card'));
  const dots    = Array.from(document.querySelectorAll('.fan-dot'));
  const btnPrev = document.getElementById('fanPrev');
  const btnNext = document.getElementById('fanNext');
  const stage   = document.getElementById('fanStage');
  const total   = cards.length;
  let current   = 0;
  let autoTimer;

  function getPos(cardIndex, activeIndex) {
    let rel = cardIndex - activeIndex;
    if (rel > Math.floor(total / 2))  rel -= total;
    if (rel < -Math.floor(total / 2)) rel += total;
    return rel;
  }

  function update() {
    cards.forEach((card, i) => {
      const pos = getPos(i, current);
      card.setAttribute('data-pos', pos);
      card.classList.toggle('fc-active', pos === 0);
    });
    dots.forEach((d, i) => d.classList.toggle('active', i === current));
  }

  function next() { current = (current + 1) % total; update(); }
  function prev() { current = (current - 1 + total) % total; update(); }
  function resetAuto() { clearInterval(autoTimer); autoTimer = setInterval(next, 3500); }

  btnNext.addEventListener('click', () => { next(); resetAuto(); });
  btnPrev.addEventListener('click', () => { prev(); resetAuto(); });

  cards.forEach((card, i) => {
    card.addEventListener('click', () => {
      if (i !== current) { current = i; update(); resetAuto(); }
    });
  });

  dots.forEach(d => {
    d.addEventListener('click', () => {
      current = parseInt(d.dataset.idx);
      update(); resetAuto();
    });
  });

  let tx = 0;
  stage.addEventListener('touchstart', e => { tx = e.touches[0].clientX; }, {passive:true});
  stage.addEventListener('touchend', e => {
    const dx = e.changedTouches[0].clientX - tx;
    if (Math.abs(dx) > 50) { dx < 0 ? next() : prev(); resetAuto(); }
  }, {passive:true});

  let mx = 0, drag = false;
  stage.addEventListener('mousedown', e => { mx = e.clientX; drag = true; });
  stage.addEventListener('mouseup', e => {
    if (!drag) return; drag = false;
    const dx = e.clientX - mx;
    if (Math.abs(dx) > 60) { dx < 0 ? next() : prev(); resetAuto(); }
  });
  stage.addEventListener('mouseleave', () => { drag = false; });

  update();
  autoTimer = setInterval(next, 3500);
})();

</script>

</body>
</html>