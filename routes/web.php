<?php

use App\Http\Controllers\DaftarController;
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

Route::get('/', function () {
    return view('welcome');
})->name('landing');

Route::resource('daftars', DaftarController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/daftarsiswa', [DaftarController::class, 'daftar_post'])->name('daftarsiswa');
Route::get('laporan-pdf/print/{id}', [DaftarController::class, 'generatePDF'])->name('laporanPdf');
