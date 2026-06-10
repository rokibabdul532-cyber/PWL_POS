<!DOCTYPE html>
<html>
<head>
    <title>Tambah User</title>
    <style>
        .form-group { margin-bottom: 15px; }
        label { display: inline-block; width: 100px; }
        input, select { padding: 5px; width: 200px; }
        .btn { padding: 5px 15px; background-color: #007bff; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Tambah User</h1>
    <form action="{{ url('/user/store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Level</label>
            <select name="level_id" required>
                <option value="">Pilih Level</option>
                @foreach($levels as $l)
                <option value="{{ $l->level_id }}">{{ $l->level_nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" required>
        </div>
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit" class="btn">Simpan</button>
        <a href="{{ url('/user') }}">Kembali</a>
    </form>
</body>
</html>