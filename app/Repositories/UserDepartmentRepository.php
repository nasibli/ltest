<?php

namespace App\Repositories;

use App\Models\UserDepartment;

class UserDepartmentRepository
{

    /**
     * Список для отдела
     *
     * @param int $departmentId
     * @return array|null
     */
    public function getByDepartment(int $departmentId)
    {
        return UserDepartment::query()
            ->where('department_id', $departmentId)
            ->get();
    }

    /**
     * Удаление пользователей из отдела
     *
     * @param int $departmentId
     * @param array $users
     */
    public function deleteUsers(int $departmentId, array $users) : void
    {
        UserDepartment::where('department_id', $departmentId)
            ->whereIn('user_id', $users)
            ->delete();
    }

    /**
     * Добавление пользователей в отдел
     *
     * @param int $departmentId
     * @param array $users
     */
    public function insertUsers(int $departmentId, array $users) : void
    {
        $insertData = [];
        foreach ($users as $user) {
            $insertData[] = ['department_id' => $departmentId, 'user_id' => $user];
        }
        UserDepartment::insert($insertData);
    }

}