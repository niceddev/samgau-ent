<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = [
        'local_uuid',
        'student_id',
        'score',
        'duration',
    ];

    public function testSubjects()
    {
        return $this->hasMany(TestSubject::class);
    }

}
