<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Models\LevelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
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

    public function list(Request $request)
    {
        $users = UserModel::select('user_id', 'username', 'nama', 'level_id')
            ->with('level');

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('aksi', function ($user) {
                $btn = '<button onclick="modalAction(\''.url('/user/' . $user->user_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/user/' . $user->user_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/user/' . $user->user_id . '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create_ajax()
    {
        $levels = LevelModel::select('level_id', 'level_nama')->get();
        return view('user.create_ajax', ['levels' => $levels]);
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_id' => 'required|integer',
                'username' => 'required|string|min:3|max:20|unique:m_user,username',
                'nama' => 'required|string|max:100',
                'password' => 'required|min:6'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            UserModel::create([
                'level_id' => $request->level_id,
                'username' => $request->username,
                'nama' => $request->nama,
                'password' => Hash::make($request->password),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Data user berhasil disimpan'
            ]);
        }
        return redirect('/');
    }

    public function edit_ajax($id)
    {
        $user = UserModel::find($id);
        $levels = LevelModel::select('level_id', 'level_nama')->get();
        return view('user.edit_ajax', ['user' => $user, 'levels' => $levels]);
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'level_id' => 'required|integer',
                'username' => 'required|string|min:3|max:20|unique:m_user,username,' . $id . ',user_id',
                'nama' => 'required|string|max:100',
                'password' => 'nullable|min:6'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            $user = UserModel::find($id);
            if ($user) {
                $user->level_id = $request->level_id;
                $user->username = $request->username;
                $user->nama = $request->nama;
                if ($request->password) {
                    $user->password = Hash::make($request->password);
                }
                $user->save();

                return response()->json([
                    'status' => true,
                    'message' => 'Data user berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    public function confirm_ajax($id)
    {
        $user = UserModel::find($id);
        return view('user.confirm_ajax', ['user' => $user]);
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $user = UserModel::find($id);
            if ($user) {
                $user->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
        return redirect('/');
    }

    // ========== SHOW AJAX - Detail User ==========
    public function show_ajax($id)
    {
        $user = UserModel::with('level')->find($id);
        return view('user.show_ajax', ['user' => $user]);
    }

    // ========== METHOD LAMA (CRUD Biasa) ==========
    public function create()
    {
        $levels = LevelModel::all();
        $activeMenu = 'user';
        return view('user_create', ['levels' => $levels, 'activeMenu' => $activeMenu]);
    }

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

    public function show($id)
    {
        $user = UserModel::with('level')->find($id);
        return view('user_show', ['user' => $user]);
    }

    public function edit($id)
    {
        $user = UserModel::find($id);
        $levels = LevelModel::all();
        return view('user_edit', ['data' => $user, 'levels' => $levels]);
    }

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

    public function delete($id)
    {
        UserModel::find($id)->delete();
        return redirect('/user');
    }

    // ========== JOBSHEET 4 ==========
    public function find($id)
    {
        $user = UserModel::find($id);
        return view('user_find', ['user' => $user]);
    }

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