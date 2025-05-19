<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\User;

<<<<<<< HEAD
=======

>>>>>>> origin/iniaaaini
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
>>>>>>> origin/iniaaaini
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

    public function dashboardMaster()
    {
     return view('admin.adminSuper.dashboardMaster');
    }

}