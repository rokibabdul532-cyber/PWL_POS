<!DOCTYPE html>
<html>
<head>
    <title>Data Kategori</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn { padding: 5px 10px; margin: 2px; text-decoration: none; color: white; border-radius: 3px; }
        .btn-success { background-color: #28a745; }
        .btn-warning { background-color: #ffc107; color: black; }
        .btn-danger { background-color: #dc3545; }
    </style>
</head>
<body>
    <h1>Data Kategori Barang</h1>
    <a href="{{ url('/kategori/create') }}" class="btn btn-success">Tambah Data</a>
    <br><br>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Kode Kategori</th>
                <th>Nama Kategori</th>
                <th>Created At</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $d)
            <tr>
                <td>{{ $d->kategori_id }}</td>
                <td>{{ $d->kategori_kode }}</td>
                <td>{{ $d->kategori_nama }}</td>
                <td>{{ $d->created_at }}</td>
                <td>
                    <a href="{{ url('/kategori/edit/' . $d->kategori_id) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ url('/kategori/delete/' . $d->kategori_id) }}" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>