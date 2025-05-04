<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BeritaController
{
    // Menampilkan daftar berita di dashboard
    public function index()
    {
        $beritas = $this->getDummyData();
        return view('dashboard', compact('beritas'));
    }

    // Menampilkan detail berita berdasarkan ID
    public function show($id)
    {
        $beritas = $this->getDummyData();
        $berita = $beritas[$id] ?? null;

        if (!$berita) {
            abort(404, 'Berita tidak ditemukan');
        }

        return view('beritaUtama', compact('berita'));
    }

    // Menambahkan berita baru ke database
    public function tambahberita(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'isi' => 'required|string',
            'lampiran' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $lampiranPath = null;
        if ($request->hasFile('lampiran')) {
            $lampiranPath = $request->file('lampiran')->store('lampiran', 'public');
        }

        DB::table('berita')->insert([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'lampiran' => $lampiranPath,
            'tanggal' => $request->tanggal, // disimpan ke kolom tanggal
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Berita berhasil ditambahkan.');
    }

    // Fungsi untuk mengambil data dummy berita
    public function getDummyData()
    {
        return [
            1 => (object)[
                'id' => 1,
                'judul' => 'Wamendag: IEU-CEPA jadi solusi strategis di tengah situasi global',
                'gambar' => asset('img/dashboard.jpg'),
                'created_at' => '2025-02-17',
                'isi' => 'Isi lengkap berita 1 di sini. Penjelasan mengenai IEU-CEPA dalam konteks global saat ini...'
            ],
            2 => (object)[
                'id' => 2,
                'judul' => 'Dinas Perdagangan Parepare Ungkap Penyebab Harga Cabai dan Bawang Meroket',
                'gambar' => 'img/berita2.jpg',
                'created_at' => '2025-02-18',
                'isi' => 'Isi lengkap berita 2 di sini. Harga cabai dan bawang meningkat karena beberapa faktor...'
            ],
            3 => (object)[
                'id' => 3,
                'judul' => 'Ekspor Parepare Tembus Puluhan Triliun, Angkat Ekonomi Regional',
                'gambar' => 'img/berita3.jpg',
                'created_at' => '2025-02-16',
                'isi' => 'Isi lengkap berita 3 di sini. Dampak ekspor terhadap ekonomi daerah Parepare...'
            ],
            4 => (object)[
                'id' => 4,
                'judul' => 'Pertumbuhan Ekonomi Parepare di Tengah Kondisi Global Makin Disipliner',
                'gambar' => 'img/berita4.jpg',
                'created_at' => '2025-02-15',
                'isi' => 'Isi lengkap berita 4 di sini. Strategi Parepare dalam mempertahankan pertumbuhan ekonomi di tengah tantangan global...'
            ],
            5 => (object)[
                'id' => 5,
                'judul' => 'Peningkatan UMKM Parepare Mendapat Dukungan Penuh',
                'gambar' => 'img/berita5.jpg',
                'created_at' => '2025-02-14',
                'isi' => 'Isi lengkap berita 5 di sini. Pemerintah Parepare memperkuat UMKM lokal dengan berbagai program pendukung...'
            ],
            6 => (object)[
                'id' => 6,
                'judul' => 'Parepare Jadi Contoh Kota Ramah Investasi di Sulsel',
                'gambar' => 'img/berita6.jpg',
                'created_at' => '2025-02-13',
                'isi' => 'Isi lengkap berita 6 di sini. Investasi di Parepare meningkat pesat karena kebijakan pro-investasi yang diterapkan...'
            ],
            7 => (object)[
                'id' => 7,
                'judul' => 'Program Pasar Digital Parepare Mulai Berjalan',
                'gambar' => 'img/berita7.jpg',
                'created_at' => '2025-02-12',
                'isi' => 'Isi lengkap berita 7 di sini. Transformasi digital di sektor perdagangan Parepare membuka peluang baru bagi pedagang dan konsumen...'
            ],
            8 => (object)[
                'id' => 8,
                'judul' => 'Parepare Dorong Ekspor Produk Lokal ke Pasar Asia',
                'gambar' => 'img/berita8.jpg',
                'created_at' => '2025-02-11',
                'isi' => 'Isi lengkap berita 8 di sini. Upaya memperluas pasar ekspor bagi produk Parepare semakin intensif melalui berbagai kerja sama dengan negara-negara di Asia...'
            ]
        ];
    }
}
