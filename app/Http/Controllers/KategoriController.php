<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index()
    {
        // SELECT DATA (menampilkan semua data kategori)
        $data = DB::table('m_kategori')->get();
        return view('kategori', ['data' => $data]);
    }

    public function create()
    {
        return view('kategori_create');
    }

    public function store(Request $request)
    {
        $data = [
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama,
            'created_at' => now()
        ];
        DB::table('m_kategori')->insert($data);
        return redirect('/kategori');
    }

    public function edit($id)
    {
        $data = DB::table('m_kategori')->where('kategori_id', $id)->first();
        return view('kategori_edit', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $data = [
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama,
            'updated_at' => now()
        ];
        DB::table('m_kategori')->where('kategori_id', $id)->update($data);
        return redirect('/kategori');
    }

    public function delete($id)
    {
        DB::table('m_kategori')->where('kategori_id', $id)->delete();
        return redirect('/kategori');
    }
}