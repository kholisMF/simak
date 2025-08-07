<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KonfigurationController;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::middleware([\App\Http\Middleware\AdminAuthMiddleware::class])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/user', UserController::class); // resource artinya semua CRUD berlaku di UserController 
    Route::resource('/karyawan', KaryawanController::class);
    Route::get('/karyawan/kabkota/{id}', [KaryawanController::class, 'getKabKota']);
    Route::get('/karyawan/kecamatan/{id}', [KaryawanController::class, 'getKecamatan']);
    Route::get('/karyawan/kelurahan/{id}', [KaryawanController::class, 'getKelurahan']);
    Route::resource('/konfigurasi', KonfigurationController::class);
    
    Route::post('/user/toggle-active', [UserController::class, 'blokUser'])->name('user.blokUser');
});
