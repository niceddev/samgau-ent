<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestSubjectQuestion extends Model
{
    protected $fillable = [
        'test_id',
        'test_subjects_id',
        'subject_id',
        'question_id',
    ];

    public function test()
    {
        return $this->belongsTo(Test::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function studentAnswers()
    {
        return $this->hasOne(TestStudentAnswer::class);
    }

    public function testSubjects()
    {
        return $this->belongsTo(TestSubject::class);
    }

}
