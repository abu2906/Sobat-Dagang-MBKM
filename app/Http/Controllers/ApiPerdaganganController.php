<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IndexHarga;
use App\Models\IndexKategori;
use App\Models\Barang;
use Carbon\Carbon;
use App\Models\Toko;
use Illuminate\Support\Facades\DB;
class ApiPerdaganganController extends ApiController
{

    public function getKategori(Request $request)
    {
        $this->validateAppKey($request);
        $data = IndexKategori::all();
        return response()->json($data);
    }

    public function getBarang(Request $request)
    {
        $this->validateAppKey($request);
        $data = Barang::with('kategori')->get();
        return response()->json($data);
    }

    public function getIndeksHarga(Request $request)
    {
        $this->validateAppKey($request);
        $data = IndexHarga::with(['barang', 'kategori'])->orderBy('tanggal', 'desc')->get();
        return response()->json($data);
    }

    public function getLokasi(Request $request)
    {
        $this->validateAppKey($request);
        $data = IndexHarga::select('lokasi')->distinct()->get();
        return response()->json($data);
    }

    public function getringkasan(Request $request)
    {
        $kecamatanFilter = $request->query('kecamatan'); // Tangkap parameter

        $query = DB::table('stok_opname')
            ->join('toko', 'stok_opname.id_toko', '=', 'toko.id_toko')
            ->select(
                'toko.kecamatan',
                'stok_opname.nama_barang',
                DB::raw('SUM(stok_opname.penyaluran) as total_penyaluran')
            );

        // 🔥 FILTER harus sebelum GROUP BY
        if ($kecamatanFilter) {
            $query->where('toko.kecamatan', $kecamatanFilter);
        }

        $data = $query
            ->groupBy('toko.kecamatan', 'stok_opname.nama_barang')
            ->get();

        // Strukturkan data
        $ringkasan = [];

        foreach ($data as $row) {
            $kecamatan = $row->kecamatan;
            $jenis = strtoupper($row->nama_barang);
            $jumlah = $row->total_penyaluran;

            if (!isset($ringkasan[$kecamatan])) {
                $ringkasan[$kecamatan] = [
                    'kecamatan' => $kecamatan,
                    'NPK' => 0,
                    'NPK-FK' => 0,
                    'UREA' => 0
                ];
            }

            if (in_array($jenis, ['NPK', 'NPK-FK', 'UREA'])) {
                $ringkasan[$kecamatan][$jenis] += $jumlah;
            }
        }

        return response()->json(array_values($ringkasan));
    }
    public function ringkasanPerToko(Request $request)
    {
        $kecamatan = $request->query('kecamatan'); // via query string

        $query = DB::table('stok_opname')
            ->join('toko', 'stok_opname.id_toko', '=', 'toko.id_toko')
            ->select(
                'toko.id_toko',
                'toko.nama_toko',
                'toko.no_register',
                'toko.kecamatan',
                'stok_opname.nama_barang',
                DB::raw('SUM(stok_opname.penyaluran) as total_penyaluran')
            )
            ->groupBy('toko.id_toko', 'toko.nama_toko', 'toko.no_register', 'toko.kecamatan', 'stok_opname.nama_barang');

        // Jika filter kecamatan dipakai
        if ($kecamatan) {
            $query->where('toko.kecamatan', $kecamatan);
        }

        $data = $query->get();

        // Strukturkan data per toko
        $result = [];

        foreach ($data as $row) {
            $id = $row->id_toko;

            if (!isset($result[$id])) {
                $result[$id] = [
                    'nama_toko' => $row->nama_toko,
                    'no_register' => $row->no_register,
                    'kecamatan' => $row->kecamatan,
                    'NPK' => 0,
                    'NPK-FK' => 0,
                    'UREA' => 0,
                ];
            }

            $jenis = strtoupper($row->nama_barang);

            if (in_array($jenis, ['NPK', 'NPK-FK', 'UREA'])) {
                $result[$id][$jenis] += $row->total_penyaluran;
            }
        }

        return response()->json(array_values($result));
    }

    public function getDistribusiPerTahun(Request $request)
    {
        $kecamatanFilter = $request->query('kecamatan');

        $query = DB::table('stok_opname')
            ->join('toko', 'stok_opname.id_toko', '=', 'toko.id_toko')
            ->select(
                DB::raw('YEAR(stok_opname.created_at) as tahun'),
                'toko.kecamatan',
                DB::raw('SUM(stok_opname.penyaluran) as total_penyaluran')
            )
            ->groupBy(DB::raw('YEAR(stok_opname.created_at)'), 'toko.kecamatan')
            ->orderBy('tahun', 'asc');

        if ($kecamatanFilter) {
            $query->where('toko.kecamatan', $kecamatanFilter);
        }

        $data = $query->get();

        return response()->json($data);
    }
    public function getDaftarKecamatan()
    {
        $kecamatan = DB::table('toko')
            ->select('kecamatan')
            ->distinct()
            ->orderBy('kecamatan')
            ->pluck('kecamatan');
        return response()->json($kecamatan);
    }

    public function getTopHargaNaik(Request $request)
    {   
        $this->validateAppKey($request);
        $lokasi = $request->lokasi ?? 'Pasar Sumpang';
        $tanggal = Carbon::parse($request->tanggal ?? now());
        $kemarin = $tanggal->copy()->subDay();

        $barangs = Barang::orderBy('nama_barang')->get();

        $perubahan = $barangs->map(function ($barang) use ($lokasi, $tanggal, $kemarin) {
            $todayPrice = IndexHarga::where('id_barang', $barang->id_barang)
                ->where('lokasi', $lokasi)
                ->whereDate('tanggal', $tanggal)
                ->value('harga') ?? 0;

            $yesterdayPrice = IndexHarga::where('id_barang', $barang->id_barang)
                ->where('lokasi', $lokasi)
                ->whereDate('tanggal', $kemarin)
                ->value('harga') ?? 0;

            $diff = $todayPrice - $yesterdayPrice;

            return [
                'label' => $barang->nama_barang,
                'price_change' => abs($diff),
                'isNaik' => $diff > 0,
            ];
        });

        $topHargaNaik = $perubahan->filter(fn($item) => $item['isNaik'] && $item['price_change'] > 0)
            ->sortByDesc('price_change')
            ->take(5)
            ->map(function ($item) {
                $item['color'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                return $item;
            })
            ->values();

        return response()->json($topHargaNaik);
    }

    public function getTopHargaTurun(Request $request)
    {
        $this->validateAppKey($request);
        $lokasi = $request->lokasi ?? 'Pasar Sumpang';
        $tanggal = Carbon::parse($request->tanggal ?? now());
        $kemarin = $tanggal->copy()->subDay();

        $barangs = Barang::orderBy('nama_barang')->get();

        $perubahan = $barangs->map(function ($barang) use ($lokasi, $tanggal, $kemarin) {
            $todayPrice = IndexHarga::where('id_barang', $barang->id_barang)
                ->where('lokasi', $lokasi)
                ->whereDate('tanggal', $tanggal)
                ->value('harga') ?? 0;

            $yesterdayPrice = IndexHarga::where('id_barang', $barang->id_barang)
                ->where('lokasi', $lokasi)
                ->whereDate('tanggal', $kemarin)
                ->value('harga') ?? 0;

            $diff = $todayPrice - $yesterdayPrice;

            return [
                'label' => $barang->nama_barang,
                'price_change' => abs($diff),
                'isNaik' => $diff > 0,
            ];
        });

        $topHargaTurun = $perubahan->filter(fn($item) => !$item['isNaik'] && $item['price_change'] > 0)
            ->sortByDesc('price_change')
            ->take(5)
            ->map(function ($item) {
                $item['color'] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
                return $item;
            })
            ->values();

        return response()->json($topHargaTurun);
    }

    public function hargaPerHari(Request $request)
    {
        $this->validateAppKey($request);
        $lokasi = $request->lokasi ?? 'Pasar Sumpang';
        $startDate = $request->start_date ?? now()->subDays(7)->format('Y-m-d');
        $endDate = $request->end_date ?? now()->format('Y-m-d');

        $barangs = Barang::orderBy('nama_barang')->get();
        
        $tanggalList = [];
        $current = Carbon::parse($startDate);
        $end = Carbon::parse($endDate);
        while ($current <= $end) {
            $tanggalList[] = $current->format('Y-m-d');
            $current->addDay();
        }

        $data = [];

        foreach ($tanggalList as $tanggal) {
            $baris = [
                'tanggal' => $tanggal,
                'harga' => []
            ];

            foreach ($barangs as $barang) {
                $harga = IndexHarga::whereDate('tanggal', $tanggal)
                    ->where('id_barang', $barang->id_barang)
                    ->where('lokasi', $lokasi)
                    ->value('harga');

                $baris['harga'][] = [
                    'id_barang' => $barang->id_barang,
                    'nama_barang' => $barang->nama_barang,
                    'harga' => $harga ?? '-'
                ];
            }

            $data[] = $baris;
        }

        return response()->json([
            'lokasi' => $lokasi,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'data' => $data,
        ]);
    }

    public function perbandinganHarga(Request $request)
    {
        $this->validateAppKey($request);
        $lokasi = $request->lokasi ?? 'Pasar Sumpang';

        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        $barangs = Barang::orderBy('nama_barang')->get();

        $data = $barangs->map(function ($barang) use ($lokasi, $today, $yesterday) {
            $hargaToday = IndexHarga::where('id_barang', $barang->id_barang)
                ->where('lokasi', $lokasi)
                ->whereDate('tanggal', $today)
                ->value('harga') ?? 0;

            $hargaYesterday = IndexHarga::where('id_barang', $barang->id_barang)
                ->where('lokasi', $lokasi)
                ->whereDate('tanggal', $yesterday)
                ->value('harga') ?? 0;

            return [
                'id_barang' => $barang->id_barang,
                'nama_barang' => $barang->nama_barang,
                'harga_hari_ini' => $hargaToday,
                'harga_kemarin' => $hargaYesterday,
                'selisih' => $hargaToday - $hargaYesterday,
            ];
        });

        return response()->json([
            'lokasi' => $lokasi,
            'tanggal_hari_ini' => $today->toDateString(),
            'tanggal_kemarin' => $yesterday->toDateString(),
            'data' => $data,
        ]);
    }

    public function jumlahToko(Request $request)
    {
        $this->validateAppKey($request);
        $jumlah = Toko::count();

        return response()->json([
            'total_toko' => $jumlah
        ]);
    }

    public function jumlahPupukTerdistribusi(Request $request)
    {
        $this->validateAppKey($request);
        $kecamatan = $request->input('kecamatan');

        $dataPupuk = DB::table('stok_opname')
            ->join('toko', 'stok_opname.id_toko', '=', 'toko.id_toko')
            ->when($kecamatan, function ($query) use ($kecamatan) {
                $query->where('toko.kecamatan', $kecamatan);
            })
            ->select('stok_opname.nama_barang', DB::raw('SUM(stok_opname.penyaluran) as total'))
            ->groupBy('stok_opname.nama_barang')
            ->pluck('total', 'stok_opname.nama_barang');

        $totalDistribusi = $dataPupuk->sum();

        return response()->json([
            'total_distribusi' => $totalDistribusi,
            'data_pupuk' => $dataPupuk
        ]);
    }    
}