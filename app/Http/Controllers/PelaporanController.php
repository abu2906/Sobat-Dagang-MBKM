<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Distributor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Exception;

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

        if ($distributor->status === 'ditolak') {
            // Jika status masih menunggu verifikasi
            return redirect()->route('cekpengajuan');
        }

        // Jika status lainnya (opsional, misal: Ditolak), kamu bisa atur juga
        return redirect()->route('pelaporan-penyaluran')->with('error', 'Status pengajuan tidak valid.');
    }

    public function verifikasiPengajuan()
    {
        // Ambil id_user dari session
        $id_user = Session::get('id_user');

        // Ambil data status dari tabel distributor
        $distributor = DB::table('distributor')
                        ->where('id_user', $id_user)
                        ->orderByDesc('created_at') // kalau ada lebih dari 1 data
                        ->first();

        // Jika tidak ditemukan
        if (!$distributor) {
            return redirect()->back()->with('error', 'Data distributor tidak ditemukan.');
        }

        // Kirim status ke blade
        $status = strtolower($distributor->status); // jadi 'menunggu', 'diterima', atau 'ditolak'
        return view('user.bidangPerdagangan.verifikasiPengajuan', compact('status'));
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
    public function hapus($id_distributor)
    {
        DB::table('distributor')->where('id_distributor', $id_distributor)->delete();

        return redirect()->back()->with('success', 'Distributor berhasil dihapus.');
    }

    public function inputDataToko(Request $request)
{
    // Validasi input jika diperlukan
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'no_register' => 'required|string|max:100',
            'rencana_kebutuhan' => 'required|string|max:255',
        ]);

        // Simpan atau proses data
        // Contoh: simpan ke database jika sudah ada modelnya
        // Toko::create($request->all());

        // Redirect atau tampilkan pesan
        return back()->with('success', 'Data toko berhasil ditambahkan.');
}
    public function showForm()    {
        return view('user.bidangPerdagangan.inputDataToko');
    }

        public function inputDataDistribusi(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_barang'    => 'required|string',
            'stok'           => 'required|numeric|min:0',
            'penyaluran'     => 'required|numeric|min:0',
            'tanggal_input'  => 'required|date',
        ]);

        // Simpan ke database
        // DistribusiPupuk::create([
        //     'nama_barang'   => $validated['nama_barang'],
        //     'stok'          => $validated['stok'],
        //     'penyaluran'    => $validated['penyaluran'],
        //     'tanggal_input' => $validated['tanggal_input'],
        // ]);

        return redirect()->back()->with('success', 'Data distribusi berhasil ditambahkan.');
    }
    public function showDataDistribusi()    {
        // Ambil semua data distribusi
        // $data = DistribusiPupuk::orderBy('tanggal_input', 'desc')->get();

        // Kirim ke view
        // return view('user.bidangPerdagangan.inputDataDistribusi', compact('data'));
        return view('user.bidangPerdagangan.inputDataDistribusi');
    }


}