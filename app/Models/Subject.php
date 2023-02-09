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

    public function questionsByGrade()
    {
        return $this->hasMany(Question::class)
            ->where('grade_number', auth()->user()->grade_number)
            ->when(1, function ($query) {
                return $query->whereIn('subject_id', [1,3])->take(15);
            })
//            ->when(1, function ($query) {
//                return $query->where('subject_id', 2)->take(20);
//            })
//            ->when(1, function ($query) {
//                return $query->whereNotIn('subject_id', [1,2,3])->take(35);
//            })
            ->orderBy('id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

}
