<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\suratMetrologi;
use App\Models\Uttp;


class DashboardMetrologiController extends Controller
{
    public function index()
    {
        $dataSurat = $this->getJumlahSurat();
        $chartData = $this->chartData();
        $chartBar = $this->chartBarJenisAlat();
        $data = array_merge($dataSurat, $chartData, $chartBar);

        return view('admin.bidangMetrologi.dashboard', $data);
    }

    public function chartBarJenisAlat()
    {
        $tahunSekarang = Carbon::now()->year;
        $tahunLalu = $tahunSekarang - 1;
        $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        // Fungsi bantu untuk ambil data per tahun dan prefix jenis_alat
        $ambilData = function ($tahun, $prefix) {
            $bulanan = Uttp::selectRaw('MONTH(tanggal_selesai) as bulan, COUNT(*) as total')
                ->whereYear('tanggal_selesai', $tahun)
                ->where('jenis_alat', 'like', $prefix . '%')
                ->groupBy('bulan')
                ->pluck('total', 'bulan')
                ->toArray();

            $result = [];
            for ($i = 1; $i <= 12; $i++) {
                $result[] = $bulanan[$i] ?? 0;
            }

            return $result;
        };

        // Ambil data untuk satu jenis alat (misalnya UP)
        $dataTahunLaluUP = $ambilData($tahunLalu, 'UP-');
        $dataTahunIniUP = $ambilData($tahunSekarang, 'UP-');
        $dataTahunLaluVOL = $ambilData($tahunLalu, 'VOL-');
        $dataTahunIniVOL = $ambilData($tahunSekarang, 'VOL-');
        $dataTahunLaluMAS = $ambilData($tahunLalu, 'MAS-');
        $dataTahunIniMAS = $ambilData($tahunSekarang, 'MAS-');

        return  [
            'labels' => json_encode($labels),
            'dataTahunLaluUP' => json_encode($dataTahunLaluUP),
            'dataTahunIniUP' => json_encode($dataTahunIniUP),
            'dataTahunLaluVOL' => json_encode($dataTahunLaluVOL),
            'dataTahunIniVOL' => json_encode($dataTahunIniVOL),
            'dataTahunLaluMAS' => json_encode($dataTahunLaluMAS),
            'dataTahunIniMAS' => json_encode($dataTahunIniMAS),
            'tahunLalu' => $tahunLalu,
            'tahunSekarang' => $tahunSekarang,
        ];
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
