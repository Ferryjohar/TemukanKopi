<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TransaksiController extends Controller
{
    // ================= SIMPAN PESANAN DARI CHECKOUT =================
    public function simpan(Request $request)
    {
        try {
            // Validasi field wajib
            if (!$request->filled('nama') || !$request->filled('wa') || !$request->filled('alamat')) {
                return response()->json(['success' => false, 'message' => 'Data tidak lengkap.'], 422);
            }

            // Parse total_harga: hilangkan "Rp ", titik pemisah ribuan, spasi
            $totalRaw    = $request->input('total_harga', '0');
            $totalBersih = (int) preg_replace('/[^0-9]/', '', $totalRaw);

            // Simpan header pesanan — sesuai struktur tr_pesanan di DB
            $idPesanan = DB::table('tr_pesanan')->insertGetId([
                'nama_customer' => $request->nama,
                'no_wa'         => $request->wa,
                'alamat'        => $request->alamat,
                'catatan'       => $request->catatan ?? null,
                'total_harga'   => $totalBersih,
                'tanggal_pesan' => now(),   // kolom bertipe datetime
                'created_at'    => now(),
                'updated_at'    => now(),
            ]);

            // Simpan detail produk — kolom qty di DB bernama "jumlah"
            $items = json_decode($request->input('items', '[]'), true);
            if (is_array($items) && count($items) > 0) {
                foreach ($items as $item) {
                    $idProduk = (int) ($item['id_produk'] ?? $item['id'] ?? 0);
                    $jumlah   = (int) ($item['qty']   ?? 1);
                    $harga    = (int) ($item['harga'] ?? 0);

                    if (!$idProduk) continue;

                    DB::table('tr_detailpesanan')->insert([
                        'id_pesanan' => $idPesanan,
                        'id_produk'  => $idProduk,
                        'jumlah'     => $jumlah,          // ← nama kolom yang benar
                        'harga'      => $harga,
                        'subtotal'   => $harga * $jumlah,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            return response()->json([
                'success'    => true,
                'id_pesanan' => $idPesanan,
                'message'    => 'Pesanan berhasil disimpan.',
            ]);

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Gagal simpan pesanan: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function index(Request $request)
    {
        if (!session('login')) {
            return redirect()->route('admin.login');
        }

        $query = DB::table('tr_pesanan');

        // Filter search nama customer
        if ($request->filled('search')) {
            $query->where('nama_customer', 'like', '%' . $request->search . '%');
        }

        // Filter dari tanggal
        if ($request->filled('dari_tanggal')) {
            $query->whereDate('tanggal_pesan', '>=', $request->dari_tanggal);
        }

        // Filter sampai tanggal
        if ($request->filled('sampai_tanggal')) {
            $query->whereDate('tanggal_pesan', '<=', $request->sampai_tanggal);
        }

        $transaksi = $query->orderBy('tanggal_pesan', 'desc')->get();
        $totalTransaksi = $transaksi->count();

        return view('admin.transaksi', compact('transaksi', 'totalTransaksi'));
    }

    public function detail($id)
    {
        $pesanan = DB::table('tr_pesanan')->where('id_pesanan', $id)->first();
        $details = DB::table('tr_detailpesanan')
            ->join('ms_produk', 'tr_detailpesanan.id_produk', '=', 'ms_produk.id_produk')
            ->where('id_pesanan', $id)
            ->select('tr_detailpesanan.*', 'ms_produk.nama_produk')
            ->get();
        return view('admin.detail_transaksi', compact('pesanan', 'details'));
    }

    public function edit($id)
    {
        $transaksi = DB::table('tr_pesanan')->where('id_pesanan', $id)->first();
        return view('admin.edit_transaksi', compact('transaksi'));
    }

    public function update(Request $request, $id)
    {
        DB::table('tr_pesanan')->where('id_pesanan', $id)->update([
            'nama_customer' => $request->nama_customer,
            'no_wa'         => $request->no_wa,
            'alamat'        => $request->alamat,
            'updated_at'    => now(),
        ]);
        return redirect()->route('admin.transaksi')->with('success', 'Data transaksi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        DB::table('tr_detailpesanan')->where('id_pesanan', $id)->delete();
        DB::table('tr_pesanan')->where('id_pesanan', $id)->delete();
        return redirect()->route('admin.transaksi')->with('success', 'Data transaksi berhasil dihapus!');
    }
}