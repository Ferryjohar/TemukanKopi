<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Detail Transaksi - Temukan Kopi</title>

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

/* SIDEBAR KONSISTEN */
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

/* INFO CARD */
.info-card {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    margin: 30px 0;
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 20px;
}

.info-group h4 {
    margin: 0 0 5px 0;
    color: #888;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.info-group p {
    margin: 0;
    font-weight: bold;
    color: var(--text-dark);
}

/* TABLE DETAIL */
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

.row-shadow {
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}

/* BUTTONS */
.btn-back {
    display: inline-block;
    margin-bottom: 20px;
    text-decoration: none;
    color: var(--primary-green);
    font-weight: bold;
    transition: 0.2s;
}

.btn-back:hover { opacity: 0.7; }

.btn-print-trigger {
    background-color: #28a745;
    color: white;
    padding: 12px 24px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: bold;
    border: none;
    cursor: pointer;
    float: right;
    transition: 0.3s;
    box-shadow: 0 4px 10px rgba(40, 167, 69, 0.2);
}

.btn-print-trigger:hover {
    background-color: #218838;
    transform: translateY(-2px);
}

/* PRINT OPTIMIZATION */
@media print {
    .sidebar, .btn-back, .btn-print-trigger {
        display: none !important;
    }
    .main-content {
        margin-left: 0 !important;
        padding: 0 !important;
    }
    body {
        background-color: white !important;
    }
    .info-card {
        box-shadow: none !important;
        border: 1px solid #eee !important;
        margin: 20px 0 !important;
    }
    .data-table td {
        box-shadow: none !important;
        border-bottom: 1px solid #eee !important;
    }
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
                   class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
                    Data Admin
                </a>
            </li>
        @else
            <li class="nav-item">
                <a href="{{ route('admin.dashboard_khusus') }}" 
                   class="nav-link {{ Route::is('admin.dashboard_khusus') ? 'active' : '' }}">
                    Dashboard
                </a>
            </li>
        @endif

        <li class="nav-item">
            <a href="{{ route('admin.transaksi') }}" 
               class="nav-link active">
                Transaksi
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.menu') }}" 
               class="nav-link">
                Produk
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.logout') }}" 
               class="nav-link logout-btn" style="color:#ff4d4d;">
                Logout
            </a>
        </li>
    </ul>
</div>

<div class="main-content">
    <a href="{{ route('admin.transaksi') }}" class="btn-back">← Kembali ke Daftar</a>

    <button onclick="window.print()" class="btn-print-trigger">
        🖨️ Cetak Invoice
    </button>

    <div class="header-title">
        <h1>Rincian Pesanan #{{ $pesanan->id_pesanan }}</h1>
        <p>Waktu Pesan: {{ date('d M Y, H:i', strtotime($pesanan->tanggal_pesan)) }}</p>
    </div>

    <div class="info-card">
        <div class="info-group">
            <h4>Nama Pelanggan</h4>
            <p>{{ $pesanan->nama_customer }}</p>
        </div>
        <div class="info-group">
            <h4>Nomor WhatsApp</h4>
            <p>{{ $pesanan->no_wa }}</p>
        </div>
        <div class="info-group">
            <h4>Alamat Kirim</h4>
            <p>{{ $pesanan->alamat }}</p>
        </div>
        <div class="info-group">
            <h4>Total Bayar</h4>
            <p style="color: var(--primary-green); font-size: 18px;">
                Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
            </p>
        </div>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($details as $d)
            <tr class="row-shadow">
                <td><b style="color: var(--primary-green);">{{ $d->nama_produk }}</b></td>
                <td>Rp {{ number_format($d->harga, 0, ',', '.') }}</td>
                <td>{{ $d->jumlah }}</td>
                <td><b>Rp {{ number_format($d->subtotal, 0, ',', '.') }}</b></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 30px; background: white; padding: 20px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
        <h4 style="margin: 0 0 10px 0; font-size: 13px; color: #888; text-transform: uppercase;">Catatan Tambahan</h4>
        <p style="margin: 0; color: #555;"><i>{{ $pesanan->catatan ?? 'Tidak ada catatan untuk pesanan ini.' }}</i></p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // SweetAlert Logout
    document.querySelectorAll('.logout-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin logout?',
                icon: 'warning',
                width: '320px',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#004d32'
            }).then((result) => {
                if (result.isConfirmed) window.location.href = this.href;
            });
        });
    });

    // Auto Print jika ada parameter ?print di URL
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('print')) {
        window.print();
    }
</script>

</body>
</html>