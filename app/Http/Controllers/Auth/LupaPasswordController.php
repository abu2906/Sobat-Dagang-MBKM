<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class LupaPasswordController extends Controller
{
    public function showForm()
    {
        return view('pages.auth.forgotpass');
    }

    public function sendLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:user,email'
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => Carbon::now()]
        );

        // Kirim email
        $resetLink = url('/reset-password/' . $token . '?email=' . urlencode($request->email));

        Mail::send('emails.reset-password', ['resetLink' => $resetLink], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Kata Sandi Sobat Dagang');
        });

        return back()->with('status', 'Link reset kata sandi telah dikirim ke email Anda.');
    }

    public function showResetForm(Request $request, $token)
    {
        return view('pages.auth.resetpass', [
            'token' => $token,
            'email' => $request->email
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:user,email',
            'password' => 'required|confirmed|min:6',
            'token' => 'required'
        ]);

        $reset = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$reset || Carbon::parse($reset->created_at)->addMinutes(60)->isPast()) {
            return back()->withErrors(['token' => 'Token tidak valid atau telah kedaluwarsa.']);
        }

        DB::table('user')->where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect('/login')->with('status', 'Kata sandi berhasil direset!');
    }
}

