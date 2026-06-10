<!DOCTYPE html>
<html>
<head>
    <title>Edit Kategori</title>
    <style>
        .form-group { margin-bottom: 15px; }
        label { display: inline-block; width: 100px; }
        input { padding: 5px; width: 200px; }
        .btn { padding: 5px 15px; background-color: #28a745; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Edit Kategori Barang</h1>
    <form action="{{ url('/kategori/update/' . $data->kategori_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Kode Kategori</label>
            <input type="text" name="kategori_kode" value="{{ $data->kategori_kode }}" required>
        </div>
        <div class="form-group">
            <label>Nama Kategori</label>
            <input type="text" name="kategori_nama" value="{{ $data->kategori_nama }}" required>
        </div>
        <button type="submit" class="btn">Update</button>
        <a href="{{ url('/kategori') }}">Kembali</a>
    </form>
</body>
</html>