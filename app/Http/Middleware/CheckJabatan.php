<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckJabatan
{
    public function handle(Request $request, Closure $next, string ...$jabatans): mixed
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (!in_array(auth()->user()->jabatan, $jabatans)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
