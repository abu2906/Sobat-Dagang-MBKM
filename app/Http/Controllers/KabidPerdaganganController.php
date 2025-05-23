<?php

namespace App\Http\Controllers;

use App\Models\IndexHarga;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;  
use App\Models\PermohonanSurat;
use App\Models\Barang;
use App\Models\StokOpname;
use Carbon\Carbon;

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

    public function analisisPasar(Request $request)
    {
        // Menentukan lokasi pasar yang dipilih, defaultnya adalah 'Pasar Sumpang'
        $lokasi = $request->lokasi ?? 'Pasar Sumpang';

        // Menentukan periode tanggal yang digunakan untuk filter data
        $startDate = $request->start_date ?? now()->subDays(30)->format('Y-m-d');
        $endDate = $request->end_date ?? now()->format('Y-m-d');

        // Inisialisasi variabel yang akan digunakan
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
            $topHargaNaik = $perubahan->where('isNaik', true)
                ->sortByDesc('price_change')
                ->take(5)
                ->map(function ($item) {
                    $item['color'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF)); // kasih warna random
                    return $item;
                })
                ->values()
                ->all();

            $topHargaTurun = $perubahan->where('isNaik', false)
                ->sortByDesc('price_change')
                ->take(5)
                ->map(function ($item) {
                    $item['color'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF)); // kasih warna random
                    return $item;
                })
                ->values()
                ->all();

        }

        // Mengembalikan tampilan dengan data yang telah diproses
        return view('admin.kabid.perdagangan.analisisPasar', [
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
        ]);
    }
    public function distribusiPupuk()
    {
        // Data distribusi per toko dan jenis pupuk
        $data = DB::table('stok_opname')
            ->join('toko', 'stok_opname.id_toko', '=', 'toko.id_toko')
            ->join('distributor', 'stok_opname.id_distributor', '=', 'distributor.id_distributor')
            ->select(
                'toko.nama_toko',
                'toko.no_register',
                'stok_opname.nama_barang',
                DB::raw('SUM(stok_opname.penyaluran) as total_penyaluran')
            )
            ->groupBy('toko.id_toko', 'stok_opname.nama_barang', 'toko.nama_toko', 'toko.no_register')
            ->get()
            ->groupBy('nama_toko');

        $jumlahToko = $data->count();

        $dataPupuk = StokOpname::selectRaw('nama_barang as jenis_pupuk, SUM(penyaluran) as total')
            ->groupBy('nama_barang')
            ->pluck('total', 'jenis_pupuk');

        $totalDistribusi = $dataPupuk->sum();

        // Data untuk line chart per tahun
        $lineData = DB::table('stok_opname')
            ->select(
                DB::raw('YEAR(tanggal) as tahun'),
                'nama_barang',
                DB::raw('SUM(penyaluran) as total_penyaluran')
            )
            ->groupBy('tahun', 'nama_barang')
            ->orderBy('tahun')
            ->get();

        $labels = $lineData->pluck('tahun')->unique()->values()->all();

        $jenisPupuk = $lineData->pluck('nama_barang')->unique();

        $datasets = [];

        foreach ($jenisPupuk as $jenis) {
            $dataPerTahun = [];
            foreach ($labels as $tahun) {
                $record = $lineData->firstWhere(function($item) use ($tahun, $jenis) {
                    return $item->tahun == $tahun && $item->nama_barang == $jenis;
                });
                $dataPerTahun[] = $record ? (int) $record->total_penyaluran : 0;
            }
            $color = match($jenis) {
                'NPK' => 'red',
                'UREA' => 'blue',
                'NPK-FK' => 'orange',
                default => 'gray'
            };

            $datasets[] = [
                'label' => $jenis,
                'data' => $dataPerTahun,
                'borderColor' => $color,
                'tension' => 0.3,
                'fill' => false
            ];
        }

        return view('admin.kabid.perdagangan.distribusiPupuk', [
            'data' => $data,
            'jumlahToko' => $jumlahToko,
            'dataPupuk' => $dataPupuk,
            'totalDistribusi' => $totalDistribusi,
            'labels' => $labels,
            'datasets' => $datasets,
        ]);
    }

}
