<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil Admin - Temukan Kopi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --primary: #004d32; --bg: #f5f3ed; }
        body { background-color: var(--bg); font-family: 'Segoe UI', sans-serif; }
        .card-modern { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .btn-save { background: var(--primary); color: white; border-radius: 12px; padding: 12px 30px; font-weight: bold; border: none; }
        .avatar-upload {
            width: 150px; height: 150px; border-radius: 50%; 
            object-fit: cover; border: 5px solid white; box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card card-modern">
                <div class="card-body p-5">
                    <h2 class="mb-4" style="color: var(--primary); font-weight: 800;">Edit Profil Admin</h2>
                    
                    <form action="{{ route('admin.update', $admin->id_user) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-5">
                            <div class="col-md-4 text-center border-end">
                                <div class="mb-3">
                                    <img src="{{ $admin->foto_admin ? asset('storage/avatars/'.$admin->foto_admin) : asset('images/user.png') }}" 
                                    id="previewFoto" class="avatar-upload">
                                </div>
                                <label for="foto_admin" class="btn btn-outline-dark btn-sm rounded-pill">Ganti Foto Profil</label>
                                <input type="file" name="foto_admin" id="foto_admin" class="d-none" accept="image/*">
                                <p class="text-muted mt-2" style="font-size: 12px;">Format: JPG, PNG. Maks 2MB</p>
                            </div>

                            <div class="col-md-8">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Nama Lengkap</label>
                                        <input type="text" name="nama" class="form-control" value="{{ $admin->nama }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Username</label>
                                        <input type="text" name="username" class="form-control" value="{{ $admin->username }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Password Baru</label>
                                        <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diganti">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Nomor HP</label>
                                        <input type="text" name="no_hp" class="form-control" value="{{ $admin->no_hp }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Role</label>
                                        <select name="role" class="form-select">
                                            <option value="admin" {{ $admin->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="superadmin" {{ $admin->role == 'superadmin' ? 'selected' : '' }}>Superadmin</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold">Status</label>
                                        <select name="status_admin" class="form-select">
                                            <option value="aktif" {{ $admin->status_admin == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="tidak aktif" {{ $admin->status_admin == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mt-5 d-flex gap-2">
                                    <button type="submit" class="btn-save">Simpan Perubahan</button>
                                    <a href="{{ route('admin.dashboard') }}" class="btn btn-light" style="border-radius: 12px; padding: 12px 30px;">Batal</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Script Live Preview Foto
    document.getElementById('foto_admin').onchange = function (evt) {
        const [file] = this.files
        if (file) {
            document.getElementById('previewFoto').src = URL.createObjectURL(file)
        }
    }
</script>
</body>
</html>