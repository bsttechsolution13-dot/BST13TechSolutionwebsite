<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminLayout
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check() || ! auth()->user()->isAdminLayout()) {
            return redirect()->route('admin.login')->with('error', 'Akses dibatasi. Silakan login sebagai Admin Layout terlebih dahulu.');
        }

        return $next($request);
    }
}
