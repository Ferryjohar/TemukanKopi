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

        session([
            'login' => true,
            'nama_admin' => $user->nama,
            'role_admin' => $user->role
        ]);

        // 🔥 INI YANG PENTING
        if ($user->role == 'superadmin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('admin.menu');
        }
    }

    return back()->with('error', 'Login gagal!');
}

    public function logout()
    {
        Session::flush();
        return redirect()->route('admin.login');
    }
}