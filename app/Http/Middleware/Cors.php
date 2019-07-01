<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /**
     * Добавление необходимых заголовков, чтобы аякс запросы r api.ltest.local
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //@TODO разобраться, как правильней добавить заголовки, т.к. аякс запросы api.test.local не проходят
        header('Access-Control-Allow-Headers: *');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');


        // Код не работает как надо, поэтому и закомментировал))
        /*if ($request->getSchemeAndHttpHost() === config('app.url')) {
            $response = $next($request);
            $response->header('Access-Control-Allow-Headers', '*');
            $response->header('Access-Control-Allow-Origin',  '*');
            $response->header('Access-Control-Allow-Methods', 'GET, PUT, POST, DELETE, OPTIONS');

            return $response;
        }
        */
        return $next($request);
    }
}
