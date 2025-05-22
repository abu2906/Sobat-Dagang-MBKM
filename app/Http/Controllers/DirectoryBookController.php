<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Uttp;
use App\Models\DataAlatUkur;
use App\Mail\NotifikasiUttpKadaluarsa;
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
        $alatUkur = DataAlatUkur::with('uttp')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.bidangMetrologi.directory_alat_ukur_sah', compact('alatUkur'));
    }

    public function showDirectoryKabidMetrologi()
    {
        $alatUkur = DataAlatUkur::with('uttp')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.kabid.metrologi.directory_alat_ukur', compact('alatUkur'));
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
        try {
            $id = $request->input('id');
            if (!$id) {
                return response()->json(['error' => 'ID tidak ditemukan'], 400);
            }

            $uttp = Uttp::with('user')->find($id);
            if (!$uttp) {
                return response()->json(['error' => 'Data UTTP tidak ditemukan'], 404);
            }

            return response()->json($uttp);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat mengambil data'], 500);
        }
    }

    public function getDetailUser(Request $request)
    {
        try {
            $id = $request->input('id');
            if (!$id) {
                return response()->json(['error' => 'ID tidak ditemukan'], 400);
            }

            $dataAlatUkur = DataAlatUkur::with('uttp')->where('id_uttp', $id)->first();
            if (!$dataAlatUkur) {
                return response()->json(['error' => 'Data alat ukur tidak ditemukan'], 404);
            }

            // Format data untuk response
            $response = [
                'no_registrasi' => $dataAlatUkur->uttp->no_registrasi,
                'nama_usaha' => $dataAlatUkur->uttp->nama_usaha,
                'nama_alat' => $dataAlatUkur->uttp->nama_alat,
                'jenis_alat' => $dataAlatUkur->uttp->jenis_alat,
                'merk_type' => $dataAlatUkur->uttp->merk_type,
                'nomor_seri' => $dataAlatUkur->uttp->nomor_seri,
                'jumlah_alat' => $dataAlatUkur->uttp->jumlah_alat,
                'alat_penguji' => $dataAlatUkur->uttp->alat_penguji,
                'ctt' => $dataAlatUkur->uttp->ctt,
                'spt_keperluan' => $dataAlatUkur->uttp->spt_keperluan,
                't_u' => $dataAlatUkur->uttp->t_u,
                'tanggal_selesai' => $dataAlatUkur->uttp->tanggal_selesai,
                'terapan' => $dataAlatUkur->uttp->terapan,
                'keterangan' => $dataAlatUkur->uttp->keterangan,
                'status' => $dataAlatUkur->status,
                'tanggal_exp' => $dataAlatUkur->tanggal_exp
            ];

            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan saat mengambil data'], 500);
        }
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
        $uttp = Uttp::findOrFail($id);

        $uttp->update([
            'tanggal_penginputan' => $request->tanggal_penginputan,
            'id_user' => $request->id_user,
            'no_registrasi' => $request->no_registrasi,
            'nama_usaha' => $request->nama_usaha,
            'jenis_alat' => $request->jenis_alat,
            'nama_alat' => $request->nama_alat,
            'merk_type' => $request->merk_type,
            'nomor_seri' => $request->nomor_seri,
            'alat_penguji' => $request->alat_penguji,
            'ctt' => $request->ctt,
            'spt_keperluan' => $request->spt_keperluan,
            'tanggal_selesai' => $request->tanggal_selesai,
            'terapan' => $request->terapan,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Data alat ukur berhasil diperbarui.');
    }

    public function periksaKadaluarsa()
    {
        $kadaluarsa = DataAlatUkur::with('uttp.user')
            ->whereDate('tanggal_exp', '<', Carbon::today())
            ->where('status', '!=', 'Kadaluarsa')
            ->get();

        foreach ($kadaluarsa as $data) {
            $user = $data->uttp->user;

            if ($user) {
                Mail::to($user->email)->send(new NotifikasiUttpKadaluarsa($data));
                $data->update(['status' => 'Kadaluarsa']);
            }
        }
        return response()->json(['pesan' => 'Notifikasi dikirim ke pengguna yang alatnya kadaluarsa.']);
    }

}
