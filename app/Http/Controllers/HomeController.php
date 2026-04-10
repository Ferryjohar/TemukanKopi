<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // Mengambil data produk dan menggabungkan nama kategori serta jenis kopi
        $produk = DB::table('ms_produk')
            ->join('ms_kategori', 'ms_produk.id_kategori', '=', 'ms_kategori.id_kategori')
            ->join('ms_jeniskopi', 'ms_produk.id_jeniskopi', '=', 'ms_jeniskopi.id_jeniskopi')
            ->select('ms_produk.*', 'ms_kategori.nama_kategori', 'ms_jeniskopi.nama_jenis')
            ->get();

        // Mengirim variabel $produk ke halaman welcome
        return view('welcome', compact('produk'));
    }
    public function checkout()
    {
        $produk = collect(DB::table('ms_produk')
            ->join('ms_kategori', 'ms_produk.id_kategori', '=', 'ms_kategori.id_kategori')
            ->join('ms_jeniskopi', 'ms_produk.id_jeniskopi', '=', 'ms_jeniskopi.id_jeniskopi')
            ->select('ms_produk.*', 'ms_kategori.nama_kategori', 'ms_jeniskopi.nama_jenis')
            ->get());

        return view('checkout', compact('produk'));
    }
}