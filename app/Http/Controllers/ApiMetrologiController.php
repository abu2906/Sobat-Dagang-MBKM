<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Uttp;

class ApiMetrologiController extends ApiController
{
    public function index(Request $request)
    {
        // Panggil fungsi validasi
        $this->validateAppKey($request);

        $data = Uttp::with(['dataAlatUkur', 'user'])->get();
        return response()->json([
            'status' => true,
            'message' => 'Data UTTP berhasil diambil',
            'data' => $data
        ]);
    }

    public function show($id, Request $request)
    {
        // Panggil fungsi validasi
        $this->validateAppKey($request);

        $data = Uttp::with(['dataAlatUkur', 'user'])->find($id);
        if (!$data) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }
        return response()->json([
            'status' => true,
            'message' => 'Detail UTTP',
            'data' => $data
        ]);
    }
}
