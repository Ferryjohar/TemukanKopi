<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index()
    {
        // 1. Proteksi Login
        if (!session('login')) {
            return redirect()->route('admin.login');
        }

        // 2. Gunakan Join agar bisa menampilkan Nama Kategori & Nama Jenis Kopi
        $products = DB::table('ms_produk')
            ->join('ms_kategori', 'ms_produk.id_kategori', '=', 'ms_kategori.id_kategori')
            ->join('ms_jeniskopi', 'ms_produk.id_jeniskopi', '=', 'ms_jeniskopi.id_jeniskopi')
            ->select('ms_produk.*', 'ms_kategori.nama_kategori', 'ms_jeniskopi.nama_jenis')
            ->get();
        
        $totalProduk = $products->count();

        // Ambil data kategori & jenis kopi untuk isi dropdown di form tambah nantinya
        $kategori = DB::table('ms_kategori')->get();
        $jenisKopi = DB::table('ms_jeniskopi')->get();

        return view('admin.menu', compact('products', 'totalProduk', 'kategori', 'jenisKopi'));
    }

    public function tambah(Request $request)
    {
        // Pastikan id_jeniskopi juga ikut disimpan sesuai skema database kopi_db
        DB::table('ms_produk')->insert([
            'nama_produk'      => $request->nama_produk,
            'id_kategori'      => $request->id_kategori,
            'id_jeniskopi'     => $request->id_jeniskopi, // Wajib ada
            'harga_produk'     => $request->harga_produk,
            'stok_produk'      => $request->stok_produk,
            'deskripsi_produk' => $request->deskripsi_produk,
            'foto_produk'      => $request->foto_produk ?? 'default.png', // Fallback jika belum upload
            'created_at'       => now(),
            'updated_at'       => now()
        ]);

        return back()->with('success', 'Produk berhasil ditambahkan');
    }

    public function hapus($id)
    {
        // Menggunakan id_produk sesuai primary key di database
        DB::table('ms_produk')->where('id_produk', $id)->delete();

        return back()->with('success', 'Produk berhasil dihapus');
    }
}