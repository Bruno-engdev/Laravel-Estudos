<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdmin
{
    /**
     * Garante que o usuário autenticado seja administrador.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Auth::check()) {
            return redirect()->route('admin.login')->withErrors([
                'email' => 'Você precisa estar autenticado para acessar essa área.',
            ]);
        }

        $user = Auth::user();

        if (! $user->isAdmin()) {
            Auth::logout();
            return redirect()->route('admin.login')->withErrors([
                'email' => 'Acesso negado. Você não possui permissões de administrador.',
            ]);
        }

        return $next($request);
    }
}
