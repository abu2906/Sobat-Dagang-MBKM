<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use App\Models\suratMetrologi;
use Illuminate\Support\Facades\Auth;


// Berisikan seluruh fungsi tentang persuratan termasuk riwayat surat dll untuk semua bidang
class PersuratanController extends Controller
{
    public function storeSuratMetrologi(Request $request)
    {
        $request->validate([
            'alamat_alat' => 'required|string',
            'dokumen' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'jenis_surat' => 'required|string',
        ]);

        $filename = 'dokumen_' . Auth::id() . '_' . time() . '.' . $request->file('dokumen')->getClientOriginalExtension();
        $filePath = $request->file('dokumen')->storeAs('dokumen_metrologi', $filename, 'public');

        suratMetrologi::create([
            'user_id' => Auth::id(),
            'alamat_alat' => $request->alamat_alat,
            'jenis_surat' => $request->jenis_surat,
            'dokumen' => $filePath,
            'dokumen_balasan' => '',
            'status' => 'Menunggu',
        ]);

        return redirect()->back()->with('success', 'Permohonan berhasil diajukan.');
    }

    public function showAdministrasiMetrologi()
    {
        if(Auth::check())
        {
            $permohonan = suratMetrologi::where('user_id', Auth::id())->latest()->get();

            return view('user.bidangMetrologi.administrasi', compact('permohonan'));
        } 
        else
        {
            return redirect()->route('login');
        }
        
    }

    public function showDokumenMetrologi($id)
    {
        $permohonan = suratMetrologi::findOrFail($id);

        if ($permohonan->user_id !== Auth::id()) {
            abort(403);
        }

        return Storage::disk('public')->download($permohonan->dokumen);
    }

    public function terimaSuratMetrologi($id)
    {
        $surat = suratMetrologi::with('user')->findOrFail($id);
        $surat->status = 'Disetujui';
        $surat->save();

        return redirect()->back()->with('success', 'Surat berhasil disetujui.');
    }
    
    // Tolak surat
    public function tolakSuratMetrologi($id)
    {
        $surat = suratMetrologi::with('user')->findOrFail($id);
        $surat->status = 'ditolak';
        $surat->save();

        return redirect()->back()->with('success', 'Surat berhasil ditolak.');
    }

    // Buat Surat (form atau redirect ke editor)
    public function buatSuratMetrologi($id)
    {
        $surat = suratMetrologi::findOrFail($id);
        return view('admin.bidangMetrologi.buat_surat_balasan', compact('surat'));
    }

    // Kirim Keterangan (form keterangan untuk surat yang ditolak)
    public function kirimKeteranganMetrologi($id)
    {
        $surat = suratMetrologi::findOrFail($id);
        return view('admin.surat.keterangan', compact('surat'));
    }

    public function showFormSurat()
    {
        return view('user.bidangIndustri.form-surat');
    }
}
