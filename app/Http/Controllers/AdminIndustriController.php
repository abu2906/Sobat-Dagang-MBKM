<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\DataIkm;

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

        public function storeDataIKM(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_pemilik' => 'required|string|max:255',
            'nama_ikm' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:20',
            'luas' => 'required|string|max:50',
            'jenis_industri' => 'required|string|max:100',
            'komoditi' => 'required|string|max:100',
            'jumlah_tenaga_kerja' => 'required|integer|min:0',
            'nilai_investasi' => 'required|numeric|min:0',
            'nib' => 'required|string|max:100',
            'id_disdag' => 'required|integer|exists:disdag,id_disdag', // contoh FK validasi
        ]);

        // Simpan data
        $dataIkm = DataIkm::create($validatedData);

        // Redirect kembali ke daftar data IKM dengan pesan sukses
        return redirect()->route('admin.industri.dataIKM')->with('success', 'Data IKM berhasil disimpan.');
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
        
