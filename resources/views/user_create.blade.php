@extends('layouts.template')

@section('title', 'Tambah User')
@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Form Tambah User</h3>
        <div class="card-tools">
            <a href="{{ url('/user') }}" class="btn btn-sm btn-primary">Kembali</a>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ url('/user/store') }}" method="POST">
            @csrf
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Level Pengguna</label>
                <div class="col-sm-10">
                    <select name="level_id" class="form-control" required>
                        <option value="">- Pilih Level -</option>
                        @foreach($levels as $l)
                            <option value="{{ $l->level_id }}">{{ $l->level_nama }}</option>
                        @endforeach
                    </select>
                    @error('level_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
                    @error('username')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Lengkap</label>
                <div class="col-sm-10">
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama lengkap" required>
                    @error('nama')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ url('/user') }}" class="btn btn-default ml-1">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection