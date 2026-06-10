<!DOCTYPE html>
<html>
<head>
    <title>Agregasi Data User</title>
    <style>
        table { border-collapse: collapse; width: 400px; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; width: 150px; }
        .btn { padding: 5px 10px; text-decoration: none; color: white; border-radius: 3px; }
        .btn-back { background-color: #6c757d; }
        .container { margin: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Agregasi Data User</h1>
        
        <table>
            <tr>
                <th>Total User</th>
                <td>{{ $count }}</td>
            </tr>
            <tr>
                <th>ID Terbesar (Max)</th>
                <td>{{ $max }}</td>
            </tr>
            <tr>
                <th>ID Terkecil (Min)</th>
                <td>{{ $min }}</td>
            </tr>
            <tr>
                <th>Jumlah ID (Sum)</th>
                <td>{{ $sum }}</td>
            </tr>
            <tr>
                <th>Rata-rata ID (Avg)</th>
                <td>{{ number_format($avg, 2) }}</td>
            </tr>
        </table>
        
        <br>
        <a href="{{ url('/user') }}" class="btn btn-back">Kembali ke Daftar User</a>
        <br><br>
        <hr>
        <small>Data diambil menggunakan Eloquent ORM: count(), max(), min(), sum(), avg()</small>
    </div>
</body>
</html>