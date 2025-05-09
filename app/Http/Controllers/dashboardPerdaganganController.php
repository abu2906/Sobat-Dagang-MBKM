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
use App\Models\IndexKategori;

class DashboardPerdaganganController extends Controller
{
    public function index()
    {
        $dataSurat = $this->getSuratPerdaganganData();
        
        return view('admin.bidangPerdagangan.dashboardPerdagangan', $dataSurat);
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
            'totalSuratTerverifikasi' => DB::table('form_permohonan')->whereIn('jenis_surat', $jenis)->where('status', 'disetujui')->count(),
            'totalSuratDitolak' => DB::table('form_permohonan')->whereIn('jenis_surat', $jenis)->where('status', 'ditolak')->count(),
            'totalSuratDraft' => DB::table('form_permohonan')->whereIn('jenis_surat', $jenis)->where('status', 'draft')->count(),
        ];
    }

    public function kelolaSurat()
    {
    $rekapSurat = $this->getSuratPerdaganganData();

    // Ambil daftar surat perdagangan dengan nama pemohon
    // $dataSurat = DB::table('form_permohonan')
    //     ->join('users', 'form_permohonan.id_user', '=', 'users.id')
    //     ->whereIn('form_permohonan.jenis_surat', [
    //         'surat_rekomendasi_perdagangan',
    //         'surat_keterangan_perdagangan',
    //         'dan_lainnya_perdagangan',
    //     ])
    //     ->select(
    //         'form_permohonan.id as id_surat',
    //         'form_permohonan.created_at',
    //         'form_permohonan.status',
    //         'users.name as nama'
    //     )
    //     ->orderByDesc('form_permohonan.created_at')
    //     ->get();

    // Gabungkan dan kirim ke view
    return view('admin.bidangPerdagangan.kelolaSurat', array_merge([
        // 'dataSurat' => $dataSurat
    ], $rekapSurat));
    }
    public function detailPermohonan($id)
    {
        // $data = DB::table('form_permohonan')
        //     ->join('users', 'form_permohonan.id_user', '=', 'users.id')
        //     ->where('form_permohonan.id', $id)
        //     ->select(
        //         'form_permohonan.*',
        //         'users.name as nama',
        //         'users.email',
        //         'users.no_telp',
        //         'users.jenis_kelamin'
        //     )
        //     ->first();
    
        return view('admin.bidangPerdagangan.detailPermohonan', compact('data'));
    }
    

    public function formTambahBarang()
    {
        $kategori = IndexKategori::all();
        return view('admin.bidangPerdagangan.tambahBarang', compact('kategori'));
    }

    public function storeBarang(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string',
            'kategori_lama' => 'nullable|string',
            'kategori_baru' => 'nullable|string',
        ]);

        $idKategori = null;

        if ($request->kategori_lama === 'tambah_baru' && $request->filled('kategori_baru')) {
            $kategoriBaru = IndexKategori::create([
                'nama_kategori' => $request->kategori_baru,
            ]);
            $idKategori = $kategoriBaru->id_index_kategori;
        } elseif (is_numeric($request->kategori_lama)) {
            $kategoriLama = IndexKategori::find($request->kategori_lama);
            if ($kategoriLama) {
                $idKategori = $kategoriLama->id_index_kategori;
            }
        }

        if (!$idKategori) {
            return back()->withErrors(['kategori' => 'Kategori tidak valid.'])->withInput();
        }

        Barang::create([
            'nama_barang' => $request->nama_barang,
            'id_index_kategori' => $idKategori,
        ]);

        return redirect()->back()->with('success', 'Barang berhasil ditambahkan.');
    }

    public function formUpdateHarga()
    {
        return view('admin.bidangPerdagangan.updateHarga');
    }

    public function deleteBarang()
    {
        $barangs = Barang::with('kategori')->get(); // eager load kategori
        return view('admin.bidangPerdagangan.hapusBarang', compact('barangs'));
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
        // $userId = auth()->user()->id;

        // $riwayat = DB::table('form_permohonan') 
        // ->where('id_user', $userId)
        // ->orderBy('tgl_pengajuan', 'desc')
        // ->get();
        
        $riwayatSurat = PermohonanSurat::all();
        return view('user.bidangPerdagangan.riwayatSurat', compact('riwayatSurat'));
    }

    public function ajukanPermohonan(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'jenis_surat' => 'required|in:surat_rekomendasi_perdagangan,surat_keterangan_perdagangan,dan_lainnya_perdagangan',
            'kecamatan' => 'required|string',
            'kelurahan' => 'required|string',
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

            // Simpan ke tabel form_permohonan
            DB::table('form_permohonan')->insert([
                'id_permohonan' => $idPermohonan,  // Masukkan UUID yang baru dibuat
                // 'id_user' => auth()->id() ?? null, // atau null jika belum login
                'kecamatan' => $request->kecamatan,
                'kelurahan' => $request->kelurahan,
                'tgl_pengajuan' => now()->toDateString(),
                'jenis_surat' => $request->jenis_surat,
                'titik_koordinat' => $request->titik_koordinat,
                'file_surat' => $fileSuratPath,
                'status' => 'menunggu',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Simpan ke tabel document_user
            DB::table('document_user')->insert([
                'id_permohonan' => $idPermohonan,  // Masukkan id_permohonan yang sama ke document_user
                'npwp' => $npwpPath,
                'akta_perusahaan' => $aktaPerusahaanPath,
                'foto_ktp' => $fotoKTPPath,
                'foto_usaha' => $fotoUsahaPath,
                'dokument_nib' => $dokumenNibPath,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return redirect()->route('bidangPerdagangan.riwayatSurat')
                ->with('success', 'Pengajuan surat berhasil diajukan.');
        } catch (Exception $e) {
            Log::error('Gagal mengajukan surat: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', $e->getMessage()); // hanya untuk dev
        }
    }
}
