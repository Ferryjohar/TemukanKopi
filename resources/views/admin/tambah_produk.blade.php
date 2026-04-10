<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Produk - Temukan Kopi</title>
<style>
    :root {
        --primary-green: #004d32;
        --bg-light: #f5f3ed;
        --text-dark: #1a1a1a;
    }

    body { margin: 0; font-family: 'Segoe UI', sans-serif; background-color: var(--bg-light); display: flex; }

    /* SIDEBAR (Sesuai Dashboard Utama) */
    .sidebar { width: 280px; background-color: var(--primary-green); min-height: 100vh; color: white; padding: 40px 20px; position: fixed; z-index: 100; }
    .logo-text { font-family: 'Georgia', serif; font-size: 28px; margin-bottom: 40px; padding-left: 20px; }
    .nav-menu { list-style: none; padding: 0; }
    .nav-link { display: flex; align-items: center; padding: 12px 20px; color: #ffffffb3; text-decoration: none; border-radius: 10px; margin-bottom: 10px; }
    .nav-link.active { background-color: white; color: var(--primary-green); font-weight: bold; }

    /* MAIN CONTENT */
    .main-content { margin-left: 280px; flex: 1; padding: 60px; }
    
    .header-area { margin-bottom: 40px; }
    .header-area h1 { font-size: 32px; color: var(--text-dark); margin: 0; }
    .header-area p { color: #666; margin: 5px 0 0; }

    /* MODERN FORM BOX */
    .form-container {
        background: white;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        max-width: 800px; /* Lebih lebar agar lega */
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
    }

    .full-width { grid-column: span 2; }

    .input-group { margin-bottom: 5px; }
    .input-group label { display: block; font-size: 13px; font-weight: 600; color: #555; margin-bottom: 8px; }
    
    .input-group input, 
    .input-group select, 
    .input-group textarea {
        width: 100%;
        padding: 14px;
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        background-color: #fcfcfc;
        font-size: 14px;
        color: var(--text-dark);
        box-sizing: border-box;
        transition: 0.3s;
    }

    .input-group input:focus, .input-group select:focus {
        border-color: var(--primary-green);
        background-color: white;
        outline: none;
        box-shadow: 0 0 0 4px rgba(0, 77, 50, 0.05);
    }

    /* ACTION BUTTONS */
    .btn-group {
        margin-top: 40px;
        display: flex;
        gap: 15px;
        justify-content: flex-end;
    }

    .btn-save {
        background-color: var(--primary-green);
        color: white;
        padding: 14px 40px;
        border: none;
        border-radius: 12px;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-save:hover { background-color: #003624; transform: translateY(-2px); }

    .btn-cancel {
        background-color: transparent;
        color: #888;
        padding: 14px 30px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: 0.3s;
    }

    .btn-cancel:hover { color: #333; }

    input[type="file"] { padding: 10px 0; border: none; background: none; }
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
    <div class="header-area">
        <h1>Tambah Produk Baru</h1>
        <p>Input detail produk kopi untuk ditampilkan di website utama.</p>
    </div>

    <div class="form-container">
        <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-grid">
                <div class="input-group">
                    <label>Nama Produk</label>
                    <input type="text" name="nama_produk" placeholder="Contoh: Arabica Gayo" required>
                </div>

                <div class="input-group">
                    <label>Harga (Rp)</label>
                    <input type="number" name="harga_produk" placeholder="0" required>
                </div>

                <div class="input-group">
                    <label>Kategori</label>
                    <select name="id_kategori" required>
                        <option value="" disabled selected>Pilih Kategori</option>
                        @foreach($kategori as $kat)
                            <option value="{{ $kat->id_kategori }}">{{ $kat->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input-group">
                    <label>Jenis Kopi</label>
                    <select name="id_jeniskopi" required>
                        <option value="" disabled selected>Pilih Jenis</option>
                        @foreach($jenisKopi as $jenis)
                            <option value="{{ $jenis->id_jeniskopi }}">{{ $jenis->nama_jenis }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="input-group">
                    <label>Stok Produk</label>
                    <input type="number" name="stok_produk" placeholder="0" required>
                </div>

                <div class="input-group">
                    <label>Foto Produk</label>
                    <input type="file" name="foto_produk" required>
                </div>

                <div class="input-group full-width">
                    <label>Deskripsi Produk</label>
                    <textarea name="deskripsi_produk" rows="4" placeholder="Tuliskan cerita unik tentang biji kopi ini..."></textarea>
                </div>
            </div>

            <div class="btn-group">
                <a href="{{ route('admin.menu') }}" class="btn-cancel">Batal & Kembali</a>
                <button type="submit" class="btn-save">Simpan</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>