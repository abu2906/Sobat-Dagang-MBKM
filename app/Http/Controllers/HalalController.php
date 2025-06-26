<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SertifikasiHalal;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class HalalController extends Controller
{
    public function index()
    {
        $items = SertifikasiHalal::latest()->get();
        return view('admin.bidangIndustri.halal', compact('items'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_usaha' => 'required|string|max:255',
            'no_sertifikasi_halal' => 'nullable|string|max:255',
            'tanggal_sah' => 'required|date',
            'tanggal_exp' => 'required|date|after_or_equal:tanggal_sah',
            'alamat' => 'required|string',
            'sertifikat' => 'required|file|mimes:pdf|max:2048',
            'form_type' => 'required|string',
        ]);

        // 1. Panggil API sistem pakar
        $hasilAnalisis = $this->getExpertSystemAnalysis(
            $validatedData['tanggal_sah'],
            $validatedData['tanggal_exp']
        );

        // 2. Gabungkan form + hasil API
        $dataToCreate = array_merge($validatedData, $hasilAnalisis);
        $dataToCreate['status'] = $hasilAnalisis['status_sistem'];
        unset($dataToCreate['status_sistem']);

        // 3. Simpan file
        $filePath = $request->file('sertifikat')->store('sertifikat-halal', 'public');
        $dataToCreate['sertifikat'] = $filePath;

        SertifikasiHalal::create($dataToCreate);

        return redirect()->route('admin.industri.halal')->with('success', 'Data berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $halal = SertifikasiHalal::findOrFail($id);

        try {
            $validatedData = $request->validate([
                'nama_usaha' => 'required|string|max:255',
                'no_sertifikasi_halal' => 'nullable|string|max:255',
                'tanggal_sah' => 'required|date',
                'tanggal_exp' => 'required|date|after_or_equal:tanggal_sah',
                'alamat' => 'required|string',
                'sertifikat' => 'nullable|file|mimes:pdf|max:512',
                'status' => 'required|string',
                'form_type' => 'required|string',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('form_type', 'edit')
                ->with('old_input', $request->all());
        }

        $hasilAnalisis = $this->getExpertSystemAnalysis(
            $validatedData['tanggal_sah'],
            $validatedData['tanggal_exp']
        );

        if ($request->hasFile('sertifikat')) {
            Storage::disk('public')->delete($halal->sertifikat);
            $filePath = $request->file('sertifikat')->store('sertifikat-halal', 'public');
            $validatedData['sertifikat'] = $filePath;
        }

        $dataToUpdate = array_merge($validatedData, $hasilAnalisis);
        $dataToUpdate['status'] = $hasilAnalisis['status_sistem'];
        unset($dataToUpdate['status_sistem']);

        $halal->update($dataToUpdate);

        return redirect()->route('admin.industri.halal')
            ->with('success', 'Data berhasil diupdate dengan analisis risiko terbaru.');
    }

    public function destroy($id)
    {
        $halal = SertifikasiHalal::findOrFail($id);
        Storage::disk('public')->delete($halal->sertifikat);
        $halal->delete();

        return redirect()->route('admin.industri.halal')->with('success', 'Data berhasil dihapus.');
    }

    private function getExpertSystemAnalysis($tanggalSah, $tanggalExp)
    {
        $apiUrl = env('EXPERT_SYSTEM_API_URL', 'http://localhost:8001/api/cek-sertifikat');

        try {
            $response = Http::timeout(10)->post($apiUrl, [
                'tanggal_diterbitkan' => $tanggalSah,
                'berlaku_sampai' => $tanggalExp,
            ]);

            //  dd($response->json(), $response->status(), $response->body());

            if ($response->successful()) {
                $data = $response->json();

                return [
                    'status_sistem'         => $data['status_sistem'] ?? 'Tidak diketahui',
                    'umur_sertifikat_teks'  => $data['umur_sertifikat_teks'] ?? '-',
                    'klasifikasi_risiko'    => $data['klasifikasi'] ?? '-',
                    'rekomendasi_tindakan'  => $data['rekomendasi'] ?? '-',
                    'sisa_berlaku_teks'     => $data['sisa_berlaku_teks'] ?? '-',
                ];
            }
        } catch (\Exception $e) {
            Log::error('Gagal menghubungi API Sistem Pakar: ' . $e->getMessage());
        }

        return [
            'status_sistem'         => 'Gagal Analisis',
            'umur_sertifikat_teks'  => '-',
            'klasifikasi_risiko'    => '-',
            'rekomendasi_tindakan'  => 'Tidak tersedia',
            'sisa_berlaku_teks'     => '-',
        ];
    }
}
