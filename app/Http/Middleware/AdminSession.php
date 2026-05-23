<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminSession
{
    public function handle(Request $request, Closure $next)
    {
        abort_unless($request->session()->get('is_admin'), 403);

        return $next($request);
    }
}
