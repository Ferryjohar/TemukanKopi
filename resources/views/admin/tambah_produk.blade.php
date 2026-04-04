<div style="background: white; padding: 30px; border-radius: 20px; width: 500px; margin: 30px auto; box-shadow: 0 10px 30px rgba(0,0,0,0.1); font-family: sans-serif;">
    <h2 style="color: #004d32; margin-bottom: 25px; text-align: center;">Tambah Produk Baru</h2>
    
    <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
            <div>
                <label style="display: block; font-weight: bold; font-size: 13px;">Nama Produk</label>
                <input type="text" name="nama_produk" required style="width: 100%; padding: 10px; background: #f0f0f0; border: none; border-radius: 8px; box-sizing: border-box;">
            </div>
            <div>
                <label style="display: block; font-weight: bold; font-size: 13px;">Harga</label>
                <input type="number" name="harga_produk" required style="width: 100%; padding: 10px; background: #f0f0f0; border: none; border-radius: 8px; box-sizing: border-box;">
            </div>
            <div>
                <label style="display: block; font-weight: bold; font-size: 13px;">Stok</label>
                <input type="number" name="stok_produk" required style="width: 100%; padding: 10px; background: #f0f0f0; border: none; border-radius: 8px; box-sizing: border-box;">
            </div>
            <div>
                <label style="display: block; font-weight: bold; font-size: 13px;">Kategori (ID)</label>
                <input type="number" name="id_kategori" required style="width: 100%; padding: 10px; background: #f0f0f0; border: none; border-radius: 8px; box-sizing: border-box;">
            </div>
            <div style="grid-column: span 2;">
                <label style="display: block; font-weight: bold; font-size: 13px;">Jenis Kopi (ID)</label>
                <input type="number" name="id_jeniskopi" required placeholder="Masukkan ID Jenis Kopi" style="width: 100%; padding: 10px; background: #f0f0f0; border: none; border-radius: 8px; box-sizing: border-box;">
            </div>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; font-weight: bold; font-size: 13px;">Deskripsi</label>
            <textarea name="deskripsi_produk" rows="3" style="width: 100%; padding: 10px; background: #f0f0f0; border: none; border-radius: 8px; box-sizing: border-box;"></textarea>
        </div>

        <div style="margin-bottom: 25px;">
            <label style="display: block; font-weight: bold; font-size: 13px;">Foto Produk</label>
            <input type="file" name="foto_produk" required style="font-size: 12px;">
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" style="flex: 1; background: #004d32; color: white; padding: 12px; border: none; border-radius: 25px; cursor: pointer; font-weight: bold;">Tambah Produk</button>
            <a href="{{ route('admin.menu') }}" style="flex: 1; background: #ccc; color: white; padding: 12px; border: none; border-radius: 25px; text-align: center; text-decoration: none; font-weight: bold; font-size: 14px; display: flex; align-items: center; justify-content: center;">Batal</a>
        </div>
    </form>
</div>