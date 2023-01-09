<?php

namespace App\Models;

use Orchid\Platform\Models\User as Authenticatable;

class Student extends Authenticatable
{
    protected $fillable = [
        'fio',
        'email',
        'password',
        'school_id',
        'grade_id',
    ];

    protected $table = 'students';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function grade()
    {
        return $this->hasOne(Grade::class, 'id', 'grade_id');
    }

    public function school()
    {
        return $this->hasOne(School::class, 'id', 'school_id');
    }

}
