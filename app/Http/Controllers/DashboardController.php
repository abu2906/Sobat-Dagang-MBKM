<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\User;


class DashboardController extends Controller
{
    public function index()
    {
        // Path ke file wilayah.json yang berada di folder public/assets/data
        $filePath = public_path('assets/data/wilayah.json');
        
        // Membaca file JSON
        if (File::exists($filePath)) {
            $wilayah = json_decode(File::get($filePath), true);
        } else {
            $wilayah = [];
        }

        // Cek apakah 'kabupaten' ada, jika tidak, beri fallback kosong
        if (!isset($wilayah['kabupaten'])) {
            $wilayah['kabupaten'] = [];
        }

        return view('user.dashboard', compact('wilayah'));
    }

    // Menampilkan halaman profil
    public function showProfile()
    {
        $user = Auth::user();

        // Ambil data wilayah dari file JSON
        $wilayah = json_decode(file_get_contents(public_path('wilayah.json')), true);

        return view('component.profile', compact('user', 'wilayah'));
    }

    // Proses update data profil
    public function updateProfile(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kabupaten' => 'required|string',
            'kecamatan' => 'nullable|string',
            'kelurahan' => 'nullable|string',
            'alamat_lengkap' => 'nullable|string',
            'email' => 'required|email',
            'telp' => 'nullable|string|max:20',
            'nib' => 'nullable|string|max:30',
            'nik' => 'nullable|string|max:16',
            'jenis_kelamin' => 'nullable|string|in:Laki-laki,Perempuan',
        ]);

        $user = Auth::user();
        $user->fill([
            'nama' => $request->input('nama'),
            'kabupaten' => $request->input('kabupaten'),
            'kecamatan' => $request->input('kecamatan'),
            'kelurahan' => $request->input('kelurahan'),
            'alamat_lengkap' => $request->input('alamat_lengkap'),
            'email' => $request->input('email'),
            'telp' => $request->input('telp'),
            'nib' => $request->input('nib'),
            'nik' => $request->input('nik'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
        ]);
        
        if ($user->save()) {
            return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui.');
        } else {
            return redirect()->route('profile')->with('error', 'Gagal memperbarui profil.');
        }
    }        

    public function showMetrologi() 
    {
        return view('admin.bidangMetrologi.dashboard');
    }
}
