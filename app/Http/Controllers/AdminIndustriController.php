<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AdminIndustriController extends Controller
{

        public function dashboard()
        {
        
                return view('admin.bidangIndustri.dashboardAdmin');
            }
        
        }
        
