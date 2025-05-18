<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use App\Models\suratMetrologi;
use App\Models\suratBalasan;
use Illuminate\Support\Facades\Auth;


// Berisikan seluruh fungsi tentang persuratan termasuk riwayat surat dll untuk semua bidang
class PersuratanController extends Controller
{
    public function showAdministrasiMetrologi()
    {
        if (Auth::guard('user')->check()) {
            $permohonan = suratMetrologi::where('user_id', Auth::guard('user')->id())->latest()->get();

            return view('user.bidangMetrologi.administrasi', compact('permohonan'));
        }

        return redirect()->route('login');
    }

    public function storeSuratMetrologi(Request $request)
    {
        $request->validate([
            'alamat_alat' => 'required|string',
            'nomor_surat' => 'required|string',
            'dokumen' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'jenis_surat' => 'required|string',
        ]);

        $sanitizedNomorSurat = str_replace(['/', '\\', ' '], '_', $request->nomor_surat);
        $filename = $sanitizedNomorSurat . '_' . Auth::guard('user')->id(). '.' . $request->file('dokumen')->getClientOriginalExtension();
        $filePath = $request->file('dokumen')->storeAs('surat_masuk_metrologi', $filename, 'public');

        suratMetrologi::create([
            'id_surat' => $request->nomor_surat,
            'user_id' => Auth::guard('user')->id(),
            'alamat_alat' => $request->alamat_alat,
            'jenis_surat' => $request->jenis_surat,
            'dokumen' => $filePath,
            'status_surat_masuk' => 'Menunggu',
            'status_admin' => 'Menunggu',
        ]);

        return redirect()->back()->with('success', 'Permohonan berhasil diajukan.');
    }

    public function showDokumenMetrologi($id)
    {
        $permohonan = suratMetrologi::findOrFail($id);

        if ($permohonan->user_id !== Auth::guard('user')->id()) {
            abort(403);
        }

        return Storage::disk('public')->download($permohonan->dokumen);
    }

    public function showcreateSuratBalasan($id)
    {
        return view('admin.bidangMetrologi.buat_surat', compact('id'));
    }

    public function createSuratBalasan(Request $request, $id)
    {
        set_time_limit(300); // Tambah waktu jadi 2 menit
        $id_surat_masuk = str_replace('_', '/', $id);

        // Validasi input
        $validated = $request->validate([
            'id_surat_balasan' => 'required|string',
            'sifat_surat' => 'required|string',
            'lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'perihal' => 'required|string',
            'tanggal_pembuatan_surat' => 'required|date',
            'tanggal_surat' => 'required|date',
            'nama_yang_dituju' => 'required|string',
            'isi' => 'required|string',
        ]);

        // Simpan lampiran jika ada
        $lampiranPath = '-';
        if ($request->hasFile('lampiran')) {
            $lampiranPath = $request->file('lampiran')->store('lampiran_surat', 'public');
        }

        // Generate PDF dari view blade
        $pdf = Pdf::loadView('SuratBalasan.surat-metrologi', [
            'nomor_surat' => $validated['id_surat_balasan'],
            'sifat_surat' => $validated['sifat_surat'],
            'lampiran' => $lampiranPath,
            'hal' => $validated['perihal'],
            'tanggal_pembuatan_surat' => $validated['tanggal_pembuatan_surat'],
            'tanggal_surat' => $validated['tanggal_surat'],
            'nama_yang_dituju' => $validated['nama_yang_dituju'],
            'isi' => $validated['isi'],
        ])->setPaper('a4', 'portrait')->setOptions([
            'isHtml5ParserEnabled' => true,
            'isPhpEnabled' => false,
            'isRemoteEnabled' => true,
            'defaultFont' => 'sans-serif', // font lebih ringan
        ]);

        // Simpan PDF ke storage
        $namaFile = str_replace('/', '_', $validated['id_surat_balasan']) . '_' . now()->format('Ymd_His') . '.pdf';
        Storage::disk('public')->put('surat_balasan/' . $namaFile, $pdf->output());

        // Simpan data ke database
        $surat = new SuratBalasan();
        $surat->id_surat_balasan = $validated['id_surat_balasan'];
        $surat->id_surat = $id_surat_masuk;
        $surat->sifat = $validated['sifat_surat'];
        $surat->perihal = $validated['perihal'];
        $surat->lampiran = $lampiranPath;
        $surat->tanggal = $validated['tanggal_pembuatan_surat'];
        $surat->path_dokumen = 'surat_balasan/' . $namaFile;
        $surat->status_surat_keluar = 'Menunggu';
        $surat->status_kepalaBidang = 'Menunggu';
        $surat->save();

        return redirect()->back()->with('success', 'Surat balasan berhasil dibuat dan disimpan sebagai PDF.');

    }

    public function terimaSurat($id)
    {
        $id_srt= str_replace(['_'], '/', $id);
        $surat = suratMetrologi::where('id_surat', $id_srt)->firstOrFail();
        $surat->status_admin = 'Disetujui';
        $surat->save();

        return redirect()->back()->with('success', 'Surat berhasil diterima.');
    }

    public function tolakSurat($id)
    {
        $id_srt= str_replace(['_'], '/', $id);
        $surat = suratMetrologi::where('id_surat', $id_srt)->firstOrFail();
        $surat->status_admin = 'Ditolak';
        $surat->save();

        return redirect()->back()->with('success', 'Surat berhasil ditolak.');
    }

    public function terimaKabid($id, Request $request)
    {
        $surat = SuratBalasan::findOrFail($id);
        $surat->status_kepalaBidang = 'Disetujui'; // atau 'Diterima'
        $surat->save();

        return back()->with('success', 'Surat berhasil disetujui.');
    }

    public function tolakKabid($id, Request $request)
    {
        $surat = SuratBalasan::findOrFail($id);
        $surat->status_kepalaBidang = 'Ditolak';
        $surat->save();

        return back()->with('success', 'Surat berhasil ditolak.');
    }

}
