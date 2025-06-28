<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiPerdaganganController;


//Perdagangan
Route::get('/kategori', [ApiPerdaganganController::class, 'getKategori']);
Route::get('/barang', [ApiPerdaganganController::class, 'getBarang']);
Route::get('/indeks-harga', [ApiPerdaganganController::class, 'getIndeksHarga']);
Route::get('/lokasi', [ApiPerdaganganController::class, 'getLokasi']);
Route::get('/analisis/top-harga-naik', [ApiPerdaganganController::class, 'getTopHargaNaik']);
Route::get('/analisis/top-harga-turun', [ApiPerdaganganController::class, 'getTopHargaTurun']);
Route::get('/analisis/harga-perhari', [ApiPerdaganganController::class, 'hargaPerHari']);
Route::get('/analisis/perbandingan-harga', [ApiPerdaganganController::class, 'perbandinganHarga']);
Route::get('/distribusi/jumlah-toko', [ApiPerdaganganController::class, 'jumlahToko']);
Route::get('/distribusi/jumlah-pupuk', [ApiPerdaganganController::class, 'jumlahPupukTerdistribusi']);

//Industri


//Metrologi