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
    font-family: 'Segoe UI', sans-serif;
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
    font-family: 'Segoe UI', sans-serif;
    font-size: 14px;
    transition: opacity 0.2s;
}

.btn-add:hover { opacity: 0.85; }

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

.action-link { text-decoration: none; font-weight: bold; cursor: pointer; font-size: 14px; }
.row-shadow { box-shadow: 0 4px 15px rgba(0,0,0,0.05); }

.badge-active {
    background-color: #76e09e;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 14px;
}

.badge-inactive {
    background-color: #ffb3b3;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 14px;
}

.avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 15px;
    object-fit: cover;
}

/* ===================== MODAL ===================== */
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
    width: 620px;
    max-width: 95vw;
    max-height: 90vh;
    overflow-y: auto;
    position: relative;
    box-shadow: 0 10px 40px rgba(0,0,0,0.2);
}

.modal-box h2 {
    margin: 0 0 25px;
    font-size: 22px;
    color: var(--primary-green);
    font-weight: 800;
}

.modal-close {
    position: absolute;
    top: 16px;
    right: 20px;
    font-size: 24px;
    cursor: pointer;
    color: #999;
    background: none;
    border: none;
    line-height: 1;
}

.modal-close:hover { color: #333; }

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin-bottom: 16px;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.form-group label {
    font-size: 13px;
    font-weight: 700;
    color: #444;
}

.form-group input[type="text"],
.form-group input[type="password"],
.form-group select {
    padding: 10px 14px;
    border-radius: 10px;
    border: 1px solid #ddd;
    font-size: 14px;
    font-family: 'Segoe UI', sans-serif;
    outline: none;
    background: #fafafa;
    transition: border 0.2s;
    box-sizing: border-box;
    width: 100%;
}

.form-group input:focus,
.form-group select:focus {
    border-color: var(--primary-green);
    background: white;
}

.avatar-section {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-right: 24px;
    border-right: 1px solid #eee;
    margin-right: 8px;
    gap: 12px;
}

.avatar-upload {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid white;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.upload-btn-label {
    display: inline-block;
    padding: 8px 16px;
    background: #f0f0f0;
    border-radius: 20px;
    cursor: pointer;
    font-size: 12px;
    font-weight: 700;
    color: #444;
    border: 1px solid #ddd;
    transition: background 0.2s;
    white-space: nowrap;
}

.upload-btn-label:hover { background: #e0e0e0; }

.foto-hint {
    font-size: 11px;
    color: #999;
    text-align: center;
}

.edit-body {
    display: flex;
    gap: 0;
    align-items: flex-start;
}

.edit-fields { flex: 1; }

.divider {
    border: none;
    border-top: 1px solid #eee;
    margin: 20px 0;
}

.btn-submit {
    background: var(--primary-green);
    color: white;
    border: none;
    border-radius: 12px;
    padding: 12px 30px;
    font-weight: bold;
    font-size: 15px;
    font-family: 'Segoe UI', sans-serif;
    cursor: pointer;
    transition: opacity 0.2s;
}

.btn-submit:hover { opacity: 0.85; }

.btn-cancel-modal {
    background: #eee;
    color: #333;
    border: none;
    border-radius: 12px;
    padding: 12px 24px;
    font-size: 14px;
    font-family: 'Segoe UI', sans-serif;
    cursor: pointer;
    transition: background 0.2s;
}

.btn-cancel-modal:hover { background: #ddd; }
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
            <a href="{{ route('admin.logout') }}" class="nav-link btn-logout" style="color:#ff4d4d;">
                Logout
            </a>
        </li>
    </ul>
</div>

<div class="main-content">

    <div class="header-title">
        <h1>Kelola Data Admin</h1>
        <p>Total {{ $totalAdmin }} Admin</p>
        <p>Login sebagai: <b>{{ session('nama_admin') }}</b></p>
    </div>

    @if(session('success'))
        <div style="background:#d4edda; color:#155724; padding:15px; margin:20px 0; border-radius:10px; border:1px solid #c3e6cb;">
            {{ session('success') }}
        </div>
    @endif

    <div class="top-bar">
        <div class="search-wrapper">
            <form action="" method="GET">
                <input type="text" name="search" placeholder="Cari admin..." value="{{ request('search') }}">
            </form>
        </div>
        <button class="btn-add" onclick="bukaModalTambah()">+ Tambah Admin</button>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Role</th>
                <th>Status</th>
                <th>Update</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $admin)
            <tr class="row-shadow">
                <td style="display:flex; align-items:center;">
                    @php
                        $fotoPath    = 'avatars/' . $admin->foto_admin;
                        $fileTersedia = !blank($admin->foto_admin) && Storage::disk('public')->exists($fotoPath);
                        $fotoUrl     = $fileTersedia ? asset('storage/' . $fotoPath) : asset('images/user.png');
                    @endphp
                    <img src="{{ $fotoUrl }}" class="avatar" alt="Foto Admin">
                    {{ $admin->nama }}
                </td>
                <td>{{ ucfirst($admin->role) }}</td>
                <td>
                    <span class="{{ $admin->status_admin == 'aktif' ? 'badge-active' : 'badge-inactive' }}">
                        {{ $admin->status_admin }}
                    </span>
                </td>
                <td>{{ $admin->updated_at ? date('d-m-Y', strtotime($admin->updated_at)) : '-' }}</td>
                <td>
                    <div style="display:flex; gap:15px;">
                        <button class="action-link"
                            style="color:#007bff; background:none; border:none; padding:0;"
                            onclick="bukaModalEdit(
                                {{ $admin->id_user }},
                                '{{ addslashes($admin->nama) }}',
                                '{{ addslashes($admin->username) }}',
                                '{{ $admin->no_hp }}',
                                '{{ $admin->role }}',
                                '{{ $admin->status_admin }}',
                                '{{ $fotoUrl }}'
                            )">
                            Edit
                        </button>

                        <a href="{{ route('admin.destroy', $admin->id_user) }}"
                           class="action-link btn-delete" style="color:#dc3545;">
                            Hapus
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


{{-- ===================== MODAL TAMBAH ADMIN ===================== --}}
<div class="modal-overlay" id="modalTambah">
    <div class="modal-box">
        <button class="modal-close" onclick="tutupModal('modalTambah')">&times;</button>
        <h2>Tambah Admin Baru</h2>

        <form action="{{ route('admin.store') }}" method="POST">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama" placeholder="Masukkan nama..." required>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Masukkan username..." required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Masukkan password..." required>
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="role">
                        <option value="admin">Admin</option>
                        <option value="superadmin">Superadmin</option>
                    </select>
                </div>
            </div>

            <hr class="divider">

            <div style="display:flex; gap:12px;">
                <button type="submit" class="btn-submit">Simpan Admin</button>
                <button type="button" class="btn-cancel-modal" onclick="tutupModal('modalTambah')">Batal</button>
            </div>
        </form>
    </div>
</div>


{{-- ===================== MODAL EDIT ADMIN ===================== --}}
<div class="modal-overlay" id="modalEdit">
    <div class="modal-box">
        <button class="modal-close" onclick="tutupModal('modalEdit')">&times;</button>
        <h2>Edit Profil Admin</h2>

        {{-- 
            Action di-set dinamis lewat JS pakai route admin.update
            Route: POST /admin/update-admin/{id}
        --}}
        <form id="formEdit" action="" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="edit-body">
                {{-- Kolom kiri: foto --}}
                <div class="avatar-section">
                    <img src="" id="previewFotoEdit" class="avatar-upload" alt="Foto Admin">
                    <label class="upload-btn-label" for="inputFotoEdit">Ganti Foto</label>
                    <input type="file" name="foto_admin" id="inputFotoEdit" accept="image/*"
                           style="display:none;"
                           onchange="previewFoto(this, 'previewFotoEdit')">
                    <p class="foto-hint">Format: JPG, PNG<br>Maks 2MB</p>
                </div>

                {{-- Kolom kanan: field --}}
                <div class="edit-fields">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama" id="editNama" placeholder="Nama lengkap..." required>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" id="editUsername" placeholder="Username..." required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Password Baru <span style="color:#999; font-weight:400;">(opsional)</span></label>
                            <input type="password" name="password" placeholder="Kosongkan jika tidak diganti">
                        </div>
                        <div class="form-group">
                            <label>Nomor HP</label>
                            <input type="text" name="no_hp" id="editNoHp" placeholder="Nomor HP...">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Role</label>
                            <select name="role" id="editRole">
                                <option value="admin">Admin</option>
                                <option value="superadmin">Superadmin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status_admin" id="editStatus">
                                <option value="aktif">Aktif</option>
                                <option value="tidak aktif">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="divider">

            <div style="display:flex; gap:12px;">
                <button type="submit" class="btn-submit">Simpan Perubahan</button>
                <button type="button" class="btn-cancel-modal" onclick="tutupModal('modalEdit')">Batal</button>
            </div>
        </form>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Base URL route admin.update — sesuai web.php: POST /admin/update-admin/{id}
    const urlUpdateAdmin = "{{ url('admin/update-admin') }}";

function bukaModalTambah() {
    document.getElementById('modalTambah').classList.add('show');
}

function bukaModalEdit(id, nama, username, noHp, role, status, fotoUrl) {
    // Set action form pakai URL yang benar sesuai route web.php
    document.getElementById('formEdit').action = urlUpdateAdmin + '/' + id;

    // Isi semua field dengan data admin yang diklik
    document.getElementById('editNama').value     = nama;
    document.getElementById('editUsername').value = username;
    document.getElementById('editNoHp').value     = noHp;
    document.getElementById('editRole').value     = role;
    document.getElementById('editStatus').value   = status;
    document.getElementById('previewFotoEdit').src = fotoUrl;

    document.getElementById('modalEdit').classList.add('show');
}

function tutupModal(id) {
    document.getElementById(id).classList.remove('show');
}

// Tutup jika klik di luar modal box
document.querySelectorAll('.modal-overlay').forEach(function(overlay) {
    overlay.addEventListener('click', function(e) {
        if (e.target === overlay) overlay.classList.remove('show');
    });
});

// Preview foto sebelum upload
function previewFoto(input, targetId) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById(targetId).src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// ===== SWEETALERT =====
document.addEventListener("DOMContentLoaded", function () {

    // LOGOUT
    document.querySelectorAll('.btn-logout').forEach(function(el) {
        el.addEventListener('click', function(e) {
            e.preventDefault();
            const href = this.href;
            Swal.fire({
                title: 'Yakin logout?',
                icon: 'warning',
                width: '300px',
                padding: '1.5em',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) window.location.href = href;
            });
        });
    });

    // HAPUS
    document.querySelectorAll('.btn-delete').forEach(function(el) {
        el.addEventListener('click', function(e) {
            e.preventDefault();
            const targetUrl = this.href;
            Swal.fire({
                title: 'Yakin hapus?',
                text: 'Data akan dihapus permanen',
                icon: 'warning',
                width: '300px',
                padding: '1.5em',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) window.location.href = targetUrl;
            });
        });
    });

});
</script>

@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: "{{ session('success') }}",
    width: '300px',
    padding: '1.5em',
    timer: 2000,
    showConfirmButton: false
});
</script>
@endif

</body>
</html>