<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Verifica si el usuario está autenticado
        if (!auth()->check()) {
            return redirect('/login');
        }

        // Verifica si el rol coincide
        if (auth()->user()->role !== $role) {
            // Redirigir al dashboard correspondiente según el rol
            if (auth()->user()->role === 'admin') {
                return redirect()->route('projects.index');
            }

            if (auth()->user()->role === 'student') {
                return redirect()->route('layouts.student');
            }

            // Si el rol no es válido, mostrar un mensaje de error
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
