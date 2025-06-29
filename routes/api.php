<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiPerdaganganController;
use App\Http\Controllers\ApiIndustriController;


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
Route::get('/sertifikat-halal', [ApiIndustriController::class, 'getSertifikatHalal']);
Route::get('/data-ikm', [ApiIndustriController::class, 'getDataIkm']);

Route::get('/data-ikm/{id}', [ApiIndustriController::class, 'getDataIkmDetail']);
Route::get('/data-ikm/{id}/karyawan', [ApiIndustriController::class, 'getKaryawan']);
Route::get('/data-ikm/{id}/persentase-pemilik', [ApiIndustriController::class, 'getPersentasePemilik']);
Route::get('/data-ikm/{id}/pemakaian-bahan', [ApiIndustriController::class, 'getPemakaianBahan']);
Route::get('/data-ikm/{id}/penggunaan-air', [ApiIndustriController::class, 'getPenggunaanAir']);
Route::get('/data-ikm/{id}/pengeluaran', [ApiIndustriController::class, 'getPengeluaran']);
Route::get('/data-ikm/{id}/penggunaan-bahan-bakar', [ApiIndustriController::class, 'getPenggunaanBahanBakar']);
Route::get('/data-ikm/{id}/listrik', [ApiIndustriController::class, 'getListrik']);
Route::get('/data-ikm/{id}/mesin-produksi', [ApiIndustriController::class, 'getMesinProduksi']);
Route::get('/data-ikm/{id}/produksi', [ApiIndustriController::class, 'getProduksi']);
Route::get('/data-ikm/{id}/persediaan', [ApiIndustriController::class, 'getPersediaan']);
Route::get('/data-ikm/{id}/pendapatan', [ApiIndustriController::class, 'getPendapatan']);
Route::get('/data-ikm/{id}/modal', [ApiIndustriController::class, 'getModal']);
Route::get('/data-ikm/{id}/bentuk-pengelolaan-limbah', [ApiIndustriController::class, 'getBentukPengelolaanLimbah']);
Route::get('/data-ikm/{id}/hitung-level', [ApiIndustriController::class, 'hitungLevel']);






//Metrologi