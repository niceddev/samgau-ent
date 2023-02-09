<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Option extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'option',
        'question_id',
        'is_correct',
    ];

    public $translatable = [
        'option',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

}
