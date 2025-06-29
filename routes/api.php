<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiPerdaganganController;
use App\Http\Controllers\ApiMetrologiController;

//Perdagangan
Route::get('/kategori', [ApiPerdaganganController::class, 'getKategori']);
Route::get('/barang', [ApiPerdaganganController::class, 'getBarang']);
Route::get('/indeks-harga', [ApiPerdaganganController::class, 'getIndeksHarga']);
Route::get('/lokasi', [ApiPerdaganganController::class, 'getLokasi']);
Route::get('/Ringkasan-Distribusi-PerKecamatan', [ApiPerdaganganController::class, 'getringkasan']);
Route::get('/Distribusi-PerToko', [ApiPerdaganganController::class, 'ringkasanPerToko']);
Route::get('/distribusi-per-tahun', [ApiPerdaganganController::class, 'getDistribusiPerTahun']);
Route::get('/kecamatan', [ApiPerdaganganController::class, 'getDaftarKecamatan']);
Route::get('/analisis/top-harga-naik', [ApiPerdaganganController::class, 'getTopHargaNaik']);
Route::get('/analisis/top-harga-turun', [ApiPerdaganganController::class, 'getTopHargaTurun']);
Route::get('/analisis/harga-perhari', [ApiPerdaganganController::class, 'hargaPerHari']);
Route::get('/analisis/perbandingan-harga', [ApiPerdaganganController::class, 'perbandinganHarga']);
Route::get('/distribusi/jumlah-toko', [ApiPerdaganganController::class, 'jumlahToko']);
Route::get('/distribusi/jumlah-pupuk', [ApiPerdaganganController::class, 'jumlahPupukTerdistribusi']);

//Industri


//Metrologi
Route::get('/get-uttp', [ApiMetrologiController::class, 'index']);
Route::get('/get-uttp/{id}', [ApiMetrologiController::class, 'show']);

Route::get('/test-api', function () {
    return response()->json(['message' => 'API berjalan']);
});