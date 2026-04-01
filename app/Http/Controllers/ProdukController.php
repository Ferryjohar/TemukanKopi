<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function index()
    {
        if (!session('login')) {
            return redirect()->route('admin.login');
        }

        $produk = DB::table('ms_produk')->get();

        return view('admin.produk', compact('produk'));
    }
}