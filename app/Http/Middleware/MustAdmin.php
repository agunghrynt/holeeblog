<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MustAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->secure() && env('APP_ENV') !== 'local') {
            return redirect()->secure($request->getRequestUri());
        }

        if(auth()->guest() || !auth()->user()->isadmin)
        {
            abort(403);
        }

        return $next($request);
    }
}
