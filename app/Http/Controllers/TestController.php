<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Subject;

class TestController extends Controller
{
    public function index(Subject $subject)
    {
        $subjects = Subject::get();
        $questions = Question::where('subject_id', $subject->id)->orderBy('id')->get();

        return view('test', compact('subject', 'subjects', 'questions'));
    }

}
