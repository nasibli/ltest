<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\{Auth,Route};
use Illuminate\Http\Request;
use Illuminate\Auth\AuthManager;
use Illuminate\Routing\Router;

class Authenticate
{

    /**
     * @var AuthManager
     */
    private $auth;

    /**
     * @var Router
     */
    private $router;

    public function __construct(AuthManager $auth, Router $router)
    {
        $this->auth = $auth;
        $this->router = $router;
    }

    /**
     * Проверка на наличие авторизации, и перенаправление, если есть необходимость
     *
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (! $this->auth->check() && ! strpos($this->router->currentRouteAction(), '@login')) {
            return redirect()->route('login');
        } else if ($this->auth->check() && strpos($this->router->currentRouteAction(), '@login')) {
            return redirect()->route('app');
        }

        return $next($request);
    }
}
