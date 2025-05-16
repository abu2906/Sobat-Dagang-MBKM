<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\suratMetrologi;


class DashboardMetrologiController extends Controller
{
    public function index()
    {
        $dataSurat = $this->getJumlahSurat();
        $chartData = $this->chartData();

        return view('admin.bidangMetrologi.dashboard', $dataSurat, $chartData);
    }

    public function chartData()
    {
        // Ambil data bulanan untuk jenis 'tera'
        $tera = suratMetrologi::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->where('jenis_surat', 'tera')
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        // Ambil data bulanan untuk jenis 'tera_ulang'
        $teraUlang = suratMetrologi::selectRaw('MONTH(created_at) as bulan, COUNT(*) as total')
            ->where('jenis_surat', 'tera_ulang')
            ->groupBy('bulan')
            ->pluck('total', 'bulan');

        // Konversi ke array dengan default 0 untuk tiap bulan (1–12)
        $dataTera = [];
        $dataTeraUlang = [];

        for ($i = 1; $i <= 12; $i++) {
            $dataTera[] = $tera[$i] ?? 0;
            $dataTeraUlang[] = $teraUlang[$i] ?? 0;
        }

        return [
            'dataTera' => json_encode($dataTera),
            'dataTeraUlang' => json_encode($dataTeraUlang),
        ];
    }

    private function getJumlahSurat()
    {
        $totalSuratMasuk = DB::table('surat_metrologi')->count();
        $totalSuratDiterima = DB::table('surat_metrologi')->where('status', 'Disetujui')->count();
        if($totalSuratDiterima < 1)
        {
            $totalSuratDiterima == 0;
        }
        $totalSuratMenunggu = DB::table('surat_metrologi')->where('status', 'Menunggu')->count();
        if($totalSuratMenunggu < 1)
        {
            $totalSuratMenunggu == 0;
        }
        $totalSuratDitolak = DB::table('surat_metrologi')->where('status', 'Ditolak')->count();
        if($totalSuratDitolak < 1)
        {
            $totalSuratDitolak == 0;
        }

        $suratTerbaru = suratMetrologi::with('user')->orderBy('created_at', 'desc')->take(6)->get();

        return [
            'totalSuratMasuk' => $totalSuratMasuk,
            'totalSuratDiterima' => $totalSuratDiterima,
            'totalSuratDitolak' => $totalSuratDitolak,
            'totalSuratMenunggu' => $totalSuratMenunggu,
            'suratTerbaru' => $suratTerbaru
        ];
    }

    public function showAlatukur()
    {
        return view('admin.bidangMetrologi.directory_alat_ukur_sah');
    }

    public function showAdministrasi()
    {
        $suratList = SuratMetrologi::with('user')->get();
        $dataJumlahSurat = $this->getJumlahSurat();

        return view('admin.bidangMetrologi.directory_surat', $dataJumlahSurat, compact('suratList'));
    }
    
}
