<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class PerizinanController extends Controller
{
    public function index()
    {
        return view('form_permohonan'); // Pastikan file blade kamu sesuai ya
    }
}
