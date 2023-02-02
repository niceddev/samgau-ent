<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Question extends Model
{
    use HasTranslations;

    protected $fillable = [
        'question',
        'sub_question',
        'grade_number',
        'grade_letter',
        'subject_id',
        'topic',
    ];

    public $translatable = [
        'question',
        'sub_question',
        'topic',
    ];

    public function options()
    {
        return $this->hasMany(Option::class)->orderBy('id');
    }

}
