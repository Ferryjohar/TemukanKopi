<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // helper cek role
    private function isSuperAdmin() {
        return strtolower(session('role')) === 'superadmin';
    }

    // ================= DASHBOARD SUPERADMIN =================
    public function index() {
        if (!session('login')) return redirect()->route('admin.login');

        if (!$this->isSuperAdmin()) {
            return redirect()->route('admin.dashboard_khusus');
        }

        $admins = DB::table('ms_admin')->get();
        $totalAdmin = $admins->count();

        return view('admin.dashboard', compact('admins', 'totalAdmin'));
    }

    // ================= DASHBOARD ADMIN =================
    public function dashboardKhusus() {
        if (!session('login')) return redirect()->route('admin.login');

        if ($this->isSuperAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        $totalPesanan = DB::table('tr_pesanan')->count();
        $totalProduk  = DB::table('ms_produk')->count();

        return view('admin.dashboard_admin', compact('totalPesanan', 'totalProduk'));
    }

    // ================= CRUD ADMIN =================
    public function create() {
        if (!$this->isSuperAdmin()) return redirect()->back();
        return view('admin.tambah_admin');
    }

    public function store(Request $request) {

        DB::table('ms_admin')->insert([
            'nama'         => $request->nama,
            'username'     => $request->username,
            'password'     => Hash::make($request->password), // ✅ HASH
            'no_hp'        => $request->no_hp,
            'role'         => $request->role,
            'status_admin' => 'aktif',
            'foto_admin'   => 'user.png',
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Admin ditambahkan!');
    }

    public function edit($id) {
        if (!$this->isSuperAdmin()) return redirect()->back();

        $admin = DB::table('ms_admin')->where('id_user', $id)->first();
        if (!$admin) return redirect()->route('admin.dashboard');

        return view('admin.edit_admin', compact('admin'));
    }

    public function update(Request $request, $id) {
        if (!$this->isSuperAdmin()) return redirect()->back();

        $data = [
            'nama'         => $request->nama,
            'username'     => $request->username,
            'no_hp'        => $request->no_hp,
            'role'         => $request->role,
            'status_admin' => $request->status_admin,
            'updated_at'   => now(),
        ];

        // ✅ HASH kalau password diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // upload foto
        if ($request->hasFile('foto_admin')) {
            $file = $request->file('foto_admin');
            $namaFile = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('storage/avatars'), $namaFile);
            $data['foto_admin'] = $namaFile;
        }

        DB::table('ms_admin')->where('id_user', $id)->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Admin diupdate!');
    }

    public function destroy($id) {
        if (!$this->isSuperAdmin()) return redirect()->back();

        DB::table('ms_admin')->where('id_user', $id)->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Admin dihapus!');
    }

    // ================= TRANSAKSI =================
    public function transaksi() {
        if (!session('login')) return redirect()->route('admin.login');

        $transaksi = DB::table('tr_pesanan')
            ->orderBy('tanggal_pesan', 'desc')
            ->get();

        $totalTransaksi = $transaksi->count();

        return view('admin.transaksi', compact('transaksi', 'totalTransaksi'));
    }

    
}