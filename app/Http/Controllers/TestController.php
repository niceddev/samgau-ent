<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $subjects = Subject::with('questions', 'questions.options')
            ->whereIn('id', $request->input('subjects'))
            ->get();

        return view('test', compact( 'subjects'));
    }

    public function testFinish(Request $request)
    {
        $subjects = Subject::with('questions', 'questions.options')
            ->whereIn('id', json_decode($request->input('subjects')))
            ->get();

        foreach ($subjects as $subject) {
            foreach ($subject->questions as $question) {
                foreach ($question->options->where('is_correct', true) as $option) {

                    if(in_array($option->option, $request->input('question-' . $question->id))){

                        dump($option->option);

                    }

                }
            }
        }

        dd('asd');

        return view('test_finish');
    }

}
