<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ResepsionisMiddleware
{
    public function handle($request, Closure $next): Response
    {
        if (Auth::guard('resepsionis')->check()) {
            return $next($request);
        }

        return redirect('/login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
