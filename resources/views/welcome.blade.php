<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Temukan Kopi</title>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,400;1,700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
/* ════════════════════════════════════
   RESET & ROOT
════════════════════════════════════ */
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

/* ════════════════════════════════════
   NAVBAR
════════════════════════════════════ */
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

/* ══ KERANJANG ICON ══ */
.cart-btn {
  margin-left: 28px;
  position: relative;
  background: none;
  border: none;
  cursor: pointer;
  padding: 6px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--teks-mid);
  transition: color .3s;
}
.cart-btn:hover { color: var(--teks); }
.cart-btn svg {
  width: 22px; height: 22px;
  stroke: currentColor; fill: none;
  stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round;
}
.cart-badge {
  position: absolute; top: 0; right: 0;
  background: var(--hijau); color: #fff;
  font-size: 10px; font-weight: 700;
  width: 18px; height: 18px;
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  transform: translate(30%, -30%);
  opacity: 0; transition: opacity .2s, transform .2s;
  pointer-events: none;
}
.cart-badge.visible { opacity: 1; transform: translate(30%, -30%) scale(1); }

/* ══ SIDEBAR KERANJANG ══ */
.cart-overlay {
  position: fixed; inset: 0;
  background: rgba(0,0,0,0.35);
  z-index: 800; opacity: 0; pointer-events: none; transition: opacity .3s;
}
.cart-overlay.open { opacity: 1; pointer-events: all; }

.cart-sidebar {
  position: fixed; top: 0; right: 0;
  width: 380px; height: 100vh;
  background: var(--putih);
  z-index: 900; display: flex; flex-direction: column;
  transform: translateX(100%);
  transition: transform .35s cubic-bezier(.23,.88,.34,1.05);
  box-shadow: -8px 0 40px rgba(0,0,0,0.12);
}
.cart-sidebar.open { transform: translateX(0); }

.cart-header {
  display: flex; justify-content: space-between; align-items: center;
  padding: 22px 24px 18px;
  border-bottom: 1px solid rgba(0,0,0,0.08);
}
.cart-header-title {
  font-family: 'Playfair Display', serif;
  font-size: 20px; font-weight: 900; color: var(--teks); letter-spacing: -.3px;
}
.cart-close {
  background: none; border: none; cursor: pointer;
  color: var(--teks-soft); padding: 4px; border-radius: 6px;
  display: flex; align-items: center; justify-content: center;
  transition: color .2s, background .2s;
}
.cart-close:hover { color: var(--teks); background: var(--krem); }
.cart-close svg { width: 20px; height: 20px; stroke: currentColor; fill: none; stroke-width: 1.8; stroke-linecap: round; }

.cart-items { flex: 1; overflow-y: auto; padding: 16px 24px; }
.cart-items::-webkit-scrollbar { width: 4px; }
.cart-items::-webkit-scrollbar-track { background: transparent; }
.cart-items::-webkit-scrollbar-thumb { background: #ddd; border-radius: 2px; }

.cart-empty {
  display: flex; flex-direction: column; align-items: center;
  justify-content: center; height: 100%; gap: 12px; color: var(--teks-soft);
}
.cart-empty svg { width: 56px; height: 56px; stroke: var(--teks-soft); fill: none; stroke-width: 1.4; stroke-linecap: round; opacity: .5; }
.cart-empty p { font-size: 14px; }

.cart-item {
  display: flex; gap: 14px; align-items: flex-start;
  padding: 14px 0; border-bottom: 1px solid rgba(0,0,0,0.06);
}
.cart-item:last-child { border-bottom: none; }
.cart-item-img { width: 64px; height: 64px; border-radius: 8px; object-fit: cover; flex-shrink: 0; background: var(--krem); }
.cart-item-info { flex: 1; min-width: 0; }
.cart-item-name { font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: .3px; color: var(--teks); margin-bottom: 3px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.cart-item-cat { font-size: 11px; color: var(--teks-soft); margin-bottom: 8px; }
.cart-item-controls { display: flex; align-items: center; }
.ci-btn { width: 26px; height: 26px; border: 1px solid #ddd; background: var(--krem); border-radius: 5px; cursor: pointer; font-size: 14px; font-weight: 600; color: var(--teks); display: flex; align-items: center; justify-content: center; transition: all .2s; }
.ci-btn:hover { background: var(--hijau); color: #fff; border-color: var(--hijau); }
.ci-qty { width: 32px; height: 26px; text-align: center; font-size: 13px; font-weight: 600; border: 1px solid #ddd; border-left: none; border-right: none; background: var(--putih); color: var(--teks); outline: none; }
.cart-item-price { text-align: right; flex-shrink: 0; }
.cart-item-subtotal { font-size: 13px; font-weight: 700; color: var(--teks); margin-bottom: 6px; }
.cart-item-remove { background: none; border: none; cursor: pointer; color: var(--teks-soft); font-size: 11px; font-weight: 500; padding: 0; transition: color .2s; }
.cart-item-remove:hover { color: #e74c3c; }

.cart-footer { padding: 18px 24px 24px; border-top: 1px solid rgba(0,0,0,0.08); background: var(--putih); }
.cart-summary-row { display: flex; justify-content: space-between; font-size: 13px; color: var(--teks-mid); margin-bottom: 6px; }
.cart-total-row { display: flex; justify-content: space-between; align-items: center; margin: 14px 0; padding-top: 12px; border-top: 1px solid rgba(0,0,0,0.08); }
.cart-total-label { font-size: 14px; font-weight: 600; color: var(--teks); }
.cart-total-val { font-size: 20px; font-weight: 800; color: var(--hijau); }

.btn-checkout-cart {
  width: 100%; background: var(--hijau); color: #fff; border: none;
  border-radius: 10px; padding: 14px; font-size: 14px; font-weight: 600;
  cursor: pointer; transition: all .3s; letter-spacing: .3px;
  display: flex; align-items: center; justify-content: center; gap: 8px;
}
.btn-checkout-cart:hover { background: var(--hijau-tua); transform: translateY(-2px); box-shadow: 0 8px 22px rgba(31,94,59,.3); }
.btn-clear-cart { width: 100%; background: transparent; color: var(--teks-soft); border: none; padding: 10px; font-size: 13px; font-weight: 500; cursor: pointer; margin-top: 8px; transition: color .2s; }
.btn-clear-cart:hover { color: #e74c3c; }

/* ══ CARD ADD BUTTON ══ */
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

/* ══ MODAL PEMESANAN ══ */
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

/* ══ TOAST ══ */
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

/* ════════════════════════════════════
   HERO
════════════════════════════════════ */
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

/* decorative blobs */
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

/* pill badge */
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
  /* entrance */
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

//* hero image */
.hero-img-wrap {
  position: relative;
  z-index: 2;
  flex-shrink: 0;
  opacity: 0;
  animation: fadeLeft .85s .35s forwards;
}

.hero-img-wrap img {
  width: 600px; /* ⬅️ DIUBAH dari 520px supaya lebih besar */
  filter: drop-shadow(0 28px 52px rgba(31,94,59,.22));
  animation: float 4.5s ease-in-out infinite;
}

/* .hero-img-wrap {
  position: relative;
  z-index: 2;
  flex-shrink: 0;
  opacity: 0;
  animation: fadeLeft .85s .35s forwards;
}
.hero-img-wrap img {
  width: 400px;
  filter: drop-shadow(0 28px 52px rgba(31,94,59,.22));
  animation: float 4.5s ease-in-out infinite;
} */

@keyframes float {
  0%,100% { transform: translateY(0px); }
  50%      { transform: translateY(-20px); }
}

/* hero stats */
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

/* ════════════════════════════════════
   SHARED SECTION STYLES
════════════════════════════════════ */
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

/* .bg-title1 {
  position: absolute;
  font-family: 'Playfair Display', serif;
  font-size: 140px;
  font-weight: 900;
  color: rgba(0,0,0,0.04);
  top: 30px; left: 80px;
  pointer-events: none;
  user-select: none;
  white-space: nowrap;
  line-height: 1;
} */


/* background transparan */
.bg-title {
    overflow: hidden;
    position: absolute;
    top: 5px;
    left: 40px;    /* ⬅️ geser ke kiri */
    font-size: 140px;
    font-weight: bold;

    color: transparent; /* isi transparan */
    -webkit-text-stroke: 1px #1f4d3a; /* outline */

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

    color: transparent; /* isi transparan */
    -webkit-text-stroke: 1px #1f4d3a; /* outline */

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

/* ════════════════════════════════════
   ABOUT
════════════════════════════════════ */
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

/* ════════════════════════════════════
   PRODUK
════════════════════════════════════ */
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

/* ════════════════════════════════════
   TESTIMONI
════════════════════════════════════ */
.testi-section { background: var(--putih); }

.testi-header { text-align: center; margin-bottom: 56px; }
.testi-header p { color: var(--teks-soft); font-size: 14px; }

.testimoni-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 26px;
  justify-content: center;
}

.testi {
  background: linear-gradient(135deg, #1f5e3b 0%, #2f7a52 100%);
  color: var(--putih);
  padding: 36px 32px;
  border-radius: 18px;
  position: relative;
  overflow: hidden;
  transition: transform .35s;
}
.testi::before {
  content: '"';
  position: absolute;
  top: -8px; left: 18px;
  font-family: 'Playfair Display', serif;
  font-size: 110px;
  opacity: .12;
  line-height: 1;
  pointer-events: none;
}
.testi:hover { transform: translateY(-8px); }

.testi p { font-size: 14px; line-height: 1.8; position: relative; z-index: 1; margin-bottom: 22px; }

.testi-author { display: flex; align-items: center; gap: 12px; position: relative; z-index: 1; }
.testi-avatar {
  width: 38px; height: 38px;
  background: rgba(255,255,255,.22);
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-weight: 700; font-size: 15px;
}
.testi-name  { font-weight: 600; font-size: 13px; display: block; }
.testi-handle{ font-size: 11px; opacity: .7; display: block; }

/* ════════════════════════════════════
   PENGIRIMAN
════════════════════════════════════ */
.pengiriman-section { background: var(--krem); padding: 80px 100px; }

.pengiriman {
  display: grid;
  grid-template-columns: 1fr 1fr;
  border-radius: 22px;
  overflow: hidden;
  box-shadow: var(--shadow-lg);
}

.pengiriman-img {
  position: relative;
  min-height: 380px;
  overflow: hidden;
}
.pengiriman-img img {
  width: 100%; height: 100%;
  object-fit: cover;
  display: block;
  transition: transform .6s ease;
}
.pengiriman:hover .pengiriman-img img { transform: scale(1.05); }

.pengiriman-content {
  background: linear-gradient(145deg, #143d27 0%, #1f5e3b 100%);
  color: var(--putih);
  display: flex; flex-direction: column; justify-content: center;
  padding: 56px 52px;
}
.pengiriman-content .section-tag { color: rgba(255,255,255,.5); }
.pengiriman-content .section-title { color: var(--putih); font-size: 34px; }

.pengiriman-content p {
  color: rgba(255,255,255,.78);
  font-size: 14px;
  line-height: 1.9;
  margin-bottom: 32px;
}

.peng-list { display: flex; flex-direction: column; gap: 15px; }
.peng-item { display: flex; align-items: center; gap: 14px; font-size: 13.5px; color: rgba(255,255,255,.88); }
.peng-icon {
  width: 36px; height: 36px; border-radius: 9px;
  background: rgba(255,255,255,.13);
  display: flex; align-items: center; justify-content: center;
  font-size: 16px; flex-shrink: 0;
}

/* ════════════════════════════════════
   MENGAPA
════════════════════════════════════ */
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

/* ════════════════════════════════════
   TIPS PENYAJIAN
════════════════════════════════════ */
.tips {
  background: var(--hijau-tua);
  color: var(--putih);
  position: relative;
  overflow: hidden;
}
.tips::before {
  content: '';
  position: absolute; inset: 0;
  background: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Ccircle cx='40' cy='40' r='30' fill='none' stroke='white' stroke-width='1' opacity='0.04'/%3E%3C/svg%3E") repeat;
  pointer-events: none;
}

.tips .section-tag  { color: rgba(255,255,255,.48); }
.tips .section-title{ color: var(--putih); font-size: 44px; }

.tips-header { text-align: center; position: relative; z-index: 2; margin-bottom: 56px; }
.tips-header p { color: rgba(255,255,255,.6); font-size: 14px; }

.tips-content { position: relative; z-index: 2; }

.tips-grid {
  display: grid;
  grid-template-columns: repeat(5, 1fr);
  gap: 22px;
}

.step {
  text-align: center;
  padding: 30px 18px;
  border-radius: 16px;
  background: rgba(255,255,255,.06);
  border: 1px solid rgba(255,255,255,.1);
  transition: all .4s;
}
.step:hover {
  background: rgba(255,255,255,.12);
  transform: translateY(-8px);
}

.step-num {
  width: 40px; height: 40px;
  border-radius: 50%;
  border: 2px solid rgba(255,255,255,.25);
  background: rgba(255,255,255,.12);
  display: inline-flex; align-items: center; justify-content: center;
  font-size: 13px; font-weight: 700;
  margin-bottom: 16px;
}
.step-icon { font-size: 28px; margin-bottom: 14px; display: block; }
.step h4 { font-size: 14px; font-weight: 600; margin-bottom: 8px; }
.step p  { font-size: 12px; color: rgba(255,255,255,.6); line-height: 1.7; }

/* ════════════════════════════════════
   GALERI
════════════════════════════════════ */
.galeri-section { background: var(--krem2); }

.galeri-header { text-align: center; margin-bottom: 56px; }

.galeri-grid {
  display: grid;
  grid-template-columns: 2fr 1fr 1fr;
  grid-template-rows: 230px 230px;
  gap: 16px;
}

.g-item {
  position: relative;
  overflow: hidden;
  border-radius: var(--radius);
}
.g-item:first-child { grid-row: span 2; }

.g-item img {
  width: 100%; height: 100%;
  object-fit: cover;
  display: block;
  transition: transform .6s ease;
}
.g-item:hover img { transform: scale(1.09); }

.g-overlay {
  position: absolute; inset: 0;
  background: rgba(31,94,59,.38);
  opacity: 0;
  display: flex; align-items: center; justify-content: center;
  font-size: 32px;
  transition: opacity .4s;
}
.g-item:hover .g-overlay { opacity: 1; }

/* ════════════════════════════════════
   CONTACT
════════════════════════════════════ */
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


/* maps */

.footer-col iframe{
  width:100%;
  height:300px;
  border-radius:10px;
}

/* ════════════════════════════════════
   FOOTER
════════════════════════════════════ */
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
/* .footer-social-icons a i{
  font-size:30px;
} */
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

/* ════════════════════════════════════
   KEYFRAMES
════════════════════════════════════ */
@keyframes fadeUp {
  from { opacity: 0; transform: translateY(38px); }
  to   { opacity: 1; transform: translateY(0); }
}
@keyframes fadeLeft {
  from { opacity: 0; transform: translateX(-320px); }
  to   { opacity: 1; transform: translateX(-320px); }
}

/* ════════════════════════════════════
   SCROLL REVEAL
════════════════════════════════════ */
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
.stagger.visible > *:nth-child(1) { opacity:1; transform:none; transition-delay:.0s; }
.stagger.visible > *:nth-child(2) { opacity:1; transform:none; transition-delay:.11s; }
.stagger.visible > *:nth-child(3) { opacity:1; transform:none; transition-delay:.22s; }
.stagger.visible > *:nth-child(4) { opacity:1; transform:none; transition-delay:.33s; }
.stagger.visible > *:nth-child(5) { opacity:1; transform:none; transition-delay:.44s; }

/* ════════════════════════════════════
   RESPONSIVE (basic)
════════════════════════════════════ */
@media (max-width: 1100px) {
  .navbar, section, footer { padding-left: 40px; padding-right: 40px; }
  .hero   { padding: 80px 40px; }
  .hero h1 { font-size: 56px; }
  .hero-img-wrap img { width: 300px; }
  .produk-grid, .alasan, .testimoni-grid { grid-template-columns: repeat(2,1fr); }
  .tips-grid { grid-template-columns: repeat(3,1fr); }
  .footer-grid { grid-template-columns: 1fr 1fr; }
  .about { grid-template-columns: 1fr; }
  .pengiriman { grid-template-columns: 1fr; }
  .contact-grid { grid-template-columns: repeat(2,1fr); }
}
</style>
</head>
<body>

<!-- ╔══════════════════════════════╗
     ║          NAVBAR              ║
     ╚══════════════════════════════╝ -->
<div class="navbar" id="navbar">
  <div class="logo">temukan kopi.</div>
  <div class="nav-links">
    <a href="#Home">Home</a>
    <a href="#About">About me</a>
    <a href="#Produk">Produk</a>
    <a href="#Kontak">Kontak</a>
    <a href="#Galery">Galery</a>
    <button class="cart-btn" id="cartBtn" title="Keranjang">
      <svg viewBox="0 0 24 24"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
      <span class="cart-badge" id="cartBadge">0</span>
    </button>
  </div>
</div>


<!-- ╔══════════════════════════════╗
     ║           HERO               ║
     ╚══════════════════════════════╝ -->
<section id="Home" class="hero">
  <div class="hero-left">
    <div class="hero-pill">☕ Premium Indonesian Coffee</div>
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


<!-- ╔══════════════════════════════╗
     ║           ABOUT              ║
     ╚══════════════════════════════╝ -->
<section id="About" class="about-section"> 
  <div class="bg-title1">About</div>
  <div class="about">
    <div class="about-img-wrap reveal from-left">
      <img src="images/kopi1.png" alt="About Temukan Kopi">
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


<!-- ╔══════════════════════════════╗
     ║          PRODUK              ║
     ╚══════════════════════════════╝ -->
<section id="Produk">
  <div class="produk-header reveal" style="text-align: center; margin-bottom: 50px;">
      <span class="section-tag">Koleksi Kami</span>
      <h2 class="section-title">Menu Kopi Unggulan</h2>
  </div>

  <div class="produk-grid stagger">
    @forelse($produk as $p)
    <a class="card" href="{{ url('/checkout?id_produk='.$p->id_produk) }}">
      
      {{-- Badge otomatis: Jika produk baru atau premium --}}
      {{-- Kita tidak lagi pakai stok_produk < 10 --}}
      <div class="badge">PREMIUM</div>
      
      {{-- Gambar dengan Proteksi Fallback --}}
      <div class="img-container" style="position: relative; overflow: hidden;">
          <img src="{{ $p->foto_produk ? asset('storage/produk/'.$p->foto_produk) : asset('images/default.png') }}" 
            alt="{{ $p->nama_produk }}"
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
        {{-- Wadah baru untuk Bintang & Status --}}
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
            <div class="card-stars" style="margin-bottom: 0;">★★★★★</div>
            <span style="font-size: 11px; font-weight: 700; color: #2ecc71; text-transform: uppercase; letter-spacing: 0.5px;">
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
        <span style="font-size: 50px;">☕</span>
        <p style="margin-top: 15px; font-style: italic;">Maaf, katalog produk sedang dalam pembaruan.</p>
    </div>
    @endforelse
  </div>

  <div class="produk-cta reveal" style="margin-top: 60px;">
    <a class="btn" href="#">LIHAT SEMUA MENU</a>
  </div>
</section>


<!-- ╔══════════════════════════════╗
     ║        TESTIMONI             ║
     ╚══════════════════════════════╝ -->
<section id="Testimoni" class="testi-section">
  <div class="bg-title">Testimoni</div>
  <div class="testi-header reveal">
    <span class="section-tag">Apa Kata Mereka</span>
    <h2 class="section-title">Testimoni Pelanggan</h2>
    <p>Kata Mereka Kepada Temukan Kopi</p>
  </div>
  <div class="testimoni-grid stagger">
    <div class="testi">
      <p>"Kopi sangat nikmat dan aromanya kuat sekali. Setiap pagi tidak pernah mengecewakan."</p>
      <div class="testi-author">
        <div class="testi-avatar">D</div>
        <div>
          <span class="testi-name">Dimas</span>
          <span class="testi-handle">@dimas</span>
        </div>
      </div>
    </div>
    <div class="testi">
      <p>"Pengiriman cepat dan kualitas kopi mantap. Kemasan aman, produk sampai sempurna!"</p>
      <div class="testi-author">
        <div class="testi-avatar">B</div>
        <div>
          <span class="testi-name">Barista</span>
          <span class="testi-handle">@barista</span>
        </div>
      </div>
    </div>
    <div class="testi">
      <p>"Saya selalu membeli kopi di sini. Sudah langganan lebih dari 3 tahun!"</p>
      <div class="testi-author">
        <div class="testi-avatar">K</div>
        <div>
          <span class="testi-name">Kopimania</span>
          <span class="testi-handle">@kopimania</span>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ╔══════════════════════════════╗
     ║        PENGIRIMAN            ║
     ╚══════════════════════════════╝ -->
<section class="pengiriman-section">
  <div class="pengiriman reveal">
    <div class="pengiriman-img">
      <img src="images/Cangkir Daun.png" alt="Pengiriman Kopi">
    </div>
    <div class="pengiriman-content">
      <span class="section-tag">Layanan Kami</span>
      <h2 class="section-title">Pengiriman Lokal &amp; Internasional</h2>
      <p>Kami menyediakan layanan pengiriman kopi lokal dan internasional dengan kemasan terbaik yang menjaga kesegaran dan kualitas kopi hingga sampai ke tangan Anda.</p>
      <div class="peng-list">
        <div class="peng-item"><div class="peng-icon">📦</div> Kemasan vakum premium tahan lama</div>
        <div class="peng-item"><div class="peng-icon">🚀</div> Pengiriman express 1–2 hari kerja</div>
        <div class="peng-item"><div class="peng-icon">🌍</div> Pengiriman ke seluruh dunia</div>
      </div>
    </div>
  </div>
</section>


<!-- ╔══════════════════════════════╗
     ║         MENGAPA              ║
     ╚══════════════════════════════╝ -->
<section class="mengapa-section">
  <div class="bg-title1">Mengapa</div>
  <div class="mengapa-header reveal">
    <span class="section-tag">Keunggulan Kami</span>
    <h2 class="section-title">Mengapa memilih kami?</h2>
  </div>
  <div class="alasan stagger">
    <div class="alasan-card">
      <span class="icon">⭐</span>
      <h3>Kualitas Terjamin</h3>
      <p>Biji kopi pilihan terbaik yang diseleksi langsung dari kebun-kebun terbaik di Indonesia.</p>
    </div>
    <div class="alasan-card">
      <span class="icon">✔</span>
      <h3>Pelayanan Terpercaya</h3>
      <p>Kami melayani dengan profesional dan penuh dedikasi untuk kepuasan setiap pelanggan.</p>
    </div>
    <div class="alasan-card">
      <span class="icon">☕</span>
      <h3>Kepuasan Pelanggan</h3>
      <p>Kami selalu mengutamakan kepuasan pelanggan di atas segalanya dengan jaminan kualitas.</p>
    </div>
  </div>
</section>


<!-- ╔══════════════════════════════╗
     ║       TIPS PENYAJIAN         ║
     ╚══════════════════════════════╝ -->
<section class="tips">
  <div class="tips-header reveal">
    <span class="section-tag">Panduan Kopi</span>
    <h2 class="section-title">Tips Penyajian</h2>
    <p>5 langkah menyeduh kopi yang sempurna</p>
  </div>
  <div class="tips-content">
    <div class="tips-grid stagger">
      <div class="step">
        <span class="step-icon">🌿</span>
        <div class="step-num">01</div>
        <h4>Timbang Kopi</h4>
        <p>Gunakan 15g kopi untuk 250ml air untuk hasil terbaik</p>
      </div>
      <div class="step">
        <span class="step-icon">💧</span>
        <div class="step-num">02</div>
        <h4>Panaskan Air</h4>
        <p>Suhu ideal 90–96°C, jangan sampai mendidih</p>
      </div>
      <div class="step">
        <span class="step-icon">⚙️</span>
        <div class="step-num">03</div>
        <h4>Giling Kopi</h4>
        <p>Sesuaikan gilingan dengan metode penyajian</p>
      </div>
      <div class="step">
        <span class="step-icon">⏱️</span>
        <div class="step-num">04</div>
        <h4>Seduh Kopi</h4>
        <p>Seduh perlahan merata selama 3–4 menit</p>
      </div>
      <div class="step">
        <span class="step-icon">☕</span>
        <div class="step-num">05</div>
        <h4>Nikmati</h4>
        <p>Sajikan segera dan nikmati aroma khasnya</p>
      </div>
    </div>
  </div>
</section>


<!-- ╔══════════════════════════════╗
     ║          GALERI              ║
     ╚══════════════════════════════╝ -->
<section id="Galery" class="galeri-section">
  <div class="galeri-header reveal">
    <span class="section-tag">Koleksi Foto</span>
    <h2 class="section-title">Galeri Kopi Kami</h2>
  </div>
  <div class="galeri-grid reveal">
    <div class="g-item">
      <img src="images/COVER@-0.png" alt="Galeri 1">
      <div class="g-overlay">☕</div>
    </div>
    <div class="g-item">
      <img src="images/COVER@-1.png" alt="Galeri 2">
      <div class="g-overlay">🫘</div>
    </div>
    <div class="g-item">
      <img src="images/COVER@-3.png" alt="Galeri 3">
      <div class="g-overlay">🌿</div>
    </div>
    <div class="g-item">
      <img src="images/COVER@-4.png" alt="Galeri 4">
      <div class="g-overlay">💧</div>
    </div>
    <div class="g-item">
      <img src="images/COVER@-2.png" alt="Galeri 5">
      <div class="g-overlay">📦</div>
    </div>
  </div>
</section>


<!-- ╔══════════════════════════════╗
     ║          CONTACT             ║
     ╚══════════════════════════════╝ -->
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
      <p>+62 812345678</p>
    </div>
    <div class="contact-card green">
      <span class="contact-icon">✉️</span>
      <h4>Email</h4>
      <p>temukankopi@gmail.com</p>
    </div>
    <div class="contact-card">
      <span class="contact-icon">🕐</span>
      <h4>Working Hour</h4>
      <p>08:00 - 22:00</p>
    </div>
  </div>
  <div class="footer-col">
  <iframe 
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31635.94015942104!2d111.50745181683668!3d-7.630061412670274!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e79be537c813a33%3A0xafe2f173545a53ae!2sMadiun%2C%20Kota%20Madiun%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1775747010906!5m2!1sid!2sid"
    width="100%"
    height="200"
    style="border:0;"
    allowfullscreen=""
    loading="lazy"
    referrerpolicy="no-referrer-when-downgrade">
  </iframe>
</div>
</section>


<!-- ╔══════════════════════════════╗
     ║           FOOTER             ║
     ╚══════════════════════════════╝ -->
<footer>
  <div class="footer-grid">
    <div class="footer-brand">
      <span class="logo">temukan kopi.</span>
      <p>Kopi berkualitas dari bumi Indonesia. Setiap tegukan membawa cerita dari tanah terbaik nusantara.</p>
      
      <!-- <div class="footer-socials">
        <a class="soc-btn" title="Instagram">📸</a>
        <a class="soc-btn" title="Facebook">👥</a>
        <a class="soc-btn" title="TikTok">🎵</a>
        <a class="soc-btn" title="WhatsApp">💬</a>
        <a href="https://github.com/Aqa051206" target="_blank"><i class="fab fa-github"></i></a>
        <a href="https://www.instagram.com/awa_ilhq/" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="https://www.linkedin.com/in/awa-a-893600308/" target="_blank"><i class="fab fa-linkedin"></i></a>
        <a href="https://wa.me/62882003668995/" target="_blank"><i class="fab fa-whatsapp"></i></a>
      </div> -->

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
      <!-- <a href="#">Instagram</a>
      <a href="#">Facebook</a>
      <a href="#">TikTok</a>
      <a href="#">WhatsApp</a> -->
      <a href="https://www.facebook.com/awa.udin.984" target="_blank"><i class="fab fa-facebook"></i></a>
      <a href="https://www.instagram.com/awa_ilhq/" target="_blank"><i class="fab fa-instagram"></i></a>
      <a href="https://wa.me/62882003668995/" target="_blank"><i class="fab fa-whatsapp"></i></a>
      </div>
    </div>

  </div>
  <div class="copy">© Copyright 2025 Temukan Kopi. All rights reserved.</div>
</footer>


<!-- ════ SIDEBAR KERANJANG ════ -->
<div class="cart-overlay" id="cartOverlay"></div>
<div class="cart-sidebar" id="cartSidebar">
  <div class="cart-header">
    <span class="cart-header-title">Keranjang</span>
    <button class="cart-close" id="cartClose">
      <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>
  </div>
  <div class="cart-items" id="cartItems">
    <div class="cart-empty" id="cartEmpty">
      <svg viewBox="0 0 24 24"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
      <p>Keranjang masih kosong</p>
    </div>
  </div>
  <div class="cart-footer" id="cartFooter" style="display:none">
    <div class="cart-summary-row">
      <span>Total item</span>
      <span id="cartItemCount">0 pcs</span>
    </div>
    <div class="cart-total-row">
      <span class="cart-total-label">Total Harga</span>
      <span class="cart-total-val" id="cartTotalVal">Rp 0</span>
    </div>
    <button class="btn-checkout-cart" id="btnCheckoutCart">
      <svg viewBox="0 0 24 24" style="width:18px;height:18px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      Checkout Sekarang
    </button>
    <button class="btn-clear-cart" id="btnClearCart">Kosongkan keranjang</button>
  </div>
</div>

<!-- ════ MODAL PEMESANAN ════ -->
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
      <textarea id="alamatInput" placeholder="Jalan, RT/RW, Kec./&#10;Kota, Kodepos"></textarea>
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

<!-- ════ TOAST ════ -->
<div class="toast" id="toast">
  <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
  <span id="toastMsg">Produk ditambahkan</span>
</div>

<!-- ════════ SCRIPTS ════════ -->
<script>
/* ── Navbar scroll shadow ── */
const navbar = document.getElementById('navbar');
window.addEventListener('scroll', () => {
  navbar.classList.toggle('scrolled', window.scrollY > 40);
}, { passive: true });

/* ── Universal IntersectionObserver for .reveal & .stagger ── */
const io = new IntersectionObserver((entries) => {
  entries.forEach(e => {
    if (e.isIntersecting) { e.target.classList.add('visible'); io.unobserve(e.target); }
  });
}, { threshold: 0.12, rootMargin: '0px 0px -36px 0px' });
document.querySelectorAll('.reveal, .stagger').forEach(el => io.observe(el));

/* ── Counter animation ── */
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

/* ══════════════════════════════════════
   KERANJANG
══════════════════════════════════════ */
let keranjang = JSON.parse(localStorage.getItem('keranjangKopi') || '[]');

function simpanKeranjang() { localStorage.setItem('keranjangKopi', JSON.stringify(keranjang)); }
function fmt(n) { return 'Rp ' + n.toLocaleString('id-ID'); }
function hitungTotal() { return keranjang.reduce((s, i) => s + i.harga * i.qty, 0); }
function hitungTotalQty() { return keranjang.reduce((s, i) => s + i.qty, 0); }

function showToast(msg) {
  const t = document.getElementById('toast');
  document.getElementById('toastMsg').textContent = msg;
  t.classList.add('show');
  setTimeout(() => t.classList.remove('show'), 2500);
}

function addToCart(btn) {
  const id       = btn.dataset.id;
  const nama     = btn.dataset.nama;
  const harga    = parseInt(btn.dataset.harga);
  const kategori = btn.dataset.kategori;
  const jenis    = btn.dataset.jenis;
  const foto     = btn.dataset.foto;
  const idx      = keranjang.findIndex(i => i.id === id);
  if (idx >= 0) {
    keranjang[idx].qty++;
  } else {
    keranjang.push({ id, nama, harga, kategori, jenis, foto, qty: 1 });
  }
  simpanKeranjang();
  renderKeranjang();
  showToast(nama + ' ditambahkan ke keranjang');
}

function renderKeranjang() {
  const container = document.getElementById('cartItems');
  const empty     = document.getElementById('cartEmpty');
  const footer    = document.getElementById('cartFooter');
  const badge     = document.getElementById('cartBadge');
  const totalEl   = document.getElementById('cartTotalVal');
  const countEl   = document.getElementById('cartItemCount');

  const totalQty = hitungTotalQty();
  badge.textContent = totalQty;
  badge.classList.toggle('visible', totalQty > 0);

  Array.from(container.children).forEach(c => { if (c !== empty) c.remove(); });

  if (keranjang.length === 0) {
    empty.style.display = 'flex';
    footer.style.display = 'none';
    return;
  }

  empty.style.display = 'none';
  footer.style.display = 'block';
  totalEl.textContent = fmt(hitungTotal());
  countEl.textContent = totalQty + ' pcs';

  keranjang.forEach((item, idx) => {
    const div = document.createElement('div');
    div.className = 'cart-item';
    div.innerHTML = `
      <img class="cart-item-img" src="${item.foto}" alt="${item.nama}" onerror="this.src='/images/default.png'">
      <div class="cart-item-info">
        <div class="cart-item-name">${item.nama}</div>
        <div class="cart-item-cat">${item.kategori} · ${item.jenis}</div>
        <div class="cart-item-controls">
          <button class="ci-btn" data-idx="${idx}" data-act="min">−</button>
          <input class="ci-qty" type="number" value="${item.qty}" readonly>
          <button class="ci-btn" data-idx="${idx}" data-act="plus">+</button>
        </div>
      </div>
      <div class="cart-item-price">
        <div class="cart-item-subtotal">${fmt(item.harga * item.qty)}</div>
        <button class="cart-item-remove" data-idx="${idx}">Hapus</button>
      </div>`;
    container.appendChild(div);
  });

  // Event qty
  container.querySelectorAll('.ci-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const i = parseInt(btn.dataset.idx);
      if (btn.dataset.act === 'plus') { keranjang[i].qty++; }
      else { keranjang[i].qty--; if (keranjang[i].qty <= 0) keranjang.splice(i, 1); }
      simpanKeranjang(); renderKeranjang();
    });
  });
  container.querySelectorAll('.cart-item-remove').forEach(btn => {
    btn.addEventListener('click', () => {
      keranjang.splice(parseInt(btn.dataset.idx), 1);
      simpanKeranjang(); renderKeranjang();
    });
  });
}

/* ── Buka / Tutup sidebar ── */
function openCart()  { document.getElementById('cartSidebar').classList.add('open'); document.getElementById('cartOverlay').classList.add('open'); }
function closeCart() { document.getElementById('cartSidebar').classList.remove('open'); document.getElementById('cartOverlay').classList.remove('open'); }

document.getElementById('cartBtn').addEventListener('click', openCart);
document.getElementById('cartClose').addEventListener('click', closeCart);
document.getElementById('cartOverlay').addEventListener('click', closeCart);
document.getElementById('btnClearCart').addEventListener('click', () => {
  if (confirm('Kosongkan semua keranjang?')) { keranjang = []; simpanKeranjang(); renderKeranjang(); }
});

/* ── Checkout ── */
function openModal() {
  const overlay  = document.getElementById('modalOverlay');
  const listEl   = document.getElementById('modalOrderList');
  const subtitle = document.getElementById('modalSubtitle');
  const totalEl  = document.getElementById('modalTotal');
  const tglInput = document.getElementById('tglInput');

  listEl.innerHTML = '';
  keranjang.forEach(item => {
    const row = document.createElement('div');
    row.className = 'modal-order-item';
    row.innerHTML = `
      <span class="item-name">${item.nama}</span>
      <span class="item-detail">${item.qty} × ${fmt(item.harga)}</span>
      <span class="item-subtotal">${fmt(item.harga * item.qty)}</span>`;
    listEl.appendChild(row);
  });

  const total = hitungTotal();
  totalEl.textContent = fmt(total);
  subtitle.textContent = hitungTotalQty() + ' produk dipilih';
  tglInput.value = new Date().toLocaleDateString('id-ID', { weekday:'long', year:'numeric', month:'long', day:'numeric' });

  overlay.classList.add('open');
  closeCart();
}
function closeModal() { document.getElementById('modalOverlay').classList.remove('open'); }

document.getElementById('btnCheckoutCart').addEventListener('click', openModal);
document.getElementById('btnKembali').addEventListener('click', closeModal);
document.getElementById('modalOverlay').addEventListener('click', e => { if (e.target === document.getElementById('modalOverlay')) closeModal(); });

/* ── Bayar ── */
document.getElementById('btnBayar').addEventListener('click', async () => {
  const nama   = document.getElementById('namaInput').value.trim();
  const wa     = document.getElementById('waInput').value.trim();
  const alamat = document.getElementById('alamatInput').value.trim();
  const cttn   = document.getElementById('cttnInput').value.trim();
  const tgl    = document.getElementById('tglInput').value;
  const total  = document.getElementById('modalTotal').textContent;
  const listEl = document.getElementById('modalOrderList');

  if (!nama || !wa || !alamat) { alert('Harap isi semua data terlebih dahulu!'); return; }

  let detailProduk = '';
  listEl.querySelectorAll('.modal-order-item').forEach(el => {
    const name  = el.querySelector('.item-name').textContent;
    const parts = el.textContent.replace(name, '').trim();
    detailProduk += `  - ${name} ${parts}\n`;
  });

  const itemsToSave = keranjang.map(i => ({ id_produk: i.id, qty: i.qty, harga: i.harga }));

  const btnBayar = document.getElementById('btnBayar');
  const oriText  = btnBayar.innerHTML;
  btnBayar.disabled = true;
  btnBayar.innerHTML = '<span>Menyimpan pesanan...</span>';

  let dbBerhasil = false;
  try {
    const fd = new FormData();
    fd.append('nama',        nama);
    fd.append('wa',          wa);
    fd.append('alamat',      alamat);
    fd.append('catatan',     cttn);
    fd.append('tanggal',     tgl);
    fd.append('total_harga', total);
    fd.append('items',       JSON.stringify(itemsToSave));
    fd.append('_token',      '{{ csrf_token() }}');

    const resp   = await fetch('{{ route("transaksi.simpan") }}', { method: 'POST', body: fd });
    let result   = {};
    try { result = await resp.json(); } catch(_) {}
    if (resp.ok && result.success) {
      dbBerhasil = true;
      keranjang  = [];
      simpanKeranjang();
      renderKeranjang();
    }
  } catch(err) { console.warn('Gagal simpan DB:', err.message); }

  btnBayar.disabled = false;
  btnBayar.innerHTML = oriText;

  const waNumber = '6285850524186';
  const pesan = encodeURIComponent(
    `Halo Temukan Kopi! 🌿\n\n*PESANAN BARU DARI WEBSITE*\n--------------------------\n` +
    `Nama     : ${nama}\nNo. WA   : ${wa}\nProduk   :\n${detailProduk}` +
    `Total    : ${total}\nAlamat   : ${alamat}\nCatatan  : ${cttn}\nTanggal  : ${tgl}\n` +
    `--------------------------\nMohon segera dikonfirmasi, terima kasih! ☕`
  );
  window.open(`https://wa.me/${waNumber}?text=${pesan}`, '_blank');
  closeModal();
});

/* ── Init ── */
renderKeranjang();
</script>

</body>
</html>