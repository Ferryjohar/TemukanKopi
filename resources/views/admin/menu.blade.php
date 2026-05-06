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

        /* SIDEBAR - Konsisten dengan Dashboard */
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

        .nav-menu { list-style: none; padding: 0; }
        .nav-item { margin-bottom: 10px; }

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
            position: relative;
            z-index: 10;
        }

        .header-title h1 { font-size: 32px; margin-bottom: 5px; color: var(--text-dark); }
        .header-title p { color: #666; margin-top: 0; }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 30px 0;
        }

        .search-wrapper { width: 350px; }
        .search-wrapper input {
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            border: 1px solid #ddd;
            outline: none;
            font-size: 14px;
            box-sizing: border-box;
        }

        .btn-add {
            background-color: var(--primary-green);
            padding: 12px 20px;
            border-radius: 12px;
            color: white;
            font-weight: bold;
            cursor: pointer;
            border: none;
            font-size: 14px;
            transition: opacity 0.2s;
        }

        .btn-add:hover { opacity: 0.85; }

        /* TABLE STYLE */
        .data-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 15px;
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

        .row-shadow { box-shadow: 0 4px 15px rgba(0,0,0,0.05); }

        .prod-img {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            margin-right: 15px;
            object-fit: cover;
        }

        .badge-active { background-color: #76e09e; padding: 5px 12px; border-radius: 20px; font-size: 13px; font-weight: bold; display: inline-block; }
        .badge-inactive { background-color: #ffb3b3; padding: 5px 12px; border-radius: 20px; font-size: 13px; font-weight: bold; display: inline-block; }

        .action-link { text-decoration: none; font-weight: bold; cursor: pointer; font-size: 14px; border: none; background: none; }

        /* MODAL */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 999;
            justify-content: center;
            align-items: center;
        }
        .modal-overlay.show { display: flex; }
        .modal-box {
            background: white;
            border-radius: 20px;
            padding: 35px 40px;
            width: 600px;
            max-width: 95vw;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
        }
        .modal-box h2 { margin-bottom: 25px; color: var(--primary-green); font-weight: 800; }

        .form-group { margin-bottom: 16px; display: flex; flex-direction: column; gap: 6px; }
        .form-group label { font-size: 13px; font-weight: 700; color: #444; }
        .form-group input, .form-group select, .form-group textarea {
            padding: 10px 14px; border-radius: 10px; border: 1px solid #ddd; outline: none; background: #fafafa; font-family: inherit;
        }
        .form-group input:focus { border-color: var(--primary-green); background: white; }

        .divider { border: none; border-top: 1px solid #eee; margin: 20px 0; }

        /* MANAJEMEN KATEGORI & JENIS */
        .card-sm {
            background: white;
            padding: 25px;
            border-radius: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border: 1px solid #eee;
        }

        /* ════════════════════════════════════
           RESPONSIVE DESIGN
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

            .top-bar {
                flex-direction: column;
                gap: 15px;
                align-items: stretch;
            }
            .search-wrapper { width: 100%; }
            .btn-add { width: 100%; text-align: center; }

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

            .data-table td::before {
                content: attr(data-label);
                font-weight: 700;
                color: var(--primary-green);
                margin-right: auto;
                text-align: left;
            }

            .data-table td:last-child { border-bottom: none; }
            
            /* Penyesuaian Modal */
            .modal-box { padding: 25px 20px; }
            .form-group[style*="flex:1"] { flex: unset; width: 100%; } /* Atur lebar penuh di modal HP */
            .modal-box > form > div[style*="display:flex; gap:15px;"] {
                flex-direction: column;
                gap: 0;
            }
        }
    </style>
</head>
<body>

<!-- Tombol Toggle Mobile -->
<button class="mobile-toggle" onclick="toggleSidebar()">☰ Menu</button>

<div class="sidebar">
    <div class="logo-text">temukan kopi.</div>
    <ul class="nav-menu">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" 
            class="nav-link {{ Route::is('admin.dashboard*') ? 'active' : '' }}">
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.transaksi') }}" class="nav-link {{ Route::is('admin.transaksi*') ? 'active' : '' }}">Transaksi</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.menu') }}" class="nav-link active">Produk</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.logout') }}" class="nav-link btn-logout" style="color:#ff4d4d;">Logout</a>
        </li>
    </ul>
</div>

<div class="main-content">
    <div class="header-title">
        <h1>Manajemen Produk</h1>
        <p>Total {{ count($produk) }} Produk Tersedia</p>
        <p>Login sebagai: <b>{{ session('nama_admin') }}</b></p>
    </div>

    <div class="top-bar">
        <div class="search-wrapper">
            <form action="" method="GET">
                <input type="text" name="search" placeholder="Cari nama produk..." value="{{ request('search') }}">
            </form>
        </div>
        <button class="btn-add" onclick="bukaModalTambah()">+ Tambah Produk</button>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produk as $item)
            <tr class="row-shadow" 
                style="{{ $item->status_produk == 'habis' ? 'opacity: 0.6; filter: grayscale(1); transition: 0.3s;' : '' }}">
                <td data-label="Produk">
                    <div style="display: flex; align-items: center;">
                        <img src="{{ asset('storage/produk/'.$item->foto_produk) }}" class="prod-img" onerror="this.src='{{ asset('images/default.png') }}'">
                        <b>{{ $item->nama_produk }}</b>
                    </div>
                </td>
                <td data-label="Kategori">{{ $item->nama_kategori }}</td>
                <td data-label="Harga" style="font-weight: bold; color: var(--primary-green);">Rp {{ number_format($item->harga_produk, 0, ',', '.') }}</td>
                <td data-label="Status">
                    <span class="{{ $item->status_produk == 'tersedia' ? 'badge-active' : 'badge-inactive' }}">
                        {{ ucfirst($item->status_produk) }}
                    </span>
                </td>
                <td data-label="Aksi">
                    <div style="display:flex; gap:15px; justify-content: flex-end;">
                        <button class="action-link" style="color:#007bff;" 
                            onclick="bukaModalEdit(
                                '{{ $item->id_produk }}', 
                                '{{ addslashes($item->nama_produk) }}', 
                                '{{ $item->harga_produk }}', 
                                '{{ $item->status_produk }}', 
                                '{{ addslashes($item->deskripsi_produk) }}',
                                '{{ $item->id_kategori }}', 
                                '{{ $item->id_jeniskopi }}'
                            )">
                            Edit
                        </button>

                        <div style="width: 1px; height: 15px; background: #eee;"></div>
                        
                        <a href="{{ route('admin.menu.destroy', $item->id_produk) }}" 
                        class="action-link btn-delete-produk" 
                        style="color:#dc3545;">
                            Hapus
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px; margin-top: 40px;">
        <div class="card-sm">
            <h3 style="color: var(--text-dark); margin-top: 0; font-size: 18px;">Manajemen Kategori</h3>
            <form action="{{ route('admin.kategori.store') }}" method="POST" style="display: flex; gap: 10px; margin-bottom: 20px;">
                @csrf
                <input type="text" name="nama_kategori" placeholder="Tambah kategori..." required style="flex: 1; padding: 10px; border-radius: 10px; border: 1px solid #ddd;">
                <button type="submit" class="btn-add" style="padding: 10px 15px;">+</button>
            </form>
            <div style="max-height: 200px; overflow-y: auto;">
                <table style="width: 100%;">
                    @foreach($kategori as $k)
                    <tr style="border-bottom: 1px solid #f5f5f5;">
                        <td style="padding: 12px 0; font-size: 14px;">{{ $k->nama_kategori }}</td>
                        <td style="text-align: right;">
                            <a href="{{ route('admin.kategori.destroy', $k->id_kategori) }}" class="btn-delete-item" style="color:#dc3545; text-decoration:none; font-weight:bold; font-size:12px;">Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>

        <div class="card-sm">
            <h3 style="color: var(--text-dark); margin-top: 0; font-size: 18px;">Manajemen Jenis Kopi</h3>
            <form action="{{ route('admin.jenis.store') }}" method="POST" style="display: flex; gap: 10px; margin-bottom: 20px;">
                @csrf
                <input type="text" name="nama_jenis" placeholder="Tambah jenis..." required style="flex: 1; padding: 10px; border-radius: 10px; border: 1px solid #ddd;">
                <button type="submit" class="btn-add" style="padding: 10px 15px;">+</button>
            </form>
            <div style="max-height: 200px; overflow-y: auto;">
                <table style="width: 100%;">
                    @foreach($jenisKopi as $j)
                    <tr style="border-bottom: 1px solid #f5f5f5;">
                        <td style="padding: 12px 0; font-size: 14px;">{{ $j->nama_jenis }}</td>
                        <td style="text-align: right;">
                            <a href="{{ route('admin.jenis.destroy', $j->id_jeniskopi) }}" class="btn-delete-item" style="color:#dc3545; text-decoration:none; font-weight:bold; font-size:12px;">Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal-overlay" id="modalTambah">
    <div class="modal-box">
        <h2>Tambah Produk Baru</h2>
        <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group"><label>Nama Produk</label><input type="text" name="nama_produk" required></div>
            <div style="display:flex; gap:15px; flex-wrap: wrap;">
                <div class="form-group" style="flex:1;"><label>Harga (Rp)</label><input type="number" name="harga_produk" required></div>
                <div class="form-group" style="flex:1;"><label>Kategori</label>
                    <select name="id_kategori">
                        @foreach($kategori as $k) <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option> @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group"><label>Jenis Kopi</label>
                <select name="id_jeniskopi">
                    @foreach($jenisKopi as $j) <option value="{{ $j->id_jeniskopi }}">{{ $j->nama_jenis }}</option> @endforeach
                </select>
            </div>
            <div class="form-group"><label>Foto Produk</label><input type="file" name="foto_produk" required></div>
            <div class="form-group"><label>Deskripsi</label><textarea name="deskripsi_produk" rows="3"></textarea></div>
            <hr class="divider">
            <div style="display:flex; gap:12px;">
                <button type="submit" class="btn-add">Simpan Produk</button>
                <button type="button" class="btn-add" style="background:#eee; color:#333;" onclick="tutupModal('modalTambah')">Batal</button>
            </div>
        </form>
    </div>
</div>

<div class="modal-overlay" id="modalEdit">
    <div class="modal-box">
        <h2>Edit Produk</h2>
        <form id="formEdit" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group"><label>Nama Produk</label><input type="text" name="nama_produk" id="edit_nama" required></div>
            
            <div style="display:flex; gap:15px; flex-wrap: wrap;">
                <div class="form-group" style="flex:1;"><label>Harga (Rp)</label><input type="number" name="harga_produk" id="edit_harga" required></div>
                <div class="form-group" style="flex:1;"><label>Status</label>
                    <select name="status_produk" id="edit_status">
                        <option value="tersedia">Tersedia</option>
                        <option value="habis">Habis</option>
                    </select>
                </div>
            </div>

            <div style="display:flex; gap:15px; flex-wrap: wrap;">
                <div class="form-group" style="flex:1;">
                    <label>Kategori</label>
                    <select name="id_kategori" id="edit_kategori" required>
                        @foreach($kategori as $k)
                            <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" style="flex:1;">
                    <label>Jenis Kopi</label>
                    <select name="id_jeniskopi" id="edit_jeniskopi" required>
                        @foreach($jenisKopi as $j)
                            <option value="{{ $j->id_jeniskopi }}">{{ $j->nama_jenis }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group"><label>Ganti Foto (Opsional)</label><input type="file" name="foto_produk"></div>
            <div class="form-group"><label>Deskripsi</label><textarea name="deskripsi_produk" id="edit_deskripsi" rows="3"></textarea></div>
            <hr class="divider">
            <div style="display:flex; gap:12px;">
                <button type="submit" class="btn-add">Update Produk</button>
                <button type="button" class="btn-add" style="background:#eee; color:#333;" onclick="tutupModal('modalEdit')">Batal</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function toggleSidebar() {
        document.querySelector('.sidebar').classList.toggle('active');
    }

    // Menutup sidebar ketika klik di luar sidebar (khusus tampilan mobile)
    document.addEventListener('click', function(event) {
        const sidebar = document.querySelector('.sidebar');
        const toggleBtn = document.querySelector('.mobile-toggle');
        
        if (sidebar.classList.contains('active') && !sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
            sidebar.classList.remove('active');
        }
    });

    function bukaModalTambah() { document.getElementById('modalTambah').classList.add('show'); }
    function tutupModal(id) { document.getElementById(id).classList.remove('show'); }
    
    function bukaModalEdit(id, nama, harga, status, deskripsi, id_kat, id_jenis) {
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_harga').value = harga;
        document.getElementById('edit_status').value = status;
        document.getElementById('edit_deskripsi').value = deskripsi;
        
        if(document.getElementById('edit_kategori')) {
            document.getElementById('edit_kategori').value = id_kat;
        }
        if(document.getElementById('edit_jeniskopi')) {
            document.getElementById('edit_jeniskopi').value = id_jenis;
        }

        document.getElementById('formEdit').action = "{{ url('admin/menu/update') }}/" + id;
        
        document.getElementById('modalEdit').classList.add('show');
    }

    document.addEventListener("DOMContentLoaded", function () {
        document.querySelector('.btn-logout').addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin logout?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => { if (result.isConfirmed) window.location.href = this.href; });
        });

        document.querySelectorAll('.btn-delete-item').forEach(el => {
            el.addEventListener('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Hapus data ini?',
                    text: "Tindakan ini tidak bisa dibatalkan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    confirmButtonText: 'Ya, Hapus'
                }).then((result) => { if (result.isConfirmed) window.location.href = this.href; });
            });
        });

        document.querySelectorAll('.btn-delete-produk').forEach(el => {
            el.addEventListener('click', function(e) {
                e.preventDefault();
                const url = this.href;
                
                Swal.fire({
                    title: 'Hapus Produk?',
                    text: "Data produk akan dihapus permanen dari database!",
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus Permanen',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = url;
                    }
                });
            });
        });
    });
</script>

@if(session('success'))
<script>
    Swal.fire({ icon: 'success', title: 'Berhasil!', text: "{{ session('success') }}", timer: 2000, showConfirmButton: false });
</script>
@endif

</body>
</html>