<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ?string $role = null): Response
    {
        // Periksa apakah pengguna sudah login dan perannya sesuai
        if (Auth::check() && ($role === null || Auth::user()->role === $role)) {
            return $next($request);
        }

        // Jika bukan superadmin, arahkan ke halaman lain atau tampilkan pesan error
        return redirect('/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
