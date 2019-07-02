<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

    /**
     * Авторизация для работы с ресурсом "User"
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
        $id = $this->input('id');
        $rules = [
            'email' => 'required|unique:users,email' . ($id ? ',' . $id : '')
        ];
        if (! $id) {
            $rules['password'] = 'required';
        }
        return $rules;
    }

}