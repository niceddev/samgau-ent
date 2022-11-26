<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MustSubject extends Model
{
    use HasTranslations;

    protected $fillable = [
        'image_path',
        'name',
    ];

    public $translatable = [
        'name',
    ];

}
