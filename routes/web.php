<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KepalaSekolahController;
use App\Http\Controllers\GuruPNSController;
use App\Http\Controllers\GuruPNSAbsenController;
use App\Http\Controllers\GuruPTTController;
use App\Http\Controllers\GuruPTTAbsenController;
use App\Http\Controllers\LaporanAbsenController;
use App\Http\Controllers\KoordinatSekolahController;

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

Route::get('login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);

Route::group(['middleware' => ['auth', 'ceklevel:admin,kepsek,guru_pns,guru_ptt']], function () {

    Route::get('/', [HomeController::class, 'index'])->name('dashboard');

    Route::resource('admin', AdminController::class);

    Route::resource('guru-pns', GuruPNSController::class);
});

Route::group(['middleware' => ['auth', 'ceklevel:admin']], function () {

    Route::resource('admin', AdminController::class);

    Route::resource('kepala-sekolah', KepalaSekolahController::class);

    Route::resource('guru-pns', GuruPNSController::class);

    Route::get('/laporan-absensi-pns', [LaporanAbsenController::class, 'laporanPNS']);
    Route::get('/filter-pns/{tglawal}/{tglakhir}', [LaporanAbsenController::class, 'filterPNS']);
    Route::get('/cetak-pns/{data1}/{data2}', [LaporanAbsenController::class, 'cetakPNS']);


    Route::get('lokasi-sekolah', [KoordinatSekolahController::class, 'index']);
    Route::post('ubah-koordinat', [KoordinatSekolahController::class, 'update']);
});


Route::group(['middleware' => ['auth', 'ceklevel:guru_pns']], function () {

    Route::resource('absen-guru-pns', GuruPNSAbsenController::class);
    Route::post('absen-guru-pns-keluar', [GuruPNSAbsenController::class, 'absenKeluar'])->name('absen-pns-keluar');
});



Route::group(['middleware' => ['auth', 'ceklevel:guru_pns']], function () {

    Route::view('lokasi-anda', 'pages.lokasi.lokasi-anda');
});
