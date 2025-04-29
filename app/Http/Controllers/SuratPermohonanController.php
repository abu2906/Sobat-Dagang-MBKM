<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class SuratPermohonanController
{
    // Tampilkan form permohonan
    public function index()
    {
        return view('form_permohonan'); // Pastikan file resources/views/form_permohonan.blade.php ada
    }

}
