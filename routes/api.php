<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SppController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\RegisterAdmin;
use App\Http\Controllers\HomeController;
use App\Models\Pembayaran;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// user
Route::post('/register/admin', [RegisterAdmin::class, 'store']);


// SPP
Route::get('/home/{param}', [SppController::class, 'index']);
Route::post('/tambah', [SppController::class, 'store']);
Route::delete('/hapus/{id}', [SppController::class, 'destroy']);
Route::get('/edit/{id}', [SppController::class, 'edit']);
Route::put('/update/{id}', [SppController::class, 'update']);

// Kelas
Route::get('/kelas/{param}', [KelasController::class, 'index']);
Route::post('/kelas/create', [KelasController::class, 'store']);
Route::delete('/kelas/delete/{id}', [KelasController::class, 'destroy']);
Route::get('/kelas/edit/{id}', [KelasController::class, 'edit']);
Route::put('/kelas/update/{id}', [KelasController::class, 'update']);

// Petugas
Route::get('/petugas/{param}', [PetugasController::class, 'index']);
Route::post('/petugas/tambah', [PetugasController::class, 'store']);
Route::delete('/petugas/delete/{id}', [PetugasController::class, 'destroy']);
Route::get('/petugas/edit/{id}', [PetugasController::class, 'edit']);
Route::put('/petugas/update/{id}', [PetugasController::class, 'update']);

// Siswa
Route::get('/siswa/{param}', [SiswaController::class, 'index']);
Route::get('/siswa/detail/{id}', [SiswaController::class, 'detailSiswa']);
Route::post('/siswa/create', [SiswaController::class, 'store']);
Route::get('/siswa/edit/{id}', [SiswaController::class, 'edit']);
Route::put('/siswa/update/{id}', [SiswaController::class, 'update']);
Route::delete('/siswa/delete/{id}', [SiswaController::class, 'destroy']);

// transaksi
Route::get('/search/{nisn}', [TransaksiController::class, 'search']);
Route::get('/pembayaran/{nisn}', [TransaksiController::class, 'index']);
Route::post('/bayar', [TransaksiController::class, 'store']);
Route::get('/bayar/spp/{id}', [TransaksiController::class, 'store']);
Route::get('/batal/spp/{id}', [TransaksiController::class, 'destroy']);

Route::get('/cetak/{id}', [TransaksiController::class, 'cetak']);
Route::post('/cari/tgl', [TransaksiController::class, 'cariTanggal']);

// history
Route::get('/history/{param}', [TransaksiController::class, 'history']);
// Route::delete('/history/hapus/{id}', [TransaksiController::class, 'hapus']);
// Route::delete('/history/hapusAll', [TransaksiController::class, 'hapusAll']);

// dashboard
Route::get('/dashboardAdmin', [TransaksiController::class, 'dashboardAdmin']);

