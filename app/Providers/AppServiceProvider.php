<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('App\Services\DepartmentsService', function ($app) {
            return new \App\Services\DepartmentsService(
                $app->get('App\Repositories\DepartmentRepository'),
                $app->get('App\Repositories\UserDepartmentRepository'),
                base_path() . '/' . config('app.logo_path')
            );
        });

        $this->app->bind('DepartmentsTableSeeder', function () {
            return new \DepartmentsTableSeeder(base_path() . '/' . config('app.logo_path'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Новый валидатор для валидация массива целых чисел
        \Illuminate\Support\Facades\Validator::extend(
            'arrayint',
            function ($attribute, $param, $parameters) {
                foreach ($param as $value) {
                    if (!is_int($value)) {
                        return false;
                    }
                }

                return true;
            },
            'Must be array of integer values'
        );
    }
}
