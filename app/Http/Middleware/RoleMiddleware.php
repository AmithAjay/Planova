<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect('login');
        }

        $user = auth()->user();

        if (in_array('super_admin', $roles) && $user->isSuperAdmin()) {
            return $next($request);
        }

        if (in_array('admin', $roles) && $user->isAdmin()) {
            return $next($request);
        }

        if (in_array('student', $roles) && $user->isStudent()) {
            return $next($request);
        }

        abort(403, 'Unauthorized Access');
    }
}
