<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Temukan Kopi</title>

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

.bg-title {
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
.footer-col p, .footer-col a {
  display: block;
  color: rgba(255,255,255,.7);
  font-size: 13px; line-height: 1.6;
  margin-bottom: 10px;
  text-decoration: none;
  transition: color .3s;
}
.footer-col a:hover { color: var(--putih); }

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
      <a class="btn" href="#">Selengkapnya</a>
      <a class="btn btn-ghost" href="#">Lihat Produk</a>
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
  <div class="bg-title">About</div>
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
  <div class="produk-grid stagger">
 
    <a class="card" href="/checkout?nama=Arabica&harga=60000&satuan=250gr&img=images%2Fkopi.png&stok=23&badge=NEW">
      <div class="badge">NEW</div>
      <img src="images/kopi.png" alt="Arabica">
      <div class="card-body">
        <div class="card-stars">★★★★★</div>
        <h4>Arabica</h4>
        <div class="price">Rp 60.000 / 250gr</div>
      </div>
    </a>
 
    <a class="card" href="/checkout?nama=Robusta&harga=55000&satuan=250gr&img=images%2Fkopi.png&stok=18&badge=NEW">
      <div class="badge">NEW</div>
      <img src="images/kopi.png" alt="Robusta">
      <div class="card-body">
        <div class="card-stars">★★★★★</div>
        <h4>Robusta</h4>
        <div class="price">Rp 55.000 / 250gr</div>
      </div>
    </a>
 
    <a class="card" href="/checkout?nama=Liberica&harga=65000&satuan=250gr&img=images%2Fkopi.png&stok=15&badge=NEW">
      <div class="badge">NEW</div>
      <img src="images/kopi.png" alt="Liberica">
      <div class="card-body">
        <div class="card-stars">★★★★★</div>
        <h4>Liberica</h4>
        <div class="price">Rp 65.000 / 250gr</div>
      </div>
    </a>
 
    <a class="card" href="/checkout?nama=Toraja&harga=70000&satuan=250gr&img=images%2Fkopi.png&stok=20&badge=NEW">
      <div class="badge">NEW</div>
      <img src="images/kopi.png" alt="Toraja">
      <div class="card-body">
        <div class="card-stars">★★★★★</div>
        <h4>Toraja</h4>
        <div class="price">Rp 70.000 / 250gr</div>
      </div>
    </a>
 
  </div>
 
  <div class="produk-cta reveal">
    <a class="btn" href="#">CLICK MORE</a>
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
  <div class="bg-title">Mengapa</div>
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
  <div class="bg-title">Kopi</div>
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
  <div class="map reveal">
    <img src="images/map.png" alt="Lokasi Temukan Kopi">
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
      <div class="footer-socials">
        <a class="soc-btn" title="Instagram">📸</a>
        <a class="soc-btn" title="Facebook">👥</a>
        <a class="soc-btn" title="TikTok">🎵</a>
        <a class="soc-btn" title="WhatsApp">💬</a>
      </div>
    </div>
    <div class="footer-col">
      <h4>Contact Us</h4>
      <p>Madiun, Jawa Timur</p>
      <p>+62 812345678</p>
      <p>temukankopi@gmail.com</p>
    </div>
    <div class="footer-col">
      <h4>Sosial Media</h4>
      <a href="#">Instagram</a>
      <a href="#">Facebook</a>
      <a href="#">TikTok</a>
      <a href="#">WhatsApp</a>
    </div>
  </div>
  <div class="copy">© Copyright 2025 Temukan Kopi. All rights reserved.</div>
</footer>


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
    if (e.isIntersecting) {
      e.target.classList.add('visible');
      io.unobserve(e.target);
    }
  });
}, { threshold: 0.12, rootMargin: '0px 0px -36px 0px' });

document.querySelectorAll('.reveal, .stagger').forEach(el => io.observe(el));

/* ── Counter animation ── */
function runCounter(el) {
  const target = parseInt(el.dataset.target, 10);
  const dur    = 1800;
  const start  = performance.now();
  const tick   = now => {
    const p = Math.min((now - start) / dur, 1);
    const v = Math.round(p < 1
      ? target * (1 - Math.pow(1 - p, 3))
      : target
    );
    el.textContent = v;
    if (p < 1) requestAnimationFrame(tick);
  };
  requestAnimationFrame(tick);
}

const cntIo = new IntersectionObserver((entries) => {
  entries.forEach(e => {
    if (e.isIntersecting) {
      e.target.querySelectorAll('.counter').forEach(runCounter);
      cntIo.unobserve(e.target);
    }
  });
}, { threshold: 0.5 });

document.querySelectorAll('.hero-stats').forEach(el => cntIo.observe(el));
</script>

</body>
</html>