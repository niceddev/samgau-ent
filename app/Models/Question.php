<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Question extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'question',
        'sub_question',
        'grade_number',
        'grade_letter',
        'subject_id',
        'topic',
        'are_many_answers'
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

    public function optionsForTest()
    {
        return $this->hasMany(Option::class)
            ->where('option','!=', '{"kk":null}')
            ->orderBy('id');
    }

    public function scopeByGradeNumber($query)
    {
        return $query->where('grade_number', auth()->user()->grade_number);
    }

}
