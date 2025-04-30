<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registrasi;  

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'email_aktif' => 'required|email|unique:registrasi,email_aktif',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'nik' => 'required|string|unique:registrasi,nik',
            'nib' => 'nullable|string',
            'nomor_hp' => 'required|string',
            'alamat_lengkap' => 'required|string',
            'kabupaten' => 'required|in:Kabupaten1,Kabupaten2,Kabupaten3',
            'kecamatan' => 'required|in:Kecamatan1,Kecamatan2,Kecamatan3',
            'kelurahan' => 'required|in:Kelurahan1,Kelurahan2,Kelurahan3',
            'password' => 'required|confirmed|min:6',
        ]);
    
        // Membuat registrasi baru
        Registrasi::create([
            'nama_lengkap' => $validated['nama_lengkap'],
            'email_aktif' => $validated['email_aktif'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'nik' => $validated['nik'],
            'nib' => $validated['nib'],
            'nomor_hp' => $validated['nomor_hp'],
            'alamat_lengkap' => $validated['alamat_lengkap'],
            'kabupaten' => $validated['kabupaten'],
            'kecamatan' => $validated['kecamatan'],
            'kelurahan' => $validated['kelurahan'],
            'password' => bcrypt($validated['password']),
        ]);
    
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
    
}
