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

/* Sidebar - Konsisten dengan Data Admin */
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

/* Main Content */
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

/* Table - Style Row Shadow Identik */
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
    font-weight: 600;
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

/* Badge Status untuk Transaksi (Opsional jika ingin dipakai) */
.badge-success {
    background-color: #76e09e;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 13px;
}
</style>

</head>
<body>

<div class="sidebar">
    <div class="logo-text">temukan kopi.</div>

    <ul class="nav-menu">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">Data Admin</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.transaksi') }}" class="nav-link active">Transaksi</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.menu') }}" class="nav-link">Product</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.logout') }}" class="nav-link" style="color:#ff4d4d;">Logout</a>
        </li>
    </ul>
</div>

<div class="main-content">

    <div class="header-title">
        <h1>Kelola Transaksi</h1>
        <p>Total {{ $totalTransaksi }} Transaksi</p>
        <p>Login sebagai: <b>{{ session('nama_admin') }}</b></p>
    </div>

    @if(session('success'))
        <div style="background:#d4edda; color: #155724; padding:15px; margin:20px 0; border-radius: 10px; border: 1px solid #c3e6cb;">
            {{ session('success') }}
        </div>
    @endif

    <div class="top-bar">
        <div class="search-wrapper">
            <form action="{{ route('admin.transaksi') }}" method="GET">
                <input type="text" name="search" placeholder="Cari nama pelanggan..." value="{{ request('search') }}">
            </form>
        </div>
        
        {{-- Tombol Cetak Laporan (Opsional agar Top Bar tidak kosong) --}}
        <div style="width: 150px;"></div> 
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>Pelanggan</th>
                <th>No. WhatsApp</th>
                <th>Alamat</th>
                <th>Total Harga</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($transaksi as $t)
            <tr class="row-shadow">
                <td style="display:flex; align-items:center;">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($t->nama_customer) }}&background=004d32&color=fff" class="avatar">
                    <b>{{ $t->nama_customer }}</b>
                </td>

                <td>{{ $t->no_wa }}</td>
                <td>{{ \Illuminate\Support\Str::limit($t->alamat, 30) }}</td>
                <td><b>Rp {{ number_format($t->total_harga, 0, ',', '.') }}</b></td>
                <td>{{ date('d-m-Y H:i', strtotime($t->tanggal_pesan)) }}</td>

                <td>
                    <div style="display: flex; gap: 15px;">
                        {{-- Tombol Detail --}}
                        <a href="{{ route('admin.transaksi.detail', $t->id_pesanan) }}" 
                           class="action-link" style="color: #007bff;">Detail</a>
                        
                        {{-- TOMBOL EDIT (Sebelumnya Cetak) --}}
                        <a href="{{ route('admin.transaksi.edit', $t->id_pesanan) }}" class="action-link" style="color: #28a745;">Edit</a>

                        {{-- Tombol Hapus --}}
                        <a href="{{ route('admin.transaksi.destroy', $t->id_pesanan) }}" 
                           class="action-link" style="color: #dc3545;"
                           onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi dari {{ $t->nama_customer }}?')">
                           Hapus
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @if($transaksi->isEmpty())
        <div style="text-align: center; padding: 50px; color: #888;">
            <p>Belum ada data transaksi yang masuk.</p>
        </div>
    @endif

</div>

</body>
</html>