<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\keranjangController;
use App\Http\Controllers\Detailpenjualancontroller;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource( 'barang', BarangController::class);
Route::resource( 'pelanggan', PelangganController::class);
Route::resource('penjualan', PenjualanController::class);
Route::resource('keranjang',  KeranjangController::class);
Route::resource('detail_penjualan', Detailpenjualancontroller::class);