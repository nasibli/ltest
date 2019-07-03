<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{

    /**
     * Пользователь по id
     *
     * @param int $id
     * @return User
     */
    public function getById(int $id) : User
    {
        return User::where('id', $id)
            ->select(['name', 'surname', 'email'])
            ->get()
            ->first();
    }

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

    /**
     * Список пользователей с постраничным выводом
     *
     * @param int $perPage
     * @return null|object
     */
    public function getPaginated(int $perPage) : ?object
    {
        return User::where('id', '>=', 1)
            ->orderBy('updated_at', 'DESC')
            ->paginate($perPage);
    }

    /**
     * Список всех пользователей
     * @return mixed
     */
    public function getAll()
    {
        return User::select(['id', 'surname', 'name', 'email'])
            ->get();
    }

    /**
     * Добавление или изменение существующего пользователя
     *
     * @param array $data
     * @param int $id
     * @return User
     */
    public function update(array $data, ?int $id=null) : User
    {
        /** @var User $user */
        $user = null;
        if ($id) {
            $user = User::findOrFail($id);
        } else {
            $user = new User();
        }
        $user->fill($data);
        if (isset($data['password']) && !empty($data['password'])) {
            $user->password = bcrypt($data['password']);
        }
        $user->save();
        return $user;
    }

    /**
     * Удаление пользователя
     *
     * @param int $id
     */
    public function delete(int $id) : void
    {
        User::destroy($id);
    }

}