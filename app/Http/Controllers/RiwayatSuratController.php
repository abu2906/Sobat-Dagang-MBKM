<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiwayatSuratController
{
    public function index()
    {
        // Ambil data riwayat surat dari database kalau tersedia
        // $riwayat = SuratPermohonan::where('user_id', auth()->id())->get();

        return view('riwayat_surat'); // resources/views/riwayat_surat.blade.php
    }
}
