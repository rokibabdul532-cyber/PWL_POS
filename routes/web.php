<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;

// ==================== ROUTE UNTUK LEVEL (DB Façade) ====================
Route::get('/level', [LevelController::class, 'index']);

// ==================== ROUTE UNTUK KATEGORI (Query Builder) ====================
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/kategori/create', [KategoriController::class, 'create']);
Route::post('/kategori/store', [KategoriController::class, 'store']);
Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit']);
Route::put('/kategori/update/{id}', [KategoriController::class, 'update']);
Route::get('/kategori/delete/{id}', [KategoriController::class, 'delete']);

// ==================== ROUTE UNTUK USER (Eloquent ORM) ====================

// JOBSHEET 5 - DataTables & CRUD
Route::get('/user', [UserController::class, 'index']);              // Menampilkan halaman awal user (DataTables)
Route::post('/user/list', [UserController::class, 'list']);         // Menampilkan data user dalam bentuk json untuk DataTables
Route::get('/user/create', [UserController::class, 'create']);      // Menampilkan halaman form tambah user
Route::post('/user/store', [UserController::class, 'store']);       // Menyimpan data user baru
Route::get('/user/{id}', [UserController::class, 'show']);          // Menampilkan detail user
Route::get('/user/edit/{id}', [UserController::class, 'edit']);     // Menampilkan halaman form edit user
Route::put('/user/update/{id}', [UserController::class, 'update']); // Menyimpan perubahan data user
Route::delete('/user/{id}', [UserController::class, 'delete']);     // Menghapus data user

// ==================== JOBSHEET 4 - ROUTE TAMBAHAN ====================
Route::get('/user/find/{id}', [UserController::class, 'find']);                 // Mencari user berdasarkan ID
Route::get('/user/count', [UserController::class, 'count']);                   // Menampilkan agregasi data user
Route::get('/user/first-or-create', [UserController::class, 'firstOrCreateUser']); // firstOrCreate
Route::get('/user/first-or-new', [UserController::class, 'firstOrNewUser']);   // firstOrNew
Route::get('/user/check-dirty', [UserController::class, 'checkDirty']);        // Mengecek perubahan atribut