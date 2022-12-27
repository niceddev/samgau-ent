<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = [
        'title',
    ];

    public function schools()
    {
        return $this->hasMany(School::class);
    }

}
