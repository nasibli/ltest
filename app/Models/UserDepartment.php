<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserDepartment extends Pivot
{

    /**
     * Имя таблицы в базе данных
     *
     * @var string
     */
    protected $table = 'user_departments';

}