<div style="background: white; padding: 40px; border-radius: 25px; width: 700px; margin: 30px auto; box-shadow: 0 10px 30px rgba(0,0,0,0.1); font-family: sans-serif;">
    <h2 style="color: #004d32; margin-bottom: 30px;">Edit Foto Produk</h2>
    
    <form action="{{ route('admin.menu.update', $product->id_produk) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        
        <div style="display: flex; gap: 40px;">
            <div style="text-align: center; width: 200px;">
                <div style="width: 160px; height: 160px; background: #f0f0f0; border-radius: 50%; margin: 0 auto 15px; display: flex; align-items: center; justify-content: center; overflow: hidden; border: 2px solid #eee;">
                    <img src="{{ asset('storage/produk/'.$product->foto_produk) }}" id="preview" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='https://placehold.co/160x160?text=No+Image'">
                </div>
                <input type="file" name="foto_produk" id="foto-input" style="display: none;" onchange="previewImg(this)">
                <button type="button" onclick="document.getElementById('foto-input').click()" style="background: white; border: 1px solid #ccc; padding: 7px 15px; border-radius: 20px; cursor: pointer; font-size: 12px;">Ganti Foto Produk</button>
            </div>

            <div style="flex: 1;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                    <div>
                        <label style="display: block; font-weight: bold; font-size: 13px;">Nama Produk</label>
                        <input type="text" name="nama_produk" value="{{ $product->nama_produk }}" style="width: 100%; padding: 10px; background: #f0f0f0; border: none; border-radius: 8px;">
                    </div>
                    <div>
                        <label style="display: block; font-weight: bold; font-size: 13px;">Harga</label>
                        <input type="number" name="harga_produk" value="{{ $product->harga_produk }}" style="width: 100%; padding: 10px; background: #f0f0f0; border: none; border-radius: 8px;">
                    </div>
                    <div>
                        <label style="display: block; font-weight: bold; font-size: 13px;">Stok</label>
                        <input type="number" name="stok_produk" value="{{ $product->stok_produk }}" style="width: 100%; padding: 10px; background: #f0f0f0; border: none; border-radius: 8px;">
                    </div>
                    <div>
                        <label style="display: block; font-weight: bold; font-size: 13px;">Kategori ID</label>
                        <input type="number" name="id_kategori" value="{{ $product->id_kategori }}" style="width: 100%; padding: 10px; background: #f0f0f0; border: none; border-radius: 8px;">
                    </div>
                </div>
                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-weight: bold; font-size: 13px;">Deskripsi</label>
                    <textarea name="deskripsi_produk" rows="3" style="width: 100%; padding: 10px; background: #f0f0f0; border: none; border-radius: 8px;">{{ $product->deskripsi_produk }}</textarea>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px;">
                    <button type="submit" style="background: #004d32; color: white; padding: 10px 25px; border: none; border-radius: 25px; cursor: pointer; font-weight: bold;">Simpan Perubahan</button>
                    <a href="{{ route('admin.menu') }}" style="background: #ccc; color: white; padding: 10px 25px; border: none; border-radius: 25px; text-decoration: none; font-size: 14px; display: flex; align-items: center; justify-content: center;">Batal</a>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
function previewImg(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) { document.getElementById('preview').src = e.target.result; }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>