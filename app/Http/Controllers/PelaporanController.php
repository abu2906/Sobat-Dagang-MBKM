<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Berisikan seluruh fungsi yang digunakan dalam hal pelaporan baik admin maupun distributor
class PelaporanController extends Controller
{
    public function pelaporanPenyaluran()
    {
        return view('user.bidangPerdagangan.pelaporan_penyaluran');
    }

    public function index()
    {
        return view('user.bidangPerdagangan.pelaporan');
    }

    public function verifikasiPengajuan()
    {
        return view('user.bidangPerdagangan.verifikasiPengajuan');
    }

    public function reviewPengajuan()
    {
        return view('admin.bidangPerdagangan.reviewPengajuanDistributor');
    }
}
