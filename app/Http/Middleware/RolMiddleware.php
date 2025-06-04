<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RolMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        $usuario = Auth::user();

        if ($usuario && in_array($usuario->rol, $roles)) {
            return $next($request);
        }

        abort(403, 'Acceso no autorizado');
    }
}

