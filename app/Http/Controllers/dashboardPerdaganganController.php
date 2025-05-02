<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\HargaBarang;
use App\Models\Notifikasi;

class DashboardPerdaganganController extends Controller
{
    public function index()
    {
        return view('admin.bidangPerdagangan.dashboardPerdagangan', [
            // 'jumlahSuratMasuk' => Surat::count(),
            // 'jumlahTerverifikasi' => Surat::where('status', 'terverifikasi')->count(),
            // 'jumlahDitolak' => Surat::where('status', 'ditolak')->count(),
            // 'jumlahDraft' => Surat::where('status', 'draft')->count(),
            // 'suratMasuk' => Surat::latest()->take(5)->get(),
            // 'daftarHarga' => HargaBarang::latest()->take(4)->get(),
            // 'notifikasi' => Notifikasi::latest()->take(4)->get(),
        ]);
    }

    public function formTambahBarang()
    {
        return view('admin.bidangPerdagangan.tambahBarang');
    }

    public function storeBarang(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
        ]);

        $namaBarang = $request->nama_barang;
        $kategori = $request->kategori_lama ?: $request->kategori_baru;

        // Simpan ke database (sesuaikan nama model dan tabel)
        // Contoh:
        // Barang::create([
        //     'nama' => $namaBarang,
        //     'kategori' => $kategori,
        // ]);

        return redirect()->back()->with('success', 'Barang berhasil ditambahkan!');
    }
}
