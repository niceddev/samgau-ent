<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $subjects = Subject::with('questions')
            ->whereIn('id', $request->input('subjects'))
            ->get();

        auth()->user()->load('subjects')
            ->subjects()->sync($subjects);

        return view('test', compact( 'subjects'));
    }

    public function showFinish(Request $request)
    {
        $score = 0;

        $subjects = Subject::with('questions', 'questions.options')
            ->whereIn('id', json_decode($request->input('subjects')))
            ->get();

        foreach ($subjects as $subject) {
            foreach ($subject->questions->where('grade_number', auth()->user()->grade_number) as $question) {
                foreach ($question->options->where('is_correct', true) as $option) {
                    dump($option);
//                    switch ($question->options->count()) {
//                        case 8:
//                            if(in_array($option->option, $request->input('question-' . $question->id))){
//                                dump(88888888888);
//                                dump($question->options->toArray());
//                                dump($request->all());
//                            }
//                            break;
//                        default:
//                            if(in_array($option->option, $request->input('question-' . $question->id))){
//                                dump(555555555555);
//                                dump($question->options->toArray());
//                                dump($request->all());
//                            }
//                            break;
//                    }

                }
            }
        }

        dd('QQQQQQQQQQQQQQQ');

        return view('test_finish');
    }

    public function showStatistics()
    {
        $test = Test::all();

        return view('statistics', compact( 'test'));
    }

    public function showWorkOnMistakes(Request $request)
    {
        $subjects = Subject::with('questions')
//            ->whereIn('id', $request->input('subjects'))
            ->whereIn('id', [1,2,3,4,5])
            ->get();

        return view('test-work-on-mistakes', compact('subjects'));
    }

}
