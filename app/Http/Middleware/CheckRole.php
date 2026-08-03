<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $userRole = session('auth_user.role');

        // super_admin selalu boleh lewat, apapun modulnya
        if ($userRole === 'super_admin') {
            return $next($request);
        }

        if (!$userRole || !in_array($userRole, $roles, true)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
