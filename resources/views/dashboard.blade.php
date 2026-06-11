@extends('layouts.template')

@section('title', 'Dashboard')
@section('content')

<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ App\Models\UserModel::count() }}</h3>
                <p>Total User</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="{{ url('/user') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ App\Models\BarangModel::count() }}</h3>
                <p>Total Barang</p>
            </div>
            <div class="icon">
                <i class="fas fa-boxes"></i>
            </div>
            <a href="{{ url('/barang') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ App\Models\PenjualanModel::count() }}</h3>
                <p>Total Transaksi</p>
            </div>
            <div class="icon">
                <i class="fas fa-cash-register"></i>
            </div>
            <a href="{{ url('/penjualan') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ App\Models\StokModel::sum('stok_jumlah') }}</h3>
                <p>Total Stok</p>
            </div>
            <div class="icon">
                <i class="fas fa-cubes"></i>
            </div>
            <a href="{{ url('/stok') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Selamat Datang di Aplikasi PWL POS</h3>
            </div>
            <div class="card-body">
                <p>Sistem Point of Sales terintegrasi untuk mengelola:</p>
                <ul>
                    <li>Data User dan Level Pengguna</li>
                    <li>Data Kategori dan Barang</li>
                    <li>Stok Barang</li>
                    <li>Transaksi Penjualan</li>
                </ul>
                <hr>
                <p class="text-muted mb-0">Logged in as: <strong>{{ Auth::user()->nama }}</strong> ({{ Auth::user()->level->level_nama }})</p>
            </div>
        </div>
    </div>
</div>

@endsection