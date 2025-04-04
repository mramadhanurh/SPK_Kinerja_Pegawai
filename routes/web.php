<?php

use App\Http\Controllers\BobotController;
use App\Http\Controllers\HimpunanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Response;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\StafController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\KlasifikasiController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PangkatController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\TopsisController;

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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'is_admin:1'])->group(function () {
    // Home Manager
    Route::get('/manager', [ManagerController::class, 'index'])->name('manager');

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/cetak/{id}', [LaporanController::class, 'cetakLaporan'])->name('laporan.cetak');

});

Route::middleware(['auth', 'is_admin:2'])->group(function () {
    // Home Staf
    Route::get('/staf', [StafController::class, 'index'])->name('staf');

    // Data Jabatan
    Route::resource('jabatan', JabatanController::class);

    // Data Pangkat
    Route::resource('pangkat', PangkatController::class);

    // Data Pegawai
    // Route::resource('pegawai', PegawaiController::class);

    // Data Bobot
    Route::resource('bobot', BobotController::class);

    // Data Kriteria
    Route::resource('kriteria', KriteriaController::class);

    // Algoritma Topsis
    Route::get('/topsis', [TopsisController::class, 'index'])->name('topsis.index');

    // Data Himpunan Kriteria
    Route::resource('himpunan', HimpunanController::class);

    // Data Proses Klasifikasi
    Route::get('/klasifikasi', [KlasifikasiController::class, 'index'])->name('klasifikasi.index');
    Route::post('/klasifikasi', [KlasifikasiController::class, 'store'])->name('klasifikasi.store');

});

Route::middleware(['auth', 'is_admin:3'])->group(function () {
    // Home User
    Route::get('/user', [UserController::class, 'index'])->name('user');

    // Data Pengguna
    Route::resource('pengguna', PenggunaController::class);

    // Data Jabatan
    // Route::resource('jabatan', JabatanController::class);

    // Data Pangkat
    // Route::resource('pangkat', PangkatController::class);

    // Data Pegawai
    Route::resource('pegawai', PegawaiController::class);

    // Data Bobot
    // Route::resource('bobot', BobotController::class);

    // Data Kriteria
    // Route::resource('kriteria', KriteriaController::class);

    // Algoritma Topsis
    // Route::get('/topsis', [TopsisController::class, 'index'])->name('topsis.index');

    // Data Himpunan Kriteria
    // Route::resource('himpunan', HimpunanController::class);

    // Data Proses Klasifikasi
    // Route::get('/klasifikasi', [KlasifikasiController::class, 'index'])->name('klasifikasi.index');
    // Route::post('/klasifikasi', [KlasifikasiController::class, 'store'])->name('klasifikasi.store');

    // Laporan
    // Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    // Route::get('/laporan/cetak/{id}', [LaporanController::class, 'cetakLaporan'])->name('laporan.cetak');

});