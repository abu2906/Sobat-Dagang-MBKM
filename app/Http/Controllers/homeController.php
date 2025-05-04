<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Semua Function yang digunakan dalam halaman utama (Homepage) dimasukkan disini
class homeController
{
    public function index()
    {
        $daftarBerita= $this->getDummyData();
        return view('pages/home', compact('daftarBerita'));
    }

    public function getDummyData()
    {
        return [
            1 => (object)[
                'id' => 1,
                'judul' => 'Wamendag: IEU-CEPA jadi solusi strategis di tengah situasi global',
                'gambar' => asset('img/dashboard.jpg'),
                'created_at' => '17-02-2025',
                'isi' => 'Isi lengkap berita 1 di sini. Penjelasan mengenai IEU-CEPA dalam konteks global saat ini...'
            ],
            2 => (object)[
                'id' => 2,
                'judul' => 'Dinas Perdagangan Parepare Ungkap Penyebab Harga Cabai dan Bawang Meroket',
                'gambar' => 'img/berita2.jpg',
                'created_at' => '18-02-2025',
                'isi' => 'Isi lengkap berita 2 di sini. Harga cabai dan bawang meningkat karena beberapa faktor...'
            ],
            3 => (object)[
                'id' => 3,
                'judul' => 'Ekspor Parepare Tembus Puluhan Triliun, Angkat Ekonomi Regional',
                'gambar' => 'img/berita3.jpg',
                'created_at' => '16-02-2025',
                'isi' => 'Isi lengkap berita 3 di sini. Dampak ekspor terhadap ekonomi daerah Parepare...'
            ],
            4 => (object)[
                'id' => 4,
                'judul' => 'Pertumbuhan Ekonomi Parepare di Tengah Kondisi Global Makin Disipliner',
                'gambar' => 'img/berita4.jpg',
                'created_at' => '15-02-2025',
                'isi' => 'Isi lengkap berita 4 di sini. Strategi Parepare dalam mempertahankan pertumbuhan ekonomi di tengah tantangan global...'
            ],
            5 => (object)[
                'id' => 5,
                'judul' => 'Peningkatan UMKM Parepare Mendapat Dukungan Penuh',
                'gambar' => 'img/berita5.jpg',
                'created_at' => '14-02-2025',
                'isi' => 'Isi lengkap berita 5 di sini. Pemerintah Parepare memperkuat UMKM lokal dengan berbagai program pendukung...'
            ],
            6 => (object)[
                'id' => 6,
                'judul' => 'Parepare Jadi Contoh Kota Ramah Investasi di Sulsel',
                'gambar' => 'img/berita6.jpg',
                'created_at' => '13-02-2025',
                'isi' => 'Isi lengkap berita 6 di sini. Investasi di Parepare meningkat pesat karena kebijakan pro-investasi yang diterapkan...'
            ],
            7 => (object)[
                'id' => 7,
                'judul' => 'Program Pasar Digital Parepare Mulai Berjalan',
                'gambar' => 'img/berita7.jpg',
                'created_at' => '12-02-2025',
                'isi' => 'Isi lengkap berita 7 di sini. Transformasi digital di sektor perdagangan Parepare membuka peluang baru bagi pedagang dan konsumen...'
            ],
            8 => (object)[
                'id' => 8,
                'judul' => 'Parepare Dorong Ekspor Produk Lokal ke Pasar Asia',
                'gambar' => 'img/berita8.jpg',
                'created_at' => '11-02-2025',
                'isi' => 'Isi lengkap berita 8 di sini. Upaya memperluas pasar ekspor bagi produk Parepare semakin intensif melalui berbagai kerja sama dengan negara-negara di Asia...'
            ]
        ];
    }

    public function show($id)
    {
        $daftarBerita = $this->getDummyData();
        $berita = $daftarBerita[$id] ?? null;

        if (!$berita) {
            abort(404, 'Berita tidak ditemukan');
        }

        return view('beritaUtama', compact('berita'));
    }

    public function showAboutPage()
    {
        return view('pages.aboutUs');
    }
}
