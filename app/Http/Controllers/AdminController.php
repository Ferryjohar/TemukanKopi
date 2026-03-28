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
            'role'         => $request->role,
            'status_admin' => 'aktif',
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
        DB::table('ms_admin')->where('id_user', $id)->update([
            'nama'         => $request->nama,
            'username'     => $request->username,
            'role'         => $request->role,
            'status_admin' => $request->status_admin,
            'updated_at'   => now(),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Data admin berhasil diperbarui!');
    }

    // 6. Proses Hapus Data (Destroy)
    public function destroy($id) {
        DB::table('ms_admin')->where('id_user', $id)->delete();
        
        return redirect()->route('admin.dashboard')->with('success', 'Admin telah dihapus!');
    }
}