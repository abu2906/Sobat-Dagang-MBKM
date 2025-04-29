<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\BeritaController; // kalo kamu mau ambil dummy dari sini

class adminBeritaController{
    public function index()
    {
        $beritaController = new BeritaController();
        $beritas = $beritaController->getDummyData();

        return view('admin.kelola_berita', compact('beritas'));
    }
}
