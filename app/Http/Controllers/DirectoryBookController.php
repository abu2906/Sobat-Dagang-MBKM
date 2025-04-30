<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Directory untuk setiap bidang buat saja fungsi sesuai bidang masing masing
class DirectoryBookController extends Controller
{
    public function showDirectoryUserMetrologi()
    {
        return view('user.bidangMetrologi.directory');
    }
}
