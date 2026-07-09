<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('auth_user.is_admin')) {
            abort(403, 'Anda tidak memiliki akses untuk mengelola aktivasi akun.');
        }

        return $next($request);
    }
}
