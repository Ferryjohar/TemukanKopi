<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // PROTEKSI: Cek apakah session login ada
        if (!session('login')) {
            return redirect()->route('admin.login')->with('error', 'Silahkan login terlebih dahulu');
        }

        // AMBIL DATA
        $admins = DB::table('ms_admin')->get();
        $totalAdmin = $admins->count();

        // KIRIM DATA KE VIEW
        return view('admin.dashboard', compact('admins', 'totalAdmin'));
    }
}