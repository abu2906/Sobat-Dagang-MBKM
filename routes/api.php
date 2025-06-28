<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiPerdaganganController;


//Perdagangan
Route::get('/kategori', [ApiPerdaganganController::class, 'getKategori']);
Route::get('/barang', [ApiPerdaganganController::class, 'getBarang']);
Route::get('/indeks-harga', [ApiPerdaganganController::class, 'getIndeksHarga']);
Route::get('/lokasi', [ApiPerdaganganController::class, 'getLokasi']);

Route::get('/Ringkasan-Distribusi-PerKecamatan', [ApiPerdaganganController::class, 'getringkasan']);
Route::get('/Distribusi-PerToko', [ApiPerdaganganController::class, 'ringkasanPerToko']);
Route::get('/distribusi-per-tahun', [ApiPerdaganganController::class, 'getDistribusiPerTahun']);
Route::get('/kecamatan', [ApiPerdaganganController::class, 'getDaftarKecamatan']);


//Industri


//Metrologi