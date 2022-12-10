<?php

namespace App\Http\Controllers;

use App\Models\MustSubject;
use App\Models\Question;
use App\Models\Subject;

class TestController extends Controller
{
    public function index(int $id)
    {
        $subjects = collect([Subject::get(), MustSubject::get()])->flatten();

        $subject = collect([Subject::get(), MustSubject::get()])
            ->flatten()
            ->filter(function($item) use($id) {
                return $item->id == $id;
            })->first();


        $questions = Question::where('subject_id', $subject->id)->orderBy('id')->get();

        return view('test', compact('subject', 'subjects', 'questions'));
    }

}
