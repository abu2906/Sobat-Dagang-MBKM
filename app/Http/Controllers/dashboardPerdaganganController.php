<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\HargaBarang;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Str;
use App\Models\PermohonanSurat;
use App\Models\Barang;
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

    public function formUpdateHarga()
    {
        return view('admin.bidangPerdagangan.updateHarga');
    }

    public function deleteBarang()
    {
        // $barangs = Barang::all();
        // return view('admin.bidangPerdagangan.hapusBarang', compact('barangs'));
        return view('admin.bidangPerdagangan.hapusBarang');
    }
    public function destroy($id)
    {
    $barang = Barang::findOrFail($id);
    $barang->delete();

    return redirect()->back()->with('success', 'Barang berhasil dihapus.');
    }

    public function laporanPupuk()
    {
        return view('admin.bidangPerdagangan.lihatLaporan');
    }
    
    public function formPermohonan()
    {
        return view('user.bidangPerdagangan.formPermohonan');
    }

    public function riwayatSurat()
    {
    // $riwayatSurat = PermohonanSurat::where('user_id', auth()->id())->latest()->get();
    $riwayatSurat = PermohonanSurat::all();
    return view('user.bidangPerdagangan.riwayatSurat', compact('riwayatSurat'));
    }

    public function ajukanPermohonan(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'jenis_surat' => 'required|in:surat_rekomendasi,surat_keterangan,dan_lainnya',
            'kecamatan' => 'required|string',
            'kelurahan' => 'nullable|string',
            'titik_koordinat' => 'required|string',
            'foto_usaha' => 'required|image|mimes:jpeg,png,jpg|max:10240',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg|max:10240',
            'dokumen_nib' => 'required|mimes:pdf|max:10240',
            'npwp' => 'required|mimes:pdf,jpg,jpeg,png|max:10240',
            'akta_perusahaan' => 'required|mimes:pdf|max:10240',
            'surat' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ]);
    
        try {
            // Simpan file satu per satu
            $fotoUsahaPath = $request->file('foto_usaha')->store('uploads');
            $fotoKTPPath = $request->file('foto_ktp')->store('uploads');
            $dokumenNibPath = $request->file('dokumen_nib')->store('uploads');
            $npwpPath = $request->file('npwp')->store('uploads');
            $aktaPerusahaanPath = $request->file('akta_perusahaan')->store('uploads');
            $fileSuratPath = $request->file('surat')->store('uploads');
    
            // Buat id_permohonan unik
            $idPermohonan = Str::uuid()->toString();
    
            DB::table('form_permohonan')->insert([
                'id_permohonan' => $idPermohonan,
                // 'id_user' => auth()->user()->id,
                'id_user' => null,
                'id_kecamatan' => $request->kecamatan,
                'id_kelurahan' => $request->kelurahan,
                'tgl_pengajuan' => now()->toDateString(),
                'jenis_surat' => $request->jenis_surat,
                'titik_koordinat' => $request->titik_koordinat,
                'file_surat' => $fileSuratPath,
                'status' => 'pending',
            ]);
    
            return redirect()->route('bidangPerdagangan.riwayatSurat')->with('success', 'Pengajuan surat berhasil diajukan.');
    
        } catch (Exception $e) {
            Log::error('Gagal mengajukan surat: ' . $e->getMessage());
            dd($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat mengirim pengajuan. Silakan coba lagi.');
        }
    }
    
}
