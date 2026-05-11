<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CekAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->user()->role != 'admin')
        {
            abort(403, 'Kamu tidak memiliki akses ke halaman ini');
        }

        return $next($request);
    }
}
