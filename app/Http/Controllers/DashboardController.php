<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        return view('user.dashboard');
    }

    public function profile()
    {
        return view('component.profile');
    }

    public function kelolaAdmin()
    {
        // Mendapatkan semua data pengguna
        $users = User::all();
        
        // Mengirimkan data $users ke view 'admin.adminSuper.kelolaAdmin'
        return view('admin.adminSuper.kelolaAdmin', compact('users'));
    }


    // Proses update data profil
    // public function updateProfile(Request $request)
    // {
    //     $request->validate([
    //         'nama' => 'required|string|max:255',
    //         'kabupaten' => 'required|string',
    //         'kecamatan' => 'nullable|string',
    //         'kelurahan' => 'nullable|string',
    //         'alamat_lengkap' => 'nullable|string',
    //         'email' => 'required|email',
    //         'telp' => 'nullable|string|max:20',
    //         'nib' => 'nullable|string|max:30',
    //         'nik' => 'nullable|string|max:16',
    //         'jenis_kelamin' => 'nullable|string|in:Laki-laki,Perempuan',
    //     ]);

    //     $user = Auth::user();
    //     $user->fill([
    //         'nama' => $request->input('nama'),
    //         'kabupaten' => $request->input('kabupaten'),
    //         'kecamatan' => $request->input('kecamatan'),
    //         'kelurahan' => $request->input('kelurahan'),
    //         'alamat_lengkap' => $request->input('alamat_lengkap'),
    //         'email' => $request->input('email'),
    //         'telp' => $request->input('telp'),
    //         'nib' => $request->input('nib'),
    //         'nik' => $request->input('nik'),
    //         'jenis_kelamin' => $request->input('jenis_kelamin'),
    //     ]);
        
    //     if ($user->save()) {
    //         return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
    //     } else {
    //         return redirect()->route('profile')->with('error', 'Gagal memperbarui profil.');
    //     }
    // }  
    
    // Menambah pengguna baru
    public function tambahPengguna(Request $request)
    {
        // Validasi input yang diterima dari form
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Validasi email unik
            'password' => 'required|string|min:8|confirmed', // Validasi password dan konfirmasi password
            'role' => 'required|string|in:admin,user', // Validasi role (hanya admin atau user)
        ]);

        // Menyimpan pengguna baru ke dalam database
        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash password sebelum disimpan
            'role' => $request->role,
        ]);

        // Redirect setelah berhasil menambahkan pengguna
        return redirect()->route('kelola.pengguna')->with('success', 'Pengguna berhasil ditambahkan');
    }

    // Mengupdate data pengguna
    public function update(Request $request, $id_pengguna)
    {
        // Validasi input yang diterima dari form
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email',
            'role' => 'required|string|in:admin,user', // Validasi role
        ]);

        $user = User::findOrFail($id_pengguna);

        // Mengupdate data pengguna
        $user->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        return redirect()->route('kelola.pengguna')->with('success', 'Pengguna berhasil diupdate');
    }

    // Menghapus pengguna
    public function destroy($id_pengguna)
    {
        $user = User::findOrFail($id_pengguna);
        $user->delete();

        return redirect()->route('kelola.pengguna')->with('success', 'Pengguna berhasil dihapus');
    }
    public function dashboardMaster()    {
        $totalDistributor = DB::table('distributor')->count();
        $totalPengaduan = DB::table('forum_diskusi')
            ->whereNotNull('id_user')
            ->count();
        $totalPengguna = DB::table('user')->count();
        $totalKomoditas = DB::table('data_ikm')->count();

        $totalPermohonan = DB::table('form_permohonan')->count() + DB::table('surat_metrologi')->count();

        $permohonanPerdagangan = DB::table('form_permohonan')
            ->join('user', 'form_permohonan.id_user', '=', 'user.id_user')
            ->select(
                DB::raw('DATE_FORMAT(form_permohonan.tgl_pengajuan, "%d-%m-%Y") as tanggal'),
                'user.nama as nama_pengirim',
                DB::raw('CASE 
                    WHEN form_permohonan.jenis_surat LIKE "%perdagangan%" THEN "Perdagangan"
                    WHEN form_permohonan.jenis_surat LIKE "%industri%" THEN "Industri"
                    ELSE "Perdagangan"
                END as bidang_terkait'),
                DB::raw('CASE 
                    WHEN form_permohonan.status = "menunggu" THEN "Menunggu"
                    WHEN form_permohonan.status = "diterima" THEN "Disetujui"
                    WHEN form_permohonan.status = "ditolak" THEN "Ditolak"
                    ELSE form_permohonan.status
                END as status')
            );

        $permohonanMetrologi = DB::table('surat_metrologi')
            ->join('user', 'surat_metrologi.user_id', '=', 'user.id_user')
            ->select(
                DB::raw('DATE_FORMAT(surat_metrologi.created_at, "%d-%m-%Y") as tanggal'),
                'user.nama as nama_pengirim',
                DB::raw('"Metrologi" as bidang_terkait'),
                'surat_metrologi.status_surat_masuk as status'
            );

        $permohonan = $permohonanPerdagangan->union($permohonanMetrologi)
            ->orderBy(DB::raw('STR_TO_DATE(tanggal, "%d-%m-%Y")'), 'desc')
            ->get();
        
        return view('admin.adminSuper.dashboardMaster', compact(
            'totalDistributor',
            'totalPengaduan',
            'totalPengguna',
            'totalKomoditas',
            'totalPermohonan',
            'permohonan'
        ));
    }
}