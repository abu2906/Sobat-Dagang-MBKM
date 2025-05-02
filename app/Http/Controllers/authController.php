<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authController extends Controller
{
    // Menampilkan form login
    public function showFormLogin()
    {
        return view('pages.auth.login');
    }

    // Menampilkan form register
    public function showFormRegister()
    {
        return view('pages.auth.register');
    }

    // Menampilkan form lupa password
    public function showForgotPassword()
    {
        return view('pages.auth.forgotpass');
    }

    // Menampilkan form ubah password
    public function showChangePassword()
    {
        return view('pages.auth.resetpassword');
    }

    // Proses login
    public function loginProcess(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect berdasarkan role
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } elseif ($user->role === 'user') {
                return redirect()->intended(route('form_permohonan'));
            } else {
                return redirect()->intended('/');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
