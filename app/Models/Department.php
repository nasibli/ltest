<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
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
    protected $fillable = ['name', 'logo', 'description'];

    /*
     * Связь с пользователями "Многие ко многим"
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_departments');
    }
}