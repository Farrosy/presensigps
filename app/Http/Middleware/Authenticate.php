<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
class Authenticate extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
protected function redirectTo($request)
{
    if (!$request->expectsJson()) {
        if ($request->is('panel') || $request->is('panel/*')) {
            return route('loginadmin');
        }
        return route('login');
    }
}

}
