<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MetrologiPageController;

Route::get('/', function () {
    return view('user.bidangMetrologi.administrasi');
});
Route::get('/directory', function () {
    return view('user.bidangMetrologi.directory');
});
Route::get('/admin/directory-alat-ukur-sah', function () {
    return view('admin.bidangMetrologi.directory_alat_ukur_sah');
});
Route::get('/admin/directory-jenis-alat', function () {
    return view('admin.bidangMetrologi.directory_jenis_alat');
});
Route::get('/admin/directory-surat', function () {
    return view('admin.bidangMetrologi.directory_surat');
});


