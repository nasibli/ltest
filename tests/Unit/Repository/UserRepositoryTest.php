<?php

namespace Tests\Unit\Repository;

use Tests\TestCase;

use App\Repositories\UserRepository;
use App\Models\User;

class UserRepositoryTest extends TestCase
{
    /**
     * Пользователь по ID
     */
    public function testGetById()
    {
        $user = app(UserRepository::class)->getById(1);

        $this->assertNotEmpty($user);
        $this->assertEquals($user->name, 'Admin');
        $this->assertEmpty($user->surname);
        $this->assertEquals($user->email, 'admin@test.loc');
    }


    /**
     * Создание нового пользователя
     *
     * @return mixed
     */
    public function testUpdate()
    {
        $data = ['name' => 'Ivan', 'surname' => 'Ivanov', 'email' => 'ivan@mail.ru', 'password' => 'password!'];
        $user = app(UserRepository::class)->update($data);

        $this->assertIsInt($user->id);
        $this->assertGreaterThan(0, $user->id);


        $this->assertDatabaseHas('users', [
            'name'    => $data['name'],
            'surname' => $data['surname'],
            'email'   => $data['email'],
        ]);

        return $user;
    }

    /**
     * Удаление пользователя
     *
     * @depends testUpdate
     * @param User $user
     */
    public function testDelete($user)
    {
        $id = $user->id;
        $this->assertDatabaseHas('users', ['id' => $id]);

        app(UserRepository::class)->delete($id);

        $this->assertDatabaseMissing('users', ['id' => $id]);
    }

    /**
     * Потсраничный вывод
     */
    public function testGetPaginated()
    {
        $pagination = app(UserRepository::class)->getPaginated(6);

        $this->assertIsObject($pagination);
        $this->assertCount(6, $pagination);
        $this->assertEquals(1, $pagination->currentPage());
        $this->assertEquals($pagination->perPage(), 6);

    }

}