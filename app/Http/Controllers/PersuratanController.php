<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// Berisikan seluruh fungsi tentang persuratan termasuk riwayat surat dll untuk semua bidang
class PersuratanController extends Controller
{
    public function showAdministrasiMetrologi()
    {
        return view('user.bidangMetrologi.administrasi');
    }
}
