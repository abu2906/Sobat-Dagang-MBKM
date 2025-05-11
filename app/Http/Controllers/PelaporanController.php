<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Distributor;
// Berisikan seluruh fungsi yang digunakan dalam hal pelaporan baik admin maupun distributor
class PelaporanController extends Controller
{
    public function pelaporanPenyaluran()
    {
        return view('user.bidangPerdagangan.pelaporan_penyaluran');
    }

    public function index()
    {
        return view('user.bidangPerdagangan.pelaporan');
    }

    public function verifikasiPengajuan()
    {
        return view('user.bidangPerdagangan.verifikasiPengajuan');
    }
    public function formDistributor()
    {
        return view('user.bidangPerdagangan.daftarDistributor');
    }

    public function submitDistributor(Request $request)
    {
        $request->validate([
            'dokumen_nib' => 'required|file|mimes:pdf|max:51200',
        ]);

        // $userId = auth()->id(); 
        $userId = null; // Ambil ID pengguna yang sedang login
        $file = $request->file('dokumen_nib');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('nib_dokumen', $fileName, 'public');

        // Masukkan data ke tabel distributor
        Distributor::create([
            'id_user' => $userId,
            'nib' => $path,
            'status' => 'Menunggu',
        ]);

        return redirect()->back()->with('success', 'Permohonan berhasil diajukan dan sedang menunggu verifikasi.');
    }
    public function reviewPengajuanDistributor()
    {
        $distributor = Distributor::with('user')->latest()->get(); // pastikan relasi 'user' ada

        return view('admin.adminSuper.reviewPengajuanDistributor', compact('distributor'));
    }

    public function indexDistributor()
    {
        $distributor = Distributor::with('user')->latest()->get();
        return view('admin.distributor.index', compact('distributor'));
    }

    public function verifikasiDistributor(Request $request, $id)
    {
    $request->validate([
        'status' => 'required|in:Disetujui,Ditolak',
    ]);

    $distributor = Distributor::findOrFail($id);
    $distributor->status = $request->status;
    $distributor->save();

    return back()->with('success', 'Status berhasil diperbarui.');
    }

    public function lihatLaporan()
    {
        return view('admin.adminSuper.lihatLaporan');
    }

    public function tambahBarangDistribusi()
    {
        return view('admin.adminSuper.tambahBarangDistribusi');
    }
}
