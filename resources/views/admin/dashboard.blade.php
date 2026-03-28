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

/* Main */
.main-content {
    margin-left: 280px;
    flex: 1;
    padding: 60px;
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
}

/* Table */
.data-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 15px;
}

.data-table th {
    padding: 15px;
    background-color: #e2e2e2;
}

.data-table td {
    background-color: white;
    padding: 15px;
}

.row-shadow {
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}

/* Badge */
.badge-active {
    background-color: #76e09e;
    padding: 5px 10px;
    border-radius: 20px;
}

.badge-inactive {
    background-color: #ffb3b3;
    padding: 5px 10px;
    border-radius: 20px;
}

/* Avatar */
.avatar {
    width: 40px;
    border-radius: 50%;
    margin-right: 10px;
}
</style>

</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="logo-text">temukan kopi.</div>

    <ul class="nav-menu">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link active">Data Admin</a>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">Transaksi</a>
        </li>

        <!-- 🔥 FIX PENTING -->
        <li class="nav-item">
            <a href="{{ route('admin.menu') }}" class="nav-link">Product</a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.logout') }}" class="nav-link" style="color:red;">Logout</a>
        </li>
    </ul>
</div>

<!-- MAIN -->
<div class="main-content">

    <div class="header-title">
        <h1>Kelola Data Admin</h1>
        <p>Total {{ $totalAdmin }} Admin</p>
        <p>Login sebagai: <b>{{ session('nama_admin') }}</b></p>
    </div>

    @if(session('success'))
        <div style="background:#d4edda;padding:10px;margin:10px 0;">
            {{ session('success') }}
        </div>
    @endif

    <div class="top-bar">
        <div class="search-wrapper">
            <input type="text" placeholder="Cari admin...">
        </div>

        <a href="#" class="btn-add">+ Tambah Admin</a>
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
                <td style="display:flex;align-items:center;">
                    <img src="https://i.pravatar.cc/150" class="avatar">
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
                    <a href="#">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

</body>
</html>