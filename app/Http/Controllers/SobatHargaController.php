<?php

namespace App\Http\Controllers;

use App\Models\IndexKategori;
use App\Models\Barang;
use App\Models\IndexHarga;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SobatHargaController extends Controller
{
    public function index($kategori)
    {
        // Ambil data kategori berdasarkan nama
        $kategoriData = IndexKategori::where('nama_kategori', 'like', '%' . $kategori . '%')->firstOrFail();

        // Ambil barang berdasarkan id kategori
        $barangs = Barang::where('id_index_kategori', $kategoriData->id_index_kategori)->get();

        // Lokasi yang tersedia
        $lokasiList = ['Pasar Sumpang', 'Pasar Lakessi'];

        $daftarHarga = [];

        // Ambil histori harga untuk tiap barang dan lokasi
        foreach ($barangs as $barang) {
            $namaBarang = $barang->nama_barang;
            $daftarHarga[$namaBarang] = [];

            foreach ($lokasiList as $lokasi) {
                $histori = IndexHarga::where('id_barang', $barang->id_barang)
                            ->where('lokasi', $lokasi)
                            ->orderBy('tanggal', 'desc')
                            ->take(6)
                            ->get()
                            ->sortBy('tanggal');

                // Mengambil data tanggal dan harga
                $labels = $histori->pluck('tanggal')->map(fn($tgl) => \Carbon\Carbon::parse($tgl)->translatedFormat('l'));
                $dataHarga = $histori->pluck('harga');

                $hariIni = $histori->last()->harga ?? 0;
                $kemarin = $histori->count() > 1 ? $histori->slice(-2)->first()->harga : $hariIni;

                $selisih = $kemarin != 0 ? round((($hariIni - $kemarin) / $kemarin) * 100, 2) : 0;

                // Menambahkan data harga ke daftar
                $daftarHarga[$namaBarang][$lokasi] = [
                    'hari_ini' => $hariIni,
                    'kemarin' => $kemarin,
                    'selisih' => $selisih,
                    'labels' => $labels->toArray(),
                    'data' => $dataHarga->toArray(),
                ];
            }
        }

        // Ambil semua kategori yang sudah diurutkan berdasarkan id
        $semuaKategori = IndexKategori::orderBy('id_index_kategori')->get();

        // Mengirim data ke view
        return view('pages.sobatHarga', [
            'judul' => ucfirst($kategori),
            'daftarHarga' => $daftarHarga,
            'semuaKategori' => $semuaKategori,
        ]);
    }
}