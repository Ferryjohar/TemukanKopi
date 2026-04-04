<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // 1. Menampilkan Tabel (Read)
    
    public function index() {
        if (!session('login')) return redirect()->route('admin.login');
        
        $admins = DB::table('ms_admin')->get();
        $totalAdmin = $admins->count();
        
        return view('admin.dashboard', compact('admins', 'totalAdmin'));
    }

    // 2. Menampilkan Form Tambah (Create) - INI YANG TADI HILANG
    public function create() {
        return view('admin.tambah_admin');
    }

    // 3. Proses Simpan Data ke Database (Store)
    public function store(Request $request) {
        DB::table('ms_admin')->insert([
            'nama'         => $request->nama,
            'username'     => $request->username,
            'password'     => $request->password, 
            'no_hp'        => $request->no_hp,    
            'role'         => $request->role,
            'status_admin' => 'aktif',
            'foto_admin'   => 'user.png',         // Berikan foto default saat pertama daftar
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Admin baru berhasil ditambahkan!');
    }

    // 4. Menampilkan Form Edit (Edit)
    public function edit($id) {
        $admin = DB::table('ms_admin')->where('id_user', $id)->first();
        
        if (!$admin) {
            return redirect()->route('admin.dashboard')->with('error', 'Data tidak ditemukan');
        }

        return view('admin.edit_admin', compact('admin'));
    }

    // 5. Proses Update Data (Update)
    public function update(Request $request, $id) {
    $data = [
        'nama'         => $request->nama,
        'username'     => $request->username,
        'no_hp'        => $request->no_hp,
        'role'         => $request->role,
        'status_admin' => $request->status_admin,
        'updated_at'   => now(),
    ];

    if ($request->filled('password')) {
        $data['password'] = $request->password;
    }

    // PROSES UPLOAD FOTO
    if ($request->hasFile('foto_admin')) {
        $file = $request->file('foto_admin');
        $namaFile = time() . "_" . $file->getClientOriginalName();
        
        $file->move(public_path('storage/avatars'), $namaFile);
        
        $data['foto_admin'] = $namaFile;
    }

    DB::table('ms_admin')->where('id_user', $id)->update($data);

    return redirect()->route('admin.dashboard')->with('success', 'Admin berhasil diupdate!');
    }

    public function destroy($id) {
        DB::table('ms_admin')->where('id_user', $id)->delete();
        
        return redirect()->route('admin.dashboard')->with('success', 'Admin telah dihapus!');
    }

    // Tambahkan ini di bagian paling bawah sebelum penutup class
    public function transaksi()
    {
        if (!session('login')) return redirect()->route('admin.login');
        // Ambil data transaksi dari database kopi_db
        $transaksi = DB::table('tr_pesanan')->get();
        // HITUNG TOTALNYA DI SINI
        $totalTransaksi = $transaksi->count();
        // KIRIM KEDUA VARIABEL KE VIEW
        return view('admin.transaksi', compact('transaksi', 'totalTransaksi'));
        }
} // Ini penutup class AdminController
