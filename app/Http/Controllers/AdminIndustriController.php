<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\Notifikasi;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Str;
use App\Models\PermohonanSurat;
use App\Models\DocumentUser;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Models\DataIkm;
use App\Models\SertifikasiHalal;
use App\Exports\DataIkmExport;
use Maatwebsite\Excel\Facades\Excel;


class AdminIndustriController extends Controller
{
    public function showDashboard()
    {

        // Ambil data surat industri
        $rekapSurat = $this->getSuratIndustriData();
        $dataSurat = PermohonanSurat::with('user')
            ->whereIn('jenis_surat', ['surat_rekomendasi_industri', 'surat_keterangan_industri'])
            ->orderBy('created_at', 'desc')
            ->get();


        // Definisikan range tanggal sebulan terakhir
        $startDate = Carbon::now()->subDays(30)->format('Y-m-d');
        $endDate = Carbon::now()->format('Y-m-d');

        // Kirim semua data ke view
        return view('admin.bidangIndustri.dashboardAdmin', [
            'dataSurat' => $dataSurat,
            'totalSuratIndustri' => $rekapSurat['totalSuratIndustri'],
            'totalSuratTerverifikasi' => $rekapSurat['totalSuratTerverifikasi'],
            'totalSuratDitolak' => $rekapSurat['totalSuratDitolak'],
            'totalSuratDraft' => $rekapSurat['totalSuratDraft'],

        ]);
    }

    private function getSuratIndustriData()
    {
        $jenis = [
            'surat_rekomendasi_industri',
            'surat_keterangan_industri',
            'dan_lainnya_industri',
        ];

        return [
            'totalSuratIndustri' => DB::table('form_permohonan')->whereIn('jenis_surat', $jenis)->count(),
            'totalSuratTerverifikasi' => DB::table('form_permohonan')->whereIn('jenis_surat', $jenis)->where('status', 'diterima')->count(),
            'totalSuratDitolak' => DB::table('form_permohonan')->whereIn('jenis_surat', $jenis)->where('status', 'ditolak')->count(),
            'totalSuratDraft' => DB::table('form_permohonan')->whereIn('jenis_surat', $jenis)->where('status', 'draft')->count(),
        ];
    }

    public function detailSurat($id)
    {
        $data = PermohonanSurat::where('id_permohonan', $id)->first();
        $dokumen = DocumentUser::where('id_permohonan', $id)->first();
        $user = DB::table('user')->where('id_user', $data->id_user)->first();

        return view('admin.bidangIndustri.detailPermohonan', [
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
        return view('admin.bidangIndustri.dashboardAdmin');
    }

    public function showDataIKM()
    {
        $dataIkm = DataIkm::all();
        return view('admin.bidangIndustri.dataIKM', compact('dataIkm'));
    }

    public function editIKM($id)
    {
        $ikm = \App\Models\DataIkm::findOrFail($id);
        return view('admin.bidangindustri.editIKM', compact('ikm'));
    }

    public function destroyIKM($id)
    {
        \App\Models\DataIkm::destroy($id);
        return redirect()->route('dataIKM')->with('success', 'Data berhasil dihapus.');
    }


    public function showFormIKM()
    {
        $json = file_get_contents(public_path('assets/data/wilayah.json'));
        $wilayah = json_decode($json, true);

        return view('admin.bidangIndustri.formIKM', compact('wilayah'));
    }

    public function exportIKM(Request $request)
    {
        $filtered = DataIKM::query();

        if ($request->filled('kecamatan')) {
            $filtered->where('kecamatan', $request->kecamatan);
        }

        if ($request->filled('jenis_industri')) {
            $filtered->where('jenis_industri', $request->jenis_industri);
        }

        $data = $filtered->get();

        return Excel::download(new DataIkmExport($data), 'data_ikm_terfilter.xlsx');
    }

    public function storeDataIKM(Request $request)
    {
        $validatedDataIKM = $request->validate([
            'nama_ikm' => 'required|string|max:255',
            'luas' => 'required|string|max:255',
            'nama_pemilik' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'kecamatan' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'komoditi' => 'required|string|max:255',
            'jenis_industri' => 'required|string|max:255',
            'alamat' => 'required|string',
            'nib' => 'required|string|max:255',
            'no_telp' => 'required|string|max:20',
            'tenaga_kerja' => 'required|integer|min:0',
        ]);

        // 🛠️ Jika ID dikirim, artinya edit — bukan tambah
        if ($request->filled('id')) {
            $ikm = \App\Models\DataIKM::find($request->id);
            if ($ikm) {
                $ikm->update($validatedDataIKM);
            }
        } else {
            // Tambah data baru
            \App\Models\DataIKM::create($validatedDataIKM);
        }

        $validatedPersentasePemilik = $request->validate([
            'pemerintah_pusat' => 'required|numeric|min:0|max:100',
            'pemerintah_daerah' => 'required|numeric|min:0|max:100',
            'swasta_nasional' => 'required|numeric|min:0|max:100',
            'asing' => 'required|numeric|min:0|max:100',
        ]);


        $validatedKaryawan = $request->validate([
            // Status Tenaga Kerja
            'tenaga_kerja_tetap' => 'required|integer|min:0',
            'tenaga_kerja_tidak_tetap' => 'required|integer|min:0',

            // Gender
            'tenaga_kerja_laki_laki' => 'required|integer|min:0',
            'tenaga_kerja_perempuan' => 'required|integer|min:0',

            // Pendidikan
            'sd' => 'required|integer|min:0',
            'smp' => 'required|integer|min:0',
            'sma_smk' => 'required|integer|min:0',
            'd1_d3' => 'required|integer|min:0',
            's1_d4' => 'required|integer|min:0',
            's2' => 'required|integer|min:0',
            's3' => 'required|integer|min:0',
        ]);

        $totalIkm = (int) $request->tenaga_kerja;

        $totalStatus = (int) ($request->tenaga_kerja_tetap ?? 0) + (int) ($request->tenaga_kerja_tidak_tetap ?? 0);
        $totalGender = (int) ($request->tenaga_kerja_laki_laki ?? 0) + (int) ($request->tenaga_kerja_perempuan ?? 0);
        $totalPendidikan = (int) ($request->sd ?? 0)
            + (int) ($request->smp ?? 0)
            + (int) ($request->sma_smk ?? 0)
            + (int) ($request->d1_d3 ?? 0)
            + (int) ($request->s1_d4 ?? 0)
            + (int) ($request->s2 ?? 0)
            + (int) ($request->s3 ?? 0);

        if ($totalStatus !== $totalIkm || $totalGender !== $totalIkm || $totalPendidikan !== $totalIkm) {
            return back()->withErrors([
                'konsistensi' => 'Jumlah tenaga kerja tidak konsisten. Pastikan semua total (status, gender, pendidikan) = total tenaga kerja.'
            ])->withInput();
        }


        $validatedPemakaianBahan = $request->validate([
            'nama_bahan' => 'required|array',
            'nama_bahan.*' => 'required|string|max:255',

            'jenis_bahan' => 'required|array',
            'jenis_bahan.*' => 'required|in:Bahan Baku,Bahan Penolong',

            'spesifikasi' => 'required|array',
            'spesifikasi.*' => 'required|string|max:255',

            'kode_hs' => 'required|array',
            'kode_hs.*' => 'required|string|max:255',

            'satuan_standar_bahan' => 'required|array',
            'satuan_standar_bahan.*' => 'required|string|in:kg,ton,liter,ml,m,m2,m3,pcs,drum,nm3',

            'jumlah_dalam_negeri' => 'required|array',
            'jumlah_dalam_negeri.*' => 'required|integer|min:0',

            'nilai_dalam_negeri' => 'required|array',
            'nilai_dalam_negeri.*' => 'required|numeric|min:0',

            'jumlah_impor' => 'required|array',
            'jumlah_impor.*' => 'required|integer|min:0',

            'nilai_impor' => 'required|array',
            'nilai_impor.*' => 'required|numeric|min:0',

            'negara_asal_impor' => 'required|array',
            'negara_asal_impor.*' => 'required|string|max:255',
        ]);

        $validatedPenggunaanAir = $request->validate([
            'sumber_air' => 'required|string|in:air_permukaan,air_tanah,perusahaan_penyedia_air,air_daur_ulang',
            'banyaknya_penggunaan_m3' => 'required|numeric|min:0.01',
            'biaya' => 'required|numeric|min:0',
        ]);

        $validatedPengeluaran = $request->validate([
            'upah_gaji' => 'required|numeric|min:0',
            'pengeluaran_industri_distribusi' => 'required|numeric|min:0',
            'pengeluaran_rnd' => 'required|numeric|min:0',
            'pengeluaran_tanah' => 'required|numeric|min:0',
            'pengeluaran_gedung' => 'required|numeric|min:0',
            'pengeluaran_mesin' => 'required|numeric|min:0',
            'lainnya' => 'required|numeric|min:0',
        ]);

        $validatedPenggunaanBahanBakar = $request->validate([
            'jenis_bahan_bakar' => 'required|array',
            'jenis_bahan_bakar.*' => 'required|string|in:bensin,solar_hsd_ado,batubara,briket_batubara,gas_dari_pgn,gas_bukan_dari_pgn,cng,lpg,pelumas',

            'satuan_standar' => 'required|array',
            'satuan_standar.*' => 'required|string|in:liter,ton,mmbtu,kg',

            'banyaknya_proses_produksi' => 'required|array',
            'banyaknya_proses_produksi.*' => 'required|numeric|min:0',

            'nilai_proses_produksi' => 'required|array',
            'nilai_proses_produksi.*' => 'required|numeric|min:0',

            'banyaknya_ptl' => 'required|array',
            'banyaknya_ptl.*' => 'required|numeric|min:0',

            'nilai_ptl' => 'required|array',
            'nilai_ptl.*' => 'required|numeric|min:0',
        ]);

        $validatedListrik = $request->validate([
            'sumber_listrik' => 'required|string|in:pln,non_pln,pembangkit_sendiri',
            'banyaknya_penggunaan_listrik' => 'required|numeric|min:0',
            'nilai_penggunaan_listrik' => 'required|numeric|min:0',
            'peruntukkan_listrik' => 'required|string|max:255',
        ]);

        $validatedMesinProduksi = $request->validate([
            'jenis_mesin' => 'required|array',
            'jenis_mesin.*' => 'required|string|in:Mesin,Peralatan',

            'nama_mesin' => 'required|array',
            'nama_mesin.*' => 'required|string|max:255',

            'merk_type' => 'required|array',
            'merk_type.*' => 'required|string|max:255',

            'teknologi' => 'required|array',
            'teknologi.*' => 'required|string|max:255',

            'negara_pembuat' => 'required|array',
            'negara_pembuat.*' => 'required|string|max:255',

            'tahun_perolehan' => 'required|array',
            'tahun_perolehan.*' => 'required|integer|min:1900|max:' . date('Y'),

            'tahun_pembuatan' => 'required|array',
            'tahun_pembuatan.*' => 'required|integer|min:1900|max:' . date('Y'),

            'jumlah_unit' => 'required|array',
            'jumlah_unit.*' => 'required|integer|min:1',
        ]);

        $validatedProduksi = $request->validate([
            'jenis_produksi' => 'required|string|max:255',
            'kbli' => 'required|string|max:255',
            'produksi_kode_hs' => 'required|string|max:255',
            'produksi_spesifikasi' => 'required|string|max:255',
            'jumlah_produksi' => 'required|numeric|min:0',
            'nilai_produksi' => 'required|numeric|min:0',
            'satuan' => 'required|string|in:kg,bungkus,biji,ton,buah,liter,galon,dos,balok,meter,set,lusin,potong,lembar,m3,tabung,unit',
            'persentase_ekspor' => 'required|numeric|min:0|max:100',
            'negara_ekspor' => 'nullable|string|max:255',
            'kapasitas_tahun' => 'required|integer|min:0',
        ]);

        $validatedPersediaan = $request->validate([
            'jenis_persediaan' => 'required|string|in:persediaan_bahan,setengah_jadi,barang_jadi',
            'awal' => 'required|numeric|min:0',
            'akhir' => 'required|numeric|min:0',
        ]);

        $validatedPendapatan = $request->validate([
            'sumber' => 'required|string|max:255',
            'nilai' => 'required|numeric|min:0',
        ]);

        $validatedModal = $request->validate([
            'jenis_barang' => 'required|array',
            'jenis_barang.*' => 'required|string|in:tanah,gedung,mesin dan perlengkapan,kendaraan,software/database',

            'pembelian_penambahan_perbaikan' => 'required|array',
            'pembelian_penambahan_perbaikan.*' => 'required|numeric|min:0',

            'pengurangan_barang_modal' => 'required|array',
            'pengurangan_barang_modal.*' => 'required|numeric|min:0',

            'penyusutan_barang' => 'required|array',
            'penyusutan_barang.*' => 'required|numeric|min:0',

            'nilai_taksiran' => 'required|array',
            'nilai_taksiran.*' => 'required|numeric|min:0',
        ]);

        $validatedBentukPengelolaan = $request->validate([
            'jenis_limbah' => 'required|string|max:255',
            'jumlah_limbah' => 'required|numeric|min:0',

            'jenis_limbah_b3' => 'required|string|max:255',
            'jumlah_limbah_b3' => 'required|numeric|min:0',
            'tps_limbah_b3' => 'nullable|string|max:255',

            'pihak_berizin' => 'nullable|string|max:255',
            'internal_industri' => 'nullable|string|max:255',

            'parameter_limbah_cair' => 'required|string|in:debit_inlet,debit_outlet,cod_inlet,cod_outlet,sludge_removed',
            'jumlah_limbah_cair' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        try {
            $idIkm = $this->saveDataIKM($validatedDataIKM);
            $this->savePersentasePemilik($idIkm, $validatedPersentasePemilik);
            $this->saveKaryawan($idIkm, $validatedKaryawan);
            $this->savePemakaianBahan($idIkm, $validatedPemakaianBahan);
            $this->savePenggunaanAir($idIkm, $validatedPenggunaanAir);
            $this->savePengeluaran($idIkm, $validatedPengeluaran);
            $this->savePenggunaanBahanBakar($idIkm, $validatedPenggunaanBahanBakar);
            $this->saveListrik($idIkm, $validatedListrik);
            $this->saveMesinProduksi($idIkm, $validatedMesinProduksi);
            $this->saveProduksi($idIkm, $validatedProduksi);
            $this->savePersediaan($idIkm, $validatedPersediaan);
            $this->savePendapatan($idIkm, $validatedPendapatan);
            $this->saveModal($idIkm, $validatedModal);
            $this->saveBentukPengelolaan($idIkm, $validatedBentukPengelolaan);



            DB::commit();

            return redirect()->route('dataIKM')->with('success', 'Data berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->withErrors([
                'msg' => 'Terjadi kesalahan: ' . $e->getMessage()
            ])->withInput();
        }
    }
    protected function saveDataIKM(array $data)
    {
        return DB::table('data_ikm')->insertGetId([
            'nama_ikm' => $data['nama_ikm'],
            'luas' => $data['luas'],
            'nama_pemilik' => $data['nama_pemilik'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'kecamatan' => $data['kecamatan'],
            'kelurahan' => $data['kelurahan'],
            'komoditi' => $data['komoditi'],
            'jenis_industri' => $data['jenis_industri'],
            'alamat' => $data['alamat'],
            'nib' => $data['nib'],
            'no_telp' => $data['no_telp'],
            'tenaga_kerja' => $data['tenaga_kerja'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    protected function savePersentasePemilik(int $idIkm, array $data)
    {
        return DB::table('persentase_pemilik')->insert([
            'id_ikm' => $idIkm,
            'pemerintah_pusat' => $data['pemerintah_pusat'],
            'pemerintah_daerah' => $data['pemerintah_daerah'],
            'swasta_nasional' => $data['swasta_nasional'],
            'asing' => $data['asing'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    protected function saveKaryawan(int $idIkm, array $data)
    {
        return DB::table('karyawan')->insert([
            'id_ikm' => $idIkm,

            'tenaga_kerja_tetap' => $data['tenaga_kerja_tetap'],
            'tenaga_kerja_tidak_tetap' => $data['tenaga_kerja_tidak_tetap'],
            'tenaga_kerja_laki_laki' => $data['tenaga_kerja_laki_laki'],
            'tenaga_kerja_perempuan' => $data['tenaga_kerja_perempuan'],

            'sd' => $data['sd'],
            'smp' => $data['smp'],
            'sma_smk' => $data['sma_smk'],
            'd1_d3' => $data['d1_d3'],
            's1_d4' => $data['s1_d4'],
            's2' => $data['s2'],
            's3' => $data['s3'],

            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    protected function savePemakaianBahan(int $idIkm, array $data)
    {
        $count = count($data['nama_bahan']);
        $records = [];

        for ($i = 0; $i < $count; $i++) {
            $records[] = [
                'id_ikm' => $idIkm,
                'nama_bahan' => $data['nama_bahan'][$i],
                'jenis_bahan' => $data['jenis_bahan'][$i],
                'spesifikasi' => $data['spesifikasi'][$i],
                'kode_hs' => $data['kode_hs'][$i],
                'satuan_standar' => $data['satuan_standar_bahan'][$i],
                'jumlah_dalam_negeri' => $data['jumlah_dalam_negeri'][$i],
                'nilai_dalam_negeri' => $data['nilai_dalam_negeri'][$i],
                'jumlah_impor' => $data['jumlah_impor'][$i],
                'nilai_impor' => $data['nilai_impor'][$i],
                'negara_asal_impor' => $data['negara_asal_impor'][$i],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        return DB::table('pemakaian_bahan')->insert($records);
    }

    protected function savePenggunaanAir(int $idIkm, array $data)
    {
        return DB::table('penggunaan_air')->insert([
            'id_ikm' => $idIkm,
            'sumber_air' => $data['sumber_air'],
            'banyaknya_penggunaan_m3' => $data['banyaknya_penggunaan_m3'],
            'biaya' => $data['biaya'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    protected function savePengeluaran(int $idIkm, array $data)
    {
        return DB::table('pengeluaran')->insert([
            'id_ikm' => $idIkm,
            'upah_gaji' => $data['upah_gaji'],
            'pengeluaran_industri_distribusi' => $data['pengeluaran_industri_distribusi'],
            'pengeluaran_rnd' => $data['pengeluaran_rnd'],
            'pengeluaran_tanah' => $data['pengeluaran_tanah'],
            'pengeluaran_gedung' => $data['pengeluaran_gedung'],
            'pengeluaran_mesin' => $data['pengeluaran_mesin'],
            'lainnya' => $data['lainnya'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    protected function savePenggunaanBahanBakar(int $idIkm, array $data)
    {
        $count = count($data['jenis_bahan_bakar']);
        $records = [];

        for ($i = 0; $i < $count; $i++) {
            $records[] = [
                'id_ikm' => $idIkm,
                'jenis_bahan_bakar' => $data['jenis_bahan_bakar'][$i],
                'satuan_standar' => $data['satuan_standar'][$i],
                'banyaknya_proses_produksi' => (float) $data['banyaknya_proses_produksi'][$i],
                'nilai_proses_produksi' => (int) $data['nilai_proses_produksi'][$i],
                'banyaknya_pembangkit_tenaga_listrik' => (float) $data['banyaknya_ptl'][$i],
                'nilai_pembangkit_tenaga_listrik' => (int) $data['nilai_ptl'][$i],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        return DB::table('penggunaan_bahan_bakar')->insert($records);
    }

    protected function saveListrik(int $idIkm, array $data)
    {
        return DB::table('listrik')->insert([
            'id_ikm' => $idIkm,
            'sumber' => $data['sumber_listrik'],
            'banyaknya' => (float) $data['banyaknya_penggunaan_listrik'],
            'nilai' => (int) $data['nilai_penggunaan_listrik'],
            'peruntukkan' => $data['peruntukkan_listrik'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    protected function saveMesinProduksi(int $idIkm, array $data)
    {
        $count = count($data['jenis_mesin']);
        $records = [];

        for ($i = 0; $i < $count; $i++) {
            $records[] = [
                'id_ikm' => $idIkm,
                'jenis_mesin' => $data['jenis_mesin'][$i],
                'nama_mesin' => $data['nama_mesin'][$i],
                'merk_type' => $data['merk_type'][$i],
                'teknologi' => $data['teknologi'][$i],
                'negara_pembuat' => $data['negara_pembuat'][$i],
                'tahun_perolehan' => $data['tahun_perolehan'][$i],
                'tahun_pembuatan' => $data['tahun_pembuatan'][$i],
                'jumlah_unit' => $data['jumlah_unit'][$i],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        return DB::table('mesin_produksi')->insert($records);
    }

    protected function saveProduksi(int $idIkm, array $data)
    {
        return DB::table('produksi')->insert([
            'id_ikm' => $idIkm,
            'jenis_produksi' => $data['jenis_produksi'],
            'kbli' => $data['kbli'],
            'kode_hs' => $data['produksi_kode_hs'],
            'spesifikasi' => $data['produksi_spesifikasi'],
            'banyaknya' => (int) $data['jumlah_produksi'],
            'nilai' => (int) $data['nilai_produksi'],
            'satuan' => $data['satuan'],
            'presentase_produk_ekspor' => (float) $data['persentase_ekspor'],
            'negara_tujuan_ekspor' => $data['negara_ekspor'] ?? null,
            'kapasitas_terpasang_per_tahun' => (int) $data['kapasitas_tahun'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    protected function savePersediaan(int $idIkm, array $data)
    {
        return DB::table('persediaan')->insert([
            'id_ikm' => $idIkm,
            'jenis_persediaan' => $data['jenis_persediaan'],
            'awal' => (int) $data['awal'],
            'akhir' => (int) $data['akhir'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    protected function savePendapatan(int $idIkm, array $data)
    {
        return DB::table('pendapatan')->insert([
            'id_ikm' => $idIkm,
            'nilai' => $data['nilai'],
            'sumber' => $data['sumber'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    protected function saveModal(int $idIkm, array $data)
    {
        $count = count($data['jenis_barang']);
        $records = [];

        for ($i = 0; $i < $count; $i++) {
            $records[] = [
                'id_ikm' => $idIkm,
                'jenis_barang' => $data['jenis_barang'][$i],
                'pembelian_penambahan_perbaikan' => (int) $data['pembelian_penambahan_perbaikan'][$i],
                'pengurangan_barang_modal' => (int) $data['pengurangan_barang_modal'][$i],
                'penyusutan_barang' => (int) $data['penyusutan_barang'][$i],
                'nilai_taksiran' => (int) $data['nilai_taksiran'][$i],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        return DB::table('modal')->insert($records);
    }

    protected function saveBentukPengelolaan(int $idIkm, array $data)
    {
        return DB::table('bentuk_pengelolaan_limbah')->insert([
            'id_ikm' => $idIkm,
            'jenis_limbah' => $data['jenis_limbah'],
            'jumlah_limbah' => (float) $data['jumlah_limbah'],
            'jenis_limbah_b3' => $data['jenis_limbah_b3'],
            'jumlah_limbah_b3' => (float) $data['jumlah_limbah_b3'],
            'tps_limbah_b3' => $data['tps_limbah_b3'] ?? null,
            'pihak_berizin' => $data['pihak_berizin'] ?? null,
            'internal_industri' => $data['internal_industri'] ?? null,
            'parameter_limbah_cair' => $data['parameter_limbah_cair'],
            'jumlah_limbah_cair' => (float) $data['jumlah_limbah_cair'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }


    public function showHalal()
    {
        $data = SertifikasiHalal::all();
        return view('admin.bidangIndustri.Halal', compact('data'));
    }

    public function kelolaSurat()
    {
        $rekapSurat = $this->getSuratIndustriData();
        $dataSurat = PermohonanSurat::with('user')
            ->whereIn('jenis_surat', ['surat_rekomendasi_industri', 'surat_keterangan_industri'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.bidangIndustri.kelolaSurat', [
            'dataSurat' => $dataSurat,
            'totalSuratIndustri' => $rekapSurat['totalSuratIndustri'],
            'totalSuratTerverifikasi' => $rekapSurat['totalSuratTerverifikasi'],
            'totalSuratDitolak' => $rekapSurat['totalSuratDitolak'],
            'totalSuratDraft' => $rekapSurat['totalSuratDraft'],
        ]);
    }

    //UNTUK USER INDUSTRI

    public function formPermohonan()
    {
        if (!auth()->guard('user')->check()) {
            return redirect()->route('login')->with('error', 'Harap login terlebih dahulu');
        }
        return view('user.bidangIndustri.formPermohonan');
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
                'surat rekomendasi' => 'surat_rekomendasi_industri',
                'rekomendasi' => 'surat_rekomendasi_industri',
                'rek' => 'surat_rekomendasi_industri',
                'surat keterangan' => 'surat_keterangan_industri',
                'keterangan' => 'surat_keterangan_industri',
                'ket' => 'surat_keterangan_industri',
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

        return view('user.bidangIndustri.riwayatSurat', compact('riwayatSurat'));
    }

    public function ajukanPermohonan(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'jenis_surat' => 'required|in:surat_rekomendasi_industri,surat_keterangan_industri,dan_lainnya_industri',
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

            return redirect()->route('bidangIndustri.riwayatSurat')
                ->with('success', 'Pengajuan surat berhasil diajukan.');
        } catch (Exception $e) {
            Log::error('Gagal mengajukan surat: ' . $e->getMessage());
            return redirect()->back()->withInput()->with('error', $e->getMessage()); // hanya untuk dev
        }
    }

    public function viewSuratBalasan($id)
    {
        $file = DB::table('form_permohonan')->where('id_permohonan', $id)->value('file_surat');

        if (!$file || !Storage::disk('public')->exists($file)) {
            return abort(404, 'Surat balasan tidak ditemukan.');
        }

        return response()->file(storage_path("app/public/{$file}"));
    }

    public function downloadSuratBalasan($id)
    {
        $file = DB::table('form_permohonan')->where('id_permohonan', $id)->value('file_surat');

        if (!$file || !Storage::disk('public')->exists($file)) {
            return abort(404, 'Surat balasan tidak ditemukan.');
        }

        return response()->download(storage_path("app/public/{$file}"));
    }
}
