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
        $userId = session('id_user');

        // Cek apakah user sudah ada di tabel distributor
        $distributor = Distributor::where('id_user', $userId)->first();

        if (!$distributor) {
            // Jika belum mengisi form distributor
            return redirect()->route('pelaporan-penyaluran');
        }

        if ($distributor->status === 'menunggu') {
            // Jika status masih menunggu verifikasi
            return redirect()->route('cekpengajuan');
        }

        if ($distributor->status === 'diterima') {
            // Jika status sudah diterima, tampilkan halaman pelaporan
            return view('user.bidangPerdagangan.pelaporan');
        }

        // Jika status lainnya (opsional, misal: Ditolak), kamu bisa atur juga
        return redirect()->route('pelaporan-penyaluran')->with('error', 'Status pengajuan tidak valid.');
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
        try {
            // Validasi input
            $request->validate([
                'dokumen_nib' => 'required|file|mimes:pdf|max:51200',
            ]);

            // Ambil ID pengguna dari session
            $userId = session('id_user');

            if (!$userId) {
                return redirect()->back()->with('error', 'User tidak ditemukan dalam sesi.');
            }

            // Upload file
            $file = $request->file('dokumen_nib');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('nib_dokumen', $fileName, 'public');

            // Perbarui data jika id_user sudah ada, atau buat baru jika belum
            Distributor::updateOrCreate(
                ['id_user' => $userId], // Kondisi
                ['nib' => $path, 'status' => 'Menunggu'] // Data yang akan diupdate/ditambahkan
            );

            return redirect()->back()->with('success', 'Data berhasil disimpan!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function reviewPengajuanDistributor()
{
    $distributor = Distributor::with('user')->latest()->get(); // mengambil semua data termasuk user
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
    public function setujui($id_distributor)
    {
        $distributor = Distributor::findOrFail($id_distributor);
        $distributor->status = 'diterima';
        $distributor->save();

        return redirect()->back()->with('success', 'Distributor disetujui.');
    }

    public function tolak($id_distributor)
    {
        $distributor = Distributor::findOrFail($id_distributor);
        $distributor->status = 'ditolak';
        $distributor->save();

        return redirect()->back()->with('success', 'Distributor ditolak.');
    }

}