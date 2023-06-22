<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\SiswaAbsenController;
use App\Http\Controllers\EditProfileController;
use App\Http\Controllers\TahunAjarController;
use App\Http\Controllers\LaporanAbsenController;
use App\Http\Controllers\KoordinatSekolahController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\WebcamController;

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

Route::group(['middleware' => ['auth', 'ceklevel:admin,siswa']], function () {

    Route::get('/', [HomeController::class, 'index'])->name('dashboard');

    Route::resource('admin', AdminController::class);

    Route::resource('siswa', SiswaController::class);
});

Route::group(['middleware' => ['auth', 'ceklevel:admin']], function () {

    Route::resource('admin', AdminController::class);
    Route::resource('kelas', KelasController::class);
    Route::resource('tahunajar', TahunAjarController::class);
    Route::resource('siswa', SiswaController::class);
    Route::resource('transaksi', TransaksiController::class);
    Route::get('/filtertransaksi/{idkelas}/{idtahunajar}', [TransaksiController::class, 'filter']);
    Route::get('/hapustransaksi/{idkelas}/{idtahunajar}', [TransaksiController::class, 'hapus']);
    Route::get('/laporan-absensi', [LaporanAbsenController::class, 'laporan']);
    Route::delete('/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('transaksi.destroy');
    Route::get('/filter/{tglawal}/{tglakhir}/{idkelas}/{idtahunajar}', [LaporanAbsenController::class, 'filter']);
    Route::get('/cetak/{data1}/{data2}/{data3}/{data4}', [LaporanAbsenController::class, 'cetak']);
    Route::get('lokasi-sekolah', [KoordinatSekolahController::class, 'index']);
    Route::post('ubah-koordinat', [KoordinatSekolahController::class, 'update']);
    Route::post('/import_excel/import', [SiswaController::class, 'import']);
});


Route::group(['middleware' => ['auth', 'ceklevel:siswa']], function () {

    Route::resource('absen-siswa', SiswaAbsenController::class);
    Route::post('absen-siswa-keluar', [SiswaAbsenController::class, 'absenKeluar'])->name('absen-siswa-keluar');
    Route::resource('edit-profile', EditProfileController::class);
   
   
});



Route::group(['middleware' => ['auth', 'ceklevel:siswa']], function () {

    Route::view('lokasi-anda', 'pages.lokasi.lokasi-anda');
});
