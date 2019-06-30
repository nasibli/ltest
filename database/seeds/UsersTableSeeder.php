<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Генерация пользователей
     *
     * @return void
     */
    public function run() : void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@test.loc',
            'password' => bcrypt('secret'),
        ]);

        factory(User::class, 15)->create();
    }
}
