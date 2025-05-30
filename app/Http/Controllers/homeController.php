<?php

namespace App\Http\Controllers;
use App\Models\Berita;
use App\Models\Faq;

class HomeController extends Controller
{
    // Menampilkan halaman utama dengan daftar berita
    public function index()
    {
        $daftarBerita = Berita::orderBy('tanggal', 'desc')->get();
        return view('pages.home', compact('daftarBerita'));
    }


    public function show($judul)
    {
        $judulDecoded = urldecode($judul);
        $berita = Berita::where('judul', $judulDecoded)->firstOrFail();
        return view('pages.halamanBerita', compact('berita'));
    }

    public function showAboutPage()
    {
        return view('pages.aboutUs');
    }

    public function showFaqPage()
    {
        $faqs = Faq::all(); 
        return view('pages.faq', compact('faqs'));
    }

    public function showHalal()
    {
        return view('user.bidangIndustri.halal');
    }
}
