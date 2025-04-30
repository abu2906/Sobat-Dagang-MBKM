<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PelaporanPenyaluranController extends Controller
{
    public function index()
    {
        return view('pelaporan.pelaporan_penyaluran');
    }
}