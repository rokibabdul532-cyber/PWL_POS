<!DOCTYPE html>
<html>
<head>
    <title>Data Level</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Data Level Pengguna</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Kode Level</th>
                <th>Nama Level</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $d)
            <tr>
                <td>{{ $d->level_id }}</td>
                <td>{{ $d->level_kode }}</td>
                <td>{{ $d->level_nama }}</td>
                <td>{{ $d->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>