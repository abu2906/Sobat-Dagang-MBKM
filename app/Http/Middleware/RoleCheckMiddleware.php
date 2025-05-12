<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $guard
     * @param  string  ...$roles
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next, $guard, ...$roles)
    {
        // Pastikan user sudah login dengan guard yang sesuai
        if (!Auth::guard($guard)->check()) {
            return redirect()->route('login')->withErrors([
                'auth' => 'Silakan login sebagai ' . $guard,
            ]);
        }

        $user = Auth::guard($guard)->user();

        // Periksa apakah role user sesuai dengan yang diizinkan
        if (!in_array($user->role, $roles)) {
            return redirect()->route('login')->withErrors([
                'auth' => 'Anda Tidak Memiliki Akses Ke halaman ini, Pastikan anda login dengan Role yang benar',
            ]);
        }

        return $next($request);
    }
}
