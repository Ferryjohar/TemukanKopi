<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard - Temukan Kopi</title>

<style>
:root {
    --primary-green: #004d32;
    --bg-light: #f5f3ed;
    --text-dark: #1a1a1a;
}

body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background-color: var(--bg-light);
    display: flex;
}

/* SIDEBAR SESUAI ACUAN */
.sidebar {
    width: 280px;
    background-color: var(--primary-green);
    min-height: 100vh;
    color: white;
    padding: 40px 20px;
    position: fixed;
    z-index: 100;
}

.logo-text {
    font-family: 'Georgia', serif;
    font-size: 28px;
    margin-bottom: 40px;
    padding-left: 20px;
}

.nav-menu {
    list-style: none;
    padding: 0;
}

.nav-item {
    margin-bottom: 10px;
}

.nav-link {
    display: flex;
    align-items: center;
    padding: 12px 20px;
    color: #ffffffb3;
    text-decoration: none;
    border-radius: 10px;
    transition: 0.3s;
}

.nav-link.active {
    background-color: white;
    color: var(--primary-green);
    font-weight: bold;
}

.nav-link:hover:not(.active) {
    background-color: rgba(255,255,255,0.1);
}

/* MAIN CONTENT */
.main-content {
    margin-left: 280px;
    flex: 1;
    padding: 60px;
}

.welcome-box {
    background: linear-gradient(135deg, var(--primary-green), #006b46);
    color: white;
    padding: 40px;
    border-radius: 20px;
    margin-bottom: 40px;
    box-shadow: 0 10px 20px rgba(0, 77, 50, 0.15);
}

.welcome-box h2 {
    margin: 0;
    font-size: 28px;
    font-family: 'Georgia', serif;
}

.welcome-box p {
    margin-top: 10px;
    opacity: 0.9;
    font-size: 16px;
}

.section-title {
    font-size: 22px;
    color: var(--text-dark);
    margin-bottom: 25px;
    font-weight: 700;
}

/* STATS GRID */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 25px;
}

.stat-card {
    background: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    transition: transform 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
}

.stat-card p {
    margin: 0;
    color: #666;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 600;
}

.stat-card .value {
    font-size: 36px;
    font-weight: 800;
    color: var(--primary-green);
    margin-top: 10px;
    display: block;
}

.stat-card .sub-value {
    font-size: 13px;
    color: #aaa;
    margin-top: 5px;
}
</style>
</head>

<body>

<div class="sidebar">
    <div class="logo-text">temukan kopi.</div>

    <ul class="nav-menu">
        @if(strtolower(session('role_admin')) === 'superadmin')
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" 
                   class="nav-link {{ Route::is('admin.dashboard*') ? 'active' : '' }}">
                    Data Admin
                </a>
            </li>
        @else
            <li class="nav-item">
                <a href="{{ route('admin.dashboard_khusus') }}" 
                   class="nav-link {{ Route::is('admin.dashboard_khusus*') ? 'active' : '' }}">
                    Dashboard
                </a>
            </li>
        @endif

        <li class="nav-item">
            <a href="{{ route('admin.transaksi') }}" 
               class="nav-link {{ Route::is('admin.transaksi*') ? 'active' : '' }}">
                Transaksi
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.menu') }}" 
               class="nav-link {{ Route::is('admin.menu*') ? 'active' : '' }}">
                Product
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.logout') }}" class="nav-link logout-btn" style="color:#ff4d4d;">
                Logout
            </a>
        </li>
    </ul>
</div>

<div class="main-content">

    <div class="welcome-box">
        <h2>Halo, {{ session('nama_admin') ?? 'Admin' }} 👋</h2>
        <p>Selamat datang kembali. Berikut adalah ringkasan performa <b>Temukan Kopi</b> hari ini.</p>
    </div>

    <h1 class="section-title">Ringkasan Aktivitas</h1>

    <div class="stats-grid">

        <div class="stat-card">
            <p>Total Pesanan</p>
            <span class="value">{{ number_format($totalPesanan ?? 0) }}</span>
            <span class="sub-value">Pesanan masuk</span>
        </div>

        <div class="stat-card">
            <p>Total Produk</p>
            <span class="value">{{ number_format($totalProduk ?? 0) }}</span>
            <span class="sub-value">Menu tersedia</span>
        </div>

        <div class="stat-card">
            <p>Status Akses</p>
            <span class="value" style="color: #3498db;">{{ ucfirst(session('role_admin')) }}</span>
            <span class="sub-value">Level izin saat ini</span>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.logout-btn').forEach(btn => {
        btn.addEventListener('click', function(e){
            e.preventDefault();
            Swal.fire({
                title: 'Yakin ingin keluar?',
                text: "Sesi admin Anda akan diakhiri.",
                icon: 'warning',
                width: '320px',
                showCancelButton: true,
                confirmButtonColor: '#004d32',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = this.href;
                }
            });
        });
    });
});
</script>

</body>
</html>