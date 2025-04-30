<?php

use App\Http\Controllers\PelaporanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MetrologiPageController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\RegulasiController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PerizinanController;
use App\Http\Controllers\PendampinganController;
use App\Http\Controllers\DirectoryBookController;
use App\Http\Controllers\DataIKMController;
use App\Http\Controllers\SertifikasiIKMController;
use App\Http\Controllers\DirectoryBookMetrologiController;
use App\Http\Controllers\PersuratanController;
use App\Http\Controllers\SuratPermohonanController;
use App\Http\Controllers\RegulasiMetrologiController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/forgotpass', function () {
    return view('forgotpass');
})->name('forgotpass');

Route::get('/resetpass', function () {
    return view('resetpass');
})->name('resetpass');

Route::get('/halal', function () {
    return view('halal');
})->name('halal');

Route::get('/regulasi', [RegulasiController::class, 'index'])->name('regulasi');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/permohonan-perizinan', [PerizinanController::class, 'index'])->name('permohonan-perizinan');
Route::get('/pendampingan', [PendampinganController::class, 'index'])->name('pendampingan');
Route::get('/directory-book', [DirectoryBookController::class, 'index'])->name('directory-book');
Route::get('/data-ikm', [DataIKMController::class, 'index'])->name('data-ikm');
Route::get('/sertifikasi-ikm', [SertifikasiIKMController::class, 'index'])->name('sertifikasi-ikm');
Route::get('/directory-book-metrologi', [DirectoryBookMetrologiController::class, 'index'])->name('directory-book-metrologi');
Route::get('/surat-permohonan', [SuratPermohonanController::class, 'index'])->name('surat-permohonan');
Route::get('/regulasi-metrologi', [RegulasiMetrologiController::class, 'index'])->name('regulasi-metrologi');
Route::get('/persuratan', [PersuratanController::class, 'index'])->name('persuratan');
Route::get('/pelaporan', [PelaporanController::class, 'index'])->name('pelaporan');

