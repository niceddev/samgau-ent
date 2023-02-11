<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Services\TestService;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $subjects = Subject::with('questionsByGrade')
            ->whereIn('id', $request->input('subjects'))
            ->get();

        auth()->user()->load('subjects')
            ->subjects()->sync($subjects);





        return view('test', compact( 'subjects'));
    }

    public function showFinish(Request $request, TestService $testService)
    {
        dd($request->all());
        $allSeconds = $request->input('timer');
        $minutes = $allSeconds / 60 % 60;
        $seconds = $allSeconds % 60;

        $score = 0;

        $subjects = Subject::with('questionsByGrade')
            ->whereIn('id', json_decode($request->input('subjects')))
            ->get();

        foreach ($subjects as $subject) {
            foreach ($subject->questionsByGrade as $question) {

                $rightAnswers = $question->optionsForTest->where('is_correct', true)->pluck('option')->toArray();
                $userAnswers = $request->input('subject-' . $subject->id . '.questions-' . $question->id);

                $mistakes = array_diff($userAnswers, $rightAnswers);
                $correctAnswers = array_intersect($userAnswers, $rightAnswers);

                $score += $testService->scoreSystem(
                    count($rightAnswers),
                    count($correctAnswers),
                    count($mistakes),
                );
            }
        }

        return view('test_finish',
            compact('subjects', 'score', 'minutes', 'seconds')
        );
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
