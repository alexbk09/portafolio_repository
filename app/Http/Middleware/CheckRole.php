<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!auth()->check()) {
            return redirect('/login');
        }

        $user = auth()->user();
        
        if ($role === 'admin' && !$user->isAdmin()) {
            abort(403, 'Acceso denegado. Solo administradores pueden acceder a esta sección.');
        }
        
        if ($role === 'freelancer' && !$user->isFreelancer()) {
            abort(403, 'Acceso denegado. Solo freelancers pueden acceder a esta sección.');
        }
        
        if ($role === 'client' && !$user->isClient()) {
            abort(403, 'Acceso denegado. Solo clientes pueden acceder a esta sección.');
        }

        return $next($request);
    }
}
