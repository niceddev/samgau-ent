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
        return $this->hasMany(Question::class)
            ->orderBy('id');
    }

    public function questionsByGrade(?int $subjectId = null)
    {
        $limit = match ($subjectId) {
            1,3 => 15,
            2 => 20,
            default => 35
        };

        return $this->hasMany(Question::class)
            ->where('grade_number', auth()->user()->grade_number)
            ->when('subject_id', function ($query) use ($limit) {
                return $query->take($limit);
            });
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

}
