<?php

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentsTableSeeder extends Seeder
{

    /**
     * @var Папка с логотипами приложения
     */
    private $logoPath;

    public function __construct(string $logoPath)
    {
        $this->logoPath = $logoPath;
    }

    /**
     * Генерация отделов и логотипов для них
     *
     * @return void
     */
    public function run()
    {
        factory(Department::class, 15)->create()->each(function(Department $department){
            $department->logo = 'logo-' . $department->id . '.png';
            $department->save();
        });

        $files = scandir(__DIR__.'/Departments');

        $i=0;

        foreach ($files as $file) {
            if ($file == '.' || $file == '..') {
                continue;
            }
            $i++;
            copy(__DIR__.'/Departments/' . $file, __DIR__.'/../../resources/logos/logo-'. $i . '.png');
        }
    }
}
