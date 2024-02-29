<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OnlineMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$user = $request->user()) {
            return $next($request);
        }

        if ($user->online_at < now()->subMinutes(15)) {
            $user->update(['online_at' => now()]);
        }

        return $next($request);
    }
}
