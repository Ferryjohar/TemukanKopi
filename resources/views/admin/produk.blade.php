<h1>Data Produk Kopi</h1>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <input type="text" name="nama_produk" placeholder="Nama Produk" required><br><br>

    <input type="number" name="harga" placeholder="Harga" required><br><br>

    <textarea name="deskripsi" placeholder="Deskripsi" required></textarea><br><br>

    <input type="file" name="gambar" required><br><br>

    <button type="submit">Tambah Produk</button>
</form>

<hr>

<table border="1">
<tr>
    <th>Nama</th>
    <th>Harga</th>
    <th>Deskripsi</th>
    <th>Gambar</th>
</tr>

@foreach($produk as $p)
<tr>
    <td>{{ $p->nama_produk }}</td>
    <td>{{ $p->harga }}</td>
    <td>{{ $p->deskripsi }}</td>
    <td>
        <img src="{{ asset('images/'.$p->gambar) }}" width="100">
    </td>
</tr>
@endforeach
</table>