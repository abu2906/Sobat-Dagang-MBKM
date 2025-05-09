<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Disdag;

class authController extends Controller
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

    public function submitFormLogin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $identifier = $request->username;

        // 1. Coba login disdag via NIP
        $disdag = Disdag::where('nip', $identifier)->first();

        if ($disdag && Hash::check($request->password, $disdag->password)) {
            Auth::login($disdag);

            //tidak terhubung pi ketampilan baru users
            switch ($disdag->role) {
                case 'master_admin':
                    return redirect()->intended(route('user.dashboard'));
                case 'admin_perdagangan':
                    return redirect()->intended(route('dashboard.perdagangan'));
                case 'admin_industri':
                    return redirect()->intended('/admin/industri');
                case 'admin_metrologi':
                    return redirect()->intended('/admin/metrologi');
                case 'kabid_perdagangan':
                    return redirect()->intended('/kabid/perdagangan');
                case 'kabid_industri':
                    return redirect()->intended('/kabid/industri');
                case 'kabid_metrologi':
                    return redirect()->intended('/kabid/metrologi');
                case 'kepala_dinas':
                    return redirect()->intended('/kepaladinas');
                default:
                    return redirect('/dashboard');
            }
        }

        $user = User::where('nik', $identifier)->orWhere('nib', $identifier)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect()->intended(route('user.dashboard'));
        }

        // Jika login gagal, kirimkan pesan error ke session
        return redirect()->route('login')->withErrors(['login_error' => 'Username atau password salah']);
    }


    public function submitRegister(Request $request)
    {
        Log::info('Data registrasi yang diterima:', $request->all());

        try {
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

            Log::info('Mencoba menyimpan user ke database');
            $user->save();
            Log::info('User berhasil disimpan dengan ID: ' . $user->id_user);
        } catch (\Exception $e) {

            Log::error('Error saat registrasi: ' . $e->getMessage());
            Log::error($e->getTraceAsString());


            return back()->withInput()->withErrors(['general' => 'Terjadi kesalahan saat mendaftar: ' . $e->getMessage()]);
        }

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }

        public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
    
        public function showforgotPassword()
    {
        return view('pages.auth.forgotpass');
    }

        public function showchangePassword()
    {
        return view('pages.auth.changepass');
    }

            public function showverification()
    {
        return view('pages.auth.verification');
    }
};
