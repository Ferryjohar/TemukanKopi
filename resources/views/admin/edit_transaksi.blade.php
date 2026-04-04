<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Transaksi - Temukan Kopi</title>
<style>
    :root {
        --primary-green: #004d32;
        --bg-light: #f5f3ed;
        --text-dark: #1a1a1a;
    }
    body { margin: 0; font-family: 'Segoe UI', sans-serif; background-color: var(--bg-light); display: flex; }
    
    .sidebar { width: 280px; background-color: var(--primary-green); min-height: 100vh; color: white; padding: 40px 20px; position: fixed; }
    .logo-text { font-family: 'Georgia', serif; font-size: 28px; margin-bottom: 40px; padding-left: 20px; }
    .nav-menu { list-style: none; padding: 0; }
    .nav-link { display: flex; align-items: center; padding: 12px 20px; color: #ffffffb3; text-decoration: none; border-radius: 10px; }
    .nav-link.active { background-color: white; color: var(--primary-green); font-weight: bold; }

    .main-content { margin-left: 280px; flex: 1; padding: 60px; }
    .header-title h1 { font-size: 32px; margin-bottom: 20px; color: var(--text-dark); }

    /* Form Style */
    .form-card {
        background: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        max-width: 600px;
    }
    .form-group { margin-bottom: 20px; }
    .form-group label { display: block; margin-bottom: 8px; font-weight: 600; color: #555; }
    .form-group input, .form-group textarea {
        width: 100%;
        padding: 12px;
        border-radius: 10px;
        border: 1px solid #ddd;
        box-sizing: border-box;
        outline: none;
    }
    .btn-save {
        background-color: var(--primary-green);
        color: white;
        padding: 12px 25px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
        font-weight: bold;
        transition: 0.3s;
    }
    .btn-save:hover { background-color: #003624; }
    .btn-cancel { text-decoration: none; color: #666; margin-left: 15px; font-size: 14px; }
</style>
</head>
<body>

<div class="sidebar">
    <div class="logo-text">temukan kopi.</div>
    <ul class="nav-menu">
        <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link">Data Admin</a></li>
        <li class="nav-item"><a href="{{ route('admin.transaksi') }}" class="nav-link active">Transaksi</a></li>
        <li class="nav-item"><a href="{{ route('admin.menu') }}" class="nav-link">Product</a></li>
        <li class="nav-item"><a href="{{ route('admin.logout') }}" class="nav-link" style="color:#ff4d4d;">Logout</a></li>
    </ul>
</div>

<div class="main-content">
    <div class="header-title">
        <h1>Edit Data Transaksi #{{ $transaksi->id_pesanan }}</h1>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.transaksi.update', $transaksi->id_pesanan) }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Pelanggan</label>
                <input type="text" name="nama_customer" value="{{ $transaksi->nama_customer }}" required>
            </div>

            <div class="form-group">
                <label>No. WhatsApp</label>
                <input type="text" name="no_wa" value="{{ $transaksi->no_wa }}" required>
            </div>

            <div class="form-group">
                <label>Alamat Pengiriman</label>
                <textarea name="alamat" rows="4" required>{{ $transaksi->alamat }}</textarea>
            </div>

            <div style="margin-top: 30px;">
                <button type="submit" class="btn-save">Simpan Perubahan</button>
                <a href="{{ route('admin.transaksi') }}" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>