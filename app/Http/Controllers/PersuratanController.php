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

        $filename = 'dokumen_' . Auth::guard('user')->id() . '_' . time() . '.' . $request->file('dokumen')->getClientOriginalExtension();
        $filePath = $request->file('dokumen')->storeAs('dokumen_metrologi', $filename, 'public');

        suratMetrologi::create([
            'user_id' => Auth::guard('user')->id(),
            'alamat_alat' => $request->alamat_alat,
            'jenis_surat' => $request->jenis_surat,
            'dokumen' => $filePath,
            'dokumen_balasan' => '',
            'status' => 'Menunggu',
            'statusAdmin' => 'Menunggu',
            'statusKabid' => 'Menunggu',
        ]);

        return redirect()->back()->with('success', 'Permohonan berhasil diajukan.');
    }

    public function showAdministrasiMetrologi()
    {
        if (Auth::guard('user')->check()) {
            $permohonan = suratMetrologi::where('user_id', Auth::guard('user')->id())->latest()->get();

            return view('user.bidangMetrologi.administrasi', compact('permohonan'));
        }

        return redirect()->route('login');
    }

    public function showDokumenMetrologi($id)
    {
        $permohonan = suratMetrologi::findOrFail($id);

        if ($permohonan->user_id !== Auth::guard('user')->id()) {
            abort(403);
        }

        return Storage::disk('public')->download($permohonan->dokumen);
    }

    public function terimaSuratMetrologi($id,$role)
    {
        $surat = suratMetrologi::with('user')->findOrFail($id);
        if($role = 'admin')
        {
            $surat->status_Admin = 'Disetujui';
        }
        else {
            $surat->status_kabid = 'Disetujui';
        }
        $surat->save();

        return redirect()->back()->with('success', 'Surat berhasil disetujui.');
    }
    public function tolakSuratMetrologi($id, $role)
    {
        $surat = suratMetrologi::with('user')->findOrFail($id);
        if($role = 'admin')
        {
            $surat->status_Admin = 'Ditolak';
        }
        else {
            $surat->status_kabid = 'Ditolak';
        }
        
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
}
