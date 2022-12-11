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
    ];

    public $translatable = [
        'name',
    ];

}
