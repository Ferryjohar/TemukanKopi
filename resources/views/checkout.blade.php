<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Temukan Kopi — Produk</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
*, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

:root {
  --hijau:      #1f5e3b;
  --hijau-tua:  #143d27;
  --hijau-mid:  #2f7a52;
  --hijau-muda: #e1e7cf;
  --krem:       #f5f5f0;
  --krem2:      #f0ece4;
  --putih:      #ffffff;
  --teks:       #222;
  --teks-mid:   #555;
  --teks-soft:  #888;
  --shadow-lg:  0 24px 60px rgba(0,0,0,0.13);
  --radius:     14px;
}

html { scroll-behavior: smooth; }

body {
  font-family: 'Poppins', sans-serif;
  background: var(--krem) !important;
  color: var(--teks);
  overflow-x: hidden;
}

/* ══ NAVBAR ══ */
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 18px 100px;
  background: rgba(245,245,240,0.96) !important;
  backdrop-filter: blur(14px);
  -webkit-backdrop-filter: blur(14px);
  position: sticky;
  top: 0;
  z-index: 1000;
  border-bottom: 1px solid rgba(0,0,0,0.07);
}

.logo {
  font-family: 'Playfair Display', serif;
  font-weight: 700;
  font-size: 21px;
  color: var(--hijau-tua);
  letter-spacing: -.3px;
}

.nav-links { display: flex; gap: 0; align-items: center; }
.nav-links a {
  margin-left: 40px;
  text-decoration: none;
  color: var(--teks-mid);
  font-size: 13.5px; font-weight: 500;
  position: relative;
  transition: color .3s;
}
.nav-links a.active { color: var(--teks); font-weight: 600; }
.nav-links a.active::after {
  content: '';
  position: absolute;
  bottom: -4px; left: 0;
  width: 100%; height: 2px;
  background: var(--teks);
  border-radius: 2px;
}
.nav-links a:hover { color: var(--teks); }

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
  stroke: currentColor;
  fill: none;
  stroke-width: 1.8;
  stroke-linecap: round;
  stroke-linejoin: round;
}

.cart-badge {
  position: absolute;
  top: 0; right: 0;
  background: var(--hijau);
  color: #fff;
  font-size: 10px; font-weight: 700;
  width: 18px; height: 18px;
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  transform: translate(30%, -30%);
  opacity: 0;
  transition: opacity .2s, transform .2s;
  pointer-events: none;
}
.cart-badge.visible {
  opacity: 1;
  transform: translate(30%, -30%) scale(1);
}

/* ══ SIDEBAR KERANJANG ══ */
.cart-overlay {
  position: fixed; inset: 0;
  background: rgba(0,0,0,0.35);
  z-index: 800;
  opacity: 0;
  pointer-events: none;
  transition: opacity .3s;
}
.cart-overlay.open {
  opacity: 1;
  pointer-events: all;
}

.cart-sidebar {
  position: fixed;
  top: 0; right: 0;
  width: 380px;
  height: 100vh;
  background: var(--putih);
  z-index: 900;
  display: flex;
  flex-direction: column;
  transform: translateX(100%);
  transition: transform .35s cubic-bezier(.23,.88,.34,1.05);
  box-shadow: -8px 0 40px rgba(0,0,0,0.12);
}
.cart-sidebar.open {
  transform: translateX(0);
}

.cart-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 22px 24px 18px;
  border-bottom: 1px solid rgba(0,0,0,0.08);
}

.cart-header-title {
  font-family: 'Playfair Display', serif;
  font-size: 20px; font-weight: 900;
  color: var(--teks);
  letter-spacing: -.3px;
}

.cart-close {
  background: none; border: none;
  cursor: pointer;
  color: var(--teks-soft);
  padding: 4px;
  border-radius: 6px;
  display: flex; align-items: center; justify-content: center;
  transition: color .2s, background .2s;
}
.cart-close:hover {
  color: var(--teks);
  background: var(--krem);
}
.cart-close svg {
  width: 20px; height: 20px;
  stroke: currentColor; fill: none;
  stroke-width: 1.8; stroke-linecap: round;
}

.cart-items {
  flex: 1;
  overflow-y: auto;
  padding: 16px 24px;
}

/* scrollbar tipis */
.cart-items::-webkit-scrollbar { width: 4px; }
.cart-items::-webkit-scrollbar-track { background: transparent; }
.cart-items::-webkit-scrollbar-thumb { background: #ddd; border-radius: 2px; }

.cart-empty {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100%;
  gap: 12px;
  color: var(--teks-soft);
}
.cart-empty svg {
  width: 56px; height: 56px;
  stroke: var(--teks-soft); fill: none;
  stroke-width: 1.4; stroke-linecap: round;
  opacity: .5;
}
.cart-empty p { font-size: 14px; }

.cart-item {
  display: flex;
  gap: 14px;
  align-items: flex-start;
  padding: 14px 0;
  border-bottom: 1px solid rgba(0,0,0,0.06);
  animation: fadeUp .3s both;
}
.cart-item:last-child { border-bottom: none; }

.cart-item-img {
  width: 64px; height: 64px;
  border-radius: 8px;
  object-fit: cover;
  flex-shrink: 0;
  background: var(--krem);
}

.cart-item-info { flex: 1; min-width: 0; }
.cart-item-name {
  font-size: 13px; font-weight: 600;
  text-transform: uppercase; letter-spacing: .3px;
  color: var(--teks);
  margin-bottom: 3px;
  white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
}
.cart-item-cat {
  font-size: 11px; color: var(--teks-soft);
  margin-bottom: 8px;
}
.cart-item-controls {
  display: flex; align-items: center; gap: 0;
}
.ci-btn {
  width: 26px; height: 26px;
  border: 1px solid #ddd;
  background: var(--krem);
  border-radius: 5px;
  cursor: pointer;
  font-size: 14px; font-weight: 600;
  color: var(--teks);
  display: flex; align-items: center; justify-content: center;
  transition: all .2s;
}
.ci-btn:hover { background: var(--hijau); color: #fff; border-color: var(--hijau); }
.ci-qty {
  width: 32px; height: 26px;
  text-align: center; font-size: 13px; font-weight: 600;
  border: 1px solid #ddd; border-left: none; border-right: none;
  background: var(--putih); color: var(--teks);
  outline: none;
}

.cart-item-price {
  text-align: right;
  flex-shrink: 0;
}
.cart-item-subtotal {
  font-size: 13px; font-weight: 700; color: var(--teks);
  margin-bottom: 6px;
}
.cart-item-remove {
  background: none; border: none;
  cursor: pointer;
  color: var(--teks-soft);
  font-size: 11px; font-weight: 500;
  padding: 0;
  transition: color .2s;
}
.cart-item-remove:hover { color: #e74c3c; }

/* ══ CART FOOTER ══ */
.cart-footer {
  padding: 18px 24px 24px;
  border-top: 1px solid rgba(0,0,0,0.08);
  background: var(--putih);
}

.cart-summary-row {
  display: flex; justify-content: space-between;
  font-size: 13px; color: var(--teks-mid);
  margin-bottom: 6px;
}
.cart-total-row {
  display: flex; justify-content: space-between; align-items: center;
  margin: 14px 0;
  padding-top: 12px;
  border-top: 1px solid rgba(0,0,0,0.08);
}
.cart-total-label { font-size: 14px; font-weight: 600; color: var(--teks); }
.cart-total-val { font-size: 20px; font-weight: 800; color: var(--hijau); }

.btn-checkout-cart {
  width: 100%;
  background: var(--hijau);
  color: #fff; border: none;
  border-radius: 10px; padding: 14px;
  font-size: 14px; font-weight: 600;
  cursor: pointer;
  transition: all .3s;
  letter-spacing: .3px;
  display: flex; align-items: center; justify-content: center; gap: 8px;
}
.btn-checkout-cart:hover {
  background: var(--hijau-tua);
  transform: translateY(-2px);
  box-shadow: 0 8px 22px rgba(31,94,59,.3);
}
.btn-checkout-cart:disabled {
  background: #ccc; cursor: not-allowed;
  transform: none; box-shadow: none;
}

.btn-clear-cart {
  width: 100%;
  background: transparent;
  color: var(--teks-soft);
  border: none;
  padding: 10px;
  font-size: 13px; font-weight: 500;
  cursor: pointer;
  margin-top: 8px;
  transition: color .2s;
}
.btn-clear-cart:hover { color: #e74c3c; }

/* ══ PAGE WRAP ══ */
.page { padding: 52px 80px 80px; max-width: 1200px; margin: 0 auto; }

.sec-title {
  font-family: 'Playfair Display', serif;
  font-size: 38px; font-weight: 900;
  color: var(--teks);
  margin-bottom: 32px;
  letter-spacing: -.5px;
}

/* ══ CHECKOUT CARD ══ */
.checkout-card {
  display: grid;
  grid-template-columns: 240px 1fr auto;
  gap: 36px;
  background: var(--putih);
  border-radius: var(--radius);
  padding: 28px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.05);
  margin-bottom: 64px;
  align-items: start;
  animation: fadeUp .6s .1s both;
}

.checkout-img-wrap {
  position: relative;
  border-radius: 10px;
  overflow: hidden;
}
.checkout-img-wrap img {
  width: 100%; aspect-ratio: 4/5;
  object-fit: cover; display: block;
  border-radius: 10px;
}
.badge-new {
  position: absolute; top: 10px; left: 10px;
  background: #20c997; color: #fff;
  font-size: 10px; font-weight: 700;
  letter-spacing: 1px; text-transform: uppercase;
  padding: 4px 10px; border-radius: 50px;
}

.checkout-info { padding-top: 4px; }
.breadcrumb {
  font-size: 11px; font-weight: 600;
  letter-spacing: 1.5px; text-transform: uppercase;
  color: var(--teks-soft); margin-bottom: 10px;
}
.breadcrumb span { margin: 0 6px; }

.product-name {
  font-size: 28px; font-weight: 700;
  letter-spacing: .5px; text-transform: uppercase;
  color: var(--teks); margin-bottom: 6px;
}
.product-price-main {
  font-size: 15px; color: var(--teks-mid); margin-bottom: 22px;
}
.product-price-main strong { font-weight: 600; color: var(--teks); }

.desc-label { font-size: 13px; font-weight: 600; color: var(--teks); margin-bottom: 10px; }
.desc-text { font-size: 13.5px; color: var(--teks-mid); line-height: 1.85; max-width: 440px; }

/* order box */
.order-box {
  background: var(--krem);
  border: 1px solid rgba(0,0,0,.09);
  border-radius: 12px;
  padding: 24px 28px;
  min-width: 230px;
}
.order-box-title { font-size: 13px; font-weight: 600; color: var(--teks); margin-bottom: 18px; }
.qty-row {
  display: flex; align-items: center; gap: 0;
  margin-bottom: 14px;
}
.qty-btn {
  width: 32px; height: 32px;
  border: 1px solid #ccc; background: var(--putih);
  font-size: 16px; font-weight: 600; cursor: pointer;
  border-radius: 6px; transition: all .2s;
  display: flex; align-items: center; justify-content: center;
  color: var(--teks);
}
.qty-btn:hover { background: var(--hijau); color: #fff; border-color: var(--hijau); }
.qty-num {
  width: 44px; height: 32px;
  border: 1px solid #ccc; border-left: none; border-right: none;
  text-align: center; font-size: 14px; font-weight: 600;
  background: var(--putih); color: var(--teks); outline: none;
}
.stok-info { font-size: 12px; color: var(--teks-soft); margin-left: 12px; }

.subtotal-row {
  display: flex; justify-content: space-between; align-items: center;
  font-size: 13px; color: var(--teks-mid); margin-bottom: 16px;
  padding-top: 10px;
  border-top: 1px solid rgba(0,0,0,.08);
}
.subtotal-row strong { color: var(--teks); font-weight: 700; font-size: 14px; }

/* ── Tombol di order box ── */
.btn-beli {
  width: 100%;
  background: var(--hijau); color: #fff;
  border: none; border-radius: 8px; padding: 12px;
  font-size: 13px; font-weight: 600; cursor: pointer;
  transition: all .3s; letter-spacing: .3px;
  margin-bottom: 10px;
}
.btn-beli:hover {
  background: var(--hijau-tua);
  box-shadow: 0 8px 22px rgba(31,94,59,.3);
  transform: translateY(-2px);
}

.btn-keranjang {
  width: 100%;
  background: transparent;
  color: var(--hijau);
  border: 1.5px solid var(--hijau);
  border-radius: 8px; padding: 11px;
  font-size: 13px; font-weight: 600; cursor: pointer;
  transition: all .3s;
  display: flex; align-items: center; justify-content: center; gap: 7px;
}
.btn-keranjang svg {
  width: 16px; height: 16px;
  stroke: currentColor; fill: none;
  stroke-width: 2; stroke-linecap: round;
}
.btn-keranjang:hover {
  background: rgba(31,94,59,.07);
}
.btn-keranjang.added {
  background: var(--hijau-muda);
  border-color: var(--hijau);
  color: var(--hijau-tua);
}

/* ══ PRODUCT SECTION ══ */
.product-header {
  display: flex; justify-content: space-between; align-items: flex-end;
  margin-bottom: 28px;
}
.product-header .sec-title { margin-bottom: 0; }

.prod-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 22px;
}

.prod-card {
  background: var(--putih);
  border-radius: 14px;
  overflow: hidden;
  box-shadow: 0 2px 14px rgba(0,0,0,.06);
  cursor: pointer;
  transition: transform .35s cubic-bezier(.23,.88,.34,1.05), box-shadow .35s;
  animation: fadeUp .5s both;
  text-decoration: none; color: inherit; display: block;
  position: relative;
}
.prod-card:nth-child(1) { animation-delay:.05s }
.prod-card:nth-child(2) { animation-delay:.12s }
.prod-card:nth-child(3) { animation-delay:.19s }
.prod-card:nth-child(4) { animation-delay:.26s }
.prod-card:nth-child(5) { animation-delay:.33s }
.prod-card:nth-child(6) { animation-delay:.40s }
.prod-card:nth-child(7) { animation-delay:.47s }
.prod-card:nth-child(8) { animation-delay:.54s }
.prod-card:hover { transform: translateY(-8px); box-shadow: 0 18px 42px rgba(0,0,0,.11); }

.prod-img-wrap { position: relative; overflow: hidden; }
.prod-img-wrap img {
  width: 100%; aspect-ratio: 4/3.5;
  object-fit: cover; display: block;
  transition: transform .5s ease;
}
.prod-card:hover .prod-img-wrap img { transform: scale(1.06); }

.prod-badge {
  position: absolute; top: 10px; left: 10px;
  background: #20c997; color: #fff;
  font-size: 9.5px; font-weight: 700;
  letter-spacing: 1px; text-transform: uppercase;
  padding: 3px 10px; border-radius: 50px;
}

/* Tombol tambah di card produk */
.card-add-btn {
  position: absolute;
  top: 10px; right: 10px;
  width: 30px; height: 30px;
  background: var(--putih);
  border: none;
  border-radius: 50%;
  cursor: pointer;
  display: flex; align-items: center; justify-content: center;
  box-shadow: 0 2px 8px rgba(0,0,0,.15);
  transition: all .25s;
  z-index: 2;
}
.card-add-btn svg {
  width: 14px; height: 14px;
  stroke: var(--hijau); fill: none;
  stroke-width: 2.2; stroke-linecap: round;
}
.card-add-btn:hover {
  background: var(--hijau);
  transform: scale(1.1);
}
.card-add-btn:hover svg { stroke: #fff; }
.card-add-btn.in-cart {
  background: var(--hijau);
}
.card-add-btn.in-cart svg { stroke: #fff; }

.prod-body { padding: 14px 16px 18px; }
.prod-cat {
  font-size: 10.5px; font-weight: 600;
  letter-spacing: 1.5px; text-transform: uppercase;
  color: var(--teks-soft); margin-bottom: 5px;
}
.prod-cat span { margin: 0 5px; opacity: .5; }
.prod-name {
  font-size: 14px; font-weight: 700;
  text-transform: uppercase; color: var(--teks);
  margin-bottom: 7px; letter-spacing: .3px;
}
.prod-pricing { display: flex; align-items: center; gap: 8px; flex-wrap: wrap; }
.prod-price { font-size: 13px; color: var(--teks); font-weight: 500; }
.prod-price-unit { font-size: 12px; color: var(--teks-soft); }

/* ══ MODAL PEMESANAN ══ */
.modal-overlay {
  position: fixed; inset: 0;
  background: rgba(0,0,0,.45);
  backdrop-filter: blur(5px);
  z-index: 1100;
  display: flex; align-items: center; justify-content: center;
  opacity: 0; pointer-events: none;
  transition: opacity .3s;
}
.modal-overlay.open { opacity: 1; pointer-events: all; }

.modal {
  background: var(--putih);
  border-radius: 20px;
  padding: 44px 44px 36px;
  width: 100%; max-width: 560px;
  box-shadow: 0 28px 80px rgba(0,0,0,.22);
  transform: translateY(28px) scale(.97);
  transition: transform .35s cubic-bezier(.23,.88,.34,1.05), opacity .3s;
  opacity: 0;
  max-height: 92vh; overflow-y: auto;
}
.modal-overlay.open .modal { transform: translateY(0) scale(1); opacity: 1; }

.modal-title {
  font-family: 'Playfair Display', serif;
  font-size: 26px; font-weight: 900;
  color: var(--teks); margin-bottom: 8px;
}
.modal-subtitle { font-size: 13px; color: var(--teks-soft); margin-bottom: 28px; }

/* Ringkasan pesanan di modal */
.modal-order-list {
  background: var(--krem);
  border-radius: 10px;
  padding: 14px 16px;
  margin-bottom: 20px;
  max-height: 180px; overflow-y: auto;
}
.modal-order-item {
  display: flex; justify-content: space-between;
  font-size: 13px; color: var(--teks-mid);
  padding: 5px 0;
  border-bottom: 1px solid rgba(0,0,0,0.06);
}
.modal-order-item:last-child { border-bottom: none; }
.modal-order-item .item-name { font-weight: 600; color: var(--teks); }

.form-group { margin-bottom: 18px; }
.form-group label { display: block; font-size: 13px; font-weight: 600; color: var(--teks); margin-bottom: 8px; }
.form-group input, .form-group textarea {
  width: 100%;
  border: 1.5px solid #ddd; border-radius: 10px;
  padding: 12px 16px;
  font-size: 14px; font-family: 'Poppins', sans-serif;
  color: var(--teks); background: var(--putih);
  outline: none;
  transition: border-color .25s, box-shadow .25s;
  resize: none;
}
.form-group input:focus, .form-group textarea:focus {
  border-color: var(--hijau);
  box-shadow: 0 0 0 3px rgba(31,94,59,.1);
}
.form-group textarea { height: 100px; }
.form-group input::placeholder, .form-group textarea::placeholder { color: #bbb; }

.total-box {
  display: flex; justify-content: space-between; align-items: center;
  border: 1.5px solid #ddd; border-radius: 10px;
  padding: 14px 20px; margin-bottom: 18px;
}
.total-label { font-size: 14px; color: var(--teks-mid); font-weight: 500; }
.total-value { font-size: 22px; font-weight: 800; color: var(--teks); }

.btn-bayar {
  width: 100%;
  background: var(--hijau); color: #fff; border: none;
  border-radius: 10px; padding: 16px;
  font-size: 15px; font-weight: 600; cursor: pointer;
  margin-bottom: 12px; letter-spacing: .3px;
  transition: all .3s;
  display: flex; align-items: center; justify-content: center; gap: 8px;
}
.btn-bayar:hover { background: var(--hijau-tua); transform: translateY(-2px); box-shadow: 0 10px 28px rgba(31,94,59,.3); }
.btn-kembali {
  width: 100%;
  background: transparent; color: var(--hijau);
  border: 1.5px solid var(--hijau);
  border-radius: 10px; padding: 14px;
  font-size: 14px; font-weight: 600; cursor: pointer;
  transition: all .3s;
}
.btn-kembali:hover { background: rgba(31,94,59,.06); }

/* ══ TOAST NOTIFIKASI ══ */
.toast {
  position: fixed;
  bottom: 32px; right: 32px;
  background: var(--hijau-tua);
  color: #fff;
  padding: 14px 20px;
  border-radius: 12px;
  font-size: 14px; font-weight: 500;
  z-index: 2000;
  display: flex; align-items: center; gap: 10px;
  box-shadow: 0 8px 30px rgba(0,0,0,.2);
  transform: translateY(20px);
  opacity: 0;
  transition: all .3s cubic-bezier(.23,.88,.34,1.05);
  pointer-events: none;
}
.toast.show { transform: translateY(0); opacity: 1; }
.toast svg {
  width: 18px; height: 18px;
  stroke: #fff; fill: none;
  stroke-width: 2.2; stroke-linecap: round; stroke-linejoin: round;
  flex-shrink: 0;
}

/* ══ ACTIVE CARD ══ */
.active-card { outline: 2px solid var(--hijau); outline-offset: -2px; }
.active-card .prod-name { color: var(--hijau); }

/* ══ ANIMATIONS ══ */
@keyframes fadeUp {
  from { opacity: 0; transform: translateY(30px); }
  to   { opacity: 1; transform: translateY(0); }
}

/* ══ RESPONSIVE ══ */
@media (max-width: 1024px) {
  .navbar, .page { padding-left: 32px; padding-right: 32px; }
  .checkout-card { grid-template-columns: 200px 1fr; }
  .order-box { grid-column: 1/-1; }
  .prod-grid { grid-template-columns: repeat(2,1fr); }
  .cart-sidebar { width: 100%; max-width: 380px; }
}
</style>
</head>
<body>
@php
    $id_target = request('id_produk');
    $item = $produk->firstWhere('id_produk', $id_target) ?? $produk->first();
@endphp

<!-- NAVBAR -->
<nav class="navbar">
  <div class="logo">temukan kopi.</div>
  <div class="nav-links">
    <a href="{{ route('welcome') }}">Home</a>
    <a href="{{ route('welcome') }}#about">About me</a>
    <a href="{{ route('welcome') }}#Produk" class="active">Produk</a>
    <a href="{{ route('welcome') }}#contact">Kontak</a>
    <a href="{{ route('welcome') }}#galeri">Galery</a>

    <!-- TOMBOL KERANJANG -->
    <button class="cart-btn" id="cartToggle" title="Keranjang Belanja">
      <svg viewBox="0 0 24 24">
        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
        <line x1="3" y1="6" x2="21" y2="6"/>
        <path d="M16 10a4 4 0 0 1-8 0"/>
      </svg>
      <span class="cart-badge" id="cartBadge">0</span>
    </button>
  </div>
</nav>

<!-- ══ SIDEBAR KERANJANG ══ -->
<div class="cart-overlay" id="cartOverlay"></div>
<aside class="cart-sidebar" id="cartSidebar">
  <div class="cart-header">
    <div class="cart-header-title">Keranjang Belanja</div>
    <button class="cart-close" id="cartClose">
      <svg viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>
  </div>

  <div class="cart-items" id="cartItems">
    <div class="cart-empty" id="cartEmpty">
      <svg viewBox="0 0 24 24">
        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/>
        <line x1="3" y1="6" x2="21" y2="6"/>
        <path d="M16 10a4 4 0 0 1-8 0"/>
      </svg>
      <p>Keranjang masih kosong</p>
    </div>
  </div>

  <div class="cart-footer" id="cartFooter" style="display:none;">
    <div class="cart-summary-row">
      <span>Jumlah item</span>
      <span id="cartItemCount">0 pcs</span>
    </div>
    <div class="cart-total-row">
      <span class="cart-total-label">Total Harga</span>
      <span class="cart-total-val" id="cartTotalVal">Rp 0</span>
    </div>
    <button class="btn-checkout-cart" id="btnCheckoutCart">
      <svg width="16" height="16" viewBox="0 0 24 24" style="stroke:#fff;fill:none;stroke-width:2;stroke-linecap:round;">
        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.18h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 9a16 16 0 0 0 6 6l1.18-1.18a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
      </svg>
      Pesan via WhatsApp
    </button>
    <button class="btn-clear-cart" id="btnClearCart">Kosongkan keranjang</button>
  </div>
</aside>

<!-- ══ PAGE ══ -->
<div class="page">

  <h2 class="sec-title">Checkout</h2>

  <div class="checkout-card">
    @php
        $id_target = request('id_produk');
        $item = $produk->firstWhere('id_produk', $id_target) ?? $produk->first();
    @endphp

    <div class="checkout-img-wrap">
      <span class="badge-new">{{ $item->nama_kategori == 'Mentah' ? 'RAW BEANS' : 'PREMIUM' }}</span>
      <img src="{{ $item->foto_produk ? asset('storage/produk/' . $item->foto_produk) : asset('images/default.png') }}"
           alt="{{ $item->nama_produk }}"
           onerror="this.src='{{ asset('images/default.png') }}'">
    </div>

    <div class="checkout-info">
      <div class="breadcrumb">{{ $item->nama_kategori }} <span>|</span> {{ $item->nama_jenis }}</div>
      <div class="product-name">{{ $item->nama_produk }}</div>
      <div class="product-price-main"><strong>Rp {{ number_format($item->harga_produk, 0, ',', '.') }}</strong> / pcs</div>
      <div class="desc-label">Deskripsi Produk</div>
      <p class="desc-text">{{ $item->deskripsi_produk ?? 'Biji kopi pilihan terbaik dari petani lokal Indonesia, diproses dengan standar kualitas tinggi untuk menghasilkan cita rasa yang autentik.' }}</p>
    </div>

    <div class="order-box">
      <div class="order-box-title">Atur jumlah dan catatan</div>
      <div class="qty-row">
        <button class="qty-btn" id="minus">−</button>
        <input class="qty-num" id="qty" type="number" value="1" readonly>
        <button class="qty-btn" id="plus">+</button>
        <span class="stok-info">Status: <strong style="color: #2ecc71;">Tersedia</strong></span>
      </div>

      <div class="subtotal-row">
        <span>Subtotal</span>
        <strong id="subtotalVal">Rp {{ number_format($item->harga_produk, 0, ',', '.') }}</strong>
      </div>

      @if($item->status_produk == 'tersedia')
        <button id="btnBeli" class="btn-beli">Beli Sekarang</button>
        <button id="btnKeranjang" class="btn-keranjang">
          <svg viewBox="0 0 24 24"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
          Tambah ke Keranjang
        </button>
      @else
        <button disabled style="background:#ccc;cursor:not-allowed;width:100%;padding:14px;border-radius:8px;border:none;font-size:13px;font-weight:600;">
          Stok Habis
        </button>
      @endif
    </div>
  </div>

  <!-- PRODUCT GRID -->
  <div class="product-header">
    <h2 class="sec-title">Product</h2>
  </div>

  <div class="prod-grid">
    @foreach($produk as $p)
    <a class="prod-card {{ request('id_produk') == $p->id_produk ? 'active-card' : '' }}"
       href="{{ url('/checkout?id_produk='.$p->id_produk) }}">
      <div class="prod-img-wrap">
        <span class="prod-badge">PREMIUM</span>
        <img src="{{ $p->foto_produk ? asset('storage/produk/'.$p->foto_produk) : asset('images/default.png') }}"
             alt="{{ $p->nama_produk }}"
             onerror="this.src='{{ asset('images/default.png') }}'">

        <!-- Tombol tambah ke keranjang -->
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

      <div class="prod-body">
        <div class="prod-cat">{{ $p->nama_kategori }} <span>|</span> {{ $p->nama_jenis }}</div>
        <div class="prod-name">{{ strtoupper($p->nama_produk) }}</div>
        <div class="prod-pricing">
          <span class="prod-price">Rp {{ number_format($p->harga_produk, 0, ',', '.') }}</span>
          <span class="prod-price-unit">/ pcs</span>
        </div>
      </div>
    </a>
    @endforeach
  </div>

</div><!-- /page -->

<!-- ══ MODAL PEMESANAN ══ -->
<div class="modal-overlay" id="modalOverlay">
  <div class="modal" id="modalBox">
    <div class="modal-title">Form Pemesanan</div>
    <div class="modal-subtitle" id="modalSubtitle">1 produk dipilih</div>

    <!-- Ringkasan pesanan -->
    <div class="modal-order-list" id="modalOrderList"></div>

    <div class="form-group">
      <label>Nama Customer:</label>
      <input type="text" id="namaInput" placeholder="Masukan Nama Anda">
    </div>
    <div class="form-group">
      <label>No. Whatsapp :</label>
      <input type="tel" id="waInput" placeholder="Contoh : 0887642561">
    </div>
    <div class="form-group">
      <label>Alamat Lengkap:</label>
      <textarea id="alamatInput" placeholder="Jalan, RT/RW, Kec./&#10;Kota, Kodepos"></textarea>
    </div>
    <div class="form-group">
      <label>Tanggal Pesan:</label>
      <input type="text" id="tglInput" readonly>
    </div>

    <div class="total-box">
      <span class="total-label">Total Harga</span>
      <span class="total-value" id="modalTotal">Rp 0</span>
    </div>

    <button class="btn-bayar" id="btnBayar">
      <span>Bayar Sekarang</span>
    </button>
    <button class="btn-kembali" id="btnKembali">Kembali</button>
  </div>
</div>

<!-- ══ TOAST ══ -->
<div class="toast" id="toast">
  <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
  <span id="toastMsg">Produk ditambahkan</span>
</div>

<script>
/* ══════════════════════════════════
   STATE PRODUK AKTIF (dari Laravel)
══════════════════════════════════ */
const produkAktif = {
  id: "{{ $item->id_produk }}",
  nama: "{{ $item->nama_produk }}",
  harga: {{ $item->harga_produk }},
  kategori: "{{ $item->nama_kategori }}",
  jenis: "{{ $item->nama_jenis }}",
  foto: "{{ $item->foto_produk ? asset('storage/produk/' . $item->foto_produk) : asset('images/default.png') }}"
};

/* ══════════════════════════════════
   KERANJANG STATE
══════════════════════════════════ */
let keranjang = JSON.parse(localStorage.getItem('keranjangKopi') || '[]');

function simpanKeranjang() {
  localStorage.setItem('keranjangKopi', JSON.stringify(keranjang));
}

function fmt(n) {
  return 'Rp ' + n.toLocaleString('id-ID');
}

function hitungTotal() {
  return keranjang.reduce((sum, item) => sum + (item.harga * item.qty), 0);
}

function hitungTotalQty() {
  return keranjang.reduce((sum, item) => sum + item.qty, 0);
}

/* ══════════════════════════════════
   RENDER KERANJANG
══════════════════════════════════ */
function renderKeranjang() {
  const container = document.getElementById('cartItems');
  const empty     = document.getElementById('cartEmpty');
  const footer    = document.getElementById('cartFooter');
  const badge     = document.getElementById('cartBadge');
  const totalEl   = document.getElementById('cartTotalVal');
  const countEl   = document.getElementById('cartItemCount');

  // Badge
  const totalQty = hitungTotalQty();
  badge.textContent = totalQty;
  badge.classList.toggle('visible', totalQty > 0);

  if (keranjang.length === 0) {
    empty.style.display = 'flex';
    footer.style.display = 'none';
    // hapus semua item kecuali empty
    Array.from(container.children).forEach(c => { if (c !== empty) c.remove(); });
    updateCardButtons();
    return;
  }

  empty.style.display = 'none';
  footer.style.display = 'block';
  totalEl.textContent = fmt(hitungTotal());
  countEl.textContent = totalQty + ' pcs';

  // Clear lalu rebuild item
  Array.from(container.children).forEach(c => { if (c !== empty) c.remove(); });

  keranjang.forEach((item, idx) => {
    const div = document.createElement('div');
    div.className = 'cart-item';
    div.dataset.idx = idx;
    div.innerHTML = `
      <img class="cart-item-img" src="${item.foto}" alt="${item.nama}" onerror="this.src='{{ asset('images/default.png') }}'">
      <div class="cart-item-info">
        <div class="cart-item-name">${item.nama}</div>
        <div class="cart-item-cat">${item.kategori} | ${item.jenis}</div>
        <div class="cart-item-controls">
          <button class="ci-btn" onclick="ubahQtyKeranjang(${idx}, -1)">−</button>
          <input class="ci-qty" type="number" value="${item.qty}" readonly>
          <button class="ci-btn" onclick="ubahQtyKeranjang(${idx}, 1)">+</button>
        </div>
      </div>
      <div class="cart-item-price">
        <div class="cart-item-subtotal">${fmt(item.harga * item.qty)}</div>
        <button class="cart-item-remove" onclick="hapusItem(${idx})">Hapus</button>
      </div>
    `;
    container.appendChild(div);
  });

  updateCardButtons();
}

function updateCardButtons() {
  const idsInCart = keranjang.map(i => String(i.id));
  document.querySelectorAll('.card-add-btn').forEach(btn => {
    const inCart = idsInCart.includes(String(btn.dataset.id));
    btn.classList.toggle('in-cart', inCart);
    btn.innerHTML = inCart
      ? `<svg viewBox="0 0 24 24" style="width:14px;height:14px;stroke:#fff;fill:none;stroke-width:2.5;stroke-linecap:round;stroke-linejoin:round"><polyline points="20 6 9 17 4 12"/></svg>`
      : `<svg viewBox="0 0 24 24" style="width:14px;height:14px;stroke:var(--hijau);fill:none;stroke-width:2.2;stroke-linecap:round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>`;
  });

  // Tombol keranjang di order box
  const btnK = document.getElementById('btnKeranjang');
  if (btnK) {
    const ada = idsInCart.includes(String(produkAktif.id));
    btnK.classList.toggle('added', ada);
    btnK.innerHTML = ada
      ? `<svg viewBox="0 0 24 24" style="width:16px;height:16px;stroke:var(--hijau-tua);fill:none;stroke-width:2.2;stroke-linecap:round;stroke-linejoin:round"><polyline points="20 6 9 17 4 12"/></svg> Ada di Keranjang`
      : `<svg viewBox="0 0 24 24" style="width:16px;height:16px;stroke:currentColor;fill:none;stroke-width:2;stroke-linecap:round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg> Tambah ke Keranjang`;
  }
}

/* ══════════════════════════════════
   AKSI KERANJANG
══════════════════════════════════ */
function addToCart(el) {
  const id      = el.dataset.id;
  const nama    = el.dataset.nama;
  const harga   = parseInt(el.dataset.harga);
  const kategori= el.dataset.kategori;
  const jenis   = el.dataset.jenis;
  const foto    = el.dataset.foto;

  const idx = keranjang.findIndex(i => String(i.id) === String(id));
  if (idx >= 0) {
    keranjang[idx].qty++;
  } else {
    keranjang.push({ id, nama, harga, kategori, jenis, foto, qty: 1 });
  }
  simpanKeranjang();
  renderKeranjang();
  showToast('Ditambahkan ke keranjang!');
}

function addProdukAktifToCart() {
  const qty = parseInt(document.getElementById('qty').value) || 1;
  const idx = keranjang.findIndex(i => String(i.id) === String(produkAktif.id));
  if (idx >= 0) {
    keranjang[idx].qty += qty;
  } else {
    keranjang.push({ ...produkAktif, qty });
  }
  simpanKeranjang();
  renderKeranjang();
  showToast(`${produkAktif.nama} x${qty} ditambahkan!`);
}

function ubahQtyKeranjang(idx, delta) {
  keranjang[idx].qty += delta;
  if (keranjang[idx].qty <= 0) keranjang.splice(idx, 1);
  simpanKeranjang();
  renderKeranjang();
}

function hapusItem(idx) {
  const nama = keranjang[idx].nama;
  keranjang.splice(idx, 1);
  simpanKeranjang();
  renderKeranjang();
  showToast(`${nama} dihapus dari keranjang`);
}

/* ══════════════════════════════════
   QTY CONTROL (produk aktif)
══════════════════════════════════ */
let qty = 1;
const stokAktif = 999;
const qtyEl = document.getElementById('qty');
const subtotalEl = document.getElementById('subtotalVal');

function updateSubtotal() {
  subtotalEl.textContent = fmt(produkAktif.harga * qty);
}

document.getElementById('minus').addEventListener('click', () => {
  if (qty > 1) { qty--; qtyEl.value = qty; updateSubtotal(); }
});
document.getElementById('plus').addEventListener('click', () => {
  if (qty < stokAktif) { qty++; qtyEl.value = qty; updateSubtotal(); }
});

/* ══════════════════════════════════
   SIDEBAR TOGGLE
══════════════════════════════════ */
function openCart() {
  document.getElementById('cartSidebar').classList.add('open');
  document.getElementById('cartOverlay').classList.add('open');
  document.body.style.overflow = 'hidden';
}
function closeCart() {
  document.getElementById('cartSidebar').classList.remove('open');
  document.getElementById('cartOverlay').classList.remove('open');
  document.body.style.overflow = '';
}

document.getElementById('cartToggle').addEventListener('click', openCart);
document.getElementById('cartClose').addEventListener('click', closeCart);
document.getElementById('cartOverlay').addEventListener('click', closeCart);
document.getElementById('btnClearCart').addEventListener('click', () => {
  if (confirm('Kosongkan semua keranjang?')) {
    keranjang = [];
    simpanKeranjang();
    renderKeranjang();
  }
});

/* ══════════════════════════════════
   TOMBOL TAMBAH KERANJANG (order box)
══════════════════════════════════ */
const btnK = document.getElementById('btnKeranjang');
if (btnK) {
  btnK.addEventListener('click', addProdukAktifToCart);
}

/* ══════════════════════════════════
   MODAL — buka dari order box
══════════════════════════════════ */
function formatDate(d) {
  return String(d.getDate()).padStart(2,'0') + '/' +
         String(d.getMonth()+1).padStart(2,'0') + '/' +
         d.getFullYear();
}
document.getElementById('tglInput').value = formatDate(new Date());

// Beli sekarang → modal dengan produk aktif saja
document.getElementById('btnBeli').addEventListener('click', () => {
  const total = produkAktif.harga * qty;
  // Isi ringkasan modal
  const list = document.getElementById('modalOrderList');
  list.innerHTML = `
    <div class="modal-order-item">
      <span><span class="item-name">${produkAktif.nama}</span> x${qty}</span>
      <span>${fmt(total)}</span>
    </div>
  `;
  document.getElementById('modalSubtitle').textContent = '1 produk dipilih';
  document.getElementById('modalTotal').textContent = fmt(total);
  document.getElementById('modalOverlay').classList.add('open');
  document.body.style.overflow = 'hidden';
});

// Checkout dari keranjang → modal dengan semua item keranjang
document.getElementById('btnCheckoutCart').addEventListener('click', () => {
  if (keranjang.length === 0) return;
  const total = hitungTotal();
  const list  = document.getElementById('modalOrderList');
  list.innerHTML = keranjang.map(i => `
    <div class="modal-order-item">
      <span><span class="item-name">${i.nama}</span> x${i.qty}</span>
      <span>${fmt(i.harga * i.qty)}</span>
    </div>
  `).join('');
  document.getElementById('modalSubtitle').textContent = hitungTotalQty() + ' produk dipilih';
  document.getElementById('modalTotal').textContent = fmt(total);
  document.getElementById('modalOverlay').classList.add('open');
  document.body.style.overflow = 'hidden';
  closeCart();
});

document.getElementById('btnKembali').addEventListener('click', closeModal);
document.getElementById('modalOverlay').addEventListener('click', (e) => {
  if (e.target === document.getElementById('modalOverlay')) closeModal();
});
function closeModal() {
  document.getElementById('modalOverlay').classList.remove('open');
  document.body.style.overflow = '';
}

/* ══════════════════════════════════
   BAYAR VIA WHATSAPP
══════════════════════════════════ */
document.getElementById('btnBayar').addEventListener('click', () => {
  const nama   = document.getElementById('namaInput').value.trim();
  const wa     = document.getElementById('waInput').value.trim();
  const alamat = document.getElementById('alamatInput').value.trim();
  const tgl    = document.getElementById('tglInput').value;
  const total  = document.getElementById('modalTotal').textContent;
  const listEl = document.getElementById('modalOrderList');

  if (!nama || !wa || !alamat) {
    alert('Harap isi semua data terlebih dahulu!');
    return;
  }

  // Buat daftar produk untuk WA
  let detailProduk = '';
  const items = listEl.querySelectorAll('.modal-order-item');
  items.forEach(el => {
    const name  = el.querySelector('.item-name').textContent;
    const parts = el.textContent.replace(name, '').trim();
    detailProduk += `  - ${name} ${parts}\n`;
  });

  const waNumber = '6285850524186';
  const pesan = encodeURIComponent(
    `Halo Temukan Kopi! 🌿\n\n` +
    `*PESANAN BARU DARI WEBSITE*\n` +
    `--------------------------\n` +
    `Nama     : ${nama}\n` +
    `No. WA   : ${wa}\n` +
    `Produk   :\n${detailProduk}` +
    `Total    : ${total}\n` +
    `Alamat   : ${alamat}\n` +
    `Tanggal  : ${tgl}\n` +
    `--------------------------\n` +
    `Mohon segera dikonfirmasi, terima kasih! ☕`
  );

  window.open(`https://wa.me/${waNumber}?text=${pesan}`, '_blank');
});

/* ══════════════════════════════════
   TOAST
══════════════════════════════════ */
let toastTimer;
function showToast(msg) {
  const toast = document.getElementById('toast');
  document.getElementById('toastMsg').textContent = msg;
  toast.classList.add('show');
  clearTimeout(toastTimer);
  toastTimer = setTimeout(() => toast.classList.remove('show'), 2800);
}

/* ══════════════════════════════════
   INIT
══════════════════════════════════ */
renderKeranjang();
updateSubtotal();
</script>
</body>
</html>