<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = [
        'title',
        'region_id',
    ];

    public function schools()
    {
        return $this->belongsTo(Region::class, 'id', 'id');
    }

}
