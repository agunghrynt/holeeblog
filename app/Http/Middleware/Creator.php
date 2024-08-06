<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Creator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Redirect to HTTPS if the request is not secure
        if (!$request->secure() && env('APP_ENV') !== 'local') {
            return redirect()->secure($request->getRequestUri());
        }

        $user = auth()->user();
        $resourceOwnerId = $request->route('comment')->user_id; // Asumsikan resource yang diakses adalah `comment` dan memiliki `user_id`

        // Check if the user is the owner or an admin
        if ($user->id !== $resourceOwnerId && !$user->isAdmin) {
            abort(403);
        }

        return $next($request);
    }
}
