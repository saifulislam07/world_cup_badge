<?php

namespace App\Http\Middleware;

use App\Models\VisitorLog;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogVisitor
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->isMethod('get') && !$request->is('admin*')) {
            VisitorLog::create([
                'ip_address' => $request->ip(),
                'session_id' => $request->hasSession() ? $request->session()->getId() : null,
                'method' => $request->method(),
                'path' => '/' . ltrim($request->path(), '/'),
                'full_url' => $request->fullUrl(),
                'route_name' => $request->route()?->getName(),
                'referer' => $request->headers->get('referer'),
                'user_agent' => $request->userAgent(),
                'visited_at' => now(),
            ]);
        }

        return $response;
    }
}
