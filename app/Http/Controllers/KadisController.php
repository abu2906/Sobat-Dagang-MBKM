<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Barang;
use App\Models\IndexHarga;

class KadisController extends Controller
{
    
    private function dataSuratPerdagangan()    {
        $jenis = [
            'surat_rekomendasi_perdagangan',
            'surat_keterangan_perdagangan',
        ];

        return [
            'totalSuratPerdagangan' => DB::table('form_permohonan')->whereIn('jenis_surat', $jenis)->count(),
            'totalSuratTerverifikasi' => DB::table('form_permohonan')->whereIn('jenis_surat', $jenis)->where('status', 'diterima')->count(),
            'totalSuratDitolak' => DB::table('form_permohonan')->whereIn('jenis_surat', $jenis)->where('status', 'ditolak')->count(),
        ];
    }

    private function getCalibrationComparisonData()
    {
        $currentYear = Carbon::now()->year;
        $lastYear = $currentYear - 1;
        
        // Get data for current year
        $currentYearData = DB::table('surat_metrologi')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', $currentYear)
            ->where('status_surat_masuk', 'Disetujui')
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();
            
        // Get data for last year
        $lastYearData = DB::table('surat_metrologi')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', $lastYear)
            ->where('status_surat_masuk', 'Disetujui')
            ->groupBy('month')
            ->pluck('total', 'month')
            ->toArray();
            
        // Fill in missing months with 0
        $currentYearComplete = [];
        $lastYearComplete = [];
        for ($i = 1; $i <= 12; $i++) {
            $currentYearComplete[] = $currentYearData[$i] ?? 0;
            $lastYearComplete[] = $lastYearData[$i] ?? 0;
        }
        
        return [
            'currentYearData' => json_encode($currentYearComplete),
            'lastYearData' => json_encode($lastYearComplete),
            'currentYear' => $currentYear,
            'lastYear' => $lastYear
        ];
    }

    private function dataSuratIndustri()    {
        $jenis = [
            'surat_rekomendasi_industri',
            'surat_keterangan_industri',
        ];

        return [
            'totalSuratIndustri' => DB::table('form_permohonan')->whereIn('jenis_surat', $jenis)->count(),
            'totalSuratTerverifikasi' => DB::table('form_permohonan')->whereIn('jenis_surat', $jenis)->where('status', 'diterima')->count(),
            'totalSuratDitolak' => DB::table('form_permohonan')->whereIn('jenis_surat', $jenis)->where('status', 'ditolak')->count(),
            'totalSuratDraft' => DB::table('form_permohonan')->whereIn('jenis_surat', $jenis)->where('status', 'draft')->count(),
        ];

    }
    private function dataSuratMetrologi()    {
        $jenis = [
            'tera',
            'tera_ulang'
        ];

        return [
            'totalSuratMetrologi' => DB::table('surat_metrologi')->whereIn('jenis_surat', $jenis)->count(),
            'totalSuratTerverifikasi' => DB::table('surat_metrologi')->whereIn('jenis_surat', $jenis)->where('status_surat_masuk', 'Disetujui')->count(),
            'totalSuratDitolak' => DB::table('surat_metrologi')->whereIn('jenis_surat', $jenis)->where('status_surat_masuk', 'Ditolak')->count(),
            'totalSuratDraft' => DB::table('surat_metrologi')->whereIn('jenis_surat', $jenis)->where('status_surat_masuk', 'Menunggu')->count(),
        ];
    }

    private function dataSuratTotal() {
        $perdagangan = $this->dataSuratPerdagangan();
        $industri = $this->dataSuratIndustri();
        $metrologi = $this->dataSuratMetrologi();

        return [
            'totalSuratPerdagangan' => $perdagangan['totalSuratPerdagangan'],
            'totalSuratTerverifikasiPerdagangan' => $perdagangan['totalSuratTerverifikasi'],
            'totalSuratDitolakPerdagangan' => $perdagangan['totalSuratDitolak'],

            'totalSuratIndustri' => $industri['totalSuratIndustri'],
            'totalSuratTerverifikasiIndustri' => $industri['totalSuratTerverifikasi'],
            'totalSuratDitolakIndustri' => $industri['totalSuratDitolak'],

            'totalSuratMetrologi' => $metrologi['totalSuratMetrologi'],
            'totalSuratTerverifikasiMetrologi' => $metrologi['totalSuratTerverifikasi'],
            'totalSuratDitolakMetrologi' => $metrologi['totalSuratDitolak'],

            // Total keseluruhan ketiga bidang
            'totalSuratKeseluruhan' =>
                $perdagangan['totalSuratPerdagangan'],+
                $industri['totalSuratIndustri'] +
                $metrologi['totalSuratMetrologi'],

            'totalSuratTerverifikasiKeseluruhan' =>
                $perdagangan['totalSuratTerverifikasi'],
                +
                $industri['totalSuratTerverifikasi'] +
                $metrologi['totalSuratTerverifikasi'],

            'totalSuratDitolakKeseluruhan' =>
                $perdagangan['totalSuratDitolak'],                +
                $industri['totalSuratDitolak'] +
                $metrologi['totalSuratDitolak'],
        ];
    }
    public function index(Request $request)
    {
        $totalSuratSmuaBidang = $this->dataSuratTotal();

        $lokasi = $request->lokasi ?? 'Pasar Sumpang';
        $startDate = $request->start_date ?? now()->subDays(30)->format('Y-m-d');
        $endDate = $request->end_date ?? now()->format('Y-m-d');

        $tanggalList = collect();
        $barangs = Barang::orderBy('nama_barang')->get();
        $dataHarga = [];
        $topHargaNaik = [];
        $topHargaTurun = [];
        $barChartData = [
            'labels' => [],
            'today' => [],
            'yesterday' => []
        ];

        if (in_array($lokasi, ['Pasar Sumpang', 'Pasar Lakessi'])) {
            $current = Carbon::parse($startDate);
            $end = Carbon::parse($endDate);
            while ($current <= $end) {
                $tanggalList->push($current->format('Y-m-d'));
                $current->addDay();
            }

            foreach ($tanggalList as $tanggal) {
                foreach ($barangs as $barang) {
                    $harga = IndexHarga::whereDate('tanggal', $tanggal)
                        ->where('id_barang', $barang->id_barang)
                        ->where('lokasi', $lokasi)
                        ->value('harga');

                    $dataHarga[$tanggal][$barang->id_barang] = $harga ?? '-';
                }
            }

            $today = Carbon::parse($endDate);
            $yesterday = $today->copy()->subDay();

            $barChartData['labels'] = $barangs->pluck('nama_barang');

            $barChartData['today'] = $barangs->map(function ($barang) use ($lokasi, $today) {
                return IndexHarga::where('id_barang', $barang->id_barang)
                    ->where('lokasi', $lokasi)
                    ->whereDate('tanggal', $today)
                    ->value('harga') ?? 0;
            });

            $barChartData['yesterday'] = $barangs->map(function ($barang) use ($lokasi, $yesterday) {
                return IndexHarga::where('id_barang', $barang->id_barang)
                    ->where('lokasi', $lokasi)
                    ->whereDate('tanggal', $yesterday)
                    ->value('harga') ?? 0;
            });

            $perubahan = $barangs->map(function ($barang, $index) use ($barChartData) {
                $todayPrice = $barChartData['today'][$index] ?? 0;
                $yesterdayPrice = $barChartData['yesterday'][$index] ?? 0;
                $diff = $todayPrice - $yesterdayPrice;

                return [
                    'label' => $barang->nama_barang,
                    'price_change' => abs($diff),
                    'isNaik' => $diff > 0,
                ];
            });

            $topHargaNaik = $perubahan->where('isNaik', true)
                ->sortByDesc('price_change')
                ->take(5)
                ->map(function ($item) {
                    $item['color'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                    return $item;
                })
                ->values()
                ->all();

            $topHargaTurun = $perubahan->where('isNaik', false)
                ->sortByDesc('price_change')
                ->take(5)
                ->map(function ($item) {
                    $item['color'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                    return $item;
                })
                ->values()
                ->all();
        }
        $calibrationData = $this->getCalibrationComparisonData();

        return view('admin.kepalaDinas.dashboard', [
            'totalSuratSmuaBidang' => $totalSuratSmuaBidang,
            'lokasiOptions' => ['Pasar Sumpang', 'Pasar Lakessi'],
            'selectedLokasi' => $lokasi,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'tanggalList' => $tanggalList,
            'barangs' => $barangs,
            'dataHarga' => $dataHarga,
            'topHargaNaik' => $topHargaNaik,
            'topHargaTurun' => $topHargaTurun,
            'barChartData' => $barChartData,
            'calibrationData' => $calibrationData,
        ]);
    }

}
