<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
<<<<<<< HEAD
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
=======
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\User;

>>>>>>> iniaaaini

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
<<<<<<< HEAD
    public function kelolaAdmin()
=======

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
>>>>>>> iniaaaini
    {
        // Mendapatkan semua data pengguna
        $users = User::all();
        
        // Mengirimkan data $users ke view 'admin.adminSuper.kelolaAdmin'
        return view('admin.adminSuper.kelolaAdmin', compact('users'));
    }

    
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
}