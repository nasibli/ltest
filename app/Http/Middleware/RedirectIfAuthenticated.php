<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RedirectIfAuthenticated
{
    /**
     * Перенаправляем авторизованного пользователя на страницу приложения, если он зашел на страницу входа в систему
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Routing\Route|mixed|object|string
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard()->check()) {
            if ($request->route()->getName() == 'login') {
                return redirect()->route('app');
            }
        }

        return $next($request);
    }
}
