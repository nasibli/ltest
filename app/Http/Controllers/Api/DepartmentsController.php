<?php

namespace App\Http\Controllers\Api;

use App\Services\DepartmentsService;
use App\Models\Department;
use Illuminate\Http\{JsonResponse, Request};
use App\Http\Requests\Api\DepartmentRequest;

class DepartmentsController
{
    /**
     * @var DepartmentsService
     */
    private $service;

    public function __construct(DepartmentsService $service)
    {
        $this->service = $service;
    }

    /**
     * Список отделов с постраничным выводом
     *
     * @param Request $request
     * @return mixed|null|object
     */
    public function index(Request $request) : ?object
    {
        return $this->service->getPaginated($request->get('per_page'));
    }

    /**
     * Отдел по Id, включая пользователей
     *
     * @param int $id
     * @return Department
     */
    public function get(int $id) : Department
    {
        return $this->service->getById($id);
    }


    /**
     * Создание нового или удаление существующего отдела с учетом пользователей
     *
     * @param DepartmentRequest $request
     * @param int|null $id
     * @return JsonResponse
     */
    public function update(DepartmentRequest $request, int $id=null) : JsonResponse
    {
        $this->service->update(
            $request->input('department'),
            $request->input('users'),
            $id,
       $request->hasFile('file') ? $request->file('file') : null
        );

        return new JsonResponse(true);
    }

    /**
     * Удаление отдела
     *
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id) : JsonResponse
    {
        $this->service->delete($id);
        return new JsonResponse(true);
    }

}