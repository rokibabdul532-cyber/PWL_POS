<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

// ==================== ROUTE LOGIN & LOGOUT ====================
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

// ==================== ROUTE YANG MEMERLUKAN AUTENTIKASI ====================
Route::middleware(['auth'])->group(function () {

    // Halaman Home/Welcome
    Route::get('/', function () {
        return view('welcome');
    });

    // ==================== ROUTE UNTUK USER (Semua role bisa akses) ====================
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index']);                         // Menampilkan halaman awal user (DataTables)
        Route::post('/list', [UserController::class, 'list']);                    // Menampilkan data user dalam bentuk json untuk DataTables
        Route::get('/create', [UserController::class, 'create']);                // Menampilkan halaman form tambah user (biasa)
        Route::post('/store', [UserController::class, 'store']);                 // Menyimpan data user baru (biasa)
        Route::get('/{id}', [UserController::class, 'show']);                    // Menampilkan detail user (biasa)
        Route::get('/edit/{id}', [UserController::class, 'edit']);               // Menampilkan halaman form edit user (biasa)
        Route::put('/update/{id}', [UserController::class, 'update']);           // Menyimpan perubahan data user (biasa)
        Route::delete('/{id}', [UserController::class, 'delete']);               // Menghapus data user (biasa)

        // Route Ajax
        Route::get('/create_ajax', [UserController::class, 'create_ajax']);      // Menampilkan form tambah user (Ajax)
        Route::post('/ajax', [UserController::class, 'store_ajax']);             // Menyimpan data user baru (Ajax)
        Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);     // Menampilkan form edit user (Ajax)
        Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // Menyimpan perubahan data user (Ajax)
        Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']); // Menampilkan konfirmasi hapus (Ajax)
        Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // Menghapus data user (Ajax)

        // Route Tambahan Jobsheet 4
        Route::get('/find/{id}', [UserController::class, 'find']);               // Mencari user berdasarkan ID
        Route::get('/count', [UserController::class, 'count']);                  // Menampilkan agregasi data user
        Route::get('/first-or-create', [UserController::class, 'firstOrCreateUser']); // firstOrCreate
        Route::get('/first-or-new', [UserController::class, 'firstOrNewUser']);  // firstOrNew
        Route::get('/check-dirty', [UserController::class, 'checkDirty']);       // Mengecek perubahan atribut
    });

    // ==================== ROUTE YANG HANYA BISA DIAKSES ADMIN ====================
    Route::middleware(['authorize:ADM'])->group(function () {

        // Route untuk Level (DB Façade)
        Route::get('/level', [LevelController::class, 'index']);

        // Route untuk Kategori (Query Builder)
        Route::prefix('kategori')->group(function () {
            Route::get('/', [KategoriController::class, 'index']);
            Route::get('/create', [KategoriController::class, 'create']);
            Route::post('/store', [KategoriController::class, 'store']);
            Route::get('/edit/{id}', [KategoriController::class, 'edit']);
            Route::put('/update/{id}', [KategoriController::class, 'update']);
            Route::get('/delete/{id}', [KategoriController::class, 'delete']);
        });
    });
});