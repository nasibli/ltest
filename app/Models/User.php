<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Конвертация даты в php datetime
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Поля, разрешенные для автоматического заполнения
     *
     * @var array
     */
    protected $fillable = ['name', 'surname', 'email'];
}
