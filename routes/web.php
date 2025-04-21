<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MetrologiPageController;

Route::get('/', function () {
    return view('user.bidangMetrologi.administrasi');
});
