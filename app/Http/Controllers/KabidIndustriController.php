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
use App\Models\DataIkm;
use App\Models\SertifikasiHalal;

class KabidIndustriController extends Controller
{

    public function index(Request $request)
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


        // Label untuk grafik (format tanggal user-friendly)
        $labels = array_map(function ($tgl) {
        return Carbon::parse($tgl)->translatedFormat('d M');
        }, $allTanggal);

        // Kirim semua data ke view
        return view('admin.bidangIndustri.dashboardAdmin', [
            'dataSurat' => $dataSurat,
            'daftarHarga' => $daftarHarga,
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

    
    
    public function dashboardKabid(Request $request)
    {
        $tahun = $request->input('tahun', date('Y'));
       
        $rekapSurat = $this->getSuratIndustriData();
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

        if ($request->ajax()) {
            return response()->json([
                'statusCounts' => $statusCounts,
                'dataBulanan' => $dataBulanan
            ]);
        }

        return view('admin.kabid.industri.industri', [
            'totalSuratIndustri' => $rekapSurat['totalSuratIndustri'],
            'totalSuratTerverifikasi' => $rekapSurat['totalSuratTerverifikasi'],
            'totalSuratDitolak' => $rekapSurat['totalSuratDitolak'],
            'totalSuratDraft' => $rekapSurat['totalSuratDraft'],
            'suratMasuk' => $suratMasuk,
            'statusCounts' => $statusCounts,
            'dataBulanan' => $dataBulanan
        ]);
    }

    public function dashboard (){
        return view ('admin.kabid.industri.industri');
    }

    public function verifSurat ()
    {

        $rekapSurat = $this->getSuratIndustriData();
        $suratMasuk = PermohonanSurat::whereIn('status', ['menunggu', 'diterima', 'ditolak'])
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('admin.kabid.industri.verifSurat', [
            'totalSuratIndustri' => $rekapSurat['totalSuratIndustri'],
            'totalSuratTerverifikasi' => $rekapSurat['totalSuratTerverifikasi'],
            'totalSuratDitolak' => $rekapSurat['totalSuratDitolak'],
            'totalSuratDraft' => $rekapSurat['totalSuratDraft'],
            'suratMasuk' => $suratMasuk,
        ]);
    }

    public function setujuiI($id)
    {
        $permohonan = PermohonanSurat::findOrFail($id);

        // Ubah status menjadi 'diterima'
        $permohonan->status = 'diterima';
        $permohonan->save();

        return redirect()->back()->with('success', 'Surat berhasil disetujui dan status diperbarui.');
    }

    public function DataIKM()
    {
        $dataIkm = DataIkm::all();
        return view('admin.kabid.industri.dataIKM', compact('dataIkm'));
    }

    public function sertifikatHalal()
    {
        $data = SertifikasiHalal::orderBy('tanggal_sah', 'desc')->get()->map(function ($item) {
            return [
                'id_halal' => $item->id_halal,
                'nama_usaha' => $item->nama_usaha,
                'no_sertifikasi_halal' => $item->no_sertifikasi_halal,
                'tanggal_sah' => $item->tanggal_sah
                    ? Carbon::parse($item->tanggal_sah)->format('Y-m-d')
                    : null,
                'tanggal_exp' => $item->tanggal_exp
                    ? Carbon::parse($item->tanggal_exp)->format('Y-m-d')
                    : null,

                'tanggal_sah_formatted' => $item->tanggal_sah
                    ? Carbon::parse($item->tanggal_sah)->translatedFormat('d F Y')
                    : '-',
                'tanggal_exp_formatted' => $item->tanggal_exp
                    ? Carbon::parse($item->tanggal_exp)->translatedFormat('d F Y')
                    : '-',

                'alamat' => $item->alamat,
                'status' => $item->status,
                'sertifikat' => $item->sertifikat,
            ];
        });

        return view('admin.kabid.industri.sertifikathalal', compact('data'));
    }

}
