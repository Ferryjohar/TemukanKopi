<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $produk = DB::table('ms_produk')
            ->join('ms_kategori', 'ms_produk.id_kategori', '=', 'ms_kategori.id_kategori')
            ->join('ms_jeniskopi', 'ms_produk.id_jeniskopi', '=', 'ms_jeniskopi.id_jeniskopi')
            ->select(
                'ms_produk.*', 
                'ms_kategori.nama_kategori', 
                'ms_jeniskopi.nama_jenis'
            )
            ->where('ms_produk.status_produk', '=', 'tersedia')
            ->orderBy('ms_produk.nama_produk', 'asc') // Urut nama produk
            ->get();

        return view('welcome', compact('produk'));
    }

    public function checkout(Request $request)
    {
        $id_produk = $request->get('id_produk');
        
        // Data produk yang dipilih untuk checkout
        $produk_dipilih = DB::table('ms_produk')
            ->join('ms_kategori', 'ms_produk.id_kategori', '=', 'ms_kategori.id_kategori')
            ->join('ms_jeniskopi', 'ms_produk.id_jeniskopi', '=', 'ms_jeniskopi.id_jeniskopi')
            ->select('ms_produk.*', 'ms_kategori.nama_kategori', 'ms_jeniskopi.nama_jenis')
            ->where('ms_produk.id_produk', $id_produk)
            ->first();

        // Semua produk tersedia untuk katalog di checkout
        $produk = DB::table('ms_produk')
            ->join('ms_kategori', 'ms_produk.id_kategori', '=', 'ms_kategori.id_kategori')
            ->join('ms_jeniskopi', 'ms_produk.id_jeniskopi', '=', 'ms_jeniskopi.id_jeniskopi')
            ->select('ms_produk.*', 'ms_kategori.nama_kategori', 'ms_jeniskopi.nama_jenis')
            ->where('ms_produk.status_produk', '=', 'tersedia')
            ->orderBy('ms_produk.nama_produk', 'asc')
            ->get();

        return view('checkout', compact('produk', 'produk_dipilih'));
    }

    // Tambahan: Route untuk detail produk (opsional)
    public function detail($id)
    {
        $produk = DB::table('ms_produk')
            ->join('ms_kategori', 'ms_produk.id_kategori', '=', 'ms_kategori.id_kategori')
            ->join('ms_jeniskopi', 'ms_produk.id_jeniskopi', '=', 'ms_jeniskopi.id_jeniskopi')
            ->select('ms_produk.*', 'ms_kategori.nama_kategori', 'ms_jeniskopi.nama_jenis')
            ->where('ms_produk.id_produk', $id)
            ->first();

        if (!$produk) {
            abort(404);
        }

        return view('produk.detail', compact('produk'));
    }
}