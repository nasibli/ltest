<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Http\Requests\Api\UserRequest;
use App\Models\User;

class UsersController
{

    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

    /**
     * Список всех пользователей или постраничный вывод
     *
     * @param Request $request
     * @return array|object
     */
    public function index(Request $request)
    {
        if ($request->has('per_page')) {
            return $this->repository->getPaginated($request->input('per_page'));
        } else {
            return $this->repository->getAll();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return User
     */
    public function get(int $id)
    {
        return $this->repository->getById($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, ?int $id=null)
    {
        $this->repository->update($request->all(), $id);
        return new JsonResponse(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(int $id)
    {
        $this->repository->delete($id);
        return new JsonResponse(true);
    }
}
