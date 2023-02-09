<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectQuestion extends Model
{
    protected $fillable = [
        'test_subject_id',
        'question_id',
        'test_id',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
