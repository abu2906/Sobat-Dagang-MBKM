<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\DirectoryBookController;
use App\Http\Controllers\DataIKMController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\SertifikasiIKMController;
use App\Http\Controllers\PersuratanController;
use App\Http\Controllers\DashboardPerdaganganController;
use App\Http\Controllers\PelaporanPenyaluranController;
use App\Http\Controllers\SobatHargaController;
use App\Http\Controllers\KabidPerdaganganController;
use App\Http\Controllers\ForumDiskusiController;
use App\Http\Middleware\UserAuthMiddleware;
use App\Http\Middleware\RoleCheckMiddleware;

// Controller untuk authentication
Route::get('/login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('/login', [AuthController::class, 'submitFormLogin'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showFormRegister'])->name('register');
Route::post('/register', [AuthController::class, 'submitRegister'])->name('register.submit');
Route::get('/forgot-password', [AuthController::class, 'showforgotPassword'])->name('forgot.password');
Route::get('/change-password', [AuthController::class, 'showChangePassword'])->name('change.password');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/forum/store', [ForumDiskusiController::class, 'store'])->name('forum.store')->middleware('auth');

// Controller untuk user
Route::get('/user/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
Route::get('/user/profil', [DashboardController::class, 'profile'])->name('profile');
Route::get('/forgotpass', [authController::class, 'showForgotPassword'])->name('forgotpass');
Route::get('/resetpass', [authController::class, 'showChangePassword'])->name('resetpass');
Route::get('/pelaporan', [PelaporanController::class, 'index'])->name('pelaporan');
Route::get('/pelaporan-penyaluran', [PelaporanController::class, 'pelaporanPenyaluran'])->name('pelaporan-penyaluran');
Route::get('/form-permohonan-distributor', [PelaporanController::class, 'formDistributor'])->name('bidangPerdagangan.formDistributor');
Route::post('/form-permohonan-distributor', [PelaporanController::class, 'submitDistributor'])->name('bidangPerdagangan.submitDistributor');
Route::get('/halal', function () {
    return view('user.halal');
})->name('halal');
// user Login
Route::middleware(['role.check:user'])->group(function () {
    Route::get('/user/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/user/profil', [DashboardController::class, 'profile'])->name('profile');
    Route::get('/forgotpass', [authController::class, 'showForgotPassword'])->name('forgotpass');
    Route::get('/resetpass', [authController::class, 'showChangePassword'])->name('resetpass');
    Route::get('/pelaporan', [PelaporanController::class, 'index'])->name('pelaporan');
    Route::get('/pelaporan-penyaluran', [PelaporanController::class, 'pelaporanPenyaluran'])->name('pelaporan-penyaluran');
    Route::get('/form-permohonan-distributor', [PelaporanController::class, 'formDistributor'])->name('bidangPerdagangan.formDistributor');
    Route::post('/form-permohonan-distributor', [PelaporanController::class, 'submitDistributor'])->name('bidangPerdagangan.submitDistributor');
    Route::get('/halal', function () {
        return view('user.halal');
    })->name('halal');
    Route::get('/bidang-perdagangan/verifikasi-pengajuan', [PelaporanController::class, 'verifikasiPengajuan']);
    Route::get('/bidang-perdagangan/form-permohonan', [DashboardPerdaganganController::class, 'formPermohonan'])->name('bidangPerdagangan.formPermohonan');
    Route::get('/bidang-perdagangan/riwayat-surat', [DashboardPerdaganganController::class, 'riwayatSurat'])->name('bidangPerdagangan.riwayatSurat');
    Route::post('/bidang-perdagangan/ajukan-permohonan', [DashboardPerdaganganController::class, 'ajukanPermohonan'])->name('ajukanPermohonan');
});
Route::get('/testchart', function () {
    return view('testchart');
});

// guest
Route::get('/harga-pasar/{kategori}', [SobatHargaController::class, 'index'])->name('harga-pasar.kategori');
Route::get('/sobat-harga/{kategori}', [SobatHargaController::class, 'index'])->name('sobatHarga.kategori');
Route::get('/', [homeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'showAboutPage'])->name('about');
Route::get('/berita/{id}', [homeController::class, 'show'])->name('berita.utama');


// Admin Perdagangan
Route::middleware(['auth:disdag'])->group(function () {
    Route::get('/dashboard-perdagangan', [DashboardPerdaganganController::class, 'index'])->name('dashboard.perdagangan');
    // Pelaporan
    Route::get('/review-pengajuan', [PelaporanController::class, 'reviewPengajuan']);
    Route::get('/lihat-laporan-distribusi-pupuk', [DashboardPerdaganganController::class, 'laporanPupuk'])->name('lihat.laporan.distribusi');
    // sobat Harga
    Route::get('/tambah-barang', [DashboardPerdaganganController::class, 'formTambahBarang'])->name('dashboard-perdagangan.form-tambah-barang');
    Route::post('/tambah-barang', [DashboardPerdaganganController::class, 'storeBarang'])->name('dashboard-perdagangan.tambah-barang');
    Route::get('/update-harga', [DashboardPerdaganganController::class, 'formUpdateHarga'])->name('updateHarga.store');
    Route::post('/update-harga', [DashboardPerdaganganController::class, 'update'])->name('updateHarga.update');
    Route::get('/get-barang-by-kategori/{id}', [DashboardPerdaganganController::class, 'getByKategori']);
    Route::get('/hapus-barang', [DashboardPerdaganganController::class, 'deleteBarang'])->name('dashboard-perdagangan.hapus-barang');
    Route::delete('/dashboard-perdagangan/barang/{id}', [DashboardPerdaganganController::class, 'destroy'])->name('barang.destroy');
    // Persuratan
    Route::get('/kelola-surat', [DashboardPerdaganganController::class, 'kelolaSurat'])->name('perdagangan.kelolaSurat');
    Route::get('/detail-surat/{id_permohonan}', [DashboardPerdaganganController::class, 'detailSurat'])
        ->where('id_permohonan', '[0-9a-fA-F\-]+')
        ->name('perdagangan.detailSurat');
    Route::put('/permohonan/{id}/tolak', [DashboardPerdaganganController::class, 'tolak'])->name('permohonan.tolak');
    Route::put('/permohonan/{id}/keterangan', [DashboardPerdaganganController::class, 'simpanketerangan'])->name('permohonan.keterangan');
    Route::put('/permohonan/{id}/rekomendasi', [DashboardPerdaganganController::class, 'simpanRekomendasi'])->name('permohonan.rekomendasi');
    Route::get('/detail-surat/{id}/view-{type}', [DashboardPerdaganganController::class, 'viewDokumen'])
        ->where('type', 'NIB|NPWP|KTP|AKTA|SURAT|USAHA')
        ->name('dokumen.view');
});

// admin master
Route::get('/review-distributor', [PelaporanController::class, 'reviewPengajuanDistributor'])->name('review.pengajuan');
Route::get('/lihat-laporan', [PelaporanController::class, 'lihatLaporan'])->name('lihat.laporan');
Route::get('/tambah-barang-distribusi', [PelaporanController::class, 'tambahBarangDistribusi'])->name('tambah.barang-distribusi');
Route::get('/admin/kelola-pengguna', [DashboardController::class, 'kelolaAdmin'])->name('kelola.admin');
Route::post('/admin/kelola-pengguna', [DashboardController::class, 'tambahpengguna'])->name('tambah.pengguna');
// Route::get('/admin/distributor', [PelaporanController::class, 'indexDistributor'])->name('admin.distributor.index');
// Route::post('/admin/distributor/{id}/verifikasi', [PelaporanController::class, 'verifikasiDistributor'])->name('admin.distributor.verifikasi');
// Menampilkan halaman admin master  untuk kelola berita
Route::get('/admin/kelola-berita', [BeritaController::class, 'show'])->name('kelola.berita');
Route::post('/admin/kelola-berita', [BeritaController::class, 'tambahberita'])->name('tambah.berita');
Route::put('/admin/{id_berita}', [BeritaController::class, 'update'])->name('berita.update');
Route::delete('/admin/{id_berita}', [BeritaController::class, 'destroy'])->name('berita.destroy');
Route::get('/berita/{id}/edit', [homeController::class, 'edit'])->name('berita.edit');

//kabid Perdagangan
Route::middleware(['check.role:disdag,kabid_perdagangan'])->group(function () {
    Route::get('/kabid-perdagangan/dashboard', [KabidPerdaganganController::class, 'dashboardKabid'])->name('kabid.perdagangan');
    Route::get('/kabid-perdagangan/distribusi-pupuk', [KabidPerdaganganController::class, 'distribusiPupuk'])->name('distribusi.pupuk');
    Route::get('/kabid-perdagangan/analisis-pasar', [KabidPerdaganganController::class, 'analisisPasar'])->name('analisis.pasar');
    Route::put('/surat/{id}/setujui', [KabidPerdaganganController::class, 'setujui'])->name('surat.setujui');
});
Route::get('/directory-book', [DirectoryBookController::class, 'index'])->name('directory-book');
Route::get('/data-ikm', [DataIKMController::class, 'index'])->name('data-ikm');
Route::get('/sertifikasi-ikm', [SertifikasiIKMController::class, 'index'])->name('sertifikasi-ikm');
// Route::get('/directory-book-metrologi', [DirectoryBookMetrologiController::class, 'index'])->name('directory-book-metrologi');
Route::get('/persuratan', [PersuratanController::class, 'index'])->name('persuratan');

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

Route::get('/surat-rekomendasi', function () {
    return view('SuratBalasan.surat-rekomendasi');
});
// })->name('form.permohonan');
// Route::get('/riwayat-surat', function () {
//     return view('user.riwayat_surat');
// })->name('riwayat.surat');