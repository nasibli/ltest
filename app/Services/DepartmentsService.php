<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Repositories\{DepartmentRepository, UserDepartmentRepository};
use App\Models\Department;

class DepartmentsService
{
    /**
     * @var DepartmentRepository
     */
    private $repository;

    /**
     * @var UserDepartmentRepository
     */
    private $userDepartmentRepository;

    /**
     * Папка для хранения логотипа отдела
     *
     * @var string
     */
    private $logoDir;

    public function __construct(
        DepartmentRepository $repository,
        UserDepartmentRepository $userDepartmentRepository,
        $logoPath
    )
    {
        $this->repository = $repository;
        $this->userDepartmentRepository = $userDepartmentRepository;
        $this->logoDir = $logoPath;
    }

    /**
     * Отдел по id
     *
     * @param int $id
     * @return Department
     */
    public function getById(int $id) : Department
    {
        return $this->repository->getById($id);
    }

    /**
     * Список отделов с постраничным выводом
     *
     * @param int $perPage
     * @return mixed|null|object
     */
    public function getPaginated(int $perPage)
    {
        return $this->repository->getPaginated($perPage);
    }

    /**
     * Добавление или изменение существующего отдела с учетом пользователей
     *
     * @param array $data
     * @param array $users
     * @param int|null $id
     * @param UploadedFile|null $file
     * @return Department
     */
    public function update(array $data, array $users, int $id=null, ?UploadedFile $file) : Department
    {
        if ($file) {
            $this->saveLogo($data, $file, $id);
        }

        $department = $this->repository->update($data, $id);

        if (! $id) {
            $id = $department->id;
        }

        $existingUsers = array_map(
            function ($value) {
                return $value['user_id'];
            },
            $this->userDepartmentRepository->getByDepartment($id)->toArray()
        );

        $usersDelete = array_diff($existingUsers, $users);
        if ($usersDelete) {
            $this->userDepartmentRepository->deleteUsers($id, $usersDelete);
        }

        $usersInsert  = array_diff($users, $existingUsers);
        if ($usersInsert) {
            $this->userDepartmentRepository->insertUsers($id, $usersInsert);
        }

        return $department;
    }

    /**
     * Удаление пользователя
     *
     * @param int $id
     */
    public function delete(int $id) : void
    {
        $this->repository->delete($id);
    }

    /**
     * Сохранение лого с удалением старого
     *
     * @param array $data
     * @param UploadedFile $file
     * @param int|null $id
     */
    private function saveLogo(array &$data, UploadedFile $file, ?int $id=null) : void
    {
        if ($file) {
            $data['logo'] = uniqid('logo-') . '.' . $file->getClientOriginalExtension();

            //если было старое лого, просто удаляем
            if ($id) {
                $oldLogo = $this->repository->getLogo($id);
                if ($oldLogo) {
                    unlink($this->logoDir. '/' . $oldLogo);
                }
            }

            $file->move($this->logoDir,  $data['logo']);
        }
    }

}