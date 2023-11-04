<?php

use App\Http\Controllers\Admin\AlatDipinjamController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Inspektor\DashboardInspektorController;
use App\Http\Controllers\Inspektor\InspeksiController;
use App\Http\Controllers\Peminjam\PeminjamController;
use App\Models\Inspeksi;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::name('peminjam.')->controller(PeminjamController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('pinjam', 'pinjam')->name('pinjam');
    Route::get('scan-barang/{kodeBarang}', 'scan')->name('scan');
});

Route::group(['controller' => AuthController::class], function() {
    Route::get('login', 'showLoginForm')->name('login.index');
    Route::get('register', 'showRegisterForm')->name('register.index');
    
    Route::post('login', 'login')->name('login.authenticate');
    Route::post('register', 'register')->name('register.create');
    Route::get('logout', 'logout')->name('logout');
});

Route::middleware('auth')->group(function () {
    
    Route::name('admin.')->middleware('role:admin')->prefix('admin')->group(function () {    
        Route::get('/', [DashboardAdminController::class, 'index'])->name('index');
        Route::get('list-alat-dipinjam', [AlatDipinjamController::class, 'index'])->name('list-alat-dipinjam');
        Route::resource('barang', BarangController::class);
    });
    
    Route::name('inspektor.')->middleware('role:inspektor')->prefix('inspektor')->group(function () {
        Route::get('/', [DashboardInspektorController::class, 'index'])->name('index');
        Route::get('inspeksi/scan-barang/{kode}', [InspeksiController::class, 'scan']);
        Route::resource('inspeksi', InspeksiController::class);
    });
});