<?php

use App\Http\Controllers\MahasiswaController;
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

Route::resource('mahasiswa', MahasiswaController::class);
Route::get('mahasiswa/Nilai/{nim}',[MahasiswaController::class,'showNilai'])->name('mahasiswa.nilai');
Route::get('mahasiswa/Nilai/cetak_pdf/{nim}',[MahasiswaController::class,'cetak_pdf'])->name('mahasiswa.cetakNilai');
