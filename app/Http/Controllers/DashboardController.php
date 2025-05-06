<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('user.dashboard');
    }

    public function profile()
    {
        return view('component.profile');
    }

    public function showMetrologi() 
    {
        return view('admin.bidangMetrologi.dashboard');
    }
}
