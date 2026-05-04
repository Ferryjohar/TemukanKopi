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





/* ══ PAGE WRAP ══ */
.page { padding: 52px 80px 80px; max-width: 1200px; margin: 0 auto; }

.sec-title {
  font-family: 'Playfair Display', serif;
  font-size: 38px; font-weight: 900;
  color: var(--teks);
  margin-bottom: 32px;
  letter-spacing: -.5px;
}

/* ══ CHECKOUT LIST WRAPPER ══ */
.checkout-wrapper {
  background: var(--putih);
  border-radius: var(--radius);
  box-shadow: 0 10px 30px rgba(0,0,0,0.06);
  margin-bottom: 64px;
  overflow: hidden;
  animation: fadeUp .6s .1s both;
}

/* ══ CHECKOUT ROW (per produk) ══ */
.checkout-row {
  display: grid;
  grid-template-columns: 90px 1fr auto;
  gap: 20px;
  align-items: center;
  padding: 20px 28px;
  border-bottom: 1px solid rgba(0,0,0,0.07);
  transition: background .2s;
  animation: fadeUp .4s both;
}
.checkout-row:last-child { border-bottom: none; }
.checkout-row:hover { background: rgba(0,0,0,0.01); }

.checkout-row-img {
  width: 90px; height: 90px;
  border-radius: 10px;
  object-fit: cover;
  flex-shrink: 0;
  background: var(--krem);
}

.checkout-row-info { flex: 1; min-width: 0; }
.checkout-row-cat {
  font-size: 10.5px; font-weight: 600;
  letter-spacing: 1.5px; text-transform: uppercase;
  color: var(--teks-soft); margin-bottom: 4px;
}
.checkout-row-cat span { margin: 0 5px; opacity: .5; }
.checkout-row-name {
  font-size: 16px; font-weight: 700;
  text-transform: uppercase; letter-spacing: .4px;
  color: var(--teks); margin-bottom: 4px;
}
.checkout-row-price {
  font-size: 13px; color: var(--teks-mid);
}
.checkout-row-price strong { color: var(--teks); font-weight: 600; }

/* ── Qty & subtotal kanan ── */
.checkout-row-right {
  display: flex; flex-direction: column;
  align-items: flex-end; gap: 10px;
  min-width: 160px;
}
.checkout-qty-row {
  display: flex; align-items: center;
}
.qty-btn {
  width: 30px; height: 30px;
  border: 1px solid #ccc; background: var(--putih);
  font-size: 16px; font-weight: 600; cursor: pointer;
  border-radius: 6px; transition: all .2s;
  display: flex; align-items: center; justify-content: center;
  color: var(--teks);
}
.qty-btn:hover { background: var(--hijau); color: #fff; border-color: var(--hijau); }
.qty-num {
  width: 40px; height: 30px;
  border: 1px solid #ccc; border-left: none; border-right: none;
  text-align: center; font-size: 13px; font-weight: 600;
  background: var(--putih); color: var(--teks); outline: none;
}
.checkout-subtotal-label {
  font-size: 11px; color: var(--teks-soft);
}
.checkout-subtotal-val {
  font-size: 15px; font-weight: 700; color: var(--teks);
}
.checkout-row-remove {
  background: none; border: none; cursor: pointer;
  color: var(--teks-soft); font-size: 11px; font-weight: 500;
  transition: color .2s; padding: 0;
}
.checkout-row-remove:hover { color: #e74c3c; }

/* ══ CHECKOUT FOOTER BAR ══ */
.checkout-footer-bar {
  display: flex; justify-content: space-between; align-items: center;
  padding: 20px 28px;
  background: var(--krem);
  border-top: 1px solid rgba(0,0,0,0.09);
}
.checkout-total-wrap {}
.checkout-total-label { font-size: 12px; color: var(--teks-soft); margin-bottom: 2px; }
.checkout-total-val { font-size: 22px; font-weight: 800; color: var(--hijau); }

.checkout-footer-actions { display: flex; align-items: center; gap: 12px; }

.btn-beli {
  background: var(--hijau); color: #fff;
  border: none; border-radius: 8px; padding: 12px 22px;
  font-size: 13px; font-weight: 600; cursor: pointer;
  transition: all .3s; letter-spacing: .3px;
  display: flex; align-items: center; gap: 7px;
  white-space: nowrap;
}
.btn-beli:hover {
  background: var(--hijau-tua);
  box-shadow: 0 8px 22px rgba(31,94,59,.3);
  transform: translateY(-2px);
}

/* Toast konfirmasi ditambahkan (muncul di pojok) */
.checkout-empty-hint {
  padding: 48px 28px;
  text-align: center;
  color: var(--teks-soft);
  font-size: 14px;
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
  background: #1f5e3b; color: #fff;
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
  .checkout-row { grid-template-columns: 70px 1fr auto; padding: 16px 20px; }
  .prod-grid { grid-template-columns: repeat(2,1fr); }
  .cart-sidebar { width: 100%; max-width: 380px; }
  .checkout-footer-bar { flex-direction: column; gap: 14px; align-items: flex-start; }
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


  </div>
</nav>



<!-- ══ PAGE ══ -->
<div class="page">

  <h2 class="sec-title">Checkout</h2>

  {{-- ══ CHECKOUT LIST MULTI-PRODUK ══ --}}
  <div class="checkout-wrapper" id="checkoutWrapper">

    {{-- List produk yang dipilih (diisi via JS) --}}
    <div id="checkoutList">
      {{-- Produk pertama dari URL param --}}
      @php
          $id_target = request('id_produk');
          $item = $produk->firstWhere('id_produk', $id_target) ?? $produk->first();
      @endphp
      <div class="checkout-row"
           data-id="{{ $item->id_produk }}"
           data-harga="{{ $item->harga_produk }}">
        <img class="checkout-row-img"
             src="{{ $item->foto_produk ? asset('storage/produk/' . $item->foto_produk) : asset('images/default.png') }}"
             alt="{{ $item->nama_produk }}"
             onerror="this.src='{{ asset('images/default.png') }}'">
        <div class="checkout-row-info">
          <div class="checkout-row-cat">{{ $item->nama_kategori }} <span>|</span> {{ $item->nama_jenis }}</div>
          <div class="checkout-row-name">{{ $item->nama_produk }}</div>
          <div class="checkout-row-price"><strong>Rp {{ number_format($item->harga_produk, 0, ',', '.') }}</strong> / pcs</div>
        </div>
        <div class="checkout-row-right">
          <div class="checkout-qty-row">
            <button class="qty-btn" onclick="changeQtyRow(this, -1)">−</button>
            <input class="qty-num" type="number" value="1" readonly>
            <button class="qty-btn" onclick="changeQtyRow(this, 1)">+</button>
          </div>
          <div>
            <div class="checkout-subtotal-label">Subtotal</div>
            <div class="checkout-subtotal-val">Rp {{ number_format($item->harga_produk, 0, ',', '.') }}</div>
          </div>
          <button class="checkout-row-remove" onclick="hapusCheckoutRow(this)">Hapus</button>
        </div>
      </div>
    </div>

    {{-- Footer total + tombol pesan --}}
    <div class="checkout-footer-bar">
      <div class="checkout-total-wrap">
        <div class="checkout-total-label">Total Keseluruhan</div>
        <div class="checkout-total-val" id="checkoutGrandTotal">Rp {{ number_format($item->harga_produk, 0, ',', '.') }}</div>
      </div>
      <div class="checkout-footer-actions">
        <button class="btn-beli" id="btnBeli">
          <svg width="16" height="16" viewBox="0 0 24 24" style="stroke:#fff;fill:none;stroke-width:2;stroke-linecap:round;stroke-linejoin:round">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 1.18h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 9a16 16 0 0 0 6 6l1.18-1.18a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
          </svg>
          Pesan Sekarang via WA
        </button>
      </div>
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

        <!-- Tombol tambah ke checkout -->
        <button class="card-add-btn"
                data-id="{{ $p->id_produk }}"
                data-nama="{{ $p->nama_produk }}"
                data-harga="{{ $p->harga_produk }}"
                data-kategori="{{ $p->nama_kategori }}"
                data-jenis="{{ $p->nama_jenis }}"
                data-foto="{{ $p->foto_produk ? asset('storage/produk/'.$p->foto_produk) : asset('images/default.png') }}"
                title="Tambahkan ke checkout"
                onclick="event.preventDefault(); addToCheckout(this)">
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
      <label>Catatan Tambahan:</label>
      <textarea id="cttnInput" placeholder="Tambahkan Catatan tertentu"></textarea>
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
const produkAktifAwal = {
  id:       "{{ $item->id_produk }}",
  nama:     "{{ $item->nama_produk }}",
  harga:    {{ $item->harga_produk }},
  kategori: "{{ $item->nama_kategori }}",
  jenis:    "{{ $item->nama_jenis }}",
  foto:     "{{ $item->foto_produk ? asset('storage/produk/' . $item->foto_produk) : asset('images/default.png') }}"
};

/* ══════════════════════════════════
   CHECKOUT LIST STATE
   Daftar produk yang muncul di bagian Checkout atas
══════════════════════════════════ */
// Inisialisasi dengan produk pertama dari URL
let checkoutList = [
  { ...produkAktifAwal, qty: 1 }
];

function fmt(n) {
  return 'Rp ' + n.toLocaleString('id-ID');
}

/* ── Hitung total checkout ── */
function hitungCheckoutTotal() {
  return checkoutList.reduce((sum, i) => sum + i.harga * i.qty, 0);
}

/* ── Render ulang checkout list ── */
function renderCheckoutList() {
  const container = document.getElementById('checkoutList');
  const totalEl   = document.getElementById('checkoutGrandTotal');

  container.innerHTML = '';

  if (checkoutList.length === 0) {
    container.innerHTML = `<div class="checkout-empty-hint">
      Belum ada produk dipilih. Klik tombol <strong>+</strong> pada produk di bawah untuk menambahkan.
    </div>`;
  } else {
    checkoutList.forEach((item, idx) => {
      const div = document.createElement('div');
      div.className = 'checkout-row';
      div.dataset.idx = idx;
      div.innerHTML = `
        <img class="checkout-row-img" src="${item.foto}" alt="${item.nama}"
             onerror="this.src='{{ asset('images/default.png') }}'">
        <div class="checkout-row-info">
          <div class="checkout-row-cat">${item.kategori} <span>|</span> ${item.jenis}</div>
          <div class="checkout-row-name">${item.nama}</div>
          <div class="checkout-row-price"><strong>${fmt(item.harga)}</strong> / pcs</div>
        </div>
        <div class="checkout-row-right">
          <div class="checkout-qty-row">
            <button class="qty-btn" onclick="changeQtyIdx(${idx}, -1)">−</button>
            <input class="qty-num" type="number" value="${item.qty}" readonly>
            <button class="qty-btn" onclick="changeQtyIdx(${idx}, 1)">+</button>
          </div>
          <div>
            <div class="checkout-subtotal-label">Subtotal</div>
            <div class="checkout-subtotal-val">${fmt(item.harga * item.qty)}</div>
          </div>
          <button class="checkout-row-remove" onclick="hapusCheckoutIdx(${idx})">Hapus</button>
        </div>
      `;
      container.appendChild(div);
    });
  }

  totalEl.textContent = fmt(hitungCheckoutTotal());
  updateCardButtons();
}

/* ── Tambah / naikkan qty produk ke checkout list ── */
function addToCheckout(el) {
  const id      = el.dataset.id;
  const nama    = el.dataset.nama;
  const harga   = parseInt(el.dataset.harga);
  const kategori= el.dataset.kategori;
  const jenis   = el.dataset.jenis;
  const foto    = el.dataset.foto;

  const idx = checkoutList.findIndex(i => String(i.id) === String(id));
  if (idx >= 0) {
    checkoutList[idx].qty++;
    showToast(`${nama} qty ditambahkan (${checkoutList[idx].qty})`);
  } else {
    checkoutList.push({ id, nama, harga, kategori, jenis, foto, qty: 1 });
    showToast(`${nama} ditambahkan ke checkout!`);
  }
  renderCheckoutList();
  // Scroll ke checkout list
  document.getElementById('checkoutWrapper').scrollIntoView({ behavior: 'smooth', block: 'start' });
}

/* ── Ubah qty di baris checkout ── */
function changeQtyIdx(idx, delta) {
  checkoutList[idx].qty += delta;
  if (checkoutList[idx].qty <= 0) {
    const nama = checkoutList[idx].nama;
    checkoutList.splice(idx, 1);
    showToast(`${nama} dihapus`);
  }
  renderCheckoutList();
}

/* ── Hapus baris checkout ── */
function hapusCheckoutIdx(idx) {
  const nama = checkoutList[idx].nama;
  checkoutList.splice(idx, 1);
  renderCheckoutList();
  showToast(`${nama} dihapus`);
}

/* Fungsi lama dari template (dipertahankan untuk referensi tombol lama) */
function changeQtyRow(btn, delta) {
  const row  = btn.closest('.checkout-row');
  const idx  = Array.from(document.getElementById('checkoutList').children).indexOf(row);
  changeQtyIdx(idx, delta);
}
function hapusCheckoutRow(btn) {
  const row = btn.closest('.checkout-row');
  const idx = Array.from(document.getElementById('checkoutList').children).indexOf(row);
  hapusCheckoutIdx(idx);
}

/* ── Update tampilan tombol + di card produk ── */
function updateCardButtons() {
  const idsInCheckout = checkoutList.map(i => String(i.id));
  document.querySelectorAll('.card-add-btn').forEach(btn => {
    const ada = idsInCheckout.includes(String(btn.dataset.id));
    btn.classList.toggle('in-cart', ada);
    btn.innerHTML = ada
      ? `<svg viewBox="0 0 24 24" style="width:14px;height:14px;stroke:#fff;fill:none;stroke-width:2.5;stroke-linecap:round;stroke-linejoin:round"><polyline points="20 6 9 17 4 12"/></svg>`
      : `<svg viewBox="0 0 24 24" style="width:14px;height:14px;stroke:var(--hijau);fill:none;stroke-width:2.2;stroke-linecap:round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>`;
  });
}

/* ══════════════════════════════════
   TOMBOL PESAN SEKARANG
══════════════════════════════════ */
function formatDate(d) {
  return String(d.getDate()).padStart(2,'0') + '/' +
         String(d.getMonth()+1).padStart(2,'0') + '/' +
         d.getFullYear();
}

document.getElementById('tglInput').value = formatDate(new Date());

document.getElementById('btnBeli').addEventListener('click', () => {
  if (checkoutList.length === 0) {
    showToast('Belum ada produk dipilih!');
    return;
  }
  const total = hitungCheckoutTotal();
  const list  = document.getElementById('modalOrderList');
  list.innerHTML = checkoutList.map(i => `
    <div class="modal-order-item">
      <span><span class="item-name">${i.nama}</span> x${i.qty}</span>
      <span>${fmt(i.harga * i.qty)}</span>
    </div>
  `).join('');
  document.getElementById('modalSubtitle').textContent = checkoutList.length + ' produk dipilih';
  document.getElementById('modalTotal').textContent = fmt(total);
  document.getElementById('modalOverlay').classList.add('open');
  document.body.style.overflow = 'hidden';
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
   BAYAR VIA WHATSAPP + SIMPAN DB
══════════════════════════════════ */
document.getElementById('btnBayar').addEventListener('click', async () => {
  const nama   = document.getElementById('namaInput').value.trim();
  const wa     = document.getElementById('waInput').value.trim();
  const alamat = document.getElementById('alamatInput').value.trim();
  const cttn   = document.getElementById('cttnInput').value.trim();
  const tgl    = document.getElementById('tglInput').value;
  const total  = document.getElementById('modalTotal').textContent;
  const listEl = document.getElementById('modalOrderList');

  if (!nama || !wa || !alamat) {
    alert('Harap isi semua data terlebih dahulu!');
    return;
  }

  let detailProduk = '';
  const items = listEl.querySelectorAll('.modal-order-item');
  items.forEach(el => {
    const name  = el.querySelector('.item-name').textContent;
    const parts = el.textContent.replace(name, '').trim();
    detailProduk += `  - ${name} ${parts}\n`;
  });

  // Gunakan checkoutList atau keranjang (tergantung modal mana yang dibuka)
  let itemsToSave = checkoutList.map(i => ({
    id_produk: i.id,
    qty:       i.qty,
    harga:     i.harga,
  }));

  const btnBayar = document.getElementById('btnBayar');
  const originalText = btnBayar.innerHTML;
  btnBayar.disabled = true;
  btnBayar.innerHTML = '<span>Menyimpan pesanan...</span>';

  try {
    const formData = new FormData();
    formData.append('nama',        nama);
    formData.append('wa',          wa);
    formData.append('alamat',      alamat);
    formData.append('catatan',     cttn);
    formData.append('tanggal',     tgl);
    formData.append('total_harga', total);
    formData.append('items',       JSON.stringify(itemsToSave));
    formData.append('_token',      '{{ csrf_token() }}');

    const resp = await fetch('{{ route("transaksi.simpan") }}', {
      method: 'POST',
      body:   formData,
    });
    let result = {};
    try { result = await resp.json(); } catch(_) {}
    if (resp.ok && result.success) {
      checkoutList = [];
      renderCheckoutList();
    }
  } catch (err) {
    console.warn('DB error:', err);
  }

  btnBayar.disabled = false;
  btnBayar.innerHTML = originalText;

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
    `Catatan  : ${cttn}\n` +
    `Tanggal  : ${tgl}\n` +
    `--------------------------\n` +
    `Mohon segera dikonfirmasi, terima kasih! ☕`
  );
  window.open(`https://wa.me/${waNumber}?text=${pesan}`, '_blank');
  closeModal();
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
renderCheckoutList();
</script>
</body>
</html>