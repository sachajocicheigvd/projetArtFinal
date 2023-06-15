<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\RedirectResponse;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // S'il n'est pas connecté, redirigez vers la page de connexion ou création de compte
        if (!$request->user()) {
            return new RedirectResponse(url('/loginchoice'));
        }

        // S'il a le rôle admin, on le laisse passer
        if ($request->user()->role->short_description === 'admin') {
            return $next($request);
        }
        return new RedirectResponse(url('/'));
    }
}
