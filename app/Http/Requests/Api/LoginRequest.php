<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Авторизация для использования валидатора (не нужна)
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Правила валидации при входе в систему
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'email'    => 'required|email',
            'password' => 'required'
        ];
    }
}
