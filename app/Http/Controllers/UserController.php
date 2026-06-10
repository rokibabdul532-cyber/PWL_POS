<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Models\LevelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    // READ - Menampilkan halaman user dengan DataTables
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar User',
            'list' => ['Home', 'User']
        ];
        $page = (object) [
            'title' => 'Daftar user yang terdaftar dalam sistem'
        ];
        $activeMenu = 'user';

        return view('user', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    // Ambil data user dalam bentuk json untuk DataTables
    public function list(Request $request)
    {
        $users = UserModel::select('user_id', 'username', 'nama', 'level_id')
            ->with('level');

        return DataTables::of($users)
            ->addIndexColumn() // menambahkan kolom index / no urut
            ->addColumn('aksi', function ($user) {
                $btn = '<a href="'.url('/user/' . $user->user_id).'" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="'.url('/user/edit/' . $user->user_id).'" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'.url('/user/'.$user->user_id).'">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    // CREATE - Menampilkan form tambah
    public function create()
    {
        $levels = LevelModel::all();
        return view('user_create', ['levels' => $levels]);
    }

    // CREATE - Menyimpan data baru
    public function store(Request $request)
    {
        UserModel::create([
            'level_id' => $request->level_id,
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
        ]);
        return redirect('/user');
    }

    // SHOW - Menampilkan detail user
    public function show($id)
    {
        $user = UserModel::with('level')->find($id);
        return view('user_show', ['user' => $user]);
    }

    // UPDATE - Menampilkan form edit
    public function edit($id)
    {
        $user = UserModel::find($id);
        $levels = LevelModel::all();
        return view('user_edit', ['data' => $user, 'levels' => $levels]);
    }

    // UPDATE - Menyimpan perubahan
    public function update(Request $request, $id)
    {
        $user = UserModel::find($id);
        $user->level_id = $request->level_id;
        $user->username = $request->username;
        $user->nama = $request->nama;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return redirect('/user');
    }

    // DELETE - Menghapus data
    public function delete($id)
    {
        UserModel::find($id)->delete();
        return redirect('/user');
    }

    // ========== JOBSHEET 4 - METHOD BARU ==========

    // find() - Mencari user berdasarkan ID
    public function find($id)
    {
        $user = UserModel::find($id);
        return view('user_find', ['user' => $user]);
    }

    // count() - Menampilkan agregasi data user
    public function count()
    {
        $count = UserModel::count();
        $maxId = UserModel::max('user_id');
        $minId = UserModel::min('user_id');
        $sumId = UserModel::sum('user_id');
        $avgId = UserModel::avg('user_id');
        
        return view('user_count', [
            'count' => $count,
            'max' => $maxId,
            'min' => $minId,
            'sum' => $sumId,
            'avg' => $avgId
        ]);
    }

    // firstOrCreate() - Mencari atau membuat data baru
    public function firstOrCreateUser()
    {
        $user = UserModel::firstOrCreate(
            ['username' => 'kasir2'],
            [
                'level_id' => 3,
                'nama' => 'Kasir Dua',
                'password' => Hash::make('12345')
            ]
        );
        return view('user_find', ['user' => $user]);
    }

    // firstOrNew() - Mencari atau membuat object baru (belum tersimpan)
    public function firstOrNewUser()
    {
        $user = UserModel::firstOrNew(
            ['username' => 'kasir3'],
            [
                'level_id' => 3,
                'nama' => 'Kasir Tiga',
                'password' => Hash::make('12345')
            ]
        );
        return view('user_find', ['user' => $user]);
    }

    // checkDirty() - Mengecek perubahan atribut
    public function checkDirty()
    {
        $user = UserModel::find(1);
        
        $user->nama = 'Administrator Update';
        $isDirty = $user->isDirty();
        $isDirtyNama = $user->isDirty('nama');
        $isClean = $user->isClean();
        
        $user->save();
        $wasChanged = $user->wasChanged();
        
        return response()->json([
            'isDirty' => $isDirty,
            'isDirtyNama' => $isDirtyNama,
            'isClean' => $isClean,
            'wasChanged' => $wasChanged
        ]);
    }
}