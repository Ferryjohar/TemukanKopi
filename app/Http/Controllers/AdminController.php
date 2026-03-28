<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
   public function index()
{
    if (!session('login') || session('role_admin') != 'superadmin') {
        return redirect()->route('admin.login');
    }

    $admins = DB::table('ms_admin')->get();
    $totalAdmin = $admins->count();

    return view('admin.dashboard', compact('admins', 'totalAdmin'));
}
}