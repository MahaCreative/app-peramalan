<?php

use App\Http\Controllers\Import;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\DataBarang;
use App\Http\Livewire\PenjualanBarang;
use App\Http\Livewire\PrediksiPenjualan;
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

Route::get('dashboard', Dashboard::class)->name('dashboard');
Route::get('data-barang', DataBarang::class)->name('data-barang');
Route::get('penjualan-barang', PenjualanBarang::class)->name('penjualan-barang');
Route::get('prediksi-penjualan', PrediksiPenjualan::class)->name('prediksi-penjualan');
Route::post('import/', [Import::class, 'index'])->name('import');