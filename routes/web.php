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
use App\Http\Controllers\DashboardController;


// Halaman utama (home) yang mengarah ke view pages.home
Route::get('/', [homeController::class, 'index'])->name('home');
Route::get('/about', [homeController::class, 'showAboutPage'])->name('about');

// Controller untuk authentication
Route::get('/login', [authController::class, 'showFormLogin'])->name('login');
Route::get('/register', [authController::class, 'showFormRegister'])->name('register');
Route::get('/forgotpass', [authController::class, 'showForgotPassword'])->name('forgotpass');
Route::get('/resetpass', [authController::class, 'showChangePassword'])->name('resetpass');
Route::post('/logout', [authController::class, 'logout'])->name('logout');


// Menampilkan berita berdasarkan ID
Route::get('/berita/{id}', [homeController::class, 'show'])->name('berita.utama');

// Menampilkan halaman admin untuk kelola berita
Route::get('/admin/kelola-berita', [homeController::class, 'kelolaBerita'])->name('kelola.berita');

// Menampilkan halaman edit berita
Route::get('/berita/{id}/edit', [homeController::class, 'edit'])->name('berita.edit');

// Halaman-halaman lain
Route::get('/halal', function () {
    return view('halal');
})->name('halal');

//user perdagangan 
Route::get('/pelaporan-penyaluran', [PelaporanController::class, 'pelaporanPenyaluran']);
Route::get('/pelaporan', [PelaporanController::class, 'Pelaporan']);
Route::get('/verifikasi-pengajuan', [PelaporanController::class, 'verifikasiPengajuan']);

// admin perdagangan
Route::get('/review-pengajuan', [PelaporanController::class, 'reviewPengajuan']);

//Route::get('/regulasi', [RegulasiController::class, 'index'])->name('regulasi');
Route::get('/directory-book', [DirectoryBookController::class, 'index'])->name('directory-book');
Route::get('/data-ikm', [DataIKMController::class, 'index'])->name('data-ikm');
Route::get('/sertifikasi-ikm', [SertifikasiIKMController::class, 'index'])->name('sertifikasi-ikm');

Route::get('/persuratan', [PersuratanController::class, 'index'])->name('persuratan');
Route::get('/pelaporan', [PelaporanController::class, 'index'])->name('pelaporan');

Route::get('/administrasi-metrologi',[PersuratanController::class, 'showAdministrasiMetrologi'])->name('administrasi-metrologi');
Route::get('/directory-book-metrologi',[DirectoryBookController::class, 'showDirectoryUserMetrologi'])->name('directory-metrologi');

Route::get('/admin/dashboard-metrologi', [DashboardController::class, 'showMetrologi'])->name('dashboard-admin-metrologi');
Route::get('/admin/alat-ukur-metrologi', [DashboardController::class, 'showMetrologi'])->name('alat-ukur-metrologi');
Route::get('/admin/managemen-uttp-metrologi', [DashboardController::class, 'showMetrologi'])->name('managemen-uttp-metrologi');
Route::get('/admin/persuratan-metrologi', [DashboardController::class, 'showMetrologi'])->name('persuratan-metrologi');

Route::get('/admin/directory-book-metrologi',[DirectoryBookController::class, 'showDirectoryUserMetrologi'])->name('directory-metrologi');
Route::get('/directory-book-metrologi',[DirectoryBookController::class, 'showDirectoryUserMetrologi'])->name('directory-metrologi');
Route::get('/directory-book-metrologi',[DirectoryBookController::class, 'showDirectoryUserMetrologi'])->name('directory-metrologi');

// form permohonan route auth fiks
// Route::middleware(['auth'])->group(function () {
//     Route::get('/form-permohonan', function () {
//         return view('user.form_permohonan'); // pastikan nama file sudah benar
//     })->name('form.permohonan');
// });

//ini untuk testing
Route::get('/form-permohonan', function () {
    return view('user.form_permohonan');
})->name('form.permohonan');
Route::get('/riwayat-surat', function () {
    return view('user.riwayat_surat');
})->name('riwayat.surat');


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