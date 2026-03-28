<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kelola Data Admin - Temukan Kopi</title>

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

/* Sidebar */
.sidebar {
    width: 280px;
    background-color: var(--primary-green);
    min-height: 100vh;
    color: white;
    padding: 40px 20px;
    position: fixed;
    z-index: 100; /* Pastikan sidebar di bawah klik konten utama jika perlu */
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
    margin-left: 280px; /* Harus sama dengan lebar sidebar */
    flex: 1;
    padding: 60px;
    position: relative;
    z-index: 10; /* Menaikkan lapisan konten utama agar bisa diklik */
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

/* Top Bar */
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
}

/* Button */
.btn-add {
    background-color: white;
    padding: 12px 20px;
    border-radius: 12px;
    text-decoration: none;
    color: var(--text-dark);
    font-weight: bold;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    transition: 0.2s;
    position: relative;
    z-index: 20; /* Prioritas klik tinggi */
}

.btn-add:hover {
    background-color: #eee;
}

/* Table */
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
}

.data-table td {
    background-color: white;
    padding: 15px;
    vertical-align: middle;
}

/* Memastikan Link Aksi Bisa Diklik */
.action-link {
    text-decoration: none;
    font-weight: bold;
    position: relative;
    z-index: 50; /* Sangat tinggi agar tidak tertutup */
    cursor: pointer;
}

.row-shadow {
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}

/* Badge */
.badge-active {
    background-color: #76e09e;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 14px;
}

.badge-inactive {
    background-color: #ffb3b3;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 14px;
}

/* Avatar */
.avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 15px;
    object-fit: cover;
}
</style>

</head>
<body>

<div class="sidebar">
    <div class="logo-text">temukan kopi.</div>

    <ul class="nav-menu">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link active">Data Admin</a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">Transaksi</a>
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
        <h1>Kelola Data Admin</h1>
        <p>Total {{ $totalAdmin }} Admin</p>
        <p>Login sebagai: <b>{{ session('nama_admin') }}</b></p>
    </div>

    @if(session('success'))
        <div style="background:#d4edda; color: #155724; padding:15px; margin:20px 0; border-radius: 10px; border: 1px solid #c3e6cb;">
            {{ session('success') }}
        </div>
    @endif

    <div class="top-bar">
        <div class="search-wrapper">
            <form action="" method="GET">
                <input type="text" name="search" placeholder="Cari admin..." value="{{ request('search') }}">
            </form>
        </div>

        <a href="{{ route('admin.create') }}" class="btn-add">+ Tambah Admin</a>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Password</th>
                <th>Role</th>
                <th>Status</th>
                <th>Update</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($admins as $admin)
            <tr class="row-shadow">
                <td style="display:flex; align-items:center;">
                    <img src="https://i.pravatar.cc/150?u={{ $admin->id_user }}" class="avatar">
                    {{ $admin->nama }}
                </td>

                <td>********</td>
                <td>{{ ucfirst($admin->role) }}</td>

                <td>
                    <span class="{{ $admin->status_admin == 'aktif' ? 'badge-active' : 'badge-inactive' }}">
                        {{ $admin->status_admin }}
                    </span>
                </td>

                <td>
                    {{ $admin->updated_at ? date('d-m-Y', strtotime($admin->updated_at)) : '-' }}
                </td>

                <td>
                    <div style="display: flex; gap: 15px;">
                        <a href="{{ route('admin.edit', $admin->id_user) }}" 
                           class="action-link" style="color: #007bff;">Edit</a>
                        
                        <a href="{{ route('admin.destroy', $admin->id_user) }}" 
                           class="action-link" style="color: #dc3545;"
                           onclick="return confirm('Apakah Anda yakin ingin menghapus admin {{ $admin->nama }}?')">
                           Hapus
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

</body>
</html>