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