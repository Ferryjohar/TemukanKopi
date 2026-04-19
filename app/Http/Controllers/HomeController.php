<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Menambahkan filter status_produk agar yang tampil hanya yang 'tersedia'
        $produk = DB::table('ms_produk')
            ->join('ms_kategori', 'ms_produk.id_kategori', '=', 'ms_kategori.id_kategori')
            ->join('ms_jeniskopi', 'ms_produk.id_jeniskopi', '=', 'ms_jeniskopi.id_jeniskopi')
            ->select('ms_produk.*', 'ms_kategori.nama_kategori', 'ms_jeniskopi.nama_jenis')
            ->where('ms_produk.status_produk', '=', 'tersedia') // Tambahan Filter
            ->get();

        return view('welcome', compact('produk'));
    }

    public function checkout()
    {
        // Tambahkan filter yang sama di halaman checkout agar katalog di bawah tetap sinkron
        $produk = DB::table('ms_produk')
            ->join('ms_kategori', 'ms_produk.id_kategori', '=', 'ms_kategori.id_kategori')
            ->join('ms_jeniskopi', 'ms_produk.id_jeniskopi', '=', 'ms_jeniskopi.id_jeniskopi')
            ->select('ms_produk.*', 'ms_kategori.nama_kategori', 'ms_jeniskopi.nama_jenis')
            ->where('ms_produk.status_produk', '=', 'tersedia') // Tambahan Filter
            ->get();

        return view('checkout', compact('produk'));
    }
}