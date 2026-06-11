<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('t_stok')->insert([
            ['barang_id' => 1, 'user_id' => 1, 'stok_jumlah' => 50, 'stok_tanggal' => '2025-06-01'],
            ['barang_id' => 2, 'user_id' => 1, 'stok_jumlah' => 30, 'stok_tanggal' => '2025-06-02'],
            ['barang_id' => 3, 'user_id' => 2, 'stok_jumlah' => 100, 'stok_tanggal' => '2025-06-03'],
            ['barang_id' => 4, 'user_id' => 2, 'stok_jumlah' => 25, 'stok_tanggal' => '2025-06-04'],
            ['barang_id' => 5, 'user_id' => 3, 'stok_jumlah' => 15, 'stok_tanggal' => '2025-06-05'],
        ]);
    }
}