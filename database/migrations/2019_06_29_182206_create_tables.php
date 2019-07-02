<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration
{
    /**
     * Создание таблиц: пользователи, отделы и промежуточная таблица
     * @return void
     */
    public function up() : void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 50);
            $table->string('surname', 50)->nullable(true);
            $table->string('email', '100')->unique();
            $table->string('password', '100');
            $table->timestamps();
        });

        Schema::create('departments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', '2000');
            $table->string('logo', 200)->nullable(true);
            $table->text('description')->nullable(true);
            $table->timestamps();
        });

        Schema::create('user_departments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->default(0);
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('department_id')->unsigned()->default(0);
            $table->foreign('department_id')->references('id')->on('departments');
            $table->timestamps();
        });
    }

    /**
     * Удаление таблиц
     * @return void
     */
    public function down() : void
    {
        Schema::dropIfExists('user_departments');
        Schema::dropIfExists('users');
        Schema::dropIfExists('departments');
    }
}
