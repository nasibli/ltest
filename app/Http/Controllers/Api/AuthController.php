<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthManager;
use App\Repositories\UserRepository;
use App\Http\Requests\Api\LoginRequest;

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
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        return new JsonResponse($this->auth->guard('web')->attempt($credentials));
    }

    /**
     * Выход текущего пользователя из системы
     * @return bool
     */
    public function logout()
    {
        $this->auth->guard()->logout();
        return  new JsonResponse(true);
    }

    /**
     * Теущий пользователь системы
     *
     * @param UserRepository $userRepository
     * @return \App\Models\User
     */
    public function user(UserRepository $userRepository)
    {
        return $userRepository->getById($this->auth->guard()->id());
    }

}