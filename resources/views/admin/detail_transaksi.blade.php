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

/* Sidebar Konsisten */
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

.nav-menu { list-style: none; padding: 0; }
.nav-item { margin-bottom: 10px; }
.nav-link {
    display: flex;
    align-items: center;
    padding: 12px 20px;
    color: #ffffffb3;
    text-decoration: none;
    border-radius: 10px;
}
.nav-link.active { background-color: white; color: var(--primary-green); font-weight: bold; }

/* Main Content */
.main-content {
    margin-left: 280px;
    flex: 1;
    padding: 60px;
}

.header-title h1 { font-size: 32px; margin-bottom: 5px; color: var(--text-dark); }
.header-title p { color: #666; margin-top: 0; }

/* Info Card */
.info-card {
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    margin-bottom: 30px;
    display: flex;
    justify-content: space-between;
}

.info-group h4 { margin: 0 0 5px 0; color: #888; font-size: 13px; text-transform: uppercase; }
.info-group p { margin: 0; font-weight: bold; color: var(--text-dark); }

/* Table Detail */
.data-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 15px;
}

.data-table th { padding: 15px; background-color: #e2e2e2; text-align: left; }
.data-table td { background-color: white; padding: 15px; vertical-align: middle; }
.row-shadow { box-shadow: 0 4px 15px rgba(0,0,0,0.05); }

.btn-back {
    display: inline-block;
    margin-bottom: 20px;
    text-decoration: none;
    color: var(--primary-green);
    font-weight: bold;
}
@media print {
        .sidebar, .btn-back, .btn-print-trigger {
            display: none !important; /* Sembunyikan navigasi saat dicetak */
        }
        .main-content {
            margin-left: 0 !important;
            padding: 0 !important;
        }
        body {
            background-color: white !important;
        }
        .info-card, .data-table td {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
        }
    }

    .btn-print-trigger {
        background-color: #28a745;
        color: white;
        padding: 10px 20px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: bold;
        border: none;
        cursor: pointer;
        float: right;
    }
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
    <a href="{{ route('admin.transaksi') }}" class="btn-back">← Kembali ke Daftar Transaksi</a>

    <button onclick="window.print()" class="btn-print-trigger">
        🖨️ Cetak Invoice
    </button>

    <div class="header-title">
        <h1>Rincian Pesanan #{{ $pesanan->id_pesanan }}</h1>
        <p>Tanggal: {{ date('d M Y, H:i', strtotime($pesanan->tanggal_pesan)) }}</p>
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
            <p style="color: var(--primary-green); font-size: 18px;">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</p>
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
                <td><b>{{ $d->nama_produk }}</b></td>
                <td>Rp {{ number_format($d->harga, 0, ',', '.') }}</td>
                <td>{{ $d->jumlah }}</td>
                <td><b>Rp {{ number_format($d->subtotal, 0, ',', '.') }}</b></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 30px;">
        <p>Catatan: <i>{{ $pesanan->catatan ?? 'Tidak ada catatan.' }}</i></p>
    </div>
</div>

</body>
</html>
<script>
    // Jika URL mengandung '?print=true', otomatis buka dialog cetak
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('print')) {
        window.print();
    }
</script>