<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController
{
    public function showAboutPage()
    {
        return view('pages.aboutUs');
    }
}
