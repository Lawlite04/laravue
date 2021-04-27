<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
// use App\Http\Controllers\AdminController;
// use App\Http\Controllers\PetugasController;
use App\Http\Controllers\TransaksiController;

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
    return view('welcome');
});

// auth


Auth::routes();

Route::get('/home-admin', [App\Http\Controllers\HomeController::class, 'handleAdmin'])->where('any','.*')->name('home')->middleware('cek_login');
// Route::get('/{any}', [App\Http\Controllers\HomeController::class, 'handleAdmin'])->where('any','.*')->middleware('cek_login');
Route::get('/home_petugas', [App\Http\Controllers\HomeController::class, 'handlePetugas'])->where('any','.*')->name('petugas')->middleware('cek_login');
// Route::get('/{any}', [App\Http\Controllers\HomeController::class, 'handlePetugas'])->where('any','.*')->middleware('cek_login');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->where('any','.*')->name('user')->middleware('cek_login');
// Route::get('/{any}', [App\Http\Controllers\HomeController::class, 'index'])->where('any','.*')->middleware('cek_login');

// Route::get('/pdf', [TransaksiController::class, 'cetak']);


