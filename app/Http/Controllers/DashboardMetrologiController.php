<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\suratMetrologi;
use App\Models\Uttp;
use App\Models\DataAlatUkur;
use App\Models\suratBalasan;
use App\Models\Surat;


class DashboardMetrologiController extends Controller
{
    public function index()
    {
        $dataSurat = $this->getJumlahSurat();
        $chartData = $this->chartData();
        $chartBar = $this->chartBarJenisAlat();
        $donutChart = $this->getDonutChartData();
        $data = array_merge($dataSurat, $chartData, $chartBar, $donutChart);


        return view('admin.bidangMetrologi.dashboard', $data);
    }
    
    public function showKabid() {
        $dataSurat = $this->getJumlahSurat();
        $jumlahPerJenis = Uttp::select('jenis_alat', DB::raw('COUNT(*) as total'))->groupBy('jenis_alat')->get();
        $jumlahValid = DB::table('uttp')
            ->join('data_alat_ukur', 'uttp.id_uttp', '=', 'data_alat_ukur.id_uttp')
            ->where('data_alat_ukur.status', 'Valid')
            ->count();
        $uttps = DataAlatUkur::with('uttp')->get();
        $donutData = $this->getDonutChartData();
        return view('admin.kabid.metrologi.dashboard', array_merge(
            $dataSurat, 
            ['jumlahPerJenis' => $jumlahPerJenis],
            ['jumlahValid' => $jumlahValid],
            ['uttps' => $uttps],
            $donutData
        ));
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

    public function getDonutChartData()
    {
        $jenisList = ['BUS', 'AT', 'ATB'];
        $data = [];

        foreach ($jenisList as $jenis) {
            $jumlah = Uttp::where('alat_penguji', $jenis)->count();
            $data[$jenis] = $jumlah;
        }

        return [
            'donutLabels' => json_encode(array_keys($data)),
            'donutData' => json_encode(array_values($data))
        ];
    }


    public function getJumlahSurat()
    {
        $totalSuratMasuk = DB::table('surat_metrologi')->count();
        $totalSuratDiterima = DB::table('surat_metrologi')->where('status_surat_masuk', 'Disetujui')->count();
        if($totalSuratDiterima < 1)
        {
            $totalSuratDiterima == 0;
        }
        $totalSuratMenunggu = DB::table('surat_metrologi')->where('status_surat_masuk', 'Menunggu')->count();
        if($totalSuratMenunggu < 1)
        {
            $totalSuratMenunggu == 0;
        }
        $totalSuratMenungguKabid = DB::table('surat_keluar_metrologi')->where('status_kepalaBidang', 'Menunggu')->count();
        if($totalSuratMenungguKabid < 1)
        {
            $totalSuratMenungguKabid == 0;
        }

        $totalSuratDitolak = DB::table('surat_keluar_metrologi')->where('status_kepalaBidang', 'Ditolak')->count();
        if($totalSuratDitolak < 1)
        {
            $totalSuratDitolak == 0;
        }

        $suratTerbaru = suratMetrologi::with('user')->orderBy('created_at', 'desc')->take(6)->get();
        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;

        $suratTerkirim = suratBalasan::where('status_surat_keluar','Disetujui')->count();
        if($suratTerkirim < 1)
        {
            $suratTerkirim == 0;
        }

        $totalSuratMasukBulanIni = DB::table('surat_metrologi')
            ->whereMonth('created_at', $bulanIni)
            ->whereYear('created_at', $tahunIni)
            ->count();

        return [
            'totalSuratMasuk' => $totalSuratMasuk,
            'totalSuratMasukBulanIni' => $totalSuratMasukBulanIni,
            'totalSuratDiterima' => $totalSuratDiterima,
            'totalSuratDitolak' => $totalSuratDitolak,
            'totalSuratMenunggu' => $totalSuratMenunggu,
            'totalSuratMenungguKabid' => $totalSuratMenungguKabid,
            'suratTerbaru' => $suratTerbaru,
            'totalSuratTerkirim' => $suratTerkirim
        ];
    }

    public function showAlatukur()
    {
        return view('admin.bidangMetrologi.directory_alat_ukur_sah');
    }

    public function showAdministrasi()
    {
        $suratList = SuratMetrologi::with('user', 'suratBalasan')
            ->orderBy('created_at', 'desc')
            ->get();
        $dataJumlahSurat = $this->getJumlahSurat();

        return view('admin.bidangMetrologi.directory_surat', $dataJumlahSurat, compact('suratList'));
    }

    public function showAdministrasiKabid()
    {
        $suratList = SuratMetrologi::with('user', 'suratBalasan')
            ->orderBy('created_at', 'desc')
            ->get();
        $dataJumlahSurat = $this->getJumlahSurat();

        return view('admin.kabid.metrologi.directory_surat', $dataJumlahSurat, compact('suratList'));
    }

    public function showKadis()
    {
        $suratList = suratBalasan::with('suratMetrologi.user')
            ->where('status_kepalaBidang', 'Disetujui')
            ->orderBy('created_at', 'desc')
            ->get();

        $totalSurat = suratBalasan::count();
        $totalSuratDisetujui = suratBalasan::where('status_kadis', 'Disetujui')->count();
        $totalSuratDitolak = suratBalasan::where('status_kadis', 'Ditolak')->count();
        $totalSuratMenunggu = suratBalasan::where('status_kadis', 'Menunggu')->count();

        return view('admin.kepalaDinas.dashboard', compact(
            'suratList',
            'totalSurat',
            'totalSuratDisetujui',
            'totalSuratDitolak',
            'totalSuratMenunggu'
        ));
    }

    public function showPersuratanKadis()
    {
        $suratList = suratBalasan::with('suratMetrologi.user')
            ->where('status_kepalaBidang', 'Disetujui')
            ->orderBy('created_at', 'desc')
            ->get();

        // Get statistics for letters visible to kepala dinas
        $totalSurat = suratBalasan::where('status_kepalaBidang', 'Disetujui')->count();
        $totalSuratDisetujui = suratBalasan::where('status_kepalaBidang', 'Disetujui')
            ->where('status_kadis', 'Disetujui')
            ->count();
        $totalSuratDitolak = suratBalasan::where('status_kepalaBidang', 'Disetujui')
            ->where('status_kadis', 'Ditolak')
            ->count();
        $totalSuratMenunggu = suratBalasan::where('status_kepalaBidang', 'Disetujui')
            ->where('status_kadis', 'Menunggu')
            ->count();

        return view('admin.kepalaDinas.persuratan', compact(
            'suratList',
            'totalSurat',
            'totalSuratDisetujui',
            'totalSuratDitolak',
            'totalSuratMenunggu'
        ));
    }
}
