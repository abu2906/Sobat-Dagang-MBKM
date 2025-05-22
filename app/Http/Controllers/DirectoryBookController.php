<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Uttp;
use App\Models\DataAlatUkur;
use App\Mail\NotifikasiUttpKadaluarsa;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Exports\UttpExport;
use Maatwebsite\Excel\Facades\Excel;

class DirectoryBookController extends Controller
{
    public function showDirectoryUserMetrologi()
    {
        $alatUkur = DataAlatUkur::select('data_alat_ukur.*')
            ->join('uttp', 'data_alat_ukur.id_uttp', '=', 'uttp.id_uttp')
            ->join(DB::raw('(
                SELECT uttp.no_registrasi, MAX(data_alat_ukur.tanggal_exp) as max_exp
                FROM data_alat_ukur
                JOIN uttp ON uttp.id_uttp = data_alat_ukur.id_uttp
                GROUP BY uttp.no_registrasi
            ) as latest'), function ($join) {
                $join->on('uttp.no_registrasi', '=', 'latest.no_registrasi')
                    ->on('data_alat_ukur.tanggal_exp', '=', 'latest.max_exp');
            })
            ->whereDate('data_alat_ukur.tanggal_exp', '>=', now()) // hanya valid
            ->with('uttp')
            ->get();

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
        try {
            $request->validate([
                'no_registrasi' => 'required|string|max:255',
                'jenis_alat' => 'required|string',
                'id_user' => 'nullable|exists:user,id_user',
            ], [
                'id_user.exists' => 'ID User tidak valid',
            ]);

            // Cek apakah no_registrasi sudah digunakan
            $existingUttps = Uttp::where('no_registrasi', $request->no_registrasi)
                ->where('jenis_alat', $request->jenis_alat)
                ->where('nomor_seri', $request->nomor_seri)
                ->get();

            if ($existingUttps->isNotEmpty()) {
                // Cek apakah ada UTTP dengan id_user yang berbeda
                foreach ($existingUttps as $existingUttp) {
                    if ($existingUttp->id_user !== null) {
                        // Jika UTTP yang ada memiliki id_user, input baru harus memiliki id_user yang sama
                        if ($request->id_user === null) {
                            return response()->json([
                                'success' => false,
                                'errors' => [
                                    'id_user' => ['ID User harus diisi karena no registrasi sudah terdaftar dengan user tertentu']
                                ]
                            ], 422);
                        }
                        if ($request->id_user != $existingUttp->id_user) {
                            return response()->json([
                                'success' => false,
                                'errors' => [
                                    'no_registrasi' => ['No registrasi sudah digunakan oleh user lain']
                                ]
                            ], 422);
                        }
                    }
                }
            } else {
                // Cek apakah no_registrasi sudah digunakan dengan jenis_alat atau nomor_seri yang berbeda
                $differentUttp = Uttp::where('no_registrasi', $request->no_registrasi)
                    ->where(function($query) use ($request) {
                        $query->where('jenis_alat', '!=', $request->jenis_alat)
                            ->orWhere('nomor_seri', '!=', $request->nomor_seri);
                    })
                    ->first();

                if ($differentUttp) {
                    return response()->json([
                        'success' => false,
                        'errors' => [
                            'no_registrasi' => ['No registrasi sudah digunakan dengan jenis alat atau nomor seri yang berbeda']
                        ]
                    ], 422);
                }
            }

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

            $today = Carbon::today();
            if(Carbon::parse($uttp->tanggal_selesai)->addYear()->greaterThan($today)){
                $status = 'Valid';
            }else{
                $status='Kadaluarsa';
            };
            DataAlatUkur::create([
                'id_uttp' => $uttp->id_uttp,
                'tanggal_exp' => Carbon::parse($uttp->tanggal_selesai)->addYear(),
                'status' => $status
            ]);

            return response()->json(['success' => true, 'message' => 'Data berhasil ditambahkan']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data'
            ], 500);
        }
    }

    public function alatUser($id_user)
    {
        $alatUkur = DataAlatUkur::select('data_alat_ukur.*')
            ->join('uttp', 'data_alat_ukur.id_uttp', '=', 'uttp.id_uttp')
            ->where('uttp.id_user', $id_user)
            ->join(DB::raw('(
                SELECT uttp.no_registrasi, MAX(data_alat_ukur.tanggal_exp) as max_exp
                FROM data_alat_ukur
                JOIN uttp ON uttp.id_uttp = data_alat_ukur.id_uttp
                GROUP BY uttp.no_registrasi
            ) as latest'), function ($join) {
                $join->on('uttp.no_registrasi', '=', 'latest.no_registrasi')
                    ->on('data_alat_ukur.tanggal_exp', '=', 'latest.max_exp');
            })
            ->with('uttp')
            ->get();

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
        try {
            $request->validate([
                'id_user' => 'nullable|exists:user,id_user',
            ], [
                'id_user.exists' => 'ID User tidak valid',
            ]);

            $uttp = Uttp::findOrFail($id);

            // Cek apakah no_registrasi sudah digunakan
            $existingUttps = Uttp::where('no_registrasi', $request->no_registrasi)
                ->where('jenis_alat', $request->jenis_alat)
                ->where('nomor_seri', $request->nomor_seri)
                ->where('id_uttp', '!=', $id) // Exclude current UTTP
                ->get();

            if ($existingUttps->isNotEmpty()) {
                // Cek apakah ada UTTP dengan id_user yang berbeda
                foreach ($existingUttps as $existingUttp) {
                    if ($existingUttp->id_user !== null) {
                        // Jika UTTP yang ada memiliki id_user, input baru harus memiliki id_user yang sama
                        if ($request->id_user === null) {
                            return response()->json([
                                'success' => false,
                                'errors' => [
                                    'id_user' => ['ID User harus diisi karena no registrasi sudah terdaftar dengan user tertentu']
                                ]
                            ], 422);
                        }
                        if ($request->id_user != $existingUttp->id_user) {
                            return response()->json([
                                'success' => false,
                                'errors' => [
                                    'no_registrasi' => ['No registrasi sudah digunakan oleh user lain']
                                ]
                            ], 422);
                        }
                    }
                }
            } else {
                // Cek apakah no_registrasi sudah digunakan dengan jenis_alat atau nomor_seri yang berbeda
                $differentUttp = Uttp::where('no_registrasi', $request->no_registrasi)
                    ->where('id_uttp', '!=', $id) // Exclude current UTTP
                    ->where(function($query) use ($request) {
                        $query->where('jenis_alat', '!=', $request->jenis_alat)
                            ->orWhere('nomor_seri', '!=', $request->nomor_seri);
                    })
                    ->first();

                if ($differentUttp) {
                    return response()->json([
                        'success' => false,
                        'errors' => [
                            'no_registrasi' => ['No registrasi sudah digunakan dengan jenis alat atau nomor seri yang berbeda']
                        ]
                    ], 422);
                }
            }

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

            $today = Carbon::today();
            if(Carbon::parse($request->tanggal_selesai)->addYear()->greaterThan($today)){
                $status = 'Valid';
            }else{
                $status='Kadaluarsa';
            };
            $uttp->dataAlatUkur->update([
                'tanggal_exp' => Carbon::parse($request->tanggal_selesai)->addYear(),
                'status' => $status
            ]);

            return response()->json(['success' => true, 'message' => 'Data alat ukur berhasil diperbarui']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data'
            ], 500);
        }
    }

    public function periksaKadaluarsa()
    {
        $targetDate = Carbon::now()->addDays(7)->toDateString();

        // Cari alat ukur yang tanggal_exp-nya sama dengan $targetDate
        $dataKedaluwarsa = DataAlatUkur::with('uttp.user')
            ->where('tanggal_exp', $targetDate)
            ->where('notifikasi_terkirim', false)->get();

        foreach ($dataKedaluwarsa as $data) {
            $user = $data->uttp->user;

            if ($user) {
                Mail::to($user->email)->send(new NotifikasiUttpKadaluarsa($data));

                // Tandai bahwa notifikasi sudah dikirim
                $data->update([
                    'status' => 'Kadaluarsa',
                    'notifikasi_terkirim' => true,
                ]);
            }
        }
    }

    public function downloadUttp()
    {
        return Excel::download(new UttpExport, 'data_uttp.xlsx');
    }

}
