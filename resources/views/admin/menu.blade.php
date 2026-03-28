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

/* SIDEBAR */
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

.nav-link {
    display: block;
    padding: 12px 20px;
    color: #ffffffb3;
    text-decoration: none;
    border-radius: 10px;
    transition: 0.3s;
    margin-bottom: 10px;
}

.nav-link.active {
    background-color: white;
    color: var(--primary-green);
    font-weight: bold;
}

.nav-link:hover {
    background-color: rgba(255,255,255,0.1);
}

/* MAIN */
.main-content {
    margin-left: 280px;
    flex: 1;
    padding: 60px;
}

/* HEADER */
.header-title h1 {
    font-size: 32px;
    margin-bottom: 5px;
    color: var(--text-dark);
}

.header-title p {
    color: #666;
}

/* ALERT */
.alert {
    background: #d4edda;
    color: #155724;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 20px;
}

/* FORM */
.form-box {
    background: white;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 20px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.05);
}

.form-box input {
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
    margin-right: 10px;
}

.btn-submit {
    background: var(--primary-green);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    cursor: pointer;
}

/* TABLE */
.data-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 15px;
}

.data-table th {
    text-align: left;
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

/* BUTTON */
.btn-delete {
    background: #ff4d4d;
    color: white;
    padding: 6px 12px;
    border-radius: 6px;
    text-decoration: none;
}
</style>

</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="logo-text">temukan kopi.</div>

    <ul class="nav-menu">
        <li><a href="{{ route('admin.menu') }}" class="nav-link active">Menu Produk</a></li>
        <li><a href="{{ route('admin.logout') }}" class="nav-link" style="color:#ff4d4d;">Logout</a></li>
    </ul>
</div>

<!-- MAIN -->
<div class="main-content">

    <div class="header-title">
        <h1>Kelola Produk Kopi</h1>
        <p>Login sebagai: <b>{{ session('nama_admin') }}</b></p>
    </div>

    @if(session('success'))
        <div class="alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- FORM TAMBAH -->
    <div class="form-box">
        <form method="POST" action="{{ route('admin.menu.tambah') }}">
            @csrf
            <input type="text" name="nama" placeholder="Nama Produk" required>
            <input type="number" name="harga" placeholder="Harga" required>
            <button type="submit" class="btn-submit">Tambah Produk</button>
        </form>
    </div>

    <!-- TABLE -->
    <table class="data-table">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($produk as $p)
            <tr class="row-shadow">
                <td>{{ $p->nama_produk }}</td>
                <td>Rp {{ number_format($p->harga,0,',','.') }}</td>
                <td>
                    <a href="{{ route('admin.menu.hapus', $p->id) }}" class="btn-delete">Hapus</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

</body>
</html>