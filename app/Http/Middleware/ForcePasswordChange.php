<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ForcePasswordChange
{
    public function handle(Request $request, Closure $next): Response
    {
        if (
            Auth::check()
            && Auth::user()->must_change_password
            && !$request->routeIs('profile.edit')
            && !$request->routeIs('profile.update')
            && !$request->routeIs('profile.password')
            && !$request->routeIs('logout')
        ) {
            return redirect()
                ->route('profile.edit')
                ->with('warning', 'Votre mot de passe a été réinitialisé par un administrateur. Vous devez le modifier avant de continuer.'
                );
        }

        return $next($request);
    }
}