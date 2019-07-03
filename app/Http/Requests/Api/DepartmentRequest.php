<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
{
    /**
     * Авторизация для работы с ресурсом (не нужна)
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }

    /**
     * Валидация при работе с пользователями
     *
     * @return array
     */
    public function rules() : array
    {
        $rules =  [
            'department.name'  => 'required',
            'users' => 'arrayint'
        ];
        if ($this->hasFile('file')) {
            $rules['file'] = 'max:100000|mimes:png,ico,svg';
        }
        return $rules;
    }
}
