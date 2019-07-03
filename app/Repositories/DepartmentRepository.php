<?php
/**
 * Created by PhpStorm.
 * User: nasibli
 * Date: 02.07.19
 * Time: 18:10
 */

namespace App\Repositories;
use App\Models\Department;

class DepartmentRepository
{

    /**
     * Отдел по id с относящимися к нему пользователями
     *
     * @param int $id
     * @return Department
     */
    public function getById(int $id) : Department
    {
        return Department::select('departments.*')
            ->with('users:users.id,users.name,users.surname,users.email')
            ->where('id', $id)
            ->first();
    }

    /**
     * Имя файла логотипа отдела
     *
     * @param $id
     * @return mixed
     */
    public function getLogo($id)
    {
        return Department::select('logo')
            ->where('id', $id)
            ->first()
            ->logo;
    }

    /**
     * Список отделов с постраничным выводом
     * @param int $perPage
     * @return mixed
     */
    public function getPaginated(int $perPage) : ?object
    {
        return Department::select('departments.*')
            ->with('users:users.id,users.name,users.surname,users.email')
            ->orderBy('departments.updated_at', 'DESC')
            ->paginate($perPage);
    }

    /**
     * Добавление или изменение существующего отдела
     *
     * @param array $data
     * @param int|null $id
     * @return Department
     */
    public function update(array $data, ?int $id=null) : Department
    {
        $department = null;
        if ($id) {
            $department = Department::findOrFail($id);
        } else {
            $department = new Department();
        }

        $department->fill($data);
        $department->save();

        return $department;
    }

    /**
     * Удаление отдела
     *
     * @param int $id
     */
    public function delete(int $id) : void
    {
        Department::destroy($id);
    }

}