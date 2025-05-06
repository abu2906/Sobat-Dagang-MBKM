<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;


use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\DirectoryBookController;
use App\Http\Controllers\DataIKMController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\SertifikasiIKMController;
use App\Http\Controllers\PersuratanController;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Http\Controllers\DashboardPerdaganganController;


// Controller untuk halaman utama (homepage)
Route::get('/', [homeController::class, 'index'])->name('Home');
Route::get('/about', [homeController::class, 'showAboutPage'])->name('about');

// Controller untuk authentication
Route::get('/login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('/login', [AuthController::class, 'submitFormLogin'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showFormRegister'])->name('register');
Route::post('/register', [AuthController::class, 'submitRegister'])->name('register.submit');
Route::get('/forgot-password', [AuthController::class, 'showforgotPassword'])->name('forgot.password');
Route::get('/change-password', [AuthController::class, 'showChangePassword'])->name('change.password');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Controller untuk user
Route::get('/user/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
Route::get('/user/profil', [DashboardController::class, 'profile'])->name('profile');

Route::get('/berita/{id}', [homeController::class, 'show'])->name('berita.utama');
Route::get('/admin/kelola-berita', [homeController::class, 'kelolaBerita'])->name('kelola.berita');

// Menampilkan halaman edit berita
Route::get('/berita/{id}/edit', [homeController::class, 'edit'])->name('berita.edit');

Route::get('/halal', function () {
    return view('user.halal');
})->name('halal');

//user perdagangan 
Route::get('/pelaporan-penyaluran', [PelaporanController::class, 'pelaporanPenyaluran']);
Route::get('/pelaporan', [PelaporanController::class, 'Pelaporan']);
Route::get('/verifikasi-pengajuan', [PelaporanController::class, 'verifikasiPengajuan']);

// admin perdagangan
Route::get('/review-pengajuan', [PelaporanController::class, 'reviewPengajuan']);
Route::get('/dashboard-perdagangan', [DashboardPerdaganganController::class, 'index'])->name('dashboard.perdagangan');
Route::get('/tambah-barang', [DashboardPerdaganganController::class, 'formTambahBarang'])->name('dashboard-perdagangan.form-tambah-barang');
Route::post('/tambah-barang', [DashboardPerdaganganController::class, 'storeBarang'])->name('dashboard-perdagangan.tambah-barang');

Route::get('/dashboard-perdagangan', [DashboardPerdaganganController::class, 'index'])->name('dashboard.perdagangan');
Route::get('/tambah-barang', [DashboardPerdaganganController::class, 'formTambahBarang'])->name('dashboard-perdagangan.form-tambah-barang');
Route::post('/tambah-barang', [DashboardPerdaganganController::class, 'storeBarang'])->name('dashboard-perdagangan.tambah-barang');
Route::get('/update-harga', [DashboardPerdaganganController::class, 'formUpdateHarga']);
Route::post('/update-harga', [DashboardPerdaganganController::class, 'store'])->name('updateHarga.store');

// admin master
Route::get('/review-pengajuan', [PelaporanController::class, 'reviewPengajuan'])->name('review.pengajuan');
Route::get('/lihat-laporan', [PelaporanController::class, 'lihatLaporan'])->name('lihat.laporan');
Route::get('/tambah-barang-distribusi', [PelaporanController::class, 'tambahBarangDistribusi'])->name('tambah.barang-distribusi');

Route::get('/directory-book', [DirectoryBookController::class, 'index'])->name('directory-book');
Route::get('/data-ikm', [DataIKMController::class, 'index'])->name('data-ikm');
Route::get('/sertifikasi-ikm', [SertifikasiIKMController::class, 'index'])->name('sertifikasi-ikm');
Route::get('/directory-book-metrologi', [DirectoryBookMetrologiController::class, 'index'])->name('directory-book-metrologi');
Route::get('/persuratan', [PersuratanController::class, 'index'])->name('persuratan');
Route::get('/pelaporan', [PelaporanController::class, 'index'])->name('pelaporan');

Route::get('/administrasi-metrologi', [PersuratanController::class, 'showAdministrasiMetrologi'])->name('administrasi-metrologi');
Route::get('/directory-book-metrologi', [DirectoryBookController::class, 'showDirectoryUserMetrologi'])->name('directory-metrologi');

Route::get('/admin/dashboard-metrologi', [DashboardController::class, 'showMetrologi'])->name('dashboard-admin-metrologi');
Route::get('/admin/alat-ukur-metrologi', [DashboardController::class, 'showMetrologi'])->name('alat-ukur-metrologi');
Route::get('/admin/managemen-uttp-metrologi', [DashboardController::class, 'showMetrologi'])->name('managemen-uttp-metrologi');
Route::get('/admin/persuratan-metrologi', [DashboardController::class, 'showMetrologi'])->name('persuratan-metrologi');

//Route for test
Route::get('/test/{viewPath}', function ($viewPath) {
    $bladePath = str_replace('-', '_', str_replace('/', '.', $viewPath));

    if (View::exists($bladePath)) {
        return view($bladePath);
    }

    return abort(404, "View '$bladePath' tidak ditemukan.");
})->where('viewPath', '.*');

Route::get('/form-permohonan', function () {
    return view('user.form_permohonan');
})->name('form.permohonan');
Route::get('/riwayat-surat', function () {
    return view('user.riwayat_surat');
})->name('riwayat.surat');


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
