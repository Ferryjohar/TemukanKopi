<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Temukan Kopi — Produk</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
/* ══ ROOT ══ */
:root {
  --hijau:     #1f5e3b;
  --hijau-tua: #143d27;
  --hijau-mid: #2d7a52;
  --krem:      #f2ede6;
  --krem2:     #ede8e0;
  --putih:     #ffffff;
  --teks:      #1a1a1a;
  --teks-mid:  #555;
  --teks-soft: #999;
  --radius:    12px;
  --shadow:    0 4px 24px rgba(0,0,0,0.08);
  --shadow-lg: 0 16px 48px rgba(0,0,0,0.14);
}
*, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
html { scroll-behavior: smooth; }
body {
  font-family: 'Poppins', sans-serif;
  background: var(--krem);
  color: var(--teks);
  min-height: 100vh;
}

/* ══ NAVBAR ══ */
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 18px 80px;
  background: rgba(242,237,230,0.96);
  backdrop-filter: blur(12px);
  position: sticky; top: 0; z-index: 100;
  border-bottom: 1px solid rgba(0,0,0,0.07);
}
.logo {
  font-family: 'Playfair Display', serif;
  font-size: 20px; font-weight: 700;
  color: var(--teks);
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
  border-radius: 16px;
  padding: 28px;
  box-shadow: var(--shadow);
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

<!-- NAVBAR -->
<nav class="navbar">
  <div class="logo">temukan kopi.</div>
  <div class="nav-links">
    <a href="temukan_kopi_v2.html">Home</a>
    <a href="temukan_kopi_v2.html">About me</a>
    <a href="#" class="active">Produk</a>
    <a href="temukan_kopi_v2.html#contact">Kontak</a>
    <a href="temukan_kopi_v2.html#galeri">Galery</a>
  </div>
</nav>

<div class="page">

  <!-- ══ CHECKOUT DETAIL ══ -->
  <h2 class="sec-title">Chekout</h2>

  <div class="checkout-card">
    <!-- Gambar produk -->
    <div class="checkout-img-wrap">
      <span class="badge-new">NEW</span>
      <img src="images/produk.jpg" alt="Arabika">
    </div>

    <!-- Info produk -->
    <div class="checkout-info">
      <div class="breadcrumb">COFFE <span>|</span> BUBUK KOPI</div>
      <div class="product-name">ARABIKA</div>
      <div class="product-price-main"><strong>Rp.60.000</strong> / gram</div>

      <div class="desc-label">Deskripsi Produk</div>
      <p class="desc-text">
        Temukan Kopi lahir dari keyakinan bahwa setiap biji kopi memiliki cerita
        dan cita rasa yang layak untuk dinikmati. Kami hadir sebagai platform
        yang menghadirkan kopi terbaik dari berbagai daerah Indonesia.
      </p>
    </div>

    <!-- Order box -->
    <div class="order-box">
      <div class="order-box-title">Atur jumlah dan catatan</div>
      <div class="qty-row">
        <button class="qty-btn" id="minus">−</button>
        <input class="qty-num" id="qty" type="number" value="1" min="1" max="23" readonly>
        <button class="qty-btn" id="plus">+</button>
        <span class="stok-info">Stok Total : <strong id="stokVal">23</strong></span>
      </div>
      <div class="subtotal-row">
        <span>Subtotal</span>
        <strong id="subtotalVal">Rp.60.000</strong>
      </div>
      <button class="btn-beli" id="btnBeli">Beli</button>
    </div>
  </div>

  <!-- ══ PRODUCT GRID ══ -->
  <div class="product-header">
    <h2 class="sec-title">Product</h2>
  </div>

  <div class="prod-grid" id="prodGrid">
    <!-- diisi otomatis oleh JavaScript -->
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
   DATA PRODUK — tambah / edit di sini
════════════════════════════════ */
const PRODUK_DATA = [
  { nama:'Arabica',  harga:60000, satuan:'250gr', stok:23, badge:'NEW', img:'images/kopi.png', diskon:null },
  { nama:'Robusta',  harga:55000, satuan:'250gr', stok:18, badge:'NEW', img:'images/kopi.png', diskon:null },
  { nama:'Liberica', harga:65000, satuan:'250gr', stok:15, badge:'NEW', img:'images/kopi.png', diskon:null },
  { nama:'Toraja',   harga:70000, satuan:'250gr', stok:20, badge:'NEW', img:'images/kopi.png', diskon:null },
  { nama:'Arabica',  harga:60000, satuan:'250gr', stok:23, badge:'NEW', img:'images/kopi.png', diskon:null },
  { nama:'Robusta',  harga:55000, satuan:'250gr', stok:18, badge:'NEW', img:'images/kopi.png', diskon:null },
  { nama:'Liberica', harga:65000, satuan:'250gr', stok:15, badge:'NEW', img:'images/kopi.png', diskon:30  },
  { nama:'Toraja',   harga:70000, satuan:'250gr', stok:20, badge:'NEW', img:'images/kopi.png', diskon:null },
];

/* ════════════════════════════════
   STATE
════════════════════════════════ */
let hargaSatuan = 60000;
let namaAktif   = 'ARABIKA';
let stokAktif   = 23;
let qty = 1;

const qtyEl      = document.getElementById('qty');
const subtotalEl = document.getElementById('subtotalVal');
const modalTotal = document.getElementById('modalTotal');

/* ════════════════════════════════
   BACA URL PARAMS (dari index.html)
════════════════════════════════ */
function getParam(key) {
  return new URLSearchParams(window.location.search).get(key);
}

function fmt(n) {
  return 'Rp.' + n.toLocaleString('id-ID');
}

function updateSubtotal() {
  subtotalEl.textContent = fmt(hargaSatuan * qty);
  modalTotal.textContent = fmt(hargaSatuan * qty);
}

function loadProductFromURL() {
  const nama   = getParam('nama')  || 'ARABIKA';
  const harga  = parseInt(getParam('harga') || '60000');
  const satuan = getParam('satuan') || '250gr';
  const img    = getParam('img')   || 'images/kopi.png';
  const stok   = parseInt(getParam('stok') || '23');
  const badge  = getParam('badge') || 'NEW';

  namaAktif   = nama.toUpperCase();
  hargaSatuan = harga;
  stokAktif   = stok;
  qty = 1;

  /* update checkout card */
  document.querySelector('.checkout-img-wrap img').src = img;
  document.querySelector('.badge-new').textContent = badge;
  document.querySelector('.product-name').textContent = namaAktif;
  document.querySelector('.product-price-main').innerHTML =
    `<strong>${fmt(harga)}</strong> / ${satuan}`;
  document.getElementById('stokVal').textContent = stok;
  document.getElementById('qty').max = stok;
  qtyEl.value = 1;
  updateSubtotal();
}

/* jalankan saat halaman load */
loadProductFromURL();

/* ════════════════════════════════
   RENDER PRODUCT GRID DARI DATA
════════════════════════════════ */
function buildProductGrid() {
  const grid = document.getElementById('prodGrid');
  grid.innerHTML = '';

  PRODUK_DATA.forEach((p, i) => {
    const hargaDiskon = p.diskon ? Math.round(p.harga * (1 - p.diskon/100)) : p.harga;
    const url = `checkout.html?nama=${encodeURIComponent(p.nama)}&harga=${hargaDiskon}&satuan=${encodeURIComponent(p.satuan)}&img=${encodeURIComponent(p.img)}&stok=${p.stok}&badge=${encodeURIComponent(p.badge)}`;

    const pricingHTML = p.diskon
      ? `<span class="prod-price-old">${fmt(p.harga)}</span>
         <span class="prod-price">${fmt(hargaDiskon)}</span>
         <span class="prod-price-unit">/ gram</span>
         <span class="prod-discount">${p.diskon}%</span>`
      : `<span class="prod-price">${fmt(p.harga)}</span>
         <span class="prod-price-unit">/ gram</span>`;

    /* tandai produk yang sedang aktif */
    const isActive = p.nama.toUpperCase() === namaAktif &&
                     (p.diskon ? Math.round(p.harga*(1-p.diskon/100)) : p.harga) === hargaSatuan;

    grid.insertAdjacentHTML('beforeend', `
      <a class="prod-card${isActive ? ' active-card' : ''}" href="${url}"
         style="animation-delay:${i*0.07}s">
        <div class="prod-img-wrap">
          <span class="prod-badge">${p.badge}</span>
          <img src="${p.img}" alt="${p.nama}">
        </div>
        <div class="prod-body">
          <div class="prod-cat">COFFE <span>|</span> BUBUK KOPI</div>
          <div class="prod-name">${p.nama.toUpperCase()}</div>
          <div class="prod-pricing">${pricingHTML}</div>
        </div>
      </a>`);
  });
}

buildProductGrid();

/* ════════════════════════════════
   QTY CONTROL
════════════════════════════════ */
document.getElementById('minus').addEventListener('click', () => {
  if (qty > 1) { qty--; qtyEl.value = qty; updateSubtotal(); }
});
document.getElementById('plus').addEventListener('click', () => {
  if (qty < stokAktif) { qty++; qtyEl.value = qty; updateSubtotal(); }
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
   MODAL
════════════════════════════════ */
document.getElementById('btnBeli').addEventListener('click', openModal);

function openModal() {
  modalTotal.textContent = fmt(hargaSatuan * qty);
  document.getElementById('modalOverlay').classList.add('open');
  document.body.style.overflow = 'hidden';
}

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

  const waNumber = '6281234567890'; // ← ganti nomor WA toko kamu
  const pesan = encodeURIComponent(
    `Halo Temukan Kopi! 🌿\n\n` +
    `*Pesanan Baru*\n` +
    `Nama     : ${nama}\n` +
    `No. WA   : ${wa}\n` +
    `Produk   : ${namaAktif} x${qty}\n` +
    `Total    : ${total}\n` +
    `Alamat   : ${alamat}\n` +
    `Tanggal  : ${tgl}\n\n` +
    `Mohon dikonfirmasi, terima kasih! ☕`
  );

  window.open(`https://wa.me/${waNumber}?text=${pesan}`, '_blank');
});
</script>

</body>
</html>