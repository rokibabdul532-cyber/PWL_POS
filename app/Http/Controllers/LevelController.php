<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LevelController extends Controller
{
    public function index()
    {
        // INSERT DATA (jalankan sekali saja, lalu komentar)
        // DB::insert('insert into m_level(level_kode, level_nama, created_at) values(?, ?, ?)', ['CUS', 'Pelanggan', now()]);
        // return 'Insert data baru berhasil';

        // UPDATE DATA (jalankan sekali saja, lalu komentar)
        // DB::update('update m_level set level_nama = ? where level_kode = ?', ['Customer', 'CUS']);
        // return 'Update data berhasil';

        // DELETE DATA (jalankan sekali saja, lalu komentar)
        // DB::delete('delete from m_level where level_kode = ?', ['CUS']);
        // return 'Delete data berhasil';

        // SELECT DATA (aktifkan ini untuk menampilkan data)
        $data = DB::select('select * from m_level');
        return view('level', ['data' => $data]);
    }
}