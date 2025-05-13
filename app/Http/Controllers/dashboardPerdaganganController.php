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
use App\Models\DocumentUser;
use App\Models\IndexKategori;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\IndexHarga;  
use App\Models\DistribusiPupuk;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class DashboardPerdaganganController extends Controller
{
    public function index()
{
    // Ambil data surat perdagangan
    $rekapSurat = $this->getSuratPerdaganganData();
    $dataSurat = PermohonanSurat::with('user')
        ->whereIn('jenis_surat', ['surat_rekomendasi_perdagangan', 'surat_keterangan_perdagangan'])
        ->orderBy('created_at', 'desc')
        ->get();

    // Ambil data harga barang
    $daftarHarga = DB::table('index_harga')
        ->join('barang', 'index_harga.id_barang', '=', 'barang.id_barang')
        ->join('index_kategori', 'index_harga.id_index_kategori', '=', 'index_kategori.id_index_kategori')
        ->select(
            'barang.nama_barang',
            'index_kategori.nama_kategori as kategori_barang',
            'index_harga.harga as harga_satuan',
            'index_harga.updated_at'
        )
        ->orderBy('index_harga.updated_at', 'desc')
        ->get();

    // Kirim semua data ke view
    return view('admin.bidangPerdagangan.dashboardPerdagangan', [
        'dataSurat' => $dataSurat,
        'daftarHarga' => $daftarHarga,
        'totalSuratPerdagangan' => $rekapSurat['totalSuratPerdagangan'],
        'totalSuratTerverifikasi' => $rekapSurat['totalSuratTerverifikasi'],
        'totalSuratDitolak' => $rekapSurat['totalSuratDitolak'],
        'totalSuratDraft' => $rekapSurat['totalSuratDraft'],
    ]);
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
            'totalSuratTerverifikasi' => DB::table('form_permohonan')->whereIn('jenis_surat', $jenis)->where('status', 'diterima')->count(),
            'totalSuratDitolak' => DB::table('form_permohonan')->whereIn('jenis_surat', $jenis)->where('status', 'ditolak')->count(),
            'totalSuratDraft' => DB::table('form_permohonan')->whereIn('jenis_surat', $jenis)->where('status', 'draft')->count(),
        ];
    }

    public function kelolaSurat()
    {
        $rekapSurat = $this->getSuratPerdaganganData();
        $dataSurat = PermohonanSurat::with('user')
            ->whereIn('jenis_surat', ['surat_rekomendasi_perdagangan', 'surat_keterangan_perdagangan'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.bidangPerdagangan.kelolaSurat', [
            'dataSurat' => $dataSurat,
            'totalSuratPerdagangan' => $rekapSurat['totalSuratPerdagangan'],
            'totalSuratTerverifikasi' => $rekapSurat['totalSuratTerverifikasi'],
            'totalSuratDitolak' => $rekapSurat['totalSuratDitolak'],
            'totalSuratDraft' => $rekapSurat['totalSuratDraft'],
        ]);
    }
    public function detailSurat($id)
    {
        $data = PermohonanSurat::where('id_permohonan', $id)->first();
        $dokumen = DocumentUser::where('id_permohonan', $id)->first();
        $user = DB::table('user')->where('id_user', $data->id_user)->first();

        return view('admin.bidangPerdagangan.detailPermohonan', [
            'data' => $data,
            'dokumen' => $dokumen,
            'user' => $user,
        ]);
    }

    public function viewDokumen($id, $type)
    {
        $dokumen = DB::table('document_user')->where('id_permohonan', $id)->first();

        if (!$dokumen) {
            return abort(404, 'Dokumen tidak ditemukan.');
        }

        $filePath = match (strtoupper($type)) {
            'NIB' => $dokumen->dokument_nib ?? null,
            'NPWP' => $dokumen->npwp ?? null,
            'KTP' => $dokumen->foto_ktp ?? null,
            'AKTA' => $dokumen->akta_perusahaan ?? null,
            'USAHA' => $dokumen->foto_usaha ?? null,
            'SURAT' => DB::table('form_permohonan')->where('id_permohonan', $id)->value('file_surat'),
            default => null,
        };

        if (!$filePath || !Storage::disk('public')->exists($filePath)) {
            return abort(404, 'File tidak ditemukan.');
        }

        return response()->file(storage_path("app/public/{$filePath}"));
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
        $kategoris = IndexKategori::orderBy('nama_kategori')->get();
        $barangs = Barang::orderBy('nama_barang')->get();

        return view('admin.bidangPerdagangan.updateHarga', compact('kategoris', 'barangs'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'id_index_kategori' => 'required|exists:index_kategori,id_index_kategori',
            'id_barang' => 'required|exists:barang,id_barang',
            'harga' => 'required|numeric',
            'tanggal' => 'required|date',
            'lokasi' => 'required|string',
        ]);

        IndexHarga::create([
            'id_index_kategori' => $request->id_index_kategori,
            'id_barang' => $request->id_barang,
            'harga' => $request->harga,
            'tanggal' => $request->tanggal,
            'lokasi' => $request->lokasi,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Harga barang berhasil diperbarui.');
    }

    public function getByKategori($id)
    {
        $barangs = Barang::where('id_index_kategori', $id)->get(['id_barang', 'nama_barang']);
        return response()->json($barangs);
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
        // $query = PermohonanSurat::where('user_id', auth()->id()); 
        $query = PermohonanSurat::query();
        if (request('search')) {
            $search = strtolower(trim(request('search'))); // lowercase & trim input

            $mapping = [
                'surat rekomendasi' => 'surat_rekomendasi_perdagangan',
                'rekomendasi' => 'surat_rekomendasi_perdagangan',
                'surat keterangan' => 'surat_keterangan_perdagangan',
                'keterangan' => 'surat_keterangan_perdagangan',
                'lainnya' => 'dan_lainnya_perdagangan',
            ];

            $matchedJenis = null;
            foreach ($mapping as $key => $value) {
                if (str_contains($search, $key)) {
                    $matchedJenis = $value;
                    break;
                }
            }

            $query->where(function ($q) use ($search, $matchedJenis) {
                if ($matchedJenis) {
                    $q->where('jenis_surat', $matchedJenis);
                } else {
                    $q->whereRaw('LOWER(status) LIKE ?', ["%$search%"])
                        ->orWhereRaw('DATE_FORMAT(tanggal_pengajuan, "%d-%m-%Y") LIKE ?', ["%$search%"]);
                }
            });
        }
        $riwayatSurat = $query->latest()->get();
        return view('user.bidangPerdagangan.riwayatSurat', compact('riwayatSurat'));
    }

    public function tolak(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_pengirim' => 'required|string',
            'alasan' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        // Cari permohonan berdasarkan ID
        $permohonan = PermohonanSurat::findOrFail($id);

        // Set status menjadi 'ditolak'
        $permohonan->status = 'ditolak';

        // Generate PDF
        try {
            // Buat PDF dari view blade
            $pdf = Pdf::loadView('SuratBalasan.surat-penolakan', [
                'nama_pengirim' => $request->nama_pengirim,
                'alasan' => $request->alasan,
                'tanggal' => $request->tanggal
            ]);

            // Nama file unik
            $filename = 'penolakan-' . Str::uuid() . '.pdf';
            // Simpan ke folder 'public/surat' di storage
            Storage::disk('public')->put("surat/{$filename}", $pdf->output());

            // Update kolom 'file_balasan' dengan path file yang baru disimpan
            $permohonan->file_balasan = "surat/{$filename}";

            // Simpan perubahan ke database (update status dan file_balasan)
            $permohonan->save();

            // Kembalikan response yang mengarah langsung ke file PDF menggunakan response()->file()
            return response()->file(storage_path("app/public/surat/{$filename}"));
        } catch (\Exception $e) {
            // Log error jika terjadi masalah
            Log::error('PDF creation error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat surat. Silakan coba lagi.');
        }
    }

    public function simpanRekomendasi(Request $request, $id)
    {

        
        set_time_limit(300); // waktu dalam detik

        // Validasi input
        $request->validate([
            'nomor_surat'       => 'required|string',
            'tanggal_surat'     => 'required|date',
            'nama_pengirim'     => 'required|string',
            'nik'               => 'required|string',
            'warga_negara'      => 'required|string',
            'pekerjaan'         => 'required|string',
            'alamat_rumah'      => 'required|string',
            'nama_usaha'        => 'required|string',
            'bentuk_usaha'      => 'required|string',
            'jenis_perusahaan'  => 'required|string',
            'luas_ruangan'      => 'required|string',
            'alamat_usaha'      => 'required|string',
        ]);

        // Cari permohonan berdasarkan ID
        $permohonan = PermohonanSurat::findOrFail($id);

        try {

            // Generate PDF dari view blade
            $pdf = Pdf::loadView('SuratBalasan.surat-rekomendasi', [
                'nomor_surat' => $request->nomor_surat,
                'tanggal_surat' => $request->tanggal_surat,
                'nama_pengirim' => $request->nama_pengirim,
                'nik' => $request->nik,
                'warga_negara' => $request->warga_negara,
                'pekerjaan' => $request->pekerjaan,
                'alamat_rumah' => $request->alamat_rumah,
                'nama_usaha' => $request->nama_usaha,
                'bentuk_usaha' => $request->bentuk_usaha,
                'jenis_perusahaan' => $request->jenis_perusahaan,
                'luas_ruangan' => $request->luas_ruangan,
                'alamat_usaha' => $request->alamat_usaha,
                'status' => $permohonan->status, // Kirim status ke view
            ]);

            // Nama file unik
            $filename = 'rekomendasi-' . Str::uuid() . '.pdf';
            // Simpan ke folder 'public/surat' di storage
            Storage::disk('public')->put("surat/{$filename}", $pdf->output());

            // Update kolom 'file_balasan' dengan path file yang baru disimpan
            $permohonan->file_balasan = "surat/{$filename}";

            // Simpan perubahan ke database (update status dan file_balasan)
            $permohonan->save();

            // Kembalikan response yang mengarah langsung ke file PDF menggunakan response()->file()
            return response()->file(storage_path("app/public/surat/{$filename}"));
        } catch (ValidationException $e) {
            dd($e->errors()); // Menampilkan semua error validasi dalam bentuk array
        }
    }

    public function simpanketerangan(Request $request, $id)
    {

        // Validasi input
        $request->validate([
            'tanggal_surat'     => 'required|date',
            'nama_pengirim'     => 'required|string',
            'jabatan'           => 'required|string',
            'nama_penerima'     => 'required|string',
            'tampat_lahir'      => 'required|string',
            'tanggal_lahir'     => 'required|date',
            'jenis_kelamin'     => 'required|string',
            'agama'             => 'required|string',
            'alamat_lengkap'    => 'required|string',
            'isi'               => 'required|string',
            'status_pernikahan' => 'required|string',
        ]);

        // Cari permohonan berdasarkan ID
        $permohonan = PermohonanSurat::findOrFail($id);

        try {

            // Generate PDF dari view blade
            $pdf = Pdf::loadView('SuratBalasan.surat-keterangan', [
                'tanggal_surat'     => $request->tanggal_surat,
                'nama_pengirim'     => $request->nama_pengirim,
                'jabatan'           => $request->jabatan,
                'nama_penerima'     => $request->nama_penerima,
                'tampat_lahir'      => $request->tampat_lahir,
                'tanggal_lahir'     => $request->tanggal_lahir,
                'jenis_kelamin'     => $request->jenis_kelamin,
                'agama'             => $request->agama,
                'alamat_lengkap'    => $request->alamat_lengkap,
                'isi'               => $request->isi,
                'status_pernikahan' => $request->status_pernikahan,
            ]);

            // Nama file unik
            $filename = 'rekomendasi-' . Str::uuid() . '.pdf';
            // Simpan ke folder 'public/surat' di storage
            Storage::disk('public')->put("surat/{$filename}", $pdf->output());

            // Update kolom 'file_balasan' dengan path file yang baru disimpan
            $permohonan->file_balasan = "surat/{$filename}";

            // Simpan perubahan ke database (update status dan file_balasan)
            $permohonan->save();

            // Kembalikan response yang mengarah langsung ke file PDF menggunakan response()->file()
            return response()->file(storage_path("app/public/surat/{$filename}"));
        } catch (ValidationException $e) {
            dd($e->errors()); // Menampilkan semua error validasi dalam bentuk array
        }
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
            $fotoUsahaPath = $request->file('foto_usaha')->store('DokumentUser', 'public');
            $fotoKTPPath = $request->file('foto_ktp')->store('DokumentUser', 'public');
            $dokumenNibPath = $request->file('dokumen_nib')->store('DokumentUser', 'public');
            $npwpPath = $request->file('npwp')->store('DokumentUser', 'public');
            $aktaPerusahaanPath = $request->file('akta_perusahaan')->store('DokumentUser', 'public');
            $fileSuratPath = $request->file('surat')->store('DokumentUser', 'public');

            // Buat id_permohonan unik
            $idPermohonan = Str::uuid()->toString();

            // Ambil id_user dari session
            $idUser = session('id_user');

            // Simpan ke tabel form_permohonan
            DB::table('form_permohonan')->insert([
                'id_permohonan' => $idPermohonan,  // Masukkan UUID yang baru dibuat
                'id_user' => $idUser,  // Ambil id_user dari session
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

        // Jika permintaan AJAX, kirim data JSON
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
}
