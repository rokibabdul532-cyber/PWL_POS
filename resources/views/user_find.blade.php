<!DOCTYPE html>
<html>
<head>
    <title>Detail User</title>
    <style>
        .card { border: 1px solid #ddd; padding: 20px; border-radius: 5px; max-width: 500px; margin-top: 20px; }
        .field { margin-bottom: 10px; }
        .label { font-weight: bold; display: inline-block; width: 100px; }
        .btn { padding: 5px 10px; text-decoration: none; color: white; border-radius: 3px; }
        .btn-back { background-color: #6c757d; }
    </style>
</head>
<body>
    <h1>Detail User</h1>
    
    @if($user)
    <div class="card">
        <div class="field"><span class="label">ID:</span> {{ $user->user_id }}</div>
        <div class="field"><span class="label">Level:</span> {{ $user->level->level_nama }}</div>
        <div class="field"><span class="label">Username:</span> {{ $user->username }}</div>
        <div class="field"><span class="label">Nama:</span> {{ $user->nama }}</div>
        <div class="field"><span class="label">Created At:</span> {{ $user->created_at }}</div>
        <div class="field"><span class="label">Updated At:</span> {{ $user->updated_at }}</div>
    </div>
    @else
        <p style="color: red;">User tidak ditemukan</p>
    @endif
    
    <br>
    <a href="{{ url('/user') }}" class="btn btn-back">Kembali ke Daftar User</a>
</body>
</html>