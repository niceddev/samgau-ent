<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestSubject extends Model
{
    protected $fillable = [
        'test_id',
        'subject_id',
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function subjectQuestions()
    {
        return $this->hasMany(TestSubjectQuestion::class,  'test_subjects_id', 'id');
    }

}
