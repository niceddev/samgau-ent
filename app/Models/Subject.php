<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Subject extends Model
{
    use HasTranslations;

    protected $fillable = [
        'image_path',
        'color',
        'name',
        'required',
        'siblings',
    ];

    public $translatable = [
        'name',
    ];

    protected $casts = [
        'siblings' => 'array'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('id');
    }

}
