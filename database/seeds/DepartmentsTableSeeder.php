<?php

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Генерация отделов
     *
     * @return void
     */
    public function run()
    {
        factory(Department::class, 15)->create();
    }
}
