<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KadisController extends Controller
{
    private function dataSuratPerdagangan()    {
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
    private function dataSuratIndustri()    {
        //ini mu isi
    }
    private function dataSuratMetrologi()    {
      //ini mu isi
    }
    private function dataSuratTotal() { 
        $perdagangan = $this->dataSuratPerdagangan();
        $industri = $this->dataSuratIndustri();
        $metrologi = $this->dataSuratMetrologi();

        return [
            'totalSuratPerdagangan' => $perdagangan['totalSuratPerdagangan'],
            'totalSuratTerverifikasiPerdagangan' => $perdagangan['totalSuratTerverifikasi'],
            'totalSuratDitolakPerdagangan' => $perdagangan['totalSuratDitolak'],
            'totalSuratDraftPerdagangan' => $perdagangan['totalSuratDraft'],

            'totalSuratIndustri' => $industri['totalSuratIndustri'],
            'totalSuratTerverifikasiIndustri' => $industri['totalSuratTerverifikasi'],
            'totalSuratDitolakIndustri' => $industri['totalSuratDitolak'],
            'totalSuratDraftIndustri' => $industri['totalSuratDraft'],

            'totalSuratMetrologi' => $metrologi['totalSuratMetrologi'],
            'totalSuratTerverifikasiMetrologi' => $metrologi['totalSuratTerverifikasi'],
            'totalSuratDitolakMetrologi' => $metrologi['totalSuratDitolak'],
            'totalSuratDraftMetrologi' => $metrologi['totalSuratDraft'],

            // Total keseluruhan ketiga bidang
            'totalSuratKeseluruhan' => 
                $perdagangan['totalSuratPerdagangan'] +
                $industri['totalSuratIndustri'] +
                $metrologi['totalSuratMetrologi'],

            'totalSuratTerverifikasiKeseluruhan' => 
                $perdagangan['totalSuratTerverifikasi'] +
                $industri['totalSuratTerverifikasi'] +
                $metrologi['totalSuratTerverifikasi'],

            'totalSuratDitolakKeseluruhan' => 
                $perdagangan['totalSuratDitolak'] +
                $industri['totalSuratDitolak'] +
                $metrologi['totalSuratDitolak'],

            'totalSuratDraftKeseluruhan' => 
                $perdagangan['totalSuratDraft'] +
                $industri['totalSuratDraft'] +
                $metrologi['totalSuratDraft'],
        ];
    }
    public function index()
    {
        $totalSuratSmuaBidang = $this->dataSuratTotal();

        // Kirim data ke view
        return view('admin.kepalaDinas.dashboard', compact('totalSuratSmuaBidang'));
    }
}
