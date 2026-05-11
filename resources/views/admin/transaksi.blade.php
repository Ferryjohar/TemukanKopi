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

.main-content {
    margin-left: 280px;
    flex: 1;
    padding: 60px;
    position: relative;
    z-index: 10;
}

.header-title h1 { font-size: 32px; margin-bottom: 5px; color: var(--text-dark); }
.header-title p { color: #666; margin-top: 0; }

.filter-bar {
    display: flex; gap: 10px; align-items: flex-end; flex-wrap: wrap;
    margin: 30px 0; background: white; padding: 20px; border-radius: 14px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}

.filter-group { display: flex; flex-direction: column; gap: 5px; }
.filter-group label { font-size: 12px; color: #666; font-weight: 600; }

.search-input-wrapper {
    display: flex; align-items: center; border: 1px solid #ddd; border-radius: 10px;
    overflow: hidden; background: #fafafa; transition: border 0.2s;
}
.search-input-wrapper:focus-within { border-color: var(--primary-green); background: white; }
.search-input-wrapper input[type="text"] {
    border: none; outline: none; padding: 10px 14px; font-size: 14px;
    font-family: 'Segoe UI', sans-serif; background: transparent; width: 250px; 
}

.btn-search {
    padding: 10px 18px; background: var(--primary-green); color: white; border: none;
    cursor: pointer; font-size: 14px; font-family: 'Segoe UI', sans-serif; font-weight: 600;
    transition: opacity 0.2s; white-space: nowrap;
}
.btn-search:hover { opacity: 0.85; }

.filter-group input[type="date"] {
    padding: 10px 14px; border-radius: 10px; border: 1px solid #ddd; outline: none;
    font-size: 14px; font-family: 'Segoe UI', sans-serif; background: #fafafa; transition: border 0.2s; cursor: pointer;
}
.filter-group input[type="date"]:focus { border-color: var(--primary-green); background: white; }
.filter-group input[type="date"]:disabled { background: #f0f0f0; color: #aaa; cursor: not-allowed; border-color: #e0e0e0; }

.btn-reset {
    padding: 10px 22px; background: #e2e2e2; color: #333; border: none; border-radius: 10px;
    cursor: pointer; font-size: 14px; font-family: 'Segoe UI', sans-serif; text-decoration: none;
    display: inline-flex; align-items: center; transition: background 0.2s;
}
.btn-reset:hover { background: #d0d0d0; }

.checkbox-semua {
    display: flex; align-items: center; gap: 8px; padding: 10px 16px; background: #f0f7f4;
    border: 1px solid #b2d8c8; border-radius: 10px; cursor: pointer; font-size: 14px;
    color: var(--primary-green); font-weight: 600; transition: background 0.2s; user-select: none;
}
.checkbox-semua:hover { background: #d9efe7; }
.checkbox-semua input[type="checkbox"] { width: 16px; height: 16px; accent-color: var(--primary-green); cursor: pointer; }

.filter-active-info {
    background: #d4edda; color: #155724; padding: 10px 16px; margin-bottom: 10px;
    border-radius: 10px; border: 1px solid #c3e6cb; font-size: 14px;
}

.data-table { width: 100%; border-collapse: separate; border-spacing: 0 15px; }
.data-table th { padding: 15px; background-color: #e2e2e2; text-align: left; color: var(--text-dark); }
.data-table td { background-color: white; padding: 15px; vertical-align: middle; }
.row-shadow { box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
.avatar { width: 40px; height: 40px; border-radius: 50%; margin-right: 15px; object-fit: cover; }
.action-link { text-decoration: none; font-weight: bold; font-size: 14px; cursor: pointer; }
.address-text { max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-size: 14px; color: #555; }

.modal-overlay {
    display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 9999;
    justify-content: center; align-items: center; backdrop-filter: blur(3px);
}
.modal-overlay.show { display: flex; }

.modal-box {
    background: white; border-radius: 20px; position: relative; padding: 30px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.2); animation: fadeUp 0.3s ease;
    max-height: 90vh; overflow-y: auto;
}
.modal-close {
    position: absolute; top: 15px; right: 20px; font-size: 28px; cursor: pointer; color: #999;
    background: none; border: none; line-height: 1; z-index: 100; transition: color 0.2s;
}
.modal-close:hover { color: #333; }

.form-group { margin-bottom: 15px; }
.form-group label { display: block; margin-bottom: 5px; font-size: 13px; font-weight: 700; color: #444; }
.form-group input, .form-group textarea {
    width: 100%; padding: 10px 14px; border-radius: 10px; border: 1px solid #ddd;
    outline: none; background: #fafafa; font-family: 'Segoe UI', sans-serif; box-sizing: border-box;
}
.form-group input:focus, .form-group textarea:focus { border-color: var(--primary-green); background: white; }

@keyframes fadeUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

.mobile-toggle {
    display: none; position: fixed; top: 20px; right: 20px; z-index: 1001;
    background: var(--primary-green); color: white; border: none; padding: 10px 15px;
    border-radius: 8px; cursor: pointer; font-weight: bold; box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

@media (max-width: 1024px) {
    .sidebar { width: 240px; }
    .main-content { margin-left: 240px; padding: 40px; }
}

@media (max-width: 768px) {
    .mobile-toggle { display: block; }
    .sidebar { left: -280px; transition: left 0.3s ease; box-shadow: 2px 0 15px rgba(0,0,0,0.2); }
    .sidebar.active { left: 0; }
    .main-content { margin-left: 0; padding: 20px; padding-top: 80px; }
    
    .filter-bar { flex-direction: column; align-items: stretch; gap: 15px; }
    .search-input-wrapper { width: 100%; }
    .search-input-wrapper input[type="text"] { width: 100%; }
    .btn-search { width: auto; }
    .checkbox-semua { justify-content: center; }
    .btn-reset { text-align: center; justify-content: center; }

    .data-table thead { display: none; }
    .data-table, .data-table tbody, .data-table tr { display: block; width: 100%; }
    .data-table tr { margin-bottom: 20px; border-radius: 15px; overflow: hidden; border: 1px solid #ddd; background: white; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
    .data-table td { display: flex !important; justify-content: flex-end; align-items: center; padding: 15px !important; border-bottom: 1px solid #f1f1f1; text-align: right; }
    .data-table td::before { content: attr(data-label); font-weight: 700; color: var(--primary-green); margin-right: auto; text-align: left; }
    .data-table td:last-child { border-bottom: none; }
    .address-text { text-align: right; }
    
    .modal-box { width: 95% !important; padding: 20px; }
}
</style>
</head>

<body>

<button class="mobile-toggle" onclick="toggleSidebar()">☰ Menu</button>

<div class="sidebar">
    <div class="logo-text">temukan kopi.</div>

    <ul class="nav-menu">
        @if(strtolower(session('role_admin')) === 'superadmin')
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard*') ? 'active' : '' }}">Data Admin</a>
            </li>
        @else
            <li class="nav-item">
                <a href="{{ route('admin.dashboard_khusus') }}" class="nav-link {{ Route::is('admin.dashboard_khusus*') ? 'active' : '' }}">Data Admin</a>
            </li>
        @endif

        <li class="nav-item">
            <a href="{{ route('admin.transaksi') }}" class="nav-link {{ Route::is('admin.transaksi*') ? 'active' : '' }}">Transaksi</a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.menu') }}" class="nav-link {{ Route::is('admin.menu*') ? 'active' : '' }}">Produk</a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.logout') }}" class="nav-link logout-btn" style="color:#ff4d4d;">Logout</a>
        </li>
    </ul>
</div>

<div class="main-content">

    <div class="header-title">
        <h1>Kelola Transaksi</h1>
        <p>Total {{ $totalTransaksi }} Transaksi Terdaftar</p>
        <p>Login sebagai: <b>{{ session('nama_admin') }}</b></p>
    </div>

    @if(session('success'))
        <div style="background:#d4edda; color: #155724; padding:15px; margin:20px 0; border-radius: 10px; border: 1px solid #c3e6cb;">
            {{ session('success') }}
        </div>
    @endif

    <div class="filter-active-info">
        @if(request('semua') == '1')
            Menampilkan <b>semua</b> transaksi
            @if(request('search')) dengan kata kunci <b>"{{ request('search') }}"</b> @endif
        @else
            Menampilkan transaksi
            @if(request('search')) dengan kata kunci <b>"{{ request('search') }}"</b> @endif
            | Tanggal:
            <b>{{ date('d-m-Y', strtotime(request('dari_tanggal', date('Y-m-d')))) }}</b>
            s/d
            <b>{{ date('d-m-Y', strtotime(request('sampai_tanggal', date('Y-m-d')))) }}</b>
        @endif
        &mdash; <b>{{ $transaksi->count() }}</b> transaksi ditemukan.
    </div>

    <form action="{{ route('admin.transaksi') }}" method="GET" id="filterForm">
        <input type="hidden" name="semua" id="hiddenSemua" value="{{ request('semua', '0') }}">
        <div class="filter-bar">
            <div class="filter-group">
                <label>Cari Pelanggan</label>
                <div class="search-input-wrapper">
                    <input type="text" name="search" id="inputSearch" placeholder="Cari nama pelanggan..." value="{{ request('search') }}">
                    <button type="submit" class="btn-search">Cari</button>
                </div>
            </div>
            <div class="filter-group">
                <label>Dari Tanggal</label>
                <input type="date" name="dari_tanggal" id="dariTanggal" value="{{ request('dari_tanggal', date('Y-m-d')) }}" {{ request('semua') == '1' ? 'disabled' : '' }}>
            </div>
            <div class="filter-group">
                <label>Sampai Tanggal</label>
                <input type="date" name="sampai_tanggal" id="sampaiTanggal" value="{{ request('sampai_tanggal', date('Y-m-d')) }}" {{ request('semua') == '1' ? 'disabled' : '' }}>
            </div>
            <label class="checkbox-semua">
                <input type="checkbox" id="checkSemua" {{ request('semua') == '1' ? 'checked' : '' }}>
                Lihat Semua
            </label>
            <a href="{{ route('admin.transaksi') }}" class="btn-reset">Reset</a>
        </div>
    </form>

    <table class="data-table">
        <thead>
            <tr>
                <th>Pelanggan</th>
                <th>No WhatsApp</th>
                <th>Alamat</th>
                <th>Total Harga</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transaksi as $t)
            <tr class="row-shadow">
                <td data-label="Pelanggan">
                    <div style="display:flex; align-items:center;">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($t->nama_customer) }}&background=004d32&color=fff&bold=true" class="avatar">
                        <span style="font-weight: 600;">{{ $t->nama_customer }}</span>
                    </div>
                </td>
                <td data-label="No WhatsApp">{{ $t->no_wa }}</td>
                <td data-label="Alamat"><div class="address-text" title="{{ $t->alamat }}">{{ $t->alamat }}</div></td>
                <td data-label="Total Harga" style="font-weight: bold; color: var(--primary-green);">
                    Rp {{ number_format($t->total_harga, 0, ',', '.') }}
                </td>
                <td data-label="Tanggal">{{ date('d-m-Y', strtotime($t->tanggal_pesan)) }}</td>
                <td data-label="Aksi">
                    <div style="display: flex; gap: 15px;">
                        <button type="button" class="action-link" style="color: #007bff; border:none; background:none; padding:0;"
                                onclick="tampilDetail('{{ $t->id_pesanan }}', '{{ addslashes($t->nama_customer) }}', '{{ $t->no_wa }}', '{{ addslashes($t->alamat) }}', '{{ $t->total_harga }}', '{{ addslashes($t->catatan) }}')">
                            Detail
                        </button>

                        <button type="button" class="action-link" style="color: #ffc107; border:none; background:none; padding:0;"
                                onclick="tampilEdit('{{ $t->id_pesanan }}', '{{ addslashes($t->nama_customer) }}', '{{ $t->no_wa }}', '{{ addslashes($t->alamat) }}', '{{ addslashes($t->catatan) }}')">
                            Edit
                        </button>

                        <a href="{{ route('admin.transaksi.destroy', $t->id_pesanan) }}" class="action-link btn-delete" style="color: #dc3545;">Hapus</a>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 40px; background: white; border-radius: 15px;">
                    <p style="color: #999; margin: 0;">Tidak ada transaksi pada rentang tanggal ini.</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="modal-overlay" id="modalDetail">
    <div class="modal-box" style="width: 600px; max-width: 95vw;">
        <button class="modal-close" onclick="tutupModal('modalDetail')">&times;</button>
        
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
            <h2 style="color: var(--primary-green); margin: 0;">Detail Pesanan</h2>
            <button onclick="cetakInvoiceDariModal()" class="btn-search" style="background-color: #28a745; padding: 8px 15px; font-size: 13px; border-radius: 8px;">
                🖨️ Cetak Invoice
            </button>
        </div>

        <div id="isiDetail" style="margin-top: 25px; line-height: 1.8;">
            </div>

        <hr style="border: none; border-top: 1px solid #eee; margin: 25px 0;">
        <button class="btn-reset" style="width:100%" onclick="tutupModal('modalDetail')">Tutup</button>
    </div>
</div>

<div class="modal-overlay" id="modalEdit">
    <div class="modal-box" style="width: 500px; max-width: 95vw;">
        <button class="modal-close" onclick="tutupModal('modalEdit')">&times;</button>
        <h2 style="color: var(--primary-green); margin-top: 0;">Edit Data Pelanggan</h2>
        <form id="formEditTransaksi" method="POST" action="">
            @csrf
            <div class="form-group">
                <label>Nama Pelanggan</label>
                <input type="text" name="nama_customer" id="editNama" required>
            </div>
            <div class="form-group">
                <label>No. WhatsApp</label>
                <input type="text" name="no_wa" id="editWa" required>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" id="editAlamat" style="height:80px; resize:vertical;"></textarea>
            </div>
            <div class="form-group">
                <label>Catatan Pesanan</label>
                <textarea name="catatan" id="editCatatan" style="height:80px; resize:vertical;" placeholder="Tambahkan catatan khusus..."></textarea>
            </div>
            <hr style="border: none; border-top: 1px solid #eee; margin: 25px 0;">
            <button type="submit" class="btn-search" style="width:100%; border-radius: 10px;">Simpan Perubahan</button>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
let dataTransaksiAktif = {};

function fmtIdr(n) {
    return 'Rp ' + parseInt(n).toLocaleString('id-ID');
}

function tampilDetail(id, nama, wa, alamat, total, catatan) {
    dataTransaksiAktif = { id, nama, wa, alamat, total, catatan };

    const isi = `
        <div style="background: #fafafa; padding: 15px; border-radius: 10px; border: 1px solid #eee;">
            <p style="margin:0 0 10px 0;"><strong>ID Pesanan:</strong> #${id}</p>
            <p style="margin:0 0 10px 0;"><strong>Nama Pelanggan:</strong> ${nama}</p>
            <p style="margin:0 0 10px 0;"><strong>WhatsApp:</strong> ${wa}</p>
            <p style="margin:0 0 10px 0;"><strong>Alamat Kirim:</strong> ${alamat}</p>
            <p style="margin:0 0 10px 0;"><strong>Total Bayar:</strong> <span style="color:var(--primary-green); font-weight:bold; font-size:16px;">${fmtIdr(total)}</span></p>
            <p style="margin:0;"><strong>Catatan:</strong> <br><i style="color:#666;">${catatan || 'Tidak ada catatan'}</i></p>
        </div>
    `;
    document.getElementById('isiDetail').innerHTML = isi;
    document.getElementById('modalDetail').classList.add('show');
}

function cetakInvoiceDariModal() {
    const d = dataTransaksiAktif;
    const printWindow = window.open('', '_blank');
    
    printWindow.document.write(`
        <html>
        <head>
            <title>Invoice #${d.id}</title>
            <style>
                body { font-family: 'Segoe UI', sans-serif; padding: 40px; color: #333; }
                .header { text-align: center; border-bottom: 2px solid #004d32; padding-bottom: 20px; margin-bottom: 30px; }
                .header h1 { margin: 0; color: #004d32; font-family: 'Georgia', serif; }
                .info-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
                .info-table td { padding: 12px 0; border-bottom: 1px solid #eee; }
                .info-table td:first-child { width: 150px; color: #666; }
                .total-box { background: #f9f9f9; padding: 20px; border-radius: 10px; text-align: right; }
                .total { font-size: 24px; font-weight: bold; color: #004d32; }
                .footer { margin-top: 50px; text-align: center; font-size: 13px; color: #888; }
            </style>
        </head>
        <body>
            <div class="header">
                <h1>TEMUKAN KOPI</h1>
                <p style="margin:5px 0 0 0; color:#666;">Invoice Pesanan #${d.id}</p>
            </div>
            
            <table class="info-table">
                <tr><td><strong>Nama Pelanggan</strong></td><td>: ${d.nama}</td></tr>
                <tr><td><strong>WhatsApp</strong></td><td>: ${d.wa}</td></tr>
                <tr><td><strong>Alamat Pengiriman</strong></td><td>: ${d.alamat}</td></tr>
                <tr><td><strong>Catatan</strong></td><td>: ${d.catatan || '-'}</td></tr>
            </table>
            
            <div class="total-box">
                <span style="color:#666; font-size:14px; display:block; margin-bottom:5px;">Total Tagihan</span>
                <div class="total">${fmtIdr(d.total)}</div>
            </div>
            
            <div class="footer">Terima kasih telah memesan di Temukan Kopi!</div>
            
            <script>
                // Otomatis memicu print saat layar dimuat, lalu menutup tab printnya setelah selesai
                window.onload = function() { 
                    window.print(); 
                    setTimeout(function(){ window.close(); }, 500);
                }
            <\/script>
        </body>
        </html>
    `);
    printWindow.document.close();
}

function tampilEdit(id, nama, wa, alamat, catatan) {
    document.getElementById('formEditTransaksi').action = "{{ url('admin/transaksi/update') }}/" + id;
    document.getElementById('editNama').value = nama;
    document.getElementById('editWa').value = wa;
    document.getElementById('editAlamat').value = alamat;
    document.getElementById('editCatatan').value = catatan;
    document.getElementById('modalEdit').classList.add('show');
}

function tutupModal(id) {
    document.getElementById(id).classList.remove('show');
}

document.querySelectorAll('.modal-overlay').forEach(function(overlay) {
    overlay.addEventListener('click', function(e) {
        if (e.target === overlay) {
            overlay.classList.remove('show');
        }
    });
});

function toggleSidebar() {
    document.querySelector('.sidebar').classList.toggle('active');
}
document.addEventListener('click', function(event) {
    const sidebar = document.querySelector('.sidebar');
    const toggleBtn = document.querySelector('.mobile-toggle');
    if (sidebar.classList.contains('active') && !sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
        sidebar.classList.remove('active');
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const filterForm = document.getElementById('filterForm');
    const dariTanggal = document.getElementById('dariTanggal');
    const sampaiTanggal = document.getElementById('sampaiTanggal');
    const checkSemua = document.getElementById('checkSemua');
    const hiddenSemua = document.getElementById('hiddenSemua');

    dariTanggal.addEventListener('change', function () { if (!checkSemua.checked) filterForm.submit(); });
    sampaiTanggal.addEventListener('change', function () { if (!checkSemua.checked) filterForm.submit(); });

    checkSemua.addEventListener('change', function () {
        if (this.checked) {
            hiddenSemua.value = '1'; dariTanggal.disabled = true; sampaiTanggal.disabled = true;
        } else {
            hiddenSemua.value = '0'; dariTanggal.disabled = false; sampaiTanggal.disabled = false;
        }
        filterForm.submit();
    });

    const swalOptions = { width: '320px', padding: '1.5em', showCancelButton: true, confirmButtonText: 'Ya', cancelButtonText: 'Batal' };

    document.querySelectorAll('.logout-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault(); const href = this.href;
            Swal.fire({ ...swalOptions, title: 'Yakin logout?', icon: 'warning' })
                .then((result) => { if (result.isConfirmed) window.location.href = href; });
        });
    });

    document.querySelectorAll('.btn-delete').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault(); const targetUrl = this.href;
            Swal.fire({ ...swalOptions, title: 'Hapus transaksi?', text: 'Data akan dihapus permanen', icon: 'error', confirmButtonColor: '#dc3545', confirmButtonText: 'Hapus' })
                .then((result) => { if (result.isConfirmed) window.location.href = targetUrl; });
        });
    });
});
</script>

@if(session('success'))
<script>
Swal.fire({ icon: 'success', title: 'Berhasil!', text: "{{ session('success') }}", width: '300px', padding: '1.5em', timer: 2000, showConfirmButton: false });
</script>
@endif

</body>
</html>