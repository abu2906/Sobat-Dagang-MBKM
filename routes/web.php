<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\SuratPermohonanController;
use App\Http\Controllers\PelaporanPenyaluranController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\admin\adminBeritaController;

use App\Http\Controllers\MetrologiPageController;
use App\Http\Controllers\RiwayatSuratController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PerizinanController;
use App\Http\Controllers\DirectoryBookController;
use App\Http\Controllers\DataIKMController;
use App\Http\Controllers\SertifikasiIKMController;
use App\Http\Controllers\DirectoryBookMetrologiController;
use App\Http\Controllers\PersuratanController;

// Route login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

// Route Form Permohonan
Route::get('/form-permohonan', [SuratPermohonanController::class, 'index'])->name('form_permohonan');

// Route Riwayat Surat
Route::get('/riwayat-surat', [RiwayatSuratController::class, 'index'])->name('riwayat_surat');

// Route Pelaporan Penyaluran
//Route::get('/pelaporan-penyaluran', [PelaporanPenyaluranController::class, 'index'])->name('pelaporan_penyaluran');

// Route untuk menampilkan halaman dashboard
Route::get('/', [BeritaController::class, 'index'])->name('dashboard');

// Rute untuk melihat detail berita berdasarkan ID
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.utama');

// Route untuk menampilkan halaman kelola berita
Route::get('/admin/kelola-berita', [adminBeritaController::class, 'index']);
Route::get('/berita/{id}/edit', [adminBeritaController::class, 'edit']);
// Route::put('/berita/{id}', [\App\Http\Controllers\BeritaController::class, 'update'])->name('berita.update');
// Route::delete('/berita/{id}', [\App\Http\Controllers\BeritaController::class, 'destroy'])->name('berita.destroy');
// Route::post('/berita/{id}', [\App\Http\Controllers\BeritaController::class, 'store'])->name('berita.store');

// Route::prefix('harga-pasar')->name('harga-pasar.')->group(function () {
//     Route::get('/beras', function () { return view('harga-pasar.beras'); })->name('beras');
//     Route::get('/cabe', function () { return view('harga-pasar.cabe'); })->name('cabe');
//     Route::get('/ayam', function () { return view('harga-pasar.ayam'); })->name('ayam');
//     Route::get('/bawang', function () { return view('harga-pasar.bawang'); })->name('bawang');
//     Route::get('/daging', function () { return view('harga-pasar.daging'); })->name('daging');
//     Route::get('/ikan', function () { return view('harga-pasar.ikan'); })->name('ikan');
//     Route::get('/tahu', function () { return view('harga-pasar.tahu'); })->name('tahu');
//     Route::get('/tempe', function () { return view('harga-pasar.tempe'); })->name('tempe');
// });



// Route halaman lain
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/directory-book', [DirectoryBookController::class, 'index'])->name('directory-book');
Route::get('/data-ikm', [DataIKMController::class, 'index'])->name('data-ikm');
Route::get('/sertifikasi-ikm', [SertifikasiIKMController::class, 'index'])->name('sertifikasi-ikm');
Route::get('/directory-book-metrologi', [DirectoryBookMetrologiController::class, 'index'])->name('directory-book-metrologi');
Route::get('/persuratan', [PersuratanController::class, 'index'])->name('persuratan');
