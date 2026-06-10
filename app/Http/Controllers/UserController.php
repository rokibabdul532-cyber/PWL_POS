<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use App\Models\LevelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = UserModel::with('level')->get();
        return view('user', ['data' => $users]);
    }

    public function create()
    {
        $levels = LevelModel::all();
        return view('user_create', ['levels' => $levels]);
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
}