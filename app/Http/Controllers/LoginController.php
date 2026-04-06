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
        $user = DB::table('ms_admin')
            ->where('username', $request->username)
            ->where('role', $request->role)
            ->first();

        if ($user && $user->password == $request->password) {

            if ($user->status_admin !== 'aktif') {
                return back()->with('error', 'Akun Anda tidak aktif.');
            }

            // 🔥 FIX SESSION (INI PENTING BANGET)
            session([
                'login'      => true,
                'id_user'    => $user->id_user,
                'nama_admin' => $user->nama,
                'role'       => $user->role, // ✅ HARUS "role" bukan role_admin
                'foto_admin' => $user->foto_admin
            ]);

            // 🔥 SATU PINTU (BIAR GA KETUKER)
            return redirect()->route('admin.home')
                ->with('success', 'Login berhasil!');
        }

        return back()->with('error', 'Username, Password, atau Role salah!');
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('admin.login')->with('success', 'Logout berhasil.');
    }
}