<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{

    /**
     * Пользователь по почте
     * @param string $email
     * @return User
     */
    public function getByEmail(string $email) : User
    {
        return User::where('email', $email)
            ->get()
            ->first();
    }

}