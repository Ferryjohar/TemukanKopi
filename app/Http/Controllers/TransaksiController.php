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

            // Cek kolom yang tersedia di tr_pesanan
            $kolomPesanan = \Illuminate\Support\Facades\Schema::getColumnListing('tr_pesanan');

            $dataPesanan = [
                'nama_customer' => $request->nama,
                'no_wa'         => $request->wa,
                'alamat'        => $request->alamat,
                'total_harga'   => $totalBersih,
                'tanggal_pesan' => $request->tanggal
                                    ? date('Y-m-d', strtotime($request->tanggal))
                                    : now()->toDateString(),
                'created_at'    => now(),
                'updated_at'    => now(),
            ];

            // Tambahkan catatan hanya jika kolomnya ada
            if (in_array('catatan', $kolomPesanan)) {
                $dataPesanan['catatan'] = $request->catatan ?? null;
            }

            // Simpan header pesanan
            $idPesanan = DB::table('tr_pesanan')->insertGetId($dataPesanan);

            // Simpan detail produk
            $items = json_decode($request->input('items', '[]'), true);
            if (is_array($items) && count($items) > 0) {
                $kolomDetail = \Illuminate\Support\Facades\Schema::getColumnListing('tr_detailpesanan');
                $punyaHarga    = in_array('harga', $kolomDetail);
                $punyaSubtotal = in_array('subtotal', $kolomDetail);

                foreach ($items as $item) {
                    // Terima key 'id_produk' ATAU 'id' (kompatibel dua-duanya)
                    $idProduk = (int) ($item['id_produk'] ?? $item['id'] ?? 0);
                    $qty      = (int) ($item['qty']  ?? 1);
                    $harga    = (int) ($item['harga'] ?? 0);

                    if (!$idProduk) continue;

                    $dataDetail = [
                        'id_pesanan' => $idPesanan,
                        'id_produk'  => $idProduk,
                        'qty'        => $qty,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                    if ($punyaHarga)    $dataDetail['harga']    = $harga;
                    if ($punyaSubtotal) $dataDetail['subtotal'] = $harga * $qty;

                    DB::table('tr_detailpesanan')->insert($dataDetail);
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