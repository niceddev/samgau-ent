<?php

namespace App\Models;

use Orchid\Platform\Models\User as Authenticatable;

class Student extends Authenticatable
{
    protected $table = 'students';

    protected $fillable = [
        'login',
        'password',
        'fio',
        'grade_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function grade()
    {
        return $this->hasOne(Grade::class, 'id', 'grade_id');
    }

}
