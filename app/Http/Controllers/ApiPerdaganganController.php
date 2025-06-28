<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IndexHarga;
use App\Models\IndexKategori;
use App\Models\Barang;
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
}
