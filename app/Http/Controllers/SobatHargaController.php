<?php

namespace App\Http\Controllers;

use App\Models\IndexKategori;
use App\Models\Barang;
use App\Models\IndexHarga;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\PermohonanSurat;
use Illuminate\Http\Request;

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
    public function suratPerdagangan(Request $request)
    {
        $tahun = $request->input('tahun', date('Y'));

        $rekapSurat = $this->getSuratPerdaganganData();
        $suratMasuk = PermohonanSurat::with('user')
            ->whereIn('jenis_surat', ['surat_rekomendasi_perdagangan', 'surat_keterangan_perdagangan'])
            ->where('status', '!=', 'disimpan')
            ->whereIn('status', ['menunggu', 'ditolak', 'diterima']) // hanya status ini yang ditampilkan
            ->orderBy('created_at', 'desc')
            ->get();

        $jenis = [
            'surat_rekomendasi_perdagangan',
            'surat_keterangan_perdagangan',
        ];

        $statusCounts = [
            'diterima' => PermohonanSurat::whereYear('created_at', $tahun)
                ->whereIn('jenis_surat', $jenis)
                ->where('status', 'diterima')
                ->count(),
            'ditolak' => PermohonanSurat::whereYear('created_at', $tahun)
                ->whereIn('jenis_surat', $jenis)
                ->where('status', 'ditolak')
                ->count(),
            'menunggu' => PermohonanSurat::whereYear('created_at', $tahun)
                ->whereIn('jenis_surat', $jenis)
                ->where('status', 'menunggu')
                ->count(),
        ];

        $dataBulanan = [];
        for ($i = 1; $i <= 12; $i++) {
            $dataBulanan[] = PermohonanSurat::whereYear('created_at', $tahun)
                ->whereMonth('created_at', $i)
                ->whereIn('jenis_surat', $jenis)
                ->where('status', '!=', 'disimpan')
                ->count();
        }


        if ($request->ajax()) {
            return response()->json([
                'statusCounts' => $statusCounts,
                'dataBulanan' => $dataBulanan
            ]);
        }
        
        return view('admin.kepalaDinas.suratPerdagangan', [
            'totalSuratPerdagangan' => $rekapSurat['totalSuratPerdagangan'],
            'totalSuratTerverifikasi' => $rekapSurat['totalSuratTerverifikasi'],
            'totalSuratDitolak' => $rekapSurat['totalSuratDitolak'],
            'totalSuratDraft' => $rekapSurat['totalSuratDraft'],
            'suratMasuk' => $suratMasuk,
            'statusCounts' => $statusCounts,
            'dataBulanan' => $dataBulanan
        ]);
    }

    public function perdagangan(Request $request)
    {
        // --- Bagian Perdagangan ---
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

        // --- Bagian Distribusi Pupuk ---
        $kecamatan = $request->input('kecamatan');

        $query = DB::table('stok_opname')
            ->join('toko', 'stok_opname.id_toko', '=', 'toko.id_toko')
            ->join('distributor', 'stok_opname.id_distributor', '=', 'distributor.id_distributor');

        if ($kecamatan) {
            $query->where('toko.kecamatan', $kecamatan);
        }

        $dataDistribusi = $query->select(
                'toko.nama_toko',
                'toko.no_register',
                'stok_opname.nama_barang',
                DB::raw('SUM(stok_opname.penyaluran) as total_penyaluran')
            )
            ->groupBy('toko.id_toko', 'stok_opname.nama_barang', 'toko.nama_toko', 'toko.no_register')
            ->get()
            ->groupBy('nama_toko');

        $dataPupuk = DB::table('stok_opname')
            ->join('toko', 'stok_opname.id_toko', '=', 'toko.id_toko')
            ->when($kecamatan, function ($query) use ($kecamatan) {
                $query->where('toko.kecamatan', $kecamatan);
            })
            ->select('stok_opname.nama_barang', DB::raw('SUM(stok_opname.penyaluran) as total'))
            ->groupBy('stok_opname.nama_barang')
            ->pluck('total', 'stok_opname.nama_barang');

        $totalDistribusi = $dataPupuk->sum();

        $dataPerTahun = DB::table('stok_opname')
            ->join('toko', 'stok_opname.id_toko', '=', 'toko.id_toko')
            ->when($kecamatan, function ($query) use ($kecamatan) {
                $query->where('toko.kecamatan', $kecamatan);
            })
            ->select(DB::raw('YEAR(stok_opname.created_at) as tahun'), DB::raw('SUM(penyaluran) as total'))
            ->groupBy(DB::raw('YEAR(stok_opname.created_at)'))
            ->orderBy('tahun')
            ->get();

        $lineLabels = $dataPerTahun->pluck('tahun')->toArray();
        $lineValues = $dataPerTahun->pluck('total')->toArray();

        $lineDatasets = [
            [
                'label' => 'Total Penyaluran Pupuk per Tahun',
                'data' => $lineValues,
                'borderColor' => 'rgba(75, 192, 192, 1)',
                'backgroundColor' => 'rgba(75, 192, 192, 0.2)',
                'fill' => true,
                'tension' => 0.4,
            ]
        ];

        // --- Return View ---
        return view('admin.kepalaDinas.perdagangan', [
            // Data perdagangan
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
            // Data distribusi pupuk
            'dataDistribusi' => $dataDistribusi,
            'dataPupuk' => $dataPupuk,
            'totalDistribusi' => $totalDistribusi,
            'selectedKecamatan' => $kecamatan,
            'lineLabels' => $lineLabels,
            'lineDatasets' => $lineDatasets,
        ]);
    } 

}