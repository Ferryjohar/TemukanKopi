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

        /* MAIN CONTENT */
        .main-content {
            margin-left: 280px;
            flex: 1;
            padding: 60px;
        }

        .header-title h1 { font-size: 32px; margin-bottom: 5px; color: var(--text-dark); }
        
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 30px 0;
        }

        .search-wrapper input {
            width: 350px;
            padding: 12px;
            border-radius: 12px;
            border: 1px solid #ddd;
            outline: none;
        }

        .btn-add {
            background-color: var(--primary-green);
            padding: 12px 20px;
            border-radius: 12px;
            color: white;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: 0.3s;
        }

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
            color: var(--text-dark);
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

        .badge-active { background-color: #76e09e; padding: 5px 12px; border-radius: 20px; font-size: 13px; font-weight: bold; }
        .badge-inactive { background-color: #ffb3b3; padding: 5px 12px; border-radius: 20px; font-size: 13px; font-weight: bold; }

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
            width: 550px;
        }
        .form-group { margin-bottom: 15px; display: flex; flex-direction: column; gap: 5px; }
        .form-group input, .form-group select, .form-group textarea {
            padding: 10px 14px; border-radius: 10px; border: 1px solid #ddd; outline: none;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="logo-text">temukan kopi.</div>
    <ul class="nav-menu">
        <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link">Data Admin</a></li>
        <li class="nav-item"><a href="{{ route('admin.transaksi') }}" class="nav-link">Transaksi</a></li>
        <li class="nav-item"><a href="{{ route('admin.menu') }}" class="nav-link active">Produk</a></li>
        <li class="nav-item"><a href="{{ route('admin.logout') }}" class="nav-link" style="color:#ff4d4d;">Logout</a></li>
    </ul>
</div>

<div class="main-content">
    <div class="header-title">
        <h1>Manajemen Produk</h1>
        <p>Total {{ count($produk) }} Produk Tersedia</p>
    </div>

    @if(session('success'))
        <div style="background:#d4edda; color:#155724; padding:15px; margin:20px 0; border-radius:10px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="top-bar">
        <div class="search-wrapper">
            <input type="text" placeholder="Cari nama produk...">
        </div>
        <button class="btn-add" onclick="bukaModalTambah()">+ Tambah Produk</button>
    </div>

    <div style="width: 100%; margin-bottom: 50px;">
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
                <tr class="row-shadow">
                    <td style="display:flex; align-items:center;">
                        <img src="{{ asset('storage/produk/'.$item->foto_produk) }}" class="prod-img" onerror="this.src='{{ asset('images/default.png') }}'">
                        <b>{{ $item->nama_produk }}</b>
                    </td>
                    <td>{{ $item->nama_kategori }}</td>
                    <td style="font-weight: bold; color: var(--primary-green);">Rp {{ number_format($item->harga_produk, 0, ',', '.') }}</td>
                    <td>
                        <span class="{{ $item->status_produk == 'tersedia' ? 'badge-active' : 'badge-inactive' }}">
                            {{ ucfirst($item->status_produk) }}
                        </span>
                    </td>
                    <td>
                        <div style="display:flex; gap:15px;">
                            <button class="action-link" style="color:#007bff;" 
                                onclick="bukaModalEdit('{{ $item->id_produk }}', '{{ addslashes($item->nama_produk) }}', '{{ $item->harga_produk }}', '{{ $item->status_produk }}', '{{ addslashes($item->deskripsi_produk) }}')">
                                Edit
                            </button>
                            @if($item->status_produk == 'tersedia')
                                <a href="{{ route('admin.menu.hapus', $item->id_produk) }}" class="action-link" style="color:#dc3545;">Set Habis</a>
                            @else
                                <a href="{{ route('admin.menu.aktifkan', $item->id_produk) }}" class="action-link" style="color:#28a745;">Aktifkan</a>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="width: 100%; display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 30px; margin-top: 20px;">
        
        <div style="background: white; padding: 25px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #eee;">
            <h3 style="color: var(--primary-green); margin-top: 0; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; font-size: 18px;">
                📁 Manajemen Kategori
            </h3>
            <form action="{{ route('admin.kategori.store') }}" method="POST" style="display: flex; gap: 10px; margin-bottom: 20px;">
                @csrf
                <input type="text" name="nama_kategori" placeholder="Tambah kategori..." required style="flex: 1; background: #fafafa;">
                <button type="submit" class="btn-add" style="padding: 10px 15px;">+</button>
            </form>
            <div style="max-height: 200px; overflow-y: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    @foreach($kategori as $k)
                    <tr style="border-bottom: 1px solid #f5f5f5;">
                        <td style="padding: 12px 0; font-size: 14px;">{{ $k->nama_kategori }}</td>
                        <td style="text-align: right;">
                            <a href="{{ route('admin.kategori.destroy', $k->id_kategori) }}" style="color:#dc3545; text-decoration:none; font-weight:bold; font-size:12px;" onclick="return confirm('Hapus?')">Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>

        <div style="background: white; padding: 25px; border-radius: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #eee;">
            <h3 style="color: #8d6e63; margin-top: 0; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; font-size: 18px;">
                ☕ Manajemen Jenis Kopi
            </h3>
            <form action="{{ route('admin.jenis.store') }}" method="POST" style="display: flex; gap: 10px; margin-bottom: 20px;">
                @csrf
                <input type="text" name="nama_jenis" placeholder="Tambah jenis..." required style="flex: 1; background: #fafafa;">
                <button type="submit" class="btn-add" style="padding: 10px 15px; background: #8d6e63;">+</button>
            </form>
            <div style="max-height: 200px; overflow-y: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    @foreach($jenisKopi as $j)
                    <tr style="border-bottom: 1px solid #f5f5f5;">
                        <td style="padding: 12px 0; font-size: 14px;">{{ $j->nama_jenis }}</td>
                        <td style="text-align: right;">
                            <a href="{{ route('admin.jenis.destroy', $j->id_jeniskopi) }}" style="color:#dc3545; text-decoration:none; font-weight:bold; font-size:12px;" onclick="return confirm('Hapus?')">Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div> <div class="modal-overlay" id="modalTambah">
    <div class="modal-box">
        <h2 style="color: var(--primary-green);">Tambah Produk</h2>
        <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group"><label>Nama Produk</label><input type="text" name="nama_produk" required></div>
            <div style="display:flex; gap:15px;">
                <div class="form-group" style="flex:1;"><label>Harga</label><input type="number" name="harga_produk" required></div>
                <div class="form-group" style="flex:1;"><label>Kategori</label>
                    <select name="id_kategori">@foreach($kategori as $k) <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option> @endforeach</select>
                </div>
            </div>
            <div class="form-group"><label>Jenis Kopi</label>
                <select name="id_jeniskopi">@foreach($jenisKopi as $j) <option value="{{ $j->id_jeniskopi }}">{{ $j->nama_jenis }}</option> @endforeach</select>
            </div>
            <div class="form-group"><label>Foto</label><input type="file" name="foto_produk" required></div>
            <div class="form-group"><label>Deskripsi</label><textarea name="deskripsi_produk" rows="3"></textarea></div>
            <div style="display:flex; gap:10px; margin-top:20px;">
                <button type="submit" class="btn-add" style="flex:1;">Simpan</button>
                <button type="button" onclick="tutupModal('modalTambah')" style="flex:1; background:#eee; color:#333; border:none; border-radius:10px; cursor:pointer;">Batal</button>
            </div>
        </form>
    </div>
</div>

<div class="modal-overlay" id="modalEdit">
    <div class="modal-box">
        <h2 style="color: var(--primary-green);">Edit Produk</h2>
        <form id="formEdit" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group"><label>Nama</label><input type="text" name="nama_produk" id="edit_nama" required></div>
            <div style="display:flex; gap:15px;">
                <div class="form-group" style="flex:1;"><label>Harga</label><input type="number" name="harga_produk" id="edit_harga" required></div>
                <div class="form-group" style="flex:1;"><label>Status</label>
                    <select name="status_produk" id="edit_status"><option value="tersedia">Tersedia</option><option value="habis">Habis</option></select>
                </div>
            </div>
            <div class="form-group"><label>Foto Baru (Opsional)</label><input type="file" name="foto_produk"></div>
            <div class="form-group"><label>Deskripsi</label><textarea name="deskripsi_produk" id="edit_deskripsi" rows="3"></textarea></div>
            <div style="display:flex; gap:10px; margin-top:20px;">
                <button type="submit" class="btn-add" style="flex:1;">Update</button>
                <button type="button" onclick="tutupModal('modalEdit')" style="flex:1; background:#eee; color:#333; border:none; border-radius:10px; cursor:pointer;">Batal</button>
            </div>
        </form>
    </div>
</div>

<script>
    function bukaModalTambah() { document.getElementById('modalTambah').classList.add('show'); }
    function tutupModal(id) { document.getElementById(id).classList.remove('show'); }
    function bukaModalEdit(id, nama, harga, status, deskripsi) {
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_harga').value = harga;
        document.getElementById('edit_status').value = status;
        document.getElementById('edit_deskripsi').value = deskripsi;
        document.getElementById('formEdit').action = "{{ url('admin/menu/update') }}/" + id;
        document.getElementById('modalEdit').classList.add('show');
    }
</script>

</body>
</html>