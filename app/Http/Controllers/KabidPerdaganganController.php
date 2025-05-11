<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IndexHarga;
use App\Models\Barang;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class KabidPerdaganganController extends Controller
{

    
    public function dashboardKabid()
    {
        return view('admin.kabid.perdagangan.perdagangan');
    }

    public function distribusiPupuk()
    {
        return view('admin.kabid.perdagangan.distribusiPupuk');
    }

    public function analisisPasar(Request $request)
    {
        // Menentukan lokasi pasar yang dipilih, defaultnya adalah 'Pasar Sumpang'
        $lokasi = $request->lokasi ?? 'Pasar Sumpang';

        // Menentukan periode tanggal yang digunakan untuk filter data
        $startDate = $request->start_date ?? now()->subDays(6)->format('Y-m-d'); // 6 hari sebelumnya
        $endDate = $request->end_date ?? now()->format('Y-m-d'); // Hari ini

        // Inisialisasi variabel yang akan digunakan
        $tanggalList = collect();  // Koleksi tanggal yang digunakan untuk tabel harga
        $barangs = Barang::orderBy('nama_barang')->get();  // Mengambil semua barang dari tabel Barang
        $dataHarga = [];  // Menyimpan harga barang per tanggal
        $top10HargaTertinggi = [];  // Menyimpan 10 barang dengan harga tertinggi
        $topHargaNaik = [];  // Menyimpan barang dengan harga naik tertinggi
        $topHargaTurun = [];  // Menyimpan barang dengan harga turun tertinggi
        $barChartData = [
            'labels' => [],  // Label untuk bar chart (nama barang)
            'today' => [],  // Data harga hari ini
            'yesterday' => []  // Data harga kemarin
        ];

        // Cek jika lokasi yang dipilih adalah 'Pasar Sumpang' atau 'Pasar Lakessi'
        if (in_array($lokasi, ['Pasar Sumpang', 'Pasar Lakessi'])) {
            // Mengambil daftar tanggal antara startDate dan endDate
            $current = Carbon::parse($startDate);
            $end = Carbon::parse($endDate);
            while ($current <= $end) {
                $tanggalList->push($current->format('Y-m-d'));
                $current->addDay();
            }

            // Mengambil harga per barang per tanggal dari model IndexHarga
            foreach ($tanggalList as $tanggal) {
                foreach ($barangs as $barang) {
                    $harga = IndexHarga::whereDate('tanggal', $tanggal)
                        ->where('id_barang', $barang->id_barang)
                        ->where('lokasi', $lokasi)
                        ->value('harga');

                    // Menyimpan harga per tanggal per barang, jika tidak ada harga maka diset '-'
                    $dataHarga[$tanggal][$barang->id_barang] = $harga ?? '-';
                }
            }

            // Data untuk Pie Chart (Top 10 harga tertinggi berdasarkan harga terbaru)
            $top10HargaTertinggi = $barangs->map(function ($barang) use ($lokasi) {
                $harga = IndexHarga::where('id_barang', $barang->id_barang)
                    ->where('lokasi', $lokasi)
                    ->latest('tanggal')  // Mengambil harga terbaru
                    ->value('harga');

                return [
                    'label' => $barang->nama_barang,
                    'harga' => $harga ?? 0,  // Jika tidak ada harga, set ke 0
                    'color' => sprintf('#%06X', mt_rand(0, 0xFFFFFF))  // Warna acak untuk pie chart
                ];
            })
            ->sortByDesc('harga')  // Mengurutkan berdasarkan harga tertinggi
            ->take(10)  // Mengambil 10 barang dengan harga tertinggi
            ->values()
            ->all();

            // Perbandingan harga hari ini dan kemarin
            $today = Carbon::parse($endDate);
            $yesterday = $today->copy()->subDay();

            // Menyiapkan label untuk bar chart
            $barChartData['labels'] = $barangs->pluck('nama_barang');

            // Menyiapkan data harga hari ini
            $barChartData['today'] = $barangs->map(function ($barang) use ($lokasi, $today) {
                return IndexHarga::where('id_barang', $barang->id_barang)
                    ->where('lokasi', $lokasi)
                    ->whereDate('tanggal', $today)  // Mengambil harga hari ini
                    ->value('harga') ?? 0;  // Jika tidak ada harga, set ke 0
            });

            // Menyiapkan data harga kemarin
            $barChartData['yesterday'] = $barangs->map(function ($barang) use ($lokasi, $yesterday) {
                return IndexHarga::where('id_barang', $barang->id_barang)
                    ->where('lokasi', $lokasi)
                    ->whereDate('tanggal', $yesterday)  // Mengambil harga kemarin
                    ->value('harga') ?? 0;  // Jika tidak ada harga, set ke 0
            });

            // Menghitung perubahan harga antara hari ini dan kemarin
            $perubahan = $barangs->map(function ($barang, $index) use ($barChartData) {
                $todayPrice = $barChartData['today'][$index] ?? 0;
                $yesterdayPrice = $barChartData['yesterday'][$index] ?? 0;
                $diff = $todayPrice - $yesterdayPrice;  // Selisih harga

                return [
                    'label' => $barang->nama_barang,
                    'price_change' => abs($diff),  // Harga perubahan absolut
                    'isNaik' => $diff > 0,  // Menentukan apakah harga naik
                ];
            });

            // Menyaring dan mengurutkan perubahan harga untuk mendapatkan top harga naik dan turun
            $topHargaNaik = $perubahan->where('isNaik', true)->sortByDesc('price_change')->take(5)->values()->all();
            $topHargaTurun = $perubahan->where('isNaik', false)->sortByDesc('price_change')->take(5)->values()->all();
        }

        // Mengembalikan tampilan dengan data yang telah diproses
        return view('admin.kabid.perdagangan.analisisPasar', [
            'lokasiOptions' => ['Pasar Sumpang', 'Pasar Lakessi'],  // Opsi lokasi pasar
            'selectedLokasi' => $lokasi,  // Lokasi yang dipilih
            'startDate' => $startDate,  // Tanggal mulai
            'endDate' => $endDate,  // Tanggal akhir
            'tanggalList' => $tanggalList,  // Daftar tanggal untuk tabel
            'barangs' => $barangs,  // Daftar barang
            'dataHarga' => $dataHarga,  // Data harga per barang per tanggal
            'top10HargaTertinggi' => $top10HargaTertinggi,  // Top 10 harga tertinggi untuk Pie Chart
            'topHargaNaik' => $topHargaNaik,  // Top harga naik
            'topHargaTurun' => $topHargaTurun,  // Top harga turun
            'barChartData' => $barChartData,  // Data untuk Bar Chart (perbandingan harga)
        ]);
    }

}
