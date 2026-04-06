<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kelola Produk - Temukan Kopi</title>

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

/* MAIN CONTENT SESUAI ACUAN */
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

.top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 30px 0;
}

.search-wrapper {
    width: 350px;
}

.search-wrapper input {
    width: 100%;
    padding: 12px;
    border-radius: 12px;
    border: 1px solid #ddd;
    outline: none;
}

.btn-add {
    background-color: white;
    padding: 12px 20px;
    border-radius: 12px;
    text-decoration: none;
    color: var(--text-dark);
    font-weight: bold;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    transition: 0.2s;
}

.btn-add:hover {
    background-color: #eee;
}

/* TABLE SESUAI ACUAN */
.data-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 15px;
    position: relative;
    z-index: 5;
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

.prod-img {
    width: 45px;
    height: 45px;
    border-radius: 10px;
    margin-right: 15px;
    object-fit: cover;
    background-color: #f9f9f9;
}

.action-link {
    text-decoration: none;
    font-weight: bold;
    font-size: 14px;
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

    <div class="header-title">
        <h1>Product</h1>
        <p>Total {{ count($produk ?? []) }} Produk</p>
        <p>Login sebagai: <b>{{ session('nama_admin') }}</b></p>
    </div>

    @if(session('success'))
        <div style="background:#d4edda; color: #155724; padding:15px; margin:20px 0; border-radius: 10px; border: 1px solid #c3e6cb;">
            {{ session('success') }}
        </div>
    @endif

    <div class="top-bar">
        <div class="search-wrapper">
            <form action="{{ route('admin.menu') }}" method="GET">
                <input type="text" name="search" placeholder="cari berdasarkan nama..." value="{{ request('search') }}">
            </form>
        </div>

        <a href="{{ route('admin.menu.create') }}" class="btn-add">+ Tambahkan Produk</a>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Kategori</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($produk as $item)
            <tr class="row-shadow">
                <td style="display:flex; align-items:center;">
                    <img src="{{ $item->foto_produk ? asset('storage/produk/' . $item->foto_produk) : 'https://placehold.co/100x100?text=Kopi' }}" class="prod-img">
                    <span style="font-weight: 600;">{{ $item->nama_produk }}</span>
                </td>
                <td style="font-weight: bold; color: var(--primary-green);">
                    Rp {{ number_format($item->harga_produk, 0, ',', '.') }}
                </td>
                <td>{{ $item->stok_produk }}</td>
                <td>
                    <span style="background: #eee; padding: 4px 10px; border-radius: 6px; font-size: 13px;">
                        {{ $item->id_kategori }}
                    </span>
                </td>
                <td style="color:#666; font-size:14px;">
                    {{ \Illuminate\Support\Str::limit($item->deskripsi_produk, 30) }}
                </td>
                <td>
                    <div style="display: flex; gap: 15px;">
                        <a href="{{ route('admin.menu.edit', $item->id_produk) }}" 
                           class="action-link" style="color: #007bff;">Edit</a>
                        
                        <a href="{{ route('admin.menu.hapus', $item->id_produk) }}" 
                           class="action-link btn-delete" style="color: #dc3545;">
                           Hapus
                        </a>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 40px; background: white; border-radius: 12px;">
                    <p style="color: #999;">Data produk tidak ditemukan.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const swalOptions = {
        width: '300px',
        padding: '1.5em',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Batal'
    };

    // LOGOUT
    document.querySelectorAll('.logout-btn').forEach(btn => {
        btn.addEventListener('click', function(e){
            e.preventDefault();
            Swal.fire({
                ...swalOptions,
                title: 'Yakin logout?',
                icon: 'warning'
            }).then((result)=>{
                if(result.isConfirmed) window.location.href = this.href;
            });
        });
    });

    // HAPUS PRODUK
    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', function(e){
            e.preventDefault();
            Swal.fire({
                ...swalOptions,
                title: 'Hapus produk?',
                text: 'Produk ini akan dihapus permanen',
                icon: 'error',
                confirmButtonText: 'Hapus'
            }).then((result)=>{
                if(result.isConfirmed) window.location.href = this.href;
            });
        });
    });
});
</script>

</body>
</html>