<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    public function run(): void
    {
        // Data penjualan
        DB::table('t_penjualan')->insert([
            ['penjualan_id' => 1, 'user_id' => 1, 'pembeli' => 'Budi', 'penjualan_kode' => 'TRX00001', 'penjualan_tanggal' => '2025-06-10'],
            ['penjualan_id' => 2, 'user_id' => 2, 'pembeli' => 'Ani', 'penjualan_kode' => 'TRX00002', 'penjualan_tanggal' => '2025-06-10'],
            ['penjualan_id' => 3, 'user_id' => 3, 'pembeli' => 'Citra', 'penjualan_kode' => 'TRX00003', 'penjualan_tanggal' => '2025-06-11'],
        ]);

        // Data detail penjualan
        DB::table('t_penjualan_detail')->insert([
            ['detail_id' => 1, 'penjualan_id' => 1, 'barang_id' => 1, 'harga' => 3500, 'jumlah' => 2],
            ['detail_id' => 2, 'penjualan_id' => 1, 'barang_id' => 2, 'harga' => 4500, 'jumlah' => 1],
            ['detail_id' => 3, 'penjualan_id' => 2, 'barang_id' => 3, 'harga' => 4500, 'jumlah' => 3],
            ['detail_id' => 4, 'penjualan_id' => 2, 'barang_id' => 4, 'harga' => 3500, 'jumlah' => 2],
            ['detail_id' => 5, 'penjualan_id' => 3, 'barang_id' => 5, 'harga' => 15000, 'jumlah' => 1],
        ]);
    }
}