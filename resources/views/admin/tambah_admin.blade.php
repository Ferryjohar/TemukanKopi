<!DOCTYPE html>
<html>
<head>
    <title>Tambah Admin</title>
    <style>
        body { font-family: sans-serif; padding: 50px; background: #f5f3ed; }
        .card { background: white; padding: 20px; border-radius: 10px; max-width: 400px; margin: auto; }
        input, select { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        button { background: #004d32; color: white; border: none; padding: 10px; width: 100%; border-radius: 5px; cursor: pointer; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Tambah Admin Baru</h2>
        <form action="{{ route('admin.store') }}" method="POST">
            @csrf
            <label>Nama Lengkap</label>
            <input type="text" name="nama" required>
            
            <label>Username</label>
            <input type="text" name="username" required>
            
            <label>Password</label>
            <input type="password" name="password" required>
            
            <label>Role</label>
            <select name="role">
                <option value="admin">Admin</option>
                <option value="superadmin">Superadmin</option>
            </select>
            
            <button type="submit">Simpan Admin</button>
            <br><br>
            <a href="{{ route('admin.dashboard') }}">Batal</a>
        </form>
    </div>
</body>
</html>