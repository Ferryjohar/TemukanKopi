<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Produk - Temukan Kopi</title>
<style>
    :root {
        --primary-green: #004d32;
        --bg-light: #f5f3ed;
        --text-dark: #1a1a1a;
    }

    body { margin: 0; font-family: 'Segoe UI', sans-serif; background-color: var(--bg-light); display: flex; }

    /* SIDEBAR */
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

    /* FORM CONTAINER */
    .form-container {
        background: white;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        max-width: 900px;
    }

    .edit-layout {
        display: grid;
        grid-template-columns: 250px 1fr; /* Kolom kiri untuk foto, kanan untuk form */
        gap: 40px;
    }

    /* PHOTO SECTION */
    .photo-section { text-align: center; }
    .preview-box {
        width: 200px;
        height: 200px;
        background: #fcfcfc;
        border-radius: 15px;
        margin: 0 auto 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border: 2px dashed #e0e0e0;
    }
    .preview-box img { width: 100%; height: 100%; object-fit: cover; }

    /* INPUT STYLES */
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    .full-width { grid-column: span 2; }
    .input-group label { display: block; font-size: 13px; font-weight: 600; color: #555; margin-bottom: 8px; }
    .input-group input, .input-group select, .input-group textarea {
        width: 100%; padding: 14px; border: 1px solid #e0e0e0; border-radius: 12px;
        background-color: #fcfcfc; font-size: 14px; box-sizing: border-box; transition: 0.3s;
    }
    .input-group input:focus { border-color: var(--primary-green); outline: none; background: white; }

    /* BUTTONS */
    .btn-group { margin-top: 30px; display: flex; gap: 15px; justify-content: flex-end; }
    .btn-save { background: var(--primary-green); color: white; padding: 14px 35px; border: none; border-radius: 12px; font-weight: bold; cursor: pointer; }
    .btn-cancel { color: #888; text-decoration: none; padding: 14px 20px; font-size: 14px; }

    .btn-upload {
        display: inline-block;
        padding: 8px 15px;
        background: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 12px;
        cursor: pointer;
        color: #555;
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
    <div class="header-area">
        <h1>Edit Produk</h1>
        <p>Perbarui informasi produk <b>{{ $product->nama_produk }}</b></p>
    </div>

    <div class="form-container">
        <form action="{{ route('admin.menu.update', $product->id_produk) }}" method="POST" enctype="multipart/form-data">
            @csrf
            {{-- Karena di route Anda menggunakan POST untuk update, @method('POST') boleh tetap ada atau dihapus --}}
            
            <div class="edit-layout">
                <div class="photo-section">
                    <div class="preview-box">
                        <img src="{{ asset('storage/produk/'.$product->foto_produk) }}" id="preview" onerror="this.src='https://placehold.co/200x200?text=No+Image'">
                    </div>
                    <input type="file" name="foto_produk" id="foto-input" style="display: none;" onchange="previewImg(this)">
                    <button type="button" class="btn-upload" onclick="document.getElementById('foto-input').click()">Ganti Foto</button>
                    <p style="font-size: 11px; color: #999; margin-top: 10px;">Klik tombol di atas untuk mengubah foto produk.</p>
                </div>

                <div>
                    <div class="form-grid">
                        <div class="input-group">
                            <label>Nama Produk</label>
                            <input type="text" name="nama_produk" value="{{ $product->nama_produk }}" required>
                        </div>
                        <div class="input-group">
                            <label>Harga (Rp)</label>
                            <input type="number" name="harga_produk" value="{{ $product->harga_produk }}" required>
                        </div>
                        <div class="input-group">
                            <label>Kategori</label>
                            <select name="id_kategori" required>
                                @foreach($kategori as $kat)
                                    <option value="{{ $kat->id_kategori }}" {{ $product->id_kategori == $kat->id_kategori ? 'selected' : '' }}>
                                        {{ $kat->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group">
                            <label>Jenis Kopi</label>
                            <select name="id_jeniskopi" required>
                                @foreach($jenisKopi as $jenis)
                                    <option value="{{ $jenis->id_jeniskopi }}" {{ $product->id_jeniskopi == $jenis->id_jeniskopi ? 'selected' : '' }}>
                                        {{ $jenis->nama_jenis }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group">
                            <label>Stok Produk</label>
                            <input type="number" name="stok_produk" value="{{ $product->stok_produk }}" required>
                        </div>
                        <div class="input-group full-width">
                            <label>Deskripsi Produk</label>
                            <textarea name="deskripsi_produk" rows="4">{{ $product->deskripsi_produk }}</textarea>
                        </div>
                    </div>

                    <div class="btn-group">
                        <a href="{{ route('admin.menu') }}" class="btn-cancel">Batal</a>
                        <button type="submit" class="btn-save">Simpan Perubahan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function previewImg(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) { document.getElementById('preview').src = e.target.result; }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

</body>
</html>