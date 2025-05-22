<?php

namespace App\Http\Controllers;

use App\Models\SertifikasiHalal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class HalalController extends Controller
{
        
    public function index()
    {
        $data = SertifikasiHalal::orderBy('tanggal_sah', 'desc')->get()->map(function ($item) {
            return [
                'id_halal' => $item->id_halal,
                'nama_usaha' => $item->nama_usaha,
                'no_sertifikasi_halal' => $item->no_sertifikasi_halal,
                'tanggal_sah' => $item->tanggal_sah
                    ? Carbon::parse($item->tanggal_sah)->format('Y-m-d')
                    : null,
                'tanggal_exp' => $item->tanggal_exp
                    ? Carbon::parse($item->tanggal_exp)->format('Y-m-d')
                    : null,

                'tanggal_sah_formatted' => $item->tanggal_sah
                    ? Carbon::parse($item->tanggal_sah)->translatedFormat('d F Y')
                    : '-',
                'tanggal_exp_formatted' => $item->tanggal_exp
                    ? Carbon::parse($item->tanggal_exp)->translatedFormat('d F Y')
                    : '-',

                'alamat' => $item->alamat,
                'status' => $item->status,
                'sertifikat' => $item->sertifikat,
            ];
        });

        return view('admin.bidangIndustri.halal', compact('data'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_usaha'            => 'required|string|max:255',
            'no_sertifikasi_halal'  => 'nullable|string|max:255',
            'tanggal_sah'           => 'required|date',
            'tanggal_exp'           => 'required|date|after_or_equal:tanggal_sah',
            'alamat'                => 'required|string',
            'status'                => 'required|string|in:Berlaku,Perlu Pembaruan',
            'sertifikat'            => 'required|file|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('sertifikat')) {
            $file = $request->file('sertifikat');
            $fileName = time() . '' . preg_replace('/\s+/', '', $file->getClientOriginalName());
            $filePath = $file->storeAs('sertifikat_halal', $fileName, 'public');
            $validated['sertifikat'] = $filePath;
        }

        SertifikasiHalal::create($validated);

        return redirect()->route('sertifikat.halal')
            ->with('success', 'Data sertifikasi halal berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $item = SertifikasiHalal::findOrFail($id);
        return view('admin.bidangIndustri.halal_edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = SertifikasiHalal::findOrFail($id);

        $validated = $request->validate([
            'nama_usaha'            => 'required|string|max:255',
            'no_sertifikasi_halal'  => 'nullable|string|max:255',
            'tanggal_sah'           => 'required|date',
            'tanggal_exp'           => 'required|date|after_or_equal:tanggal_sah',
            'alamat'                => 'required|string',
            'status'                => 'required|string|in:Berlaku,Perlu Pembaruan',
            'sertifikat'            => 'nullable|file|mimes:pdf|max:2048',
        ]);

        if ($request->hasFile('sertifikat')) {
            if ($item->sertifikat && Storage::disk('public')->exists($item->sertifikat)) {
                Storage::disk('public')->delete($item->sertifikat);
            }

            $file = $request->file('sertifikat');
            $fileName = time() . '' . preg_replace('/\s+/', '', $file->getClientOriginalName());
            $filePath = $file->storeAs('sertifikat_halal', $fileName, 'public');
            $validated['sertifikat'] = $filePath;
        }

        $item->update($validated);

        return redirect()->route('sertifikat.halal')
            ->with('success', 'Data berhasil diupdate.');
    }


    public function destroy($id)
    {
        $item = SertifikasiHalal::findOrFail($id);

        if ($item->sertifikat && Storage::disk('public')->exists($item->sertifikat)) {
            Storage::disk('public')->delete($item->sertifikat);
        }

        $item->delete();

        return redirect()->route('sertifikat.halal')
            ->with('success', 'Data berhasil dihapus.');
    }
}