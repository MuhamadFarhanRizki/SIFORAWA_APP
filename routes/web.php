<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\CekstatusPengaduanController;
use App\Http\Controllers\ProfilController;

// ==============================
// LOGIN
// ==============================

Route::get('/', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

// ==============================
// REGISTER WARGA
// ==============================

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.process');

// ==============================
// ROUTE SETELAH LOGIN
// ==============================

Route::middleware('auth')->group(function () {

    // ==============================
    // DASHBOARD ADMIN
    // ==============================

    Route::get('/admin/dashboard', [
        AdminController::class,
        'dashboard'
    ])->name('admin.dashboard');

    // ==============================
    // PENGADUAN ADMIN
    // ==============================

    Route::prefix('admin')->name('admin.')->group(function () {

        // DAFTAR SEMUA PENGADUAN WARGA
        Route::get('/pengaduan', [
            PengaduanController::class,
            'indexAdmin'
        ])->name('pengaduan.index');

        // RIWAYAT PENGADUAN (ROUTE LAMA DIPERTAHANKAN)
        Route::get('/riwayat-pengaduan', [
            PengaduanController::class,
            'riwayatAdmin'
        ])->name('pengaduan.riwayat');

        // RIWAYAT PENGADUAN
        // Nama route: admin.riwayat.index
        Route::get('/riwayat-pengaduan', [
            PengaduanController::class,
            'riwayatAdmin'
        ])->name('riwayat.index');

        // DETAIL PENGADUAN ADMIN
        Route::get('/pengaduan/{pengaduan}', [
            PengaduanController::class,
            'showAdmin'
        ])->whereNumber('pengaduan')
          ->name('pengaduan.show');

        // SIMPAN PERUBAHAN STATUS PENGADUAN
        // Nama route tetap: admin.pengaduan.update
        Route::patch('/pengaduan/{pengaduan}', [
            PengaduanController::class,
            'updateStatusAdmin'
        ])->whereNumber('pengaduan')
          ->name('pengaduan.update');

        // SIMPAN TANGGAPAN ADMIN BARU
        Route::post('/pengaduan/{pengaduan}/tanggapan', [
            PengaduanController::class,
            'storeTanggapanAdmin'
        ])->whereNumber('pengaduan')
          ->name('pengaduan.tanggapan.store');

        // EDIT / UPDATE TANGGAPAN LAMA
        Route::put(
            '/pengaduan/{pengaduan}/tanggapan/{tanggapan}',
            [PengaduanController::class, 'updateTanggapanAdmin']
        )->whereNumber('pengaduan')
         ->whereNumber('tanggapan')
         ->name('pengaduan.tanggapan.update');

        // HAPUS TANGGAPAN
        Route::delete(
            '/pengaduan/{pengaduan}/tanggapan/{tanggapan}',
            [PengaduanController::class, 'destroyTanggapanAdmin']
        )->whereNumber('pengaduan')
         ->whereNumber('tanggapan')
         ->name('pengaduan.tanggapan.destroy');

        // PROFIL ADMIN
        Route::get('/profil', [
            ProfilController::class,
            'adminIndex'
        ])->name('profil');
    });

    // ==============================
    // DASHBOARD WARGA
    // ==============================

    Route::get('/warga/dashboard', [
        WargaController::class,
        'dashboard'
    ])->name('warga.dashboard');

    // ==============================
    // PROFIL WARGA
    // ==============================

    Route::get('/warga/profil', [
        ProfilController::class,
        'index'
    ])->name('warga.profil');

    // PROSES GANTI PASSWORD WARGA
    Route::put('/warga/profil/password', [
        ProfilController::class,
        'updatePassword'
    ])->name('profil.password.update');

    // ==============================
    // FORM DAN PROSES PENGADUAN WARGA
    // ==============================

    Route::prefix('warga')->name('warga.')->group(function () {

        // FORM BUAT PENGADUAN
        Route::get('/pengaduan/create', [
            PengaduanController::class,
            'create'
        ])->name('pengaduan.create');

        // SIMPAN PENGADUAN
        Route::post('/pengaduan', [
            PengaduanController::class,
            'store'
        ])->name('pengaduan.store');
    });

    // ==============================
    // CEK STATUS PENGADUAN WARGA
    // ==============================

    Route::prefix('warga')->name('warga.')->group(function () {

        // DAFTAR PENGADUAN WARGA
        Route::get('/pengaduan', [
            CekstatusPengaduanController::class,
            'index'
        ])->name('pengaduan.index');

        // ==========================================
        // EDIT PENGADUAN WARGA
        // ==========================================

        Route::get('/pengaduan/{pengaduan}/edit', [
            CekstatusPengaduanController::class,
            'edit'
        ])->whereNumber('pengaduan')
          ->name('pengaduan.edit');

        // ==========================================
        // UPDATE PENGADUAN WARGA
        // ==========================================

        Route::put('/pengaduan/{pengaduan}', [
            CekstatusPengaduanController::class,
            'update'
        ])->whereNumber('pengaduan')
          ->name('pengaduan.update');

        // ==========================================
        // HAPUS PENGADUAN WARGA
        // ==========================================

        Route::delete('/pengaduan/{pengaduan}', [
            CekstatusPengaduanController::class,
            'destroy'
        ])->whereNumber('pengaduan')
          ->name('pengaduan.destroy');

        // ==========================================
        // DETAIL PENGADUAN DAN TANGGAPAN ADMIN
        // ==========================================

        Route::get('/pengaduan/{pengaduan}', [
            CekstatusPengaduanController::class,
            'show'
        ])->whereNumber('pengaduan')
          ->name('pengaduan.show');
    });

    // ==============================
    // LOGOUT
    // ==============================

    Route::post('/logout', [
        AuthController::class,
        'logout'
    ])->name('logout');

});