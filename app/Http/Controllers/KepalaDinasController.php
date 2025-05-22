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

class KepalaDinasController extends Controller
{
    public function index()
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
            'totalSuratMenunggu',
        ));
    }

    public function administrasi(){
        return view('admin.kepalaDinas.persuratan');
    }
}
