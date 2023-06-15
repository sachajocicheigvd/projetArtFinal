<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // S'il n'est pas connecté, redirigez vers la page de connexion ou création de compte sinon on le laisse passer
        return $request->expectsJson() ? null : route('loginChoice');
    }
}
