<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showMetrologi()
    {
        return view('admin.bidangMetrologi.dashboard');
    }
}
