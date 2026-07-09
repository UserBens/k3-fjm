<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has('auth_user')) {
            // Simpan URL tujuan supaya setelah login diarahkan kembali ke sana
            return redirect()->route('login')
                ->with('status', 'Silakan masuk terlebih dahulu untuk mengakses halaman tersebut.');
        }

        return $next($request);
    }
}
