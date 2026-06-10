<!DOCTYPE html>
<html>
<head>
    <title>Data User</title>
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
    <h1>Data User</h1>
    <a href="{{ url('/user/create') }}" class="btn btn-success">Tambah User</a>
    <br><br>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Level</th>
                <th>Username</th>
                <th>Nama</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $d)
            <tr>
                <td>{{ $d->user_id }}</td>
                <td>{{ $d->level->level_nama }}</td>
                <td>{{ $d->username }}</td>
                <td>{{ $d->nama }}</td>
                <td>
                    <a href="{{ url('/user/edit/' . $d->user_id) }}" class="btn btn-warning">Edit</a>
                    <a href="{{ url('/user/delete/' . $d->user_id) }}" class="btn btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>