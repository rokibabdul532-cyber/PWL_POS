<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;

// Route untuk Level (DB Façade)
Route::get('/level', [LevelController::class, 'index']);

// Route untuk Kategori (Query Builder)
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/kategori/create', [KategoriController::class, 'create']);
Route::post('/kategori/store', [KategoriController::class, 'store']);
Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit']);
Route::put('/kategori/update/{id}', [KategoriController::class, 'update']);
Route::get('/kategori/delete/{id}', [KategoriController::class, 'delete']);

// Route untuk User (Eloquent ORM) - CRUD Dasar
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/create', [UserController::class, 'create']);
Route::post('/user/store', [UserController::class, 'store']);
Route::get('/user/edit/{id}', [UserController::class, 'edit']);
Route::put('/user/update/{id}', [UserController::class, 'update']);
Route::get('/user/delete/{id}', [UserController::class, 'delete']);

// ========== JOBSHEET 4 - ROUTE BARU ==========

// Route untuk find() - Mencari user berdasarkan ID
Route::get('/user/find/{id}', [UserController::class, 'find']);

// Route untuk count() - Menampilkan agregasi data user
Route::get('/user/count', [UserController::class, 'count']);

// Route untuk firstOrCreate() - Mencari atau membuat data baru
Route::get('/user/first-or-create', [UserController::class, 'firstOrCreateUser']);

// Route untuk firstOrNew() - Mencari atau membuat object baru (belum tersimpan)
Route::get('/user/first-or-new', [UserController::class, 'firstOrNewUser']);

// Route untuk checkDirty() - Mengecek perubahan atribut
Route::get('/user/check-dirty', [UserController::class, 'checkDirty']);