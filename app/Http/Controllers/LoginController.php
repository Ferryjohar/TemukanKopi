<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function prosesLogin(Request $request) 
    {
        // 1. Ambil data admin berdasarkan username & role
        $user = DB::table('ms_admin')
            ->where('username', $request->username)
            ->where('role', $request->role)
            ->first();

        // 2. Cek apakah user ada, password cocok, DAN statusnya 'aktif'
        if ($user && $user->password == $request->password) {
            
            // Cek Tambahan: Apakah status admin aktif?
            if ($user->status_admin !== 'aktif') {
                return back()->with('error', 'Akun Anda sudah tidak aktif. Silakan hubungi Superadmin.');
            }

            // 3. Simpan data lengkap ke Session
            session([
                'login'      => true,
                'id_user'    => $user->id_user,    // 🔥 Tambahkan ini agar sistem tahu siapa yang login
                'nama_admin' => $user->nama,
                'role_admin' => $user->role,
                'foto_admin' => $user->foto_admin  // 🔥 Simpan foto agar bisa tampil di pojok dashboard
            ]);

            // 4. Redirect berdasarkan Role
            if ($user->role == 'superadmin') {
                return redirect()->route('admin.dashboard')->with('success', 'Selamat Datang, Superadmin!');
            } else {
                // Admin biasa langsung ke halaman Menu (Product)
                return redirect()->route('admin.menu')->with('success', 'Selamat Datang, Admin Toko!');
            }
        }

        // 5. Jika gagal
        return back()->with('error', 'Username, Password, atau Role salah!');
    }

    public function logout()
    {
        // Menghapus semua session dan kembali ke login
        Session::flush();
        return redirect()->route('admin.login')->with('success', 'Anda telah berhasil logout.');
    }
}