<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    // Menampilkan halaman login
    public function index()
    {
        return view('admin.login');
    }

    // Proses masuk ke sistem
    public function prosesLogin(Request $request) 
    {
        // 1. Ambil input dari form
        $username = $request->username;
        $password = $request->password;
        $role     = $request->role;

        // 2. Cari data di database (Query Builder)
        $user = DB::table('ms_admin')
                  ->where('username', $username)
                  ->where('role', $role)
                  ->first();

        // 3. Cek apakah user ada dan password (plain text) cocok
        if ($user && $user->password == $password) {
            
            // Simpan data ke session
            session([
                'login'      => true,
                'user_id'    => $user->id_user,
                'nama_admin' => $user->nama,
                'role_admin' => $user->role
            ]);

            // Pindah ke dashboard dengan pesan sukses
            return redirect()->route('admin.dashboard')->with('success', 'Selamat Datang, ' . $user->nama);
        }

        // Jika gagal, kembali ke login dengan pesan error
        return back()->with('error', 'Username, Password, atau Role salah!');
    }

    // Fungsi Keluar Sistem
    public function logout()
    {
        // Menghapus semua session yang aktif
        Session::flush();

        // Kembali ke login
        return redirect()->route('admin.login')->with('success', 'Berhasil Logout!');
    }
}