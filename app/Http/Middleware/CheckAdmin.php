<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Allow admin and superadmin roles to pass
        if ($user && in_array($user->role, ['admin', 'superadmin'])) {
            return $next($request);
        }

        // If logged in as customer, log them out and force admin login
        if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return redirect()->route('login')->withErrors([
            'email' => 'Akses ditolak. Silakan login menggunakan akun Admin atau Staff.'
        ]);
    }
}
