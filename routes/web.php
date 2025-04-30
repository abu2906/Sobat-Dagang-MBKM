<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\authController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\DirectoryBookController;
use App\Http\Controllers\DataIKMController;
use App\Http\Controllers\SertifikasiIKMController;
use App\Http\Controllers\PersuratanController;
use App\Http\Controllers\homeController;


// Controller untuk halaman utama (homepage)
Route::get('/', [homeController::class, 'index'])->name('Home');

// Controller untuk authentication
Route::get('/login', [authController::class, 'showFormLogin'])->name('login');
Route::get('/register', [authController::class, 'showFormRegister'])->name('register');
Route::get('/forgot-password', [authController::class, 'showforgotPassword'])->name('forgot-password');
Route::get('/change-password', [authController::class, 'showChangePassword'])->name('forgot-password');

// Controller untuk berita 
Route::get('/berita/{id}', [homeController::class, 'show'])->name('berita.utama');
Route::get('/admin/kelola-berita', [homeController::class, 'index']);
Route::get('/berita/{id}/edit', [homeController::class, 'edit']);

Route::get('/halal', function () {
    return view('halal');
})->name('halal');


Route::get('/regulasi', [RegulasiController::class, 'index'])->name('regulasi');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/directory-book', [DirectoryBookController::class, 'index'])->name('directory-book');
Route::get('/data-ikm', [DataIKMController::class, 'index'])->name('data-ikm');
Route::get('/sertifikasi-ikm', [SertifikasiIKMController::class, 'index'])->name('sertifikasi-ikm');
Route::get('/directory-book-metrologi', [DirectoryBookMetrologiController::class, 'index'])->name('directory-book-metrologi');
Route::get('/persuratan', [PersuratanController::class, 'index'])->name('persuratan');
Route::get('/pelaporan', [PelaporanController::class, 'index'])->name('pelaporan');

Route::get('/administrasi-metrologi',[PersuratanController::class, 'showAdministrasiMetrologi'])->name('administrasi-metrologi');
Route::get('/directory-book-metrologi',[DirectoryBookController::class, 'showDirectoryUserMetrologi'])->name('directory-metrologi');


// Proses dengan metode post untuk autentikasi login
Route::post('/login', [authController::class, 'login-process']);



// Route Pelaporan Penyaluran
//Route::get('/pelaporan-penyaluran', [PelaporanPenyaluranController::class, 'index'])->name('pelaporan_penyaluran');

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

?>