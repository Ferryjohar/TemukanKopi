<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TransaksiController extends Controller
{
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