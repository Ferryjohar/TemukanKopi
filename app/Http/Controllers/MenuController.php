<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    // =========================
    // TAMPIL MENU
    // =========================
    public function index()
    {
        // Proteksi Login
        if (!session('login')) {
            return redirect()->route('admin.login');
        }

        // Ambil data produk
        $produk = DB::table('ms_produk')
            ->join(
                'ms_kategori',
                'ms_produk.id_kategori',
                '=',
                'ms_kategori.id_kategori'
            )
            ->join(
                'ms_jeniskopi',
                'ms_produk.id_jeniskopi',
                '=',
                'ms_jeniskopi.id_jeniskopi'
            )
            ->select(
                'ms_produk.*',
                'ms_kategori.nama_kategori',
                'ms_jeniskopi.nama_jenis'
            )
            ->get();

        $totalProduk = $produk->count();

        $kategori = DB::table('ms_kategori')->get();
        $jenisKopi = DB::table('ms_jeniskopi')->get();

        return view(
            'admin.menu',
            compact(
                'produk',
                'totalProduk',
                'kategori',
                'jenisKopi'
            )
        );
    }

    // =========================
    // FORM TAMBAH PRODUK
    // =========================
    public function create()
    {
        if (!session('login')) {
            return redirect()->route('admin.login');
        }

        $kategori = DB::table('ms_kategori')->get();
        $jenisKopi = DB::table('ms_jeniskopi')->get();

        return view(
            'admin.tambah_produk',
            compact('kategori', 'jenisKopi')
        );
    }

    // =========================
    // SIMPAN PRODUK
    // =========================
    public function store(Request $request)
    {
        $namaFile = 'default.png';

        // upload foto
        if ($request->hasFile('foto_produk')) {

            $file = $request->file('foto_produk');

            $namaFile = time() . "_" . $file->getClientOriginalName();

            $file->move(
                public_path('storage/produk'),
                $namaFile
            );
        }

        // insert produk
        DB::table('ms_produk')->insert([

            'nama_produk'      => $request->nama_produk,
            'id_kategori'      => $request->id_kategori,
            'id_jeniskopi'     => $request->id_jeniskopi ?? 1,
            'harga_produk'     => $request->harga_produk,
            'status_produk'    => 'tersedia',
            'deskripsi_produk' => $request->deskripsi_produk,
            'foto_produk'      => $namaFile,
            'created_at'       => now(),
            'updated_at'       => now()

        ]);

        return redirect()
            ->route('admin.menu')
            ->with(
                'success',
                'Produk berhasil ditambahkan'
            );
    }

    // =========================
    // FORM EDIT PRODUK
    // =========================
    public function edit($id_produk)
    {
        if (!session('login')) {
            return redirect()->route('admin.login');
        }

        $product = DB::table('ms_produk')
            ->where('id_produk', $id_produk)
            ->first();

        $kategori = DB::table('ms_kategori')->get();
        $jenisKopi = DB::table('ms_jeniskopi')->get();

        if (!$product) {

            return redirect()
                ->route('admin.menu')
                ->with(
                    'error',
                    'Produk tidak ditemukan'
                );
        }

        return view(
            'admin.edit_produk',
            compact(
                'product',
                'kategori',
                'jenisKopi'
            )
        );
    }

    // =========================
    // UPDATE PRODUK
    // =========================
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

        // update jenis kopi
        if ($request->filled('id_jeniskopi')) {

            $data['id_jeniskopi'] = $request->id_jeniskopi;
        }

        // update foto
        if ($request->hasFile('foto_produk')) {

            $file = $request->file('foto_produk');

            $namaFile = time() . "_" . $file->getClientOriginalName();

            $file->move(
                public_path('storage/produk'),
                $namaFile
            );

            $data['foto_produk'] = $namaFile;
        }

        // update database
        DB::table('ms_produk')
            ->where('id_produk', $id_produk)
            ->update($data);

        return redirect()
            ->route('admin.menu')
            ->with(
                'success',
                'Produk berhasil diupdate'
            );
    }

    // =========================
    // HAPUS PRODUK
    // =========================
    public function destroy($id)
    {
        // cek apakah produk dipakai transaksi
        $cek = DB::table('tr_detailpesanan')
            ->where('id_produk', $id)
            ->count();

        // kalau produk sudah pernah dipakai transaksi
        if ($cek > 0) {

            // ubah status jadi habis
            DB::table('ms_produk')
                ->where('id_produk', $id)
                ->update([
                    'status_produk' => 'habis',
                    'updated_at' => now()
                ]);

            return back()->with(
                'error',
                'Produk tidak bisa dihapus karena sudah ada di transaksi. Status produk diubah menjadi habis.'
            );
        }

        // kalau belum dipakai transaksi
        DB::table('ms_produk')
            ->where('id_produk', $id)
            ->delete();

        return back()->with(
            'success',
            'Produk berhasil dihapus'
        );
    }

    // =========================
    // AKTIFKAN PRODUK
    // =========================
    public function aktifkan($id)
    {
        DB::table('ms_produk')
            ->where('id_produk', $id)
            ->update([
                'status_produk' => 'tersedia'
            ]);

        return redirect()
            ->back()
            ->with(
                'success',
                'Produk tersedia kembali!'
            );
    }

    // =========================
    // TAMBAH KATEGORI
    // =========================
    public function kategoriStore(Request $request)
    {
        DB::table('ms_kategori')->insert([

            'nama_kategori' => $request->nama_kategori

        ]);

        return back()->with(
            'success',
            'Kategori berhasil ditambah!'
        );
    }

    // =========================
    // HAPUS KATEGORI
    // =========================
    public function kategoriDestroy($id)
    {
        // cek apakah kategori dipakai produk
        $cek = DB::table('ms_produk')
            ->where('id_kategori', $id)
            ->count();

        // kalau masih dipakai
        if ($cek > 0) {

            return back()->with(
                'error',
                'Gagal! Masih ada produk yang menggunakan kategori ini.'
            );
        }

        // hapus kategori
        DB::table('ms_kategori')
            ->where('id_kategori', $id)
            ->delete();

        return back()->with(
            'success',
            'Kategori berhasil dihapus!'
        );
    }

    // =========================
    // TAMBAH JENIS KOPI
    // =========================
    public function jenisStore(Request $request)
    {
        DB::table('ms_jeniskopi')->insert([

            'nama_jenis' => $request->nama_jenis

        ]);

        return redirect()
            ->back()
            ->with(
                'success',
                'Jenis kopi baru berhasil ditambahkan!'
            );
    }
}