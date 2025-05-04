<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\User;

class AuthController extends Controller
{
    public function showFormLogin()
    {
        return view('pages.auth.login');
    }

    public function showFormRegister()
    {
        $json = file_get_contents(public_path('assets/data/wilayah.json'));
        $wilayah = json_decode($json, true);
        return view('pages.auth.register', compact('wilayah'));
    }

    public function submitRegister(Request $request)
    {
        // Debugging: Lihat semua data yang diterima
        Log::info('Data registrasi yang diterima:', $request->all());

        try {
            // Validasi input
            $validated = $request->validate([
                'nama' => 'required|string|max:255',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'kabupaten' => 'required|string|max:255',
                'kecamatan' => 'required|string|max:255',
                'kelurahan' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:user',
                'telp' => 'required|string|max:15',
                'password' => 'required|string|min:8|confirmed',
                'alamat_lengkap' => 'required|string',
                'nik' => 'required|string|unique:user',
                'nib' => 'nullable|string',
            ]);

            Log::info('Validasi berhasil, data valid:', $validated);

            // Buat user baru
            $user = new User;
            $user->nama = $validated['nama'];
            $user->jenis_kelamin = $validated['jenis_kelamin'];
            $user->kabupaten = $validated['kabupaten'];
            $user->kecamatan = $validated['kecamatan'];
            $user->kelurahan = $validated['kelurahan'];
            $user->email = $validated['email'];
            $user->telp = $validated['telp'];
            $user->password = Hash::make($validated['password']);
            $user->alamat_lengkap = $validated['alamat_lengkap'];
            $user->nik = $validated['nik'];
            $user->nib = $validated['nib'];

            // Simpan user ke database
            Log::info('Mencoba menyimpan user ke database');
            $user->save();
            Log::info('User berhasil disimpan dengan ID: ' . $user->id_user);
        } catch (\Exception $e) {
            // Tangkap error dan log
            Log::error('Error saat registrasi: ' . $e->getMessage());
            Log::error($e->getTraceAsString());

            // Kembalikan pesan error ke pengguna
            return back()->withInput()->withErrors(['general' => 'Terjadi kesalahan saat mendaftar: ' . $e->getMessage()]);
        }

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }
};
