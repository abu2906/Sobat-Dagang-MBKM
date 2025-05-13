<?php

namespace App\Http\Controllers;

use App\Models\IndexHarga;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\HargaBarang;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Str;
use App\Models\PermohonanSurat;
use App\Models\Barang;
use App\Models\DocumentUser;
use App\Models\IndexKategori;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\DistribusiPupuk;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\ValidationException;

class KabidPerdaganganController extends Controller
{

    private function getSuratPerdaganganData()
    {
        $jenis = [
            'surat_rekomendasi_perdagangan',
            'surat_keterangan_perdagangan',
            'dan_lainnya_perdagangan',
        ];

        return [
            'totalSuratPerdagangan' => DB::table('form_permohonan')->whereIn('jenis_surat', $jenis)->count(),
            'totalSuratTerverifikasi' => DB::table('form_permohonan')->whereIn('jenis_surat', $jenis)->where('status', 'diterima')->count(),
            'totalSuratDitolak' => DB::table('form_permohonan')->whereIn('jenis_surat', $jenis)->where('status', 'ditolak')->count(),
            'totalSuratDraft' => DB::table('form_permohonan')->whereIn('jenis_surat', $jenis)->where('status', 'draft')->count(),
        ];
    }
    public function dashboardKabid(Request $request)
    {
        $tahun = $request->input('tahun', date('Y'));

        $rekapSurat = $this->getSuratPerdaganganData();
        $suratMasuk = PermohonanSurat::orderBy('created_at', 'desc')->get();

        $statusCounts = [
            'diterima' => PermohonanSurat::whereYear('created_at', $tahun)->where('status', 'diterima')->count(),
            'ditolak' => PermohonanSurat::whereYear('created_at', $tahun)->where('status', 'ditolak')->count(),
            'menunggu' => PermohonanSurat::whereYear('created_at', $tahun)->where('status', 'menunggu')->count(),
        ];

        $dataBulanan = [];
        for ($i = 1; $i <= 12; $i++) {
            $dataBulanan[] = PermohonanSurat::whereYear('created_at', $tahun)->whereMonth('created_at', $i)->count();
        }

        // Jika permintaan AJAX, kirim data JSON
        if ($request->ajax()) {
            return response()->json([
                'statusCounts' => $statusCounts,
                'dataBulanan' => $dataBulanan
            ]);
        }

        return view('admin.kabid.perdagangan.perdagangan', [
            'totalSuratPerdagangan' => $rekapSurat['totalSuratPerdagangan'],
            'totalSuratTerverifikasi' => $rekapSurat['totalSuratTerverifikasi'],
            'totalSuratDitolak' => $rekapSurat['totalSuratDitolak'],
            'totalSuratDraft' => $rekapSurat['totalSuratDraft'],
            'suratMasuk' => $suratMasuk,
            'statusCounts' => $statusCounts,
            'dataBulanan' => $dataBulanan
        ]);
    }
    public function setujui($id)
    {
        $permohonan = PermohonanSurat::findOrFail($id);

        // Ubah status menjadi 'diterima'
        $permohonan->status = 'diterima';
        $permohonan->save();

        return redirect()->back()->with('success', 'Surat berhasil disetujui dan status diperbarui.');
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
