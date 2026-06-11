<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Data Barang</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h3 style="text-align: center;">LAPORAN DATA BARANG</h3>
    <table>
        <thead>
            <tr><th>No</th><th>Kode Barang</th><th>Nama Barang</th><th>Harga Beli</th><th>Harga Jual</th><th>Kategori</th></tr>
        </thead>
        <tbody>
            @foreach($barang as $key => $b)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $b->barang_kode }}</td>
                <td>{{ $b->barang_nama }}</td>
                <td>{{ number_format($b->harga_beli, 0, ',', '.') }}</td>
                <td>{{ number_format($b->harga_jual, 0, ',', '.') }}</td>
                <td>{{ $b->kategori->kategori_nama }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>