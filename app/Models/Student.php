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
        'grade_number',
        'grade_letter',
    ];

    protected $table = 'students';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function school()
    {
        return $this->hasOne(School::class, 'id', 'school_id');
    }

}
