<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthManager;

use App\Repositories\UserRepository;

class AuthController
{
    /** @var AuthManager */
    private $auth;

    public function __construct(AuthManager $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Авторизация по логину и паролю
     *
     * @param Request $request
     * @param UserRepository $userRepository
     * @return JsonResponse
     */
    public function login (Request $request, UserRepository $userRepository)
    {
        $credentials = $request->only('email', 'password');
        return new JsonResponse($this->auth->guard('web')->attempt($credentials));
    }

    /**
     * Выход текущего пользователя из системы
     * @param Request $request
     * @return mixed
     */
    public function logout(Request $request)
    {
        $this->auth->guard()->logout();
        return  new JsonResponse(true);
    }

}