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

        // Range tanggal 6 hari terakhir (termasuk hari ini)
        $endDate = Carbon::today();
        $startDate = Carbon::today()->subDays(5);

        $rangeTanggal = collect();
        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            $rangeTanggal->push($date->copy());
        }

        foreach ($barangs as $barang) {
            $namaBarang = $barang->nama_barang;
            $daftarHarga[$namaBarang] = [];

            foreach ($lokasiList as $lokasi) {
                // Ambil histori harga dalam rentang tanggal dan cocokkan berdasarkan tanggal string
                $histori = IndexHarga::where('id_barang', $barang->id_barang)
                    ->where('lokasi', $lokasi)
                    ->whereBetween('tanggal', [
                        $startDate->format('Y-m-d'),
                        $endDate->format('Y-m-d')
                    ])
                    ->get()
                    ->keyBy(fn($item) => Carbon::parse($item->tanggal)->toDateString());

                $labels = [];
                $dataHarga = [];

                foreach ($rangeTanggal as $tanggal) {
                    $tanggalStr = $tanggal->toDateString();
                    $labels[] = $tanggal->translatedFormat('l, d M');
                    $dataHarga[] = $histori[$tanggalStr]->harga ?? null;
                }

                // Harga hari ini dan kemarin
                $hariIni = end($dataHarga) ?? 0;
                $kemarin = count($dataHarga) >= 2 ? $dataHarga[count($dataHarga) - 2] : $hariIni;

                $selisih = ($kemarin && $kemarin != 0) ? round((($hariIni - $kemarin) / $kemarin) * 100, 2) : 0;

                $daftarHarga[$namaBarang][$lokasi] = [
                    'hari_ini' => $hariIni,
                    'kemarin' => $kemarin,
                    'selisih' => $selisih,
                    'labels' => $labels,
                    'data' => $dataHarga,
                ];
            }
        }

        // Ambil semua kategori
        $semuaKategori = IndexKategori::orderBy('id_index_kategori')->get();

        return view('pages.sobatHarga', [
            'judul' => ucfirst($kategori),
            'daftarHarga' => $daftarHarga,
            'semuaKategori' => $semuaKategori,
        ]);
    }
}
