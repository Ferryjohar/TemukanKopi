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

        // 2. Ambil data produk dengan Join
        // Variabel dinamai $produk (tanpa 's') agar cocok dengan @forelse($produk as $item) di Blade
        $produk = DB::table('ms_produk')
            ->join('ms_kategori', 'ms_produk.id_kategori', '=', 'ms_kategori.id_kategori')
            ->join('ms_jeniskopi', 'ms_produk.id_jeniskopi', '=', 'ms_jeniskopi.id_jeniskopi')
            ->select('ms_produk.*', 'ms_kategori.nama_kategori', 'ms_jeniskopi.nama_jenis')
            ->get();
        
        $totalProduk = $produk->count();
        $kategori = DB::table('ms_kategori')->get();
        $jenisKopi = DB::table('ms_jeniskopi')->get();

        // Kirim ketiganya ke view
        return view('admin.menu', compact('produk','totalProduk',  'kategori', 'jenisKopi'));    
    }

    // Menampilkan Form Tambah Produk
    public function create()
    {
        if (!session('login')) return redirect()->route('admin.login');
        
        $kategori = DB::table('ms_kategori')->get();
        $jenisKopi = DB::table('ms_jeniskopi')->get();
        return view('admin.tambah_produk', compact('kategori', 'jenisKopi'));
    }

    public function store(Request $request)
    {
        $namaFile = 'default.png';

        if ($request->hasFile('foto_produk')) {
            $file = $request->file('foto_produk');
            $namaFile = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('storage/produk'), $namaFile);
        }

        // Menghapus 'stok_produk' dari array insert
        DB::table('ms_produk')->insert([
            'nama_produk'      => $request->nama_produk,
            'id_kategori'      => $request->id_kategori,
            'id_jeniskopi'     => $request->id_jeniskopi ?? 1, 
            'harga_produk'     => $request->harga_produk, // Pastikan sesuai input di modal
            'status_produk'    => 'tersedia', // Default status saat tambah produk
            'deskripsi_produk' => $request->deskripsi_produk,
            'foto_produk'      => $namaFile,
            'created_at'       => now(),
            'updated_at'       => now()
        ]);

        return redirect()->route('admin.menu')->with('success', 'Produk berhasil ditambahkan');
    }

    // Menampilkan Form Edit Produk
    public function edit($id_produk)
    {
        if (!session('login')) return redirect()->route('admin.login');

        $product = DB::table('ms_produk')->where('id_produk', $id_produk)->first();
        $kategori = DB::table('ms_kategori')->get();
        $jenisKopi = DB::table('ms_jeniskopi')->get();

        if (!$product) {
            return redirect()->route('admin.menu')->with('error', 'Produk tidak ditemukan');
        }

        return view('admin.edit_produk', compact('product', 'kategori', 'jenisKopi'));
    }

    public function update(Request $request, $id_produk)
    {
        $data = [
            'nama_produk'      => $request->nama_produk,
            'id_kategori'      => $request->id_kategori,
            'harga_produk'     => $request->harga_produk,
            'status_produk'    => $request->status_produk,
            'deskripsi_produk' => $request->deskripsi_produk,
            'updated_at'       => now()
        ];

        if ($request->filled('id_jeniskopi')) {
            $data['id_jeniskopi'] = $request->id_jeniskopi;
        }

        if ($request->hasFile('foto_produk')) {
            $file = $request->file('foto_produk');
            $namaFile = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('storage/produk'), $namaFile);
            $data['foto_produk'] = $namaFile;
        }

        DB::table('ms_produk')->where('id_produk', $id_produk)->update($data);

        return redirect()->route('admin.menu')->with('success', 'Produk berhasil diupdate');
    }

    public function destroy($id) {
        DB::table('ms_produk')->where('id_produk', $id)->delete();
        return back()->with('success', 'Produk berhasil dihapus selamanya');
    }
    public function aktifkan($id)
    {
        DB::table('ms_produk')
            ->where('id_produk', $id)
            ->update(['status_produk' => 'tersedia']);

        return redirect()->back()->with('success', 'Produk sekarang tersedia kembali!');
    }

    public function kategoriStore(Request $request) {
    DB::table('ms_kategori')->insert([
        'nama_kategori' => $request->nama_kategori
    ]);
    return back()->with('success', 'Kategori berhasil ditambah!');
    }

    // Hapus Kategori
    public function kategoriDestroy($id) {
        // Cek dulu apakah ada produk yang pakai kategori ini
        $cek = DB::table('ms_produk')->where('id_kategori', $id)->count();
        if($cek > 0) {
            return back()->with('error', 'Gagal! Masih ada produk yang menggunakan kategori ini.');
        }
        
        DB::table('ms_kategori')->where('id_kategori', $id)->delete();
        return back()->with('success', 'Kategori berhasil dihapus!');
    }

    public function jenisStore(Request $request)
    {
        DB::table('ms_jeniskopi')->insert([
            'nama_jenis' => $request->nama_jenis
        ]);
        return redirect()->back()->with('success', 'Jenis kopi baru berhasil ditambahkan!');
    }


}