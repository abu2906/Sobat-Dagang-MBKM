<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        return view('user.dashboard');
    }
    public function showMetrologi()
    {
        return view('admin.bidangMetrologi.dashboard');
    }

    public function kelolaAdmin()
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