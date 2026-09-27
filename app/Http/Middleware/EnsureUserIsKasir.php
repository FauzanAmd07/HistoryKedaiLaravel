<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsKasir
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user() || (!$request->user()->isKasir() && !$request->user()->isAdmin())) {
            abort(403, 'Akses terbatas untuk Kasir atau Admin.');
        }

        return $next($request);
    }
}
