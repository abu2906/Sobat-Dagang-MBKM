<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IndexHarga;
use App\Models\IndexKategori;
use App\Models\Barang;
use Carbon\Carbon;
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
}