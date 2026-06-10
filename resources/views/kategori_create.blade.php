<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kategori</title>
    <style>
        .form-group { margin-bottom: 15px; }
        label { display: inline-block; width: 100px; }
        input { padding: 5px; width: 200px; }
        .btn { padding: 5px 15px; background-color: #007bff; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Tambah Kategori Barang</h1>
    <form action="{{ url('/kategori/store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Kode Kategori</label>
            <input type="text" name="kategori_kode" required>
        </div>
        <div class="form-group">
            <label>Nama Kategori</label>
            <input type="text" name="kategori_nama" required>
        </div>
        <button type="submit" class="btn">Simpan</button>
        <a href="{{ url('/kategori') }}">Kembali</a>
    </form>
</body>
</html>