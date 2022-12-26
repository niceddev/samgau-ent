<?php

namespace App\Models;

use Orchid\Platform\Models\User as Authenticatable;

class Student extends Authenticatable
{
    protected $fillable = [
        'fio',
        'email',
        'password',
        'school',
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

}
