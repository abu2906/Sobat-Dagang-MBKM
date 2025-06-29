<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataIkm;
use App\Models\Karyawan;
use App\Models\PersentasePemilik;
use App\Models\PemakaianBahan;
use App\Models\PenggunaanAir; 
use App\Models\Pengeluaran;
use App\Models\PenggunaanBahanBakar;
use App\Models\Listrik; 
use App\Models\MesinProduksi;
use App\Models\Produksi;
use App\Models\Persediaan;  
use App\Models\Pendapatan;
use App\Models\BentukPengelolaanLimbah; 
use App\Models\Modal; 
use App\Models\SertifikasiHalal;


class ApiIndustriController extends ApiController
{
    public function getSertifikatHalal(Request $request)
    {
        $this->validateAppKey($request);
        $data = SertifikasiHalal::all();
        return response()->json($data);
    }

    public function getDataIkm(Request $request)
    {
        $this->validateAppKey($request);

        $data = DataIkm::select(
            'id_ikm',
            'nama_ikm',
            'nama_pemilik',
            'kecamatan',
            'kelurahan',
            'komoditi',
            'jenis_industri',
            'alamat',
            'no_telp',
            'level'
        )->get();

        return response()->json($data);
    }

    public function getDataIkmDetail(Request $request, $id)
{
    $this->validateAppKey($request);

    $data = DataIkm::select(
        'id_ikm',
        'nama_ikm',
        'luas',
        'nama_pemilik',
        'jenis_kelamin',
        'kecamatan',
        'kelurahan',
        'komoditi',
        'jenis_industri',
        'alamat',
        'nib',
        'no_telp',
        'tenaga_kerja',
        'level'
    )->findOrFail($id);

    return response()->json($data);
}

public function getKaryawan(Request $request, $id)
{
    $this->validateAppKey($request);

    $data = Karyawan::where('id_ikm', $id)->first();

    if (!$data) {
        return response()->json(['message' => 'Data karyawan tidak ditemukan'], 404);
    }

    return response()->json($data);
}

public function getPersentasePemilik(Request $request, $id)
{
    $this->validateAppKey($request);

    $data = PersentasePemilik::where('id_ikm', $id)->first();

    if (!$data) {
        return response()->json(['message' => 'Data persentase pemilik tidak ditemukan'], 404);
    }

    return response()->json($data);
}

public function getPemakaianBahan(Request $request, $id)
{
    $this->validateAppKey($request);

    $data = PemakaianBahan::where('id_ikm', $id)->get();

    if ($data->isEmpty()) {
        return response()->json(['message' => 'Data pemakaian bahan tidak ditemukan'], 404);
    }

    return response()->json($data);
}

public function getPenggunaanAir(Request $request, $id)
{
    $this->validateAppKey($request);

    $data = PenggunaanAir::where('id_ikm', $id)->first();

    if (!$data) {
        return response()->json(['message' => 'Data penggunaan air tidak ditemukan'], 404);
    }

    return response()->json($data);
}

public function getPengeluaran(Request $request, $id)
{
    $this->validateAppKey($request);

    $data = Pengeluaran::where('id_ikm', $id)->first();

    if (!$data) {
        return response()->json(['message' => 'Data pengeluaran tidak ditemukan'], 404);
    }

    return response()->json($data);
}

public function getPenggunaanBahanBakar(Request $request, $id)
{
    $this->validateAppKey($request);

    $data = PenggunaanBahanBakar::where('id_ikm', $id)->get();

    if ($data->isEmpty()) {
        return response()->json(['message' => 'Data penggunaan bahan bakar tidak ditemukan'], 404);
    }

    return response()->json($data);
}

public function getListrik(Request $request, $id)
{
    $this->validateAppKey($request);

    $data = Listrik::where('id_ikm', $id)->first();

    if (!$data) {
        return response()->json(['message' => 'Data listrik tidak ditemukan'], 404);
    }

    return response()->json($data);
}

public function getMesinProduksi(Request $request, $id)
{
    $this->validateAppKey($request);

    $data = MesinProduksi::where('id_ikm', $id)->get();

    if ($data->isEmpty()) {
        return response()->json(['message' => 'Data mesin produksi tidak ditemukan'], 404);
    }

    return response()->json($data);
}

public function getProduksi(Request $request, $id)
{
    $this->validateAppKey($request);

    $data = Produksi::where('id_ikm', $id)->first();

    if (!$data) {
        return response()->json(['message' => 'Data produksi tidak ditemukan'], 404);
    }

    return response()->json($data);
}

public function getPersediaan(Request $request, $id)
{
    $this->validateAppKey($request);

    $data = Persediaan::where('id_ikm', $id)->first();

    if (!$data) {
        return response()->json(['message' => 'Data persediaan tidak ditemukan'], 404);
    }

    return response()->json($data);
}

public function getPendapatan(Request $request, $id)
{
    $this->validateAppKey($request);

    $data = Pendapatan::where('id_ikm', $id)->first();

    if (!$data) {
        return response()->json(['message' => 'Data pendapatan tidak ditemukan'], 404);
    }

    return response()->json($data);
}

public function getModal(Request $request, $id)
{
    $this->validateAppKey($request);

    $data = Modal::where('id_ikm', $id)->get();

    if ($data->isEmpty()) {
        return response()->json(['message' => 'Data modal tidak ditemukan'], 404);
    }

    return response()->json($data);
}

public function getBentukPengelolaanLimbah(Request $request, $id)
{
    $this->validateAppKey($request);

    $data = BentukPengelolaanLimbah::where('id_ikm', $id)->first();

    if (!$data) {
        return response()->json(['message' => 'Data bentuk pengelolaan limbah tidak ditemukan'], 404);
    }

    return response()->json($data);
}

public function hitungLevel(Request $request, $id)
{
    $this->validateAppKey($request);

    $ikm = DataIkm::with([
        'pemakaianBahan',
        'penggunaanAir',
        'pengeluaran',
        'penggunaanBahanBakar',
        'listrik',
        'persediaan',
        'pendapatan',
        'modal',
    ])->find($id);

    if (!$ikm) {
        return response()->json(['message' => 'Data IKM tidak ditemukan'], 404);
    }

    $level = $ikm->hitungLevel();

    return response()->json([
        'id_ikm' => $ikm->id_ikm,
        'nama_ikm' => $ikm->nama_ikm,
        'level_total' => $level
    ]);
}

}


