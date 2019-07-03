<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Closure;

class JsonParse
{
    /**
     * Парсинг параметров запросов, которые были отправлены в виде JSON - стро
     * как вариант, данные были отправлены с фронтенда через FormData
     *
     * @param  Request $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $params = $request->all();

        foreach ($params as $name => $param) {
            if (!empty($param) && (!$param instanceof UploadedFile)) {
                $params[$name] = json_decode($param, true);
            }
        }

        $request->merge($params);
        return $next($request);
    }
}
