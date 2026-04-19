<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Temukan Kopi — Produk</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
/* ════════════════════════════════════
   RESET & ROOT (Sama persis dengan Welcome)
════════════════════════════════════ */
*, *::before, *::after {
  margin: 0; padding: 0; box-sizing: border-box;
}

:root {
  --hijau:      #1f5e3b;
  --hijau-tua:  #143d27;
  --hijau-mid:  #2f7a52;
  --hijau-muda: #e1e7cf;
  --krem:       #f5f5f0; /* Kunci sinkronisasi ada di sini */
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
  background: var(--krem) !important; /* Gunakan !important agar tidak ditimpa */
  color: var(--teks);
  overflow-x: hidden;
}

/* ════════════════════════════════════
   NAVBAR (Sama persis dengan Welcome)
════════════════════════════════════ */
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 18px 100px;
  background: rgba(245,245,240,0.96) !important; /* Warna krem transparan khas Welcome */
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
.nav-links { display: flex; gap: 0; }
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

/* ══ SECTION TITLE ══ */
.sec-title {
  font-family: 'Playfair Display', serif;
  font-size: 38px; font-weight: 900;
  color: var(--teks);
  margin-bottom: 32px;
  letter-spacing: -.5px;
}

/* ══ CHECKOUT TOP CARD ══ */
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
  background: #20c997;
  color: #fff;
  font-size: 10px; font-weight: 700;
  letter-spacing: 1px; text-transform: uppercase;
  padding: 4px 10px; border-radius: 50px;
}

.checkout-info { padding-top: 4px; }
.breadcrumb {
  font-size: 11px; font-weight: 600;
  letter-spacing: 1.5px; text-transform: uppercase;
  color: var(--teks-soft);
  margin-bottom: 10px;
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

.desc-label {
  font-size: 13px; font-weight: 600; color: var(--teks);
  margin-bottom: 10px;
}
.desc-text {
  font-size: 13.5px; color: var(--teks-mid);
  line-height: 1.85; max-width: 440px;
}

/* order box */
.order-box {
  background: var(--krem);
  border: 1px solid rgba(0,0,0,.09);
  border-radius: 12px;
  padding: 24px 28px;
  min-width: 230px;
}
.order-box-title {
  font-size: 13px; font-weight: 600; color: var(--teks);
  margin-bottom: 18px;
}
.qty-row {
  display: flex; align-items: center; gap: 0;
  margin-bottom: 14px;
}
.qty-btn {
  width: 32px; height: 32px;
  border: 1px solid #ccc;
  background: var(--putih);
  font-size: 16px; font-weight: 600;
  cursor: pointer;
  border-radius: 6px;
  transition: all .2s;
  display: flex; align-items: center; justify-content: center;
  color: var(--teks);
}
.qty-btn:hover { background: var(--hijau); color: #fff; border-color: var(--hijau); }
.qty-num {
  width: 44px; height: 32px;
  border: 1px solid #ccc; border-left: none; border-right: none;
  text-align: center; font-size: 14px; font-weight: 600;
  background: var(--putih); color: var(--teks);
  outline: none;
}
.stok-info {
  font-size: 12px; color: var(--teks-soft); margin-left: 12px;
}
.subtotal-row {
  display: flex; justify-content: space-between; align-items: center;
  font-size: 13px; color: var(--teks-mid); margin-bottom: 22px;
  padding-top: 10px;
  border-top: 1px solid rgba(0,0,0,.08);
}
.subtotal-row strong { color: var(--teks); font-weight: 700; font-size: 14px; }

.btn-beli {
  width: 100%;
  background: var(--hijau);
  color: #fff;
  border: none;
  border-radius: 8px;
  padding: 14px;
  font-size: 14px; font-weight: 600;
  cursor: pointer;
  transition: all .3s;
  letter-spacing: .3px;
}
.btn-beli:hover {
  background: var(--hijau-tua);
  box-shadow: 0 8px 22px rgba(31,94,59,.3);
  transform: translateY(-2px);
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
}
.prod-card:nth-child(1) { animation-delay:.05s }
.prod-card:nth-child(2) { animation-delay:.12s }
.prod-card:nth-child(3) { animation-delay:.19s }
.prod-card:nth-child(4) { animation-delay:.26s }
.prod-card:nth-child(5) { animation-delay:.33s }
.prod-card:nth-child(6) { animation-delay:.40s }
.prod-card:nth-child(7) { animation-delay:.47s }
.prod-card:nth-child(8) { animation-delay:.54s }

.prod-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 18px 42px rgba(0,0,0,.11);
}

.prod-img-wrap { position: relative; overflow: hidden; }
.prod-img-wrap img {
  width: 100%;
  aspect-ratio: 4/3.5;
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
.prod-price-old {
  font-size: 12px; color: var(--teks-soft);
  text-decoration: line-through;
}
.prod-discount {
  background: #ff5252;
  color: #fff;
  font-size: 10px; font-weight: 700;
  padding: 2px 7px; border-radius: 4px;
}

/* ══ MODAL ══ */
.modal-overlay {
  position: fixed; inset: 0;
  background: rgba(0,0,0,.45);
  backdrop-filter: blur(5px);
  z-index: 500;
  display: flex; align-items: center; justify-content: center;
  opacity: 0; pointer-events: none;
  transition: opacity .3s;
}
.modal-overlay.open {
  opacity: 1; pointer-events: all;
}

.modal {
  background: var(--putih);
  border-radius: 20px;
  padding: 44px 44px 36px;
  width: 100%; max-width: 540px;
  box-shadow: 0 28px 80px rgba(0,0,0,.22);
  transform: translateY(28px) scale(.97);
  transition: transform .35s cubic-bezier(.23,.88,.34,1.05), opacity .3s;
  opacity: 0;
  max-height: 92vh; overflow-y: auto;
}
.modal-overlay.open .modal {
  transform: translateY(0) scale(1);
  opacity: 1;
}

.modal-title {
  font-family: 'Playfair Display', serif;
  font-size: 26px; font-weight: 900;
  color: var(--teks); margin-bottom: 30px;
  letter-spacing: -.3px;
}

.form-group { margin-bottom: 20px; }
.form-group label {
  display: block;
  font-size: 13px; font-weight: 600; color: var(--teks);
  margin-bottom: 8px;
}
.form-group input,
.form-group textarea {
  width: 100%;
  border: 1.5px solid #ddd;
  border-radius: 10px;
  padding: 12px 16px;
  font-size: 14px; font-family: 'Poppins', sans-serif;
  color: var(--teks); background: var(--putih);
  outline: none;
  transition: border-color .25s, box-shadow .25s;
  resize: none;
}
.form-group input:focus,
.form-group textarea:focus {
  border-color: var(--hijau);
  box-shadow: 0 0 0 3px rgba(31,94,59,.1);
}
.form-group textarea { height: 110px; }
.form-group input::placeholder,
.form-group textarea::placeholder { color: #bbb; }

.total-box {
  display: flex; justify-content: space-between; align-items: center;
  border: 1.5px solid #ddd;
  border-radius: 10px; padding: 16px 20px;
  margin-bottom: 20px;
}
.total-label { font-size: 14px; color: var(--teks-mid); font-weight: 500; }
.total-value { font-size: 20px; font-weight: 800; color: var(--teks); }

.btn-bayar {
  width: 100%;
  background: var(--hijau);
  color: #fff; border: none;
  border-radius: 10px; padding: 16px;
  font-size: 15px; font-weight: 600;
  cursor: pointer; margin-bottom: 12px;
  letter-spacing: .3px;
  transition: all .3s;
  display: flex; align-items: center; justify-content: center; gap: 8px;
}
.btn-bayar:hover {
  background: var(--hijau-tua);
  transform: translateY(-2px);
  box-shadow: 0 10px 28px rgba(31,94,59,.3);
}

.btn-kembali {
  width: 100%;
  background: transparent;
  color: var(--hijau); border: 1.5px solid var(--hijau);
  border-radius: 10px; padding: 14px;
  font-size: 14px; font-weight: 600;
  cursor: pointer;
  transition: all .3s;
}
.btn-kembali:hover {
  background: rgba(31,94,59,.06);
}

/* ══ ANIMATIONS ══ */
@keyframes fadeUp {
  from { opacity: 0; transform: translateY(30px); }
  to   { opacity: 1; transform: translateY(0); }
}

a.prod-card { text-decoration: none; color: inherit; display: block; }
.active-card { outline: 2px solid var(--hijau); outline-offset: -2px; }
.active-card .prod-name { color: var(--hijau); }

/* ══ RESPONSIVE ══ */
@media (max-width: 1024px) {
  .navbar, .page { padding-left: 32px; padding-right: 32px; }
  .checkout-card { grid-template-columns: 200px 1fr; }
  .order-box { grid-column: 1/-1; }
  .prod-grid { grid-template-columns: repeat(2,1fr); }
}
</style>
</head>
<body>
@php
    // Mencari produk berdasarkan ID dari URL, jika tidak ada ambil yang pertama
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

<div class="page">

  <!-- ══ CHECKOUT DETAIL ══ -->
  <h2 class="sec-title">Chekout</h2>

  <div class="checkout-card">
    @php
        // Mengambil data produk berdasarkan ID dari URL
        $id_target = request('id_produk');
        $item = $produk->firstWhere('id_produk', $id_target) ?? $produk->first();
    @endphp

    <div class="checkout-img-wrap">
    {{-- Kita ganti logika LIMITED menjadi badge status atau kategori --}}
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
        <p class="desc-text">
            {{ $item->deskripsi_produk ?? 'Biji kopi pilihan terbaik dari petani lokal Indonesia, diproses dengan standar kualitas tinggi untuk menghasilkan cita rasa yang autentik.' }}
        </p>
    </div>

    <div class="order-box">
    <div class="order-box-title">Atur jumlah dan catatan</div>
    <div class="qty-row">
        <button class="qty-btn" id="minus">−</button>
        <input class="qty-num" id="qty" type="number" value="1" readonly>
        <button class="qty-btn" id="plus">+</button>
        <span class="stok-info">Status: <strong style="color: #2ecc71;">Tersedia</strong></span>
    </div>

    <div style="margin-top: 20px;">
        @if($item->status_produk == 'tersedia')
            <button id="btnBeli" class="btn-checkout" style="display: block; width: 100%; background: #1f5e3b; color: white; padding: 15px; border-radius: 10px; border: none; font-weight: bold; cursor: pointer;">
                Beli Sekarang
            </button>
        @else
            <button class="btn-checkout" disabled style="background: #ccc; cursor: not-allowed; width: 100%; padding: 15px; border-radius: 10px; border: none;">
                Stok Habis
            </button>
        @endif
    </div>
</div>
</div>

  <!-- ══ PRODUCT GRID ══ -->
  <div class="product-header">
    <h2 class="sec-title">Product</h2>
  </div>

  <div class="prod-grid">
    @foreach($produk as $p)
    <a class="prod-card {{ request('id_produk') == $p->id_produk ? 'active-card' : '' }}" 
       href="{{ url('/checkout?id_produk='.$p->id_produk) }}">
        
        <div class="prod-img-wrap">
          <span class="prod-badge">PREMIUM</span>
            
            {{-- Gambar dari storage --}}
            <img src="{{ $p->foto_produk ? asset('storage/produk/'.$p->foto_produk) : asset('images/default.png') }}" 
              alt="{{ $p->nama_produk }}"
              onerror="this.src='{{ asset('images/default.png') }}'">
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
</div><!-- /prod-grid -->

</div><!-- /page -->


<!-- ══ MODAL PEMESANAN ══ -->
<div class="modal-overlay" id="modalOverlay">
  <div class="modal" id="modalBox">
    <div class="modal-title">Form Pemesanan</div>

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
      <span class="total-value" id="modalTotal">Rp.60.000</span>
    </div>

    <button class="btn-bayar" id="btnBayar">
      <span>+Bayar Sekarang</span>
    </button>
    <button class="btn-kembali" id="btnKembali">Kembali</button>
  </div>
</div>


<script>
/* ════════════════════════════════
   STATE & DATA DARI LARAVEL
   Variabel ini mengambil data langsung dari PHP ($item)
════════════════════════════════ */
const hargaSatuan = {{ $item->harga_produk }};
const namaAktif   = "{{ $item->nama_produk }}";
// Kita ganti stokAktif menjadi angka besar (misal 999) agar tombol plus tidak terkunci
const stokAktif   = 999;
let qty = 1;

// Element Selector
const qtyEl      = document.getElementById('qty');
const subtotalEl = document.getElementById('subtotalVal');
const modalTotal = document.getElementById('modalTotal');

/* ════════════════════════════════
   HELPER FUNCTIONS
════════════════════════════════ */
function fmt(n) {
    return 'Rp ' + n.toLocaleString('id-ID');
}

function updateSubtotal() {
    const total = hargaSatuan * qty;
    subtotalEl.textContent = fmt(total);
    modalTotal.textContent = fmt(total);
}

/* ════════════════════════════════
   QTY CONTROL
════════════════════════════════ */
document.getElementById('minus').addEventListener('click', () => {
    if (qty > 1) { 
        qty--; 
        qtyEl.value = qty; 
        updateSubtotal(); 
    }
});

document.getElementById('plus').addEventListener('click', () => {
    if (qty < stokAktif) { 
        qty++; 
        qtyEl.value = qty; 
        updateSubtotal(); 
    }
});

/* ════════════════════════════════
   TANGGAL OTOMATIS
════════════════════════════════ */
function formatDate(d) {
    const dd   = String(d.getDate()).padStart(2,'0');
    const mm   = String(d.getMonth()+1).padStart(2,'0');
    const yyyy = d.getFullYear();
    return `${dd}/${mm}/${yyyy}`;
}
document.getElementById('tglInput').value = formatDate(new Date());

/* ════════════════════════════════
   MODAL CONTROL
════════════════════════════════ */
document.getElementById('btnBeli').addEventListener('click', () => {
    modalTotal.textContent = fmt(hargaSatuan * qty);
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

/* ════════════════════════════════
   BAYAR VIA WHATSAPP
════════════════════════════════ */
document.getElementById('btnBayar').addEventListener('click', () => {
    const nama   = document.getElementById('namaInput').value.trim();
    const wa     = document.getElementById('waInput').value.trim();
    const alamat = document.getElementById('alamatInput').value.trim();
    const tgl    = document.getElementById('tglInput').value;
    const total  = modalTotal.textContent;

    if (!nama || !wa || !alamat) {
        alert('Harap isi semua data terlebih dahulu!');
        return;
    }

    const waNumber = '6285850524186'; // Ganti dengan nomor WA Admin Toko
    const pesan = encodeURIComponent(
        `Halo Temukan Kopi! 🌿\n\n` +
        `*PESANAN BARU DARI WEBSITE*\n` +
        `--------------------------\n` +
        `Nama     : ${nama}\n` +
        `No. WA   : ${wa}\n` +
        `Produk   : ${namaAktif}\n` +
        `Jumlah   : ${qty} pcs\n` +
        `Total    : ${total}\n` +
        `Alamat   : ${alamat}\n` +
        `Tanggal  : ${tgl}\n` +
        `--------------------------\n` +
        `Mohon segera dikonfirmasi, terima kasih! ☕`
    );

    window.open(`https://wa.me/${waNumber}?text=${pesan}`, '_blank');
});
</script>

</body>
</html>