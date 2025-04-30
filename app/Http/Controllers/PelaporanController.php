<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PelaporanController extends Controller
{
    public function index()
    {
        return view('pelaporan'); // Pastikan file blade kamu sesuai ya
    }
}
