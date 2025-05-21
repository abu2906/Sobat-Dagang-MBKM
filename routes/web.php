<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardMetrologiController;
use App\Http\Controllers\AdminIndustriController;
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
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\KabidIndustriController;

// Controller untuk halaman utama (homepage)
Route::get('/', [homeController::class, 'index'])->name('Home');
Route::get('/about', [homeController::class, 'showAboutPage'])->name('about');
Route::get('/harga-pasar/{kategori}', [SobatHargaController::class, 'index'])->name('harga-pasar.kategori');
Route::get('/sobat-harga/{kategori}', [SobatHargaController::class, 'index'])->name('sobatHarga.kategori');
Route::get('/', [homeController::class, 'index'])->name('home');
Route::get('/berita/{id}', [homeController::class, 'show'])->name('berita.utama');

// Controller untuk authentication
Route::get('/login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('/login', [AuthController::class, 'submitFormLogin'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showFormRegister'])->name('register');
Route::post('/register', [AuthController::class, 'submitRegister'])->name('register.submit');
Route::get('/forgot-password', [AuthController::class, 'showforgotPassword'])->name('forgot.password');
Route::get('/change-password', [AuthController::class, 'showChangePassword'])->name('change.password');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// user Login
Route::middleware(['auth.role:user'])->group(function () {
    Route::get('/user/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/user/profil', [DashboardController::class, 'profile'])->name('profile');
    Route::get('/forgotpass', [authController::class, 'showForgotPassword'])->name('forgotpass');
    Route::get('/resetpass', [authController::class, 'showChangePassword'])->name('resetpass');

    //profil
    Route::put('/user/profil', [DashboardController::class, 'updateProfile'])->name('profile.update');
    Route::post('/user/profil', [DashboardController::class, 'updateProfile'])->name('profile.update');

    //pengaduan
    Route::post('/forum-chat/send', [ForumDiskusiController::class, 'send']);
    Route::get('/forum-chat/messages', [ForumDiskusiController::class, 'getMessages']);
   
    //pelaporan
    Route::get('/pelaporan', [PelaporanController::class, 'index'])->name('pelaporan');
    Route::get('/pelaporan-penyaluran', [PelaporanController::class, 'pelaporanPenyaluran'])->name('pelaporan-penyaluran');
    Route::get('/form-permohonan-distributor', [PelaporanController::class, 'formDistributor'])->name('bidangPerdagangan.formDistributor');
    Route::post('/form-permohonan-distributor', [PelaporanController::class, 'submitDistributor'])->name('bidangPerdagangan.submitDistributor');
    Route::get('/verifikasi-pengajuan', [PelaporanController::class, 'verifikasiPengajuan'])->name('cekpengajuan');
    Route::get('/input-data-toko', [PelaporanController::class, 'showForm'])->name('pelaporan.showInputForm');
    Route::post('/input-data-toko', [PelaporanController::class, 'inputDataToko'])->name('pelaporan.inputDataToko');
    Route::get('/input-data-distribusi/{id_toko}', [PelaporanController::class, 'showDataDistribusi'])->name('pelaporan.showDataDistribusi');
    Route::post('/input-data-distribusi', [PelaporanController::class, 'inputDataDistribusi'])->name('pelaporan.inputDataDistribusi');

    //perdagangan
    Route::get('/bidang-perdagangan/form-permohonan', [DashboardPerdaganganController::class, 'formPermohonan'])->name('bidangPerdagangan.formPermohonan');
    Route::get('/bidang-perdagangan/riwayat-surat', [DashboardPerdaganganController::class, 'riwayatSurat'])->name('bidangPerdagangan.riwayatSurat');
    Route::post('/bidang-perdagangan/ajukan-permohonan', [DashboardPerdaganganController::class, 'ajukanPermohonan'])->name('ajukanPermohonan');
    
    // Metrologi
    Route::get('/administrasi-metrologi', [PersuratanController::class, 'showAdministrasiMetrologi'])->name('administrasi-metrologi');
    Route::post('/store-surat', [PersuratanController::class, 'storeSuratMetrologi'])->name('proses-surat-metrologi');
    Route::get('/lihat-dokumen/{id}', [PersuratanController::class, 'showDokumenMetrologi'])->name('lihat-dokumen');
    Route::get('/directory-book-metrologi', [DirectoryBookController::class, 'showDirectoryUserMetrologi'])->name('directory-metrologi');
    Route::get('/alat-user/{id}', [DirectoryBookController::class, 'alatUser'])->name('alat.user');
    Route::post('/alat-ukur/detail', [DirectoryBookController::class, 'getDetail'])->name('alat.detail.post');
        
    // Industri
    Route::get('/bidang-industri/form-permohonan', [AdminIndustriController::class, 'formPermohonan'])->name('bidangIndustri.formPermohonan');
    Route::get('/bidang-industri/riwayat-surat', [AdminIndustriController::class, 'riwayatSurat'])->name('bidangIndustri.riwayatSurat');
    Route::post('/bidang-industri/ajukan-permohonan', [AdminIndustriController::class, 'ajukanPermohonan'])->name('ajukanPermohonan');
    Route::get('/halal', function () {
        return view('user.halal');
    })->name('halal');
    Route::get('/bidang-industri/surat-balasan/{id}/view', [AdminIndustriController::class, 'viewSuratBalasan'])
    ->name('viewSuratBalasan');
    Route::get('/bidang-industri/surat-balasan/{id}/download', [AdminIndustriController::class, 'downloadSuratBalasan'])->name('downloadSuratBalasan');

    
});

// guest
Route::get('/harga-pasar/{kategori}', [SobatHargaController::class, 'index'])->name('harga-pasar.kategori');
Route::get('/sobat-harga/{kategori}', [SobatHargaController::class, 'index'])->name('sobatHarga.kategori');
Route::get('/', [homeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'showAboutPage'])->name('about');
Route::get('/berita/{id}', [homeController::class, 'show'])->name('berita.utama');
Route::get('/user/profil', [DashboardController::class, 'showProfile'])->name('profile');
Route::put('/user/profil', [DashboardController::class, 'updateProfile'])->name('profile.update');
Route::post('/user/profil', [DashboardController::class, 'updateProfile'])->name('profile.update');

//Admin Industri
Route::middleware(['check.role:admin_industri'])->group(function () {
    Route::get('/admin/industri', [AdminIndustriController::class, 'showDashboard'])->name('dashboard.industri');
    Route::get('/data-IKM', [AdminIndustriController::class, 'showdataIKM'])->name('dataIKM');
    Route::get('/form-IKM', [AdminIndustriController::class, 'showformIKM'])->name('formIKM');
    Route::get('/sertifikasi-halal', [AdminIndustriController::class, 'Showhalal'])->name('halal');
    Route::get('/admin/surat-industri', [AdminIndustriController::class, 'kelolaSurat'])->name('kelolaSurat.industri');
    Route::get('/admin/detail-surat/{id_permohonan}', [AdminIndustriController::class, 'detailSurat'])
        ->where('id_permohonan', '[0-9a-fA-F\-]+')
        ->name('industri.detailSurat');
    Route::put('/admin/permohonan/{id}/tolak', [AdminIndustriController::class, 'tolak'])->name('permohonan.tolakI');
    Route::put('/admin/permohonan/{id}/keterangan', [AdminIndustriController::class, 'simpanketerangan'])->name('permohonan.keteranganI');
    Route::put('/admin/permohonan/{id}/rekomendasi', [AdminIndustriController::class, 'simpanRekomendasi'])->name('permohonan.rekomendasiI');
    Route::get('/admin/detail-surat/{id}/view-{type}', [AdminIndustriController::class, 'viewDokumen'])
        ->where('type', 'NIB|NPWP|KTP|AKTA|SURAT|USAHA')
        ->name('dokumen.viewi');
        
    Route::get('dashboard', [AdminIndustriController::class, 'showDashboard'])->name('dashboard');
    Route::get('data-IKM', [AdminIndustriController::class, 'showdataIKM'])->name('dataIKM');
    Route::get('form-data-IKM', [AdminIndustriController::class, 'formDataIKM'])->name('form.dataIKM');
    Route::get('form-IKM', [AdminIndustriController::class, 'showformIKM'])->name('formIKM');
    Route::get('sertifikasi-halal', [AdminIndustriController::class, 'Showhalal'])->name('halal');
    Route::get('surat-balasan', [AdminIndustriController::class, 'Showsurat'])->name('surat');
    Route::post('data-IKM/store', [AdminIndustriController::class, 'storeDataIKM'])->name('dataIKM.store');
});

// Admin Perdagangan
Route::middleware(['check.role:admin_perdagangan'])->group(function () {
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

Route::get('/cek-session', function () {
    return session()->all();
});

// admin master
Route::middleware(['check.role:master_admin'])->group(function () {
    #dashboard nddpi isinya untuk tes2 ji
    Route::get('/dashboard-master', [DashboardController::class, 'dashboardMaster'])->name('dashboard.master');
    #distribusi
    Route::get('/review-distributor', [PelaporanController::class, 'reviewPengajuanDistributor'])->name('review.pengajuan');
    Route::post('/distributor/{id_distributor}/terima', [PelaporanController::class, 'setujui'])->name('distributor.setujui');
    Route::post('/distributor/{id_distributor}/tolak', [PelaporanController::class, 'tolak'])->name('distributor.tolak');
    Route::get('/lihat-laporan', [PelaporanController::class, 'lihatLaporan'])->name('lihat.laporan');
    Route::get('/tambah-barang-distribusi', [PelaporanController::class, 'tambahBarangDistribusi'])->name('tambah.barang-distribusi');
    Route::delete('/distributor/{id_distributor}/hapus', [PelaporanController::class, 'hapus'])->name('distributor.hapus');
    #kelola berita
    Route::get('/admin/kelola-pengguna', [DashboardController::class, 'kelolaAdmin'])->name('kelola.admin');
    Route::post('/admin/kelola-pengguna', [DashboardController::class, 'tambahpengguna'])->name('tambah.pengguna');
    Route::get('/admin/kelola-berita', [BeritaController::class, 'show'])->name('kelola.berita');
    Route::post('/admin/kelola-berita', [BeritaController::class, 'tambahberita'])->name('tambah.berita');
    Route::put('/admin/{id_berita}', [BeritaController::class, 'update'])->name('berita.update');
    Route::delete('/admin/{id_berita}', [BeritaController::class, 'destroy'])->name('berita.destroy');
    Route::get('/berita/{id}/edit', [homeController::class, 'edit'])->name('berita.edit');    

});

//kabid Perdagangan
Route::middleware(['check.role:kabid_perdagangan'])->group(function () {
    Route::get('/kabid-perdagangan/dashboard', [KabidPerdaganganController::class, 'dashboardKabid'])->name('kabid.perdagangan');
    Route::get('/kabid-perdagangan/distribusi-pupuk', [KabidPerdaganganController::class, 'distribusiPupuk'])->name('distribusi.pupuk');
    Route::get('/kabid-perdagangan/analisis-pasar', [KabidPerdaganganController::class, 'analisisPasar'])->name('analisis.pasar');
    Route::put('/kabid-perdagangan/surat/{id}/setujui', [KabidPerdaganganController::class, 'setujui'])->name('suratPerdagangan.setujui');
});

//kabid Industri
Route::middleware(['check.role:kabid_industri'])->group(function () {
    Route::get('/kabid-industri/dashboard', [KabidIndustriController::class, 'dashboardKabid'])->name('kabid.industri');
    Route::get('/kabid-industri/surat', [KabidIndustriController::class, 'verifSurat'])->name('kabid.surat');
    Route::put('/kabid-industri/surat/{id}/setujui', [KabidIndustriController::class, 'setujui'])->name('surat.setujui');

});

// Route::get('/kabid-industri/dashboard', [KabidIndustriController::class, 'dashboardKabid'])->name('kabid.industri');
// Route::get('/directory-book', [DirectoryBookController::class, 'index'])->name('directory-book');
// Route::get('/data-ikm', [DataIKMController::class, 'index'])->name('data-ikm');
// Route::get('/sertifikasi-ikm', [SertifikasiIKMController::class, 'index'])->name('sertifikasi-ikm');
// Route::get('/directory-book-metrologi', [DirectoryBookMetrologiController::class, 'index'])->name('directory-book-metrologi');
// Route::get('/persuratan', [PersuratanController::class, 'index'])->name('persuratan');

//admin metrologi
Route::middleware(['check.role:admin_metrologi'])->group(function () {
    Route::get('/admin/dashboard-metrologi', [DashboardMetrologiController::class, 'index'])->name('dashboard-admin-metrologi');
    Route::get('/admin/management-uttp-metrologi', [DirectoryBookController::class, 'showDirectoryAdminMetrologi'])->name('management-uttp-metrologi');
    Route::post('/uttp/store-alat', [DirectoryBookController::class, 'storeAlatUkur'])->name('store-uttp');
    Route::delete('/uttp/{id}', [DirectoryBookController::class, 'destroy'])->name('delete-uttp');
    Route::delete('/admin/uttp/{id}', [DirectoryBookController::class, 'destroy'])->name('uttp.destroy');
    Route::patch('/admin/uttp/update/{id}', [DirectoryBookController::class, 'update'])->name('update-uttp');
    Route::put('/admin/surat/{id}/tolak', [PersuratanController::class, 'tolakSurat'])->name('surat.tolak');
    Route::get('/admin/persuratan-metrologi', [DashboardMetrologiController::class, 'showAdministrasi'])->name('persuratan-metrologi');
    Route::put('/surat/terima/{id}', [PersuratanController::class, 'terimaSurat'])->name('surat.terima');
    Route::put('/surat/tolak/{id}', [PersuratanController::class, 'tolakSurat'])->name('surat.tolak');
    Route::get('/surat/{id}/keterangan', [PersuratanController::class, 'showkirimKeterangan'])->name('create-keterangan');
    Route::get('/surat/{id}/balasan', [PersuratanController::class, 'showcreateSuratBalasan'])->name('create-surat-balasan');
    Route::post('/admin/surat/{id}/balasan', [PersuratanController::class, 'createSuratBalasan'])->name('proces-surat-balasan');
    Route::get('/admin/surat/{id}/edit-balasan', [PersuratanController::class, 'editBalasan'])->name('edit-surat-balasan');
    Route::put('/admin/surat/{id}/update-balasan', [PersuratanController::class, 'updateBalasan'])->name('update-surat-balasan');


    Route::get('/admin/dashboard-metrologi', [DashboardController::class, 'showMetrologi'])->name('dashboard-admin-metrologi');
    Route::get('/admin/alat-ukur-metrologi', [DashboardController::class, 'showMetrologi'])->name('alat-ukur-metrologi');
    Route::get('/admin/managemen-uttp-metrologi', [DashboardController::class, 'showMetrologi'])->name('managemen-uttp-metrologi');
    Route::get('/admin/persuratan-metrologi', [DashboardController::class, 'showMetrologi'])->name('persuratan-metrologi');
});

//kabid metrologi
Route::middleware(['check.role:kabid_metrologi'])->group(function () {
    Route::get('/kabid/metrologi', [DashboardMetrologiController::class, 'showKabid'])->name('dashboard-kabid-metrologi');
    Route::get('/kabid/administrasi/metrologi', [DashboardMetrologiController::class, 'showAdministrasiKabid'])->name('administrasi-kabid-metrologi');
    Route::get('/kabid/uttp/metrologi', [DashboardMetrologiController::class, 'showUttp'])->name('informasi-uttp');
    Route::post('/surat/terima/{id}', [PersuratanController::class, 'terimaKabid'])->name('terimaKabid');
    Route::post('/surat/tolak/{id}', [PersuratanController::class, 'tolakKabid'])->name('tolakKabid');
});

// Route for test
// Route::get('/test/{viewPath}', function ($viewPath) {
//     $bladePath = str_replace('-', '_', str_replace('/', '.', $viewPath));

//     if (View::exists($bladePath)) {
//         return view($bladePath);
//     }

//     return abort(404, "View '$bladePath' tidak ditemukan.");
// })->where('viewPath', '.*');

// Route::get('/surat-rekomendasi', function () {
//     return view('SuratBalasan.surat-rekomendasi');
// });