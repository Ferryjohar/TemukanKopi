<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Admin - Temukan Kopi</title>
    <style>
        /* Pakai root dan body style dari dashboard tadi */
        :root { --primary-green: #004d32; --bg-light: #f5f3ed; }
        body { font-family: 'Segoe UI', sans-serif; background-color: var(--bg-light); padding: 50px; }
        .form-card { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); max-width: 500px; margin: auto; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 8px; box-sizing: border-box; }
        .btn-save { background-color: var(--primary-green); color: white; border: none; padding: 12px 20px; border-radius: 10px; cursor: pointer; font-weight: bold; }
        .btn-cancel { color: #666; text-decoration: none; margin-left: 15px; }
    </style>
</head>
<body>

<div class="form-card">
    <h2>Edit Data Admin</h2>
    <hr style="border: 0; border-top: 1px solid #eee; margin-bottom: 20px;">

    <form action="{{ route('admin.update', $admin->id_user) }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" name="nama" value="{{ $admin->nama }}" required>
        </div>

        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" value="{{ $admin->username }}" required>
        </div>

        <div class="form-group">
            <label>Password (Kosongkan jika tidak ingin diubah)</label>
            <input type="password" name="password" placeholder="********">
            <small style="color: gray;">*Tetap masukkan password lama jika tidak menggunakan sistem Hash</small>
        </div>

        <div class="form-group">
            <label>Role</label>
            <select name="role">
                <option value="admin" {{ $admin->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="superadmin" {{ $admin->role == 'superadmin' ? 'selected' : '' }}>Superadmin</option>
            </select>
        </div>

        <div class="form-group">
            <label>Status</label>
            <select name="status_admin">
                <option value="aktif" {{ $admin->status_admin == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="nonaktif" {{ $admin->status_admin == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>

        <div style="margin-top: 25px;">
            <button type="submit" class="btn-save">Simpan Perubahan</button>
            <a href="{{ route('admin.dashboard') }}" class="btn-cancel">Batal</a>
        </div>
    </form>
</div>

</body>
</html>