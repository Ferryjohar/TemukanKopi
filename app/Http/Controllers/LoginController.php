<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function prosesLogin(Request $request) 
    {
        // ✅ VALIDASI INPUT
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // ambil user
        $user = DB::table('ms_admin')
            ->where('username', $request->username)
            ->first();

        // ❌ kalau user tidak ditemukan
        if (!$user) {
            return back()->with('error', 'Username tidak ditemukan!');
        }

        // ❌ kalau password belum di-hash (data lama)
        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password salah!');
        }

        // ❌ kalau akun tidak aktif
        if ($user->status_admin !== 'aktif') {
            return back()->with('error', 'Akun Anda tidak aktif.');
        }

        // ✅ simpan session
        session([
            'login'      => true,
            'id_user'    => $user->id_user,
            'nama_admin' => $user->nama,
            'role'       => $user->role,
            'foto_admin' => $user->foto_admin
        ]);

        return redirect()->route('admin.home')
            ->with('success', 'Login berhasil!');
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('admin.login')
            ->with('success', 'Logout berhasil.');
    }
}