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
        // Jika belum login sesuai guard
        if (!Auth::guard($guard)->check()) {
            return redirect()->route('login')->withErrors([
                'auth' => 'Silakan login sebagai ' . $guard,
            ]);
        }

        $user = Auth::guard($guard)->user();

        if ($guard === 'disdag') {
            if (!in_array($user->role, $roles)) {
                return redirect()->route('login')->withErrors([
                    'auth' => 'Anda tidak memiliki akses ke halaman ini.',
                ]);
            }
        } elseif ($guard === 'user') {
            if (!$user) {
                return redirect()->route('login')->withErrors([
                    'auth' => 'Pengguna tidak ditemukan.',
                ]);
            }
        }

        return $next($request);
    }

}
