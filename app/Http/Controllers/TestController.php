<?php

namespace App\Http\Controllers;

use App\Models\MustSubject;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {
        dd($request->input('subjects'));
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
