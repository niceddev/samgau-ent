<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    protected $fillable = [
        'subject_question_id',
        'answers',
        'test_id',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
