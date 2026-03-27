<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = auth()->user();

        if (!$user) {
            return redirect()->route('login');
        }

        if (!$user->role || !in_array($user->role->nom, $roles)) {
            return redirect('/redirect-role')->with('error', 'Accès refusé');
        }

        return $next($request);
    }
}