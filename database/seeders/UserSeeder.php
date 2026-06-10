<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('m_user')->insert([
            ['level_id' => 1, 'username' => 'admin', 'nama' => 'Administrator', 'password' => Hash::make('12345')],
            ['level_id' => 2, 'username' => 'manager', 'nama' => 'Manager', 'password' => Hash::make('12345')],
            ['level_id' => 3, 'username' => 'kasir', 'nama' => 'Kasir', 'password' => Hash::make('12345')],
        ]);
    }
}