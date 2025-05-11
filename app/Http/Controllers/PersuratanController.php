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
            'titik_koordinat' => 'required|string',
            'dokumen' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $filePath = $request->file('dokumen')->store('dokumen_metrologi', 'public');

        suratMetrologi::create([
            'user_id' => Auth::id(),
            'titik_koordinat' => $request->titik_koordinat,
            'dokumen' => $filePath,
            'status' => 'Menunggu',
        ]);

        return redirect()->back()->with('success', 'Permohonan berhasil diajukan.');
    }

    public function showAdministrasiMetrologi()
    {
        $permohonan = suratMetrologi::where('user_id', Auth::id())->latest()->get();

        return view('user.bidangMetrologi.administrasi', compact('permohonan'));
    }

    public function showDokumenMetrologi($id)
    {
        $permohonan = suratMetrologi::findOrFail($id);

        if ($permohonan->user_id !== Auth::id()) {
            abort(403);
        }

        return Storage::disk('public')->download($permohonan->dokumen);
    }
}
