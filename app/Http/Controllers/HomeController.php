<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Ambil produk yang tersedia
        $produk = DB::table('ms_produk')
            ->join('ms_kategori', 'ms_produk.id_kategori', '=', 'ms_kategori.id_kategori')
            ->join('ms_jeniskopi', 'ms_produk.id_jeniskopi', '=', 'ms_jeniskopi.id_jeniskopi')
            ->select(
                'ms_produk.*',
                'ms_kategori.nama_kategori',
                'ms_jeniskopi.nama_jenis'
            )
            ->where('ms_produk.status_produk', '=', 'tersedia')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Currency Setting
        |--------------------------------------------------------------------------
        */

        // default Indonesia
        $currency = 'IDR';

        // kurs dollar
        $rate = 16000;

        /*
        |--------------------------------------------------------------------------
        | Jika akses:
        | http://127.0.0.1:8000?country=us
        | maka otomatis dollar
        |--------------------------------------------------------------------------
        */

        if ($request->country == 'us') {
            $currency = 'USD';
        }

        return view('welcome', compact(
            'produk',
            'currency',
            'rate'
        ));
    }

    public function checkout(Request $request)
    {
        // Ambil produk checkout
        $produk = DB::table('ms_produk')
            ->join('ms_kategori', 'ms_produk.id_kategori', '=', 'ms_kategori.id_kategori')
            ->join('ms_jeniskopi', 'ms_produk.id_jeniskopi', '=', 'ms_jeniskopi.id_jeniskopi')
            ->select(
                'ms_produk.*',
                'ms_kategori.nama_kategori',
                'ms_jeniskopi.nama_jenis'
            )
            ->where('ms_produk.status_produk', '=', 'tersedia')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Currency Setting
        |--------------------------------------------------------------------------
        */

        // default Indonesia
        $currency = 'IDR';

        // kurs dollar
        $rate = 16000;

        // jika luar negeri
        if ($request->country == 'us') {
            $currency = 'USD';
        }

        return view('checkout', compact(
            'produk',
            'currency',
            'rate'
        ));
    }
}