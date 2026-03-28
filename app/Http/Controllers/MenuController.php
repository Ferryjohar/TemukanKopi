<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index()
    {
        if (!session('login')) {
            return redirect()->route('admin.login');
        }

        $produk = DB::table('produk')->get();

        return view('admin.menu', compact('produk'));
    }

    public function tambah(Request $request)
    {
        DB::table('produk')->insert([
            'nama_produk' => $request->nama,
            'harga' => $request->harga,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return back()->with('success', 'Produk berhasil ditambahkan');
    }

    public function hapus($id)
    {
        DB::table('produk')->where('id', $id)->delete();

        return back()->with('success', 'Produk berhasil dihapus');
    }
}