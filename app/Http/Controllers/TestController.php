<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {
        dd($request->input('subjects'));
        $subjects = Subject::get();

        $subject = Subject::get()
            ->filter(function($item) {
                return $item->id;
            })->first();


        $questions = Question::where('subject_id', $subject->id)->orderBy('id')->get();

        return view('test', compact('subject', 'subjects', 'questions'));
    }

    public function testFinish()
    {
        return view('test_finish');
    }

}
