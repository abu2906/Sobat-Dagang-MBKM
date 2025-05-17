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
    public function index(Request $request)
    {
        // Ambil data surat perdagangan
        $rekapSurat = $this->getSuratPerdaganganData();
        $dataSurat = PermohonanSurat::with('user')
            ->whereIn('jenis_surat', ['surat_rekomendasi_perdagangan', 'surat_keterangan_perdagangan'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Ambil daftar harga barang terbaru (tanpa filter waktu)
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

        // Ambil daftar lokasi unik untuk dropdown
        $daftar_lokasi = DB::table('index_harga')->select('lokasi')->distinct()->pluck('lokasi');
        $lokasi = $request->input('lokasi', 'Pasar Sumpang');

        // Definisikan range tanggal sebulan terakhir
        $startDate = Carbon::now()->subDays(30)->format('Y-m-d');
        $endDate = Carbon::now()->format('Y-m-d');

        // Ambil data harga per pasar sebulan terakhir
        $dataSumpang = DB::table('index_harga')
            ->where('lokasi', 'Pasar Sumpang')
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->orderBy('tanggal')
            ->get(['tanggal', 'harga']);

        $dataLakessi = DB::table('index_harga')
            ->where('lokasi', 'Pasar Lakessi')
            ->whereBetween('tanggal', [$startDate, $endDate])
            ->orderBy('tanggal')
            ->get(['tanggal', 'harga']);

        // Gabungkan semua tanggal unik dari kedua pasar
        $tanggalSumpang = $dataSumpang->pluck('tanggal')->toArray();
        $tanggalLakessi = $dataLakessi->pluck('tanggal')->toArray();
        $allTanggal = array_unique(array_merge($tanggalSumpang, $tanggalLakessi));
        sort($allTanggal);

        // Label untuk grafik (format tanggal user-friendly)
        $labels = array_map(function ($tgl) {
        return Carbon::parse($tgl)->translatedFormat('d M');
        }, $allTanggal);

        // Buat array harga sesuai label, isi null jika tidak ada data di tanggal tersebut
        $hargaSumpang = [];
        foreach ($allTanggal as $tgl) {
            $item = $dataSumpang->firstWhere('tanggal', $tgl);
            $hargaSumpang[] = $item ? (int) $item->harga : null;
        }

        $hargaLakessi = [];
        foreach ($allTanggal as $tgl) {
            $item = $dataLakessi->firstWhere('tanggal', $tgl);
            $hargaLakessi[] = $item ? (int) $item->harga : null;
        }

        // Hitung data ringkasan dari gabungan harga kedua pasar (exclude null)
        $hargaGabungan = array_filter(array_merge($hargaSumpang, $hargaLakessi));

        if (count($hargaGabungan) > 0) {
            $minHarga = min($hargaGabungan);
            $maxHarga = max($hargaGabungan);
            $avgHarga = array_sum($hargaGabungan) / count($hargaGabungan);

            $terendah = number_format($minHarga, 0, ',', '.');
            $tertinggi = number_format($maxHarga, 0, ',', '.');
            $rata_rata = number_format($avgHarga, 0, ',', '.');
            $volatilitas = round((($maxHarga - $minHarga) / ($avgHarga ?: 1)) * 100, 1) . '%';
        } else {
            $terendah = '0';
            $rata_rata = '0';
            $tertinggi = '0';
            $volatilitas = '0%';
        }

        // Data distribusi pupuk
        $pupuk = DB::table('distribusi_pupuk')
            ->selectRaw('SUM(urea) as urea, SUM(npk) as npk, SUM(npk_fk) as npk_fk')
            ->first();

        // Kirim semua data ke view
        return view('admin.bidangPerdagangan.dashboardPerdagangan', [
            'dataSurat' => $dataSurat,
            'daftarHarga' => $daftarHarga,
            'totalSuratPerdagangan' => $rekapSurat['totalSuratPerdagangan'],
            'totalSuratTerverifikasi' => $rekapSurat['totalSuratTerverifikasi'],
            'totalSuratDitolak' => $rekapSurat['totalSuratDitolak'],
            'totalSuratDraft' => $rekapSurat['totalSuratDraft'],

            // Data grafik
            'labels' => $labels,
            'hargaSumpang' => $hargaSumpang,
            'hargaLakessi' => $hargaLakessi,
            'terendah' => $terendah,
            'rata_rata' => $rata_rata,
            'tertinggi' => $tertinggi,
            'volatilitas' => $volatilitas,
            'pupuk' => $pupuk,
            'daftar_lokasi' => $daftar_lokasi,
            'lokasi' => $lokasi,
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
        if (!auth()->guard('user')->check()) {
            return redirect()->route('login')->with('error', 'Harap login terlebih dahulu');
        }
        return view('user.bidangPerdagangan.formPermohonan');
    }

    public function riwayatSurat()
    {
        if (!auth()->guard('user')->check()) {
            return redirect()->route('login')->with('error', 'Harap login terlebih dahulu');
        }
        $userId = Auth::guard('user')->id();
        $query = PermohonanSurat::where('id_user', $userId);

        if ($searchTerm = request('search')) {
            $search = strtolower(trim($searchTerm));

            $mapping = [
                'surat rekomendasi' => 'surat_rekomendasi_perdagangan',
                'rekomendasi' => 'surat_rekomendasi_perdagangan',
                'rek' => 'surat_rekomendasi_perdagangan',
                'surat keterangan' => 'surat_keterangan_perdagangan',
                'keterangan' => 'surat_keterangan_perdagangan',
                'ket' => 'surat_keterangan_perdagangan',
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
                    ->orWhereRaw('DATE_FORMAT(tgl_pengajuan, "%d-%m-%Y") LIKE ?', ["%$search%"]);
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
            // Buat PDF dari view blade// Tambahkan ini sebelum generate PDF
            ini_set('max_execution_time', 300); // 300 detik = 5 menit

            $pdf = Pdf::loadView('SuratBalasan.surat-penolakan', [
                'nama_pengirim' => $request->nama_pengirim,
                'alasan' => $request->alasan,
                'tanggal' => $request->tanggal
            ]);;


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
            dd($e->getMessage());
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
            'isi'      => 'required|string',
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
                'isi' => $request->isi,
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

    public function analisisHarga()
    {
    // Ambil data tren harga indeks (misal barang kategori pupuk)
    $data = DB::table('index_harga')
        ->where('lokasi', 'Pasar Sumpang')
        ->orderBy('tanggal')
        ->get();

    $labels = $data->pluck('tanggal')->toArray();
    $harga = $data->pluck('harga')->toArray();

    // Statistik
    $terendah = number_format(min($harga), 0, ',', '.');
    $rata_rata = number_format(array_sum($harga)/count($harga), 0, ',', '.');
    $tertinggi = number_format(max($harga), 0, ',', '.');
    $volatilitas = round(((max($harga) - min($harga)) / ($rata_rata ?: 1)) * 100, 1) . '%';

    // Data distribusi pupuk (untuk pie chart)
    $pupuk = DB::table('distribusi_pupuk')->selectRaw('SUM(urea) as urea, SUM(npk) as npk, SUM(npk_fk) as npk_fk')->first();

    return view('admin.kabid.perdagangan.analisisHarga', compact(
        'labels', 'harga',
        'terendah', 'rata_rata', 'tertinggi', 'volatilitas',
        'pupuk'
    ));

    }
}