<?php

namespace App\Models;

use App\Enums\AnswerOption;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Question extends Model
{
    use HasTranslations;

    protected $fillable = [
        'question',
        'sub_question',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'option_e',
        'correct_answer',
        'subject_id',
    ];

    public $translatable = [
        'question',
        'sub_question',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'option_e',
    ];

    protected $casts = [
        'correct_answer' => AnswerOption::class,
    ];

}
