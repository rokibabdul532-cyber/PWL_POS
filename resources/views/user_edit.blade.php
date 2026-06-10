<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <style>
        .form-group { margin-bottom: 15px; }
        label { display: inline-block; width: 100px; }
        input, select { padding: 5px; width: 200px; }
        .btn { padding: 5px 15px; background-color: #28a745; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Edit User</h1>
    <form action="{{ url('/user/update/' . $data->user_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Level</label>
            <select name="level_id" required>
                @foreach($levels as $l)
                <option value="{{ $l->level_id }}" {{ ($l->level_id == $data->level_id) ? 'selected' : '' }}>{{ $l->level_nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" value="{{ $data->username }}" required>
        </div>
        <div class="form-group">
            <label>Nama</label>
            <input type="text" name="nama" value="{{ $data->nama }}" required>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" placeholder="Kosongkan jika tidak diubah">
        </div>
        <button type="submit" class="btn">Update</button>
        <a href="{{ url('/user') }}">Kembali</a>
    </form>
</body>
</html>