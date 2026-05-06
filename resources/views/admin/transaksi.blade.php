<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kelola Transaksi - Temukan Kopi</title>

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

.main-content {
    margin-left: 280px;
    flex: 1;
    padding: 60px;
    position: relative;
    z-index: 10;
}

.header-title h1 {
    font-size: 32px;
    margin-bottom: 5px;
    color: var(--text-dark);
}

.header-title p {
    color: #666;
    margin-top: 0;
}

/* FILTER BAR */
.filter-bar {
    display: flex;
    gap: 10px;
    align-items: flex-end;
    flex-wrap: wrap;
    margin: 30px 0;
    background: white;
    padding: 20px;
    border-radius: 14px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}

.filter-group {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.filter-group label {
    font-size: 12px;
    color: #666;
    font-weight: 600;
}

.search-input-wrapper {
    display: flex;
    align-items: center;
    border: 1px solid #ddd;
    border-radius: 10px;
    overflow: hidden;
    background: #fafafa;
    transition: border 0.2s;
}

.search-input-wrapper:focus-within {
    border-color: var(--primary-green);
    background: white;
}

.search-input-wrapper input[type="text"] {
    border: none;
    outline: none;
    padding: 10px 14px;
    font-size: 14px;
    font-family: 'Segoe UI', sans-serif;
    background: transparent;
    width: 250px; /* <-- Gunakan ukuran pasti agar kotak tidak memanjang berlebihan */
}

.btn-search {
    padding: 10px 18px;
    background: var(--primary-green);
    color: white;
    border: none;
    cursor: pointer;
    font-size: 14px;
    font-family: 'Segoe UI', sans-serif;
    font-weight: 600;
    transition: opacity 0.2s;
    white-space: nowrap;
}

.btn-search:hover {
    opacity: 0.85;
}

.filter-group input[type="date"] {
    padding: 10px 14px;
    border-radius: 10px;
    border: 1px solid #ddd;
    outline: none;
    font-size: 14px;
    font-family: 'Segoe UI', sans-serif;
    background: #fafafa;
    transition: border 0.2s;
    cursor: pointer;
}

.filter-group input[type="date"]:focus {
    border-color: var(--primary-green);
    background: white;
}

.filter-group input[type="date"]:disabled {
    background: #f0f0f0;
    color: #aaa;
    cursor: not-allowed;
    border-color: #e0e0e0;
}

.btn-reset {
    padding: 10px 22px;
    background: #e2e2e2;
    color: #333;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-size: 14px;
    font-family: 'Segoe UI', sans-serif;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    transition: background 0.2s;
}

.btn-reset:hover {
    background: #d0d0d0;
}

/* CHECKBOX LIHAT SEMUA */
.checkbox-semua {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 16px;
    background: #f0f7f4;
    border: 1px solid #b2d8c8;
    border-radius: 10px;
    cursor: pointer;
    font-size: 14px;
    color: var(--primary-green);
    font-weight: 600;
    transition: background 0.2s;
    user-select: none;
}

.checkbox-semua:hover {
    background: #d9efe7;
}

.checkbox-semua input[type="checkbox"] {
    width: 16px;
    height: 16px;
    accent-color: var(--primary-green);
    cursor: pointer;
}

/* INFO FILTER AKTIF */
.filter-active-info {
    background: #d4edda;
    color: #155724;
    padding: 10px 16px;
    margin-bottom: 10px;
    border-radius: 10px;
    border: 1px solid #c3e6cb;
    font-size: 14px;
}

/* TABLE */
.data-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 15px;
}

.data-table th {
    padding: 15px;
    background-color: #e2e2e2;
    text-align: left;
    color: var(--text-dark);
}

.data-table td {
    background-color: white;
    padding: 15px;
    vertical-align: middle;
}

.row-shadow {
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}

.avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 15px;
    object-fit: cover;
}

.action-link {
    text-decoration: none;
    font-weight: bold;
    font-size: 14px;
}

.address-text {
    max-width: 200px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    font-size: 14px;
    color: #555;
}

/* ════════════════════════════════════
   RESPONSIVE DESIGN (MOBILE & TABLET)
════════════════════════════════════ */

.mobile-toggle {
    display: none;
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 1001;
    background: var(--primary-green);
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 8px;
    cursor: pointer;
    font-weight: bold;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

@media (max-width: 1024px) {
    .sidebar { width: 240px; }
    .main-content { margin-left: 240px; padding: 40px; }
}

@media (max-width: 768px) {
    .mobile-toggle { display: block; }

    .sidebar {
        left: -280px;
        transition: left 0.3s ease;
        box-shadow: 2px 0 15px rgba(0,0,0,0.2);
    }
    .sidebar.active { left: 0; }
    
    .main-content {
        margin-left: 0;
        padding: 20px;
        padding-top: 80px;
    }

    /* Penyesuaian Filter Bar di HP */
    .filter-bar {
        flex-direction: column;
        align-items: stretch;
        gap: 15px;
    }

    .search-input-wrapper { width: 100%; }
    .search-input-wrapper input[type="text"] { width: 100%; }
    .btn-search { width: auto; }
    
    .checkbox-semua { justify-content: center; }
    .btn-reset { text-align: center; justify-content: center; }

    /* PERBAIKAN TABEL CARD MODE */
    .data-table thead { display: none; }
    .data-table, .data-table tbody, .data-table tr { 
        display: block; 
        width: 100%; 
    }

    .data-table tr {
        margin-bottom: 20px;
        border-radius: 15px;
        overflow: hidden;
        border: 1px solid #ddd;
        background: white;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .data-table td {
        display: flex !important;
        justify-content: flex-end;
        align-items: center;
        padding: 15px !important;
        border-bottom: 1px solid #f1f1f1;
        text-align: right;
    }

    /* Label Data di sebelah kiri */
    .data-table td::before {
        content: attr(data-label);
        font-weight: 700;
        color: var(--primary-green);
        margin-right: auto;
        text-align: left;
    }

    .data-table td:last-child { border-bottom: none; }
    
    /* Perbaiki teks alamat agar rata kanan di HP */
    .address-text { text-align: right; }
}
</style>
</head>

<body>

<!-- Tombol Toggle Mobile -->
<button class="mobile-toggle" onclick="toggleSidebar()">☰ Menu</button>

<div class="sidebar">
    <div class="logo-text">temukan kopi.</div>

    <ul class="nav-menu">
        @if(strtolower(session('role_admin')) === 'superadmin')
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard*') ? 'active' : '' }}">Data Admin</a>
            </li>
        @else
            <li class="nav-item">
                <a href="{{ route('admin.dashboard_khusus') }}" class="nav-link {{ Route::is('admin.dashboard_khusus*') ? 'active' : '' }}">Dashboard</a>
            </li>
        @endif

        <li class="nav-item">
            <a href="{{ route('admin.transaksi') }}" class="nav-link {{ Route::is('admin.transaksi*') ? 'active' : '' }}">Transaksi</a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.menu') }}" class="nav-link {{ Route::is('admin.menu*') ? 'active' : '' }}">Product</a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.logout') }}" class="nav-link logout-btn" style="color:#ff4d4d;">Logout</a>
        </li>
    </ul>
</div>

<div class="main-content">

    <div class="header-title">
        <h1>Kelola Transaksi</h1>
        <p>Total {{ $totalTransaksi }} Transaksi Terdaftar</p>
        <p>Login sebagai: <b>{{ session('nama_admin') }}</b></p>
    </div>

    @if(session('success'))
        <div style="background:#d4edda; color: #155724; padding:15px; margin:20px 0; border-radius: 10px; border: 1px solid #c3e6cb;">
            {{ session('success') }}
        </div>
    @endif

    {{-- INFO FILTER AKTIF --}}
    <div class="filter-active-info">
        @if(request('semua') == '1')
            Menampilkan <b>semua</b> transaksi
            @if(request('search'))
                dengan kata kunci <b>"{{ request('search') }}"</b>
            @endif
        @else
            Menampilkan transaksi
            @if(request('search'))
                dengan kata kunci <b>"{{ request('search') }}"</b>
            @endif
            | Tanggal:
            <b>{{ date('d-m-Y', strtotime(request('dari_tanggal', date('Y-m-d')))) }}</b>
            s/d
            <b>{{ date('d-m-Y', strtotime(request('sampai_tanggal', date('Y-m-d')))) }}</b>
        @endif
        &mdash; <b>{{ $transaksi->count() }}</b> transaksi ditemukan.
    </div>

    {{-- FILTER BAR --}}
    <form action="{{ route('admin.transaksi') }}" method="GET" id="filterForm">

        {{-- Hidden field semua — diisi oleh JS --}}
        <input type="hidden" name="semua" id="hiddenSemua" value="{{ request('semua', '0') }}">

        <div class="filter-bar">

            {{-- SEARCH --}}
            <div class="filter-group">
                <label>Cari Pelanggan</label>
                <div class="search-input-wrapper">
                    <input type="text" name="search" id="inputSearch"
                           placeholder="Cari nama pelanggan..."
                           value="{{ request('search') }}">
                    <button type="submit" class="btn-search">Cari</button>
                </div>
            </div>

            {{-- DARI TANGGAL --}}
            <div class="filter-group">
                <label>Dari Tanggal</label>
                <input type="date" name="dari_tanggal" id="dariTanggal"
                       value="{{ request('dari_tanggal', date('Y-m-d')) }}"
                       {{ request('semua') == '1' ? 'disabled' : '' }}>
            </div>

            {{-- SAMPAI TANGGAL --}}
            <div class="filter-group">
                <label>Sampai Tanggal</label>
                <input type="date" name="sampai_tanggal" id="sampaiTanggal"
                       value="{{ request('sampai_tanggal', date('Y-m-d')) }}"
                       {{ request('semua') == '1' ? 'disabled' : '' }}>
            </div>

            {{-- CHECKBOX LIHAT SEMUA --}}
            <label class="checkbox-semua">
                <input type="checkbox" id="checkSemua"
                       {{ request('semua') == '1' ? 'checked' : '' }}>
                Lihat Semua
            </label>

            <a href="{{ route('admin.transaksi') }}" class="btn-reset">Reset</a>

        </div>
    </form>

    <table class="data-table">
        <thead>
            <tr>
                <th>Pelanggan</th>
                <th>No WhatsApp</th>
                <th>Alamat</th>
                <th>Total Harga</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($transaksi as $t)
            <tr class="row-shadow">
                <td data-label="Pelanggan">
                    <div style="display:flex; align-items:center;">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($t->nama_customer) }}&background=004d32&color=fff&bold=true" class="avatar">
                        <span style="font-weight: 600;">{{ $t->nama_customer }}</span>
                    </div>
                </td>

                <td data-label="No WhatsApp">{{ $t->no_wa }}</td>

                <td data-label="Alamat">
                    <div class="address-text" title="{{ $t->alamat }}">
                        {{ $t->alamat }}
                    </div>
                </td>

                <td data-label="Total Harga" style="font-weight: bold; color: var(--primary-green);">
                    Rp {{ number_format($t->total_harga, 0, ',', '.') }}
                </td>

                <td data-label="Tanggal">{{ date('m-d-Y', strtotime($t->tanggal_pesan)) }}</td>

                <td data-label="Aksi">
                    <div style="display: flex; gap: 15px;">
                        <a href="{{ route('admin.transaksi.detail', $t->id_pesanan) }}"
                           class="action-link" style="color: #007bff;">Detail</a>

                        <a href="{{ route('admin.transaksi.edit', $t->id_pesanan) }}"
                           class="action-link" style="color: #ffc107;">Edit</a>

                        <a href="{{ route('admin.transaksi.destroy', $t->id_pesanan) }}"
                           class="action-link btn-delete" style="color: #dc3545;">Hapus</a>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 40px; background: white; border-radius: 15px;">
                    <p style="color: #999; margin: 0;">
                        Tidak ada transaksi pada rentang tanggal ini.
                    </p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Toggle Sidebar Responsif
function toggleSidebar() {
    document.querySelector('.sidebar').classList.toggle('active');
}

// Tutup sidebar saat klik di area luar sidebar
document.addEventListener('click', function(event) {
    const sidebar = document.querySelector('.sidebar');
    const toggleBtn = document.querySelector('.mobile-toggle');
    if (sidebar.classList.contains('active') && !sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
        sidebar.classList.remove('active');
    }
});

document.addEventListener("DOMContentLoaded", function () {

    const filterForm    = document.getElementById('filterForm');
    const dariTanggal   = document.getElementById('dariTanggal');
    const sampaiTanggal = document.getElementById('sampaiTanggal');
    const checkSemua    = document.getElementById('checkSemua');
    const hiddenSemua   = document.getElementById('hiddenSemua');

    // Auto submit saat pilih tanggal (hanya jika bukan mode semua)
    dariTanggal.addEventListener('change', function () {
        if (!checkSemua.checked) filterForm.submit();
    });

    sampaiTanggal.addEventListener('change', function () {
        if (!checkSemua.checked) filterForm.submit();
    });

    // Toggle checkbox Lihat Semua
    checkSemua.addEventListener('change', function () {
        if (this.checked) {
            hiddenSemua.value      = '1';
            dariTanggal.disabled   = true;
            sampaiTanggal.disabled = true;
        } else {
            hiddenSemua.value      = '0';
            dariTanggal.disabled   = false;
            sampaiTanggal.disabled = false;
        }
        filterForm.submit();
    });

    // SweetAlert options
    const swalOptions = {
        width: '320px',
        padding: '1.5em',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal'
    };

    // LOGOUT
    document.querySelectorAll('.logout-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const href = this.href;
            Swal.fire({
                ...swalOptions,
                title: 'Yakin logout?',
                icon: 'warning'
            }).then((result) => {
                if (result.isConfirmed) window.location.href = href;
            });
        });
    });

    // HAPUS TRANSAKSI
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const targetUrl = this.href;
            Swal.fire({
                ...swalOptions,
                title: 'Hapus transaksi?',
                text: 'Data akan dihapus permanen',
                icon: 'error',
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Hapus'
            }).then((result) => {
                if (result.isConfirmed) window.location.href = targetUrl;
            });
        });
    });
});
</script>

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: "{{ session('success') }}",
    width: '300px',
    padding: '1.5em',
    timer: 2000,
    showConfirmButton: false
});
</script>
@endif

</body>
</html>