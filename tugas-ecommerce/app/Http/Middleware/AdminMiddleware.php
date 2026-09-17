<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Membatasi akses hanya untuk pengguna dengan role "admin".
     *
     * - Kalau belum login          -> diarahkan ke halaman login.
     * - Kalau login tapi bukan admin -> ditolak dengan 403 Forbidden.
     * - Kalau admin                -> lanjut ke route/controller tujuan.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()) {
            return redirect()->route('login');
        }

        if ($request->user()->role !== 'admin') {
            abort(403, 'Akses ditolak. Halaman ini hanya untuk admin.');
        }

        return $next($request);
    }
}
