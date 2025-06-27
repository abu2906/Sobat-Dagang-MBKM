<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IndexHarga;
use App\Models\IndexKategori;
use App\Models\Barang;

class ApiPerdaganganController extends ApiController
{

    public function getKategori(Request $request)
    {
        $this->validateAppKey($request);
        $data = IndexKategori::all();
        return response()->json(['data' => $data]);
    }

    public function getBarang(Request $request)
    {
        $this->validateAppKey($request);
        $data = Barang::with('kategori')->get();
        return response()->json(['data' => $data]);
    }

    public function getIndeksHarga(Request $request)
    {
        $this->validateAppKey($request);
        $data = IndexHarga::with(['barang', 'kategori'])->orderBy('tanggal', 'desc')->get();
        return response()->json(['data' => $data]);
    }

    public function getLokasi(Request $request)
    {
        $this->validateAppKey($request);
        $data = IndexHarga::select('lokasi')->distinct()->get();
        return response()->json(['data' => $data]);
    }
}
