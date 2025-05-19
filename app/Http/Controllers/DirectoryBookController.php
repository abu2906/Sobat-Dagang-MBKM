<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Uttp;
use App\Models\DataAlatUkur;
use Illuminate\Support\Carbon;


class DirectoryBookController extends Controller
{
    public function showDirectoryUserMetrologi()
    {   
        $alatUkur = DataAlatUkur::with('uttp')->get();
        return view('user.bidangMetrologi.directory', compact('alatUkur'));
        
    }       

    public function showDirectoryAdminMetrologi()
    {
        $alatUkur = DataAlatUkur::with('uttp')->get();

        return view('admin.bidangMetrologi.directory_alat_ukur_sah', compact('alatUkur'));
    }

    public function storeAlatUkur(Request $request)
    {
        $request->validate([
            'no_registrasi' => 'required|string|max:255',
            'jenis_alat' => 'required|string',
        ]);

        $lastData = Uttp::orderBy('id_uttp', 'desc')->first();
        if (!$lastData) {
            $newIdData = 1;
        } else {
            $lastIdNumber = (int) substr($lastData->id_uttp, 1);
            $newIdNumber = $lastIdNumber + 1;
            $newIdData = $newIdNumber;
        }

        $uttp = Uttp::create([
            'id_uttp' => $newIdData,
            'id_user' => $request->id_user,
            'tanggal_penginputan' => $request->tanggal_penginputan,
            'no_registrasi' => $request->no_registrasi,
            'nama_usaha' => $request->nama_usaha,
            'jenis_alat' => $request->jenis_alat,
            'nama_alat' => $request->nama_alat,
            'merk_type' => $request->merk_type,
            'nomor_seri' => $request->nomor_seri,
            'jumlah_alat' => $request->jumlah_alat,
            'alat_penguji' => $request->alat_penguji,
            'ctt' => $request->ctt,
            'spt_keperluan' => $request->spt_keperluan,
            'tanggal_selesai' => $request->tanggal_selesai,
            'terapan' => $request->terapan,
            'keterangan' => $request->keterangan,
        ]);

        DataAlatUkur::create([
            'id_uttp' => $uttp->id_uttp,
            'tanggal_exp' => Carbon::parse($uttp->tanggal_selesai)->addYear(),
            'status' => 'Valid',
        ]);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan');
    }

    public function alatUser($id_user)
    {
        $alatUkur = DataAlatUkur::whereHas('uttp', function ($query) use ($id_user) {
            $query->where('id_user', $id_user);
        })->with('uttp')->get();

        return view('user.bidangMetrologi.directory', compact('alatUkur'));
    }

    public function getDetail(Request $request)
    {
        $id = $request->input('id');
        $uttp = Uttp::with('user')->findOrFail($id);

        return response()->json($uttp);
    }

    public function destroy($id)
    {
        $uttp = Uttp::findOrFail($id);

        // Hapus data alat ukur terkait jika ada
        DataAlatUkur::where('id_uttp', $id)->delete();

        // Hapus data UTTP
        $uttp->delete();

        return redirect()->back()->with('success', 'Data UTTP berhasil dihapus');
    }


    public function update(Request $request, $id)
    {
        $uttp = UTTP::findOrFail($id);

        $uttp->update([
            'tanggal_penginputan' => $request->tanggal_penginputan,
            'id_user' => $request->id_user,
            'no_registrasi' => $request->no_registrasi,
            'nama_usaha' => $request->nama_usaha,
            'jenis_alat' => $request->jenis_alat,
            'nama_alat' => $request->nama_alat,
            'merk_type' => $request->merk_type,
            'nomor_seri' => $request->nomor_seri,
            'jumlah_alat' => $request->jumlah_alat,
            'alat_penguji' => $request->alat_penguji,
            'ctt' => $request->ctt,
            'spt_keperluan' => $request->spt_keperluan,
            'tanggal_selesai' => $request->tanggal_selesai,
            'terapan' => $request->terapan,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Data alat ukur berhasil diperbarui.');
    }
    // public function update(Request $request, $id)
    // {
    //     $uttp = Uttp::with('user')->findOrFail($id);
    //     $uttp->update($request->all());

    //     return redirect()->back()->with('success', 'Data berhasil diperbarui');
    // }

}
