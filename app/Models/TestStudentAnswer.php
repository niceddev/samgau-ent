<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestStudentAnswer extends Model
{
    protected $fillable = [
        'test_id',
        'test_subject_question_id',
        'option_id',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

}
