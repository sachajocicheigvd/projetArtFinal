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

        // if not logged in, redirect to login page
        if (!$request->user()) {
            return new RedirectResponse(url('/login'));
        }

        // if user's role is admin, let him pass
        if ($request->user()->role->short_description === 'admin') {
            return $next($request);
        }
        return new RedirectResponse(url('/'));
    }
}
