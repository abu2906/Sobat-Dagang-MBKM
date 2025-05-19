<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AdminIndustriController extends Controller
{
    public function showDashboard()
    {
        return view('admin.bidangIndustri.dashboardAdmin');
    }

    public function showDataIKM()
    {
        return view('admin.bidangIndustri.dataIKM');
    }
    
    public function showFormIKM()
    {   
        $json = file_get_contents(public_path('assets/data/wilayah.json'));
        $wilayah = json_decode($json, true);

        return view('admin.bidangIndustri.formIKM', compact('wilayah'));
    }


    public function showHalal()
    {
        return view('admin.bidangIndustri.halal');
    }
    
    public function showSurat()
    {
        return view('admin.bidangIndustri.suratBalasan');
    }
}
        
