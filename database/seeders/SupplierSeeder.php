<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('m_supplier')->insert([
            ['supplier_kode' => 'SPL1', 'supplier_nama' => 'PT Sumber Makmur', 'supplier_alamat' => 'Jl. Raya No. 1 Malang'],
            ['supplier_kode' => 'SPL2', 'supplier_nama' => 'CV Berkah Abadi', 'supplier_alamat' => 'Jl. Sudirman No. 45 Surabaya'],
            ['supplier_kode' => 'SPL3', 'supplier_nama' => 'UD Jaya Sentosa', 'supplier_alamat' => 'Jl. Diponegoro No. 78 Jakarta'],
        ]);
    }
}