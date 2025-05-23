<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataIkmController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('data_ikm');

        if ($request->has('search')) {
            $query->where('nama_ikm', 'like', '%' . $request->search . '%');
        }

        $data = $query->orderBy('created_at', 'desc')->get();

        return view('admin.bidangIndustri.dataIKM', compact('data'));
    }
}
