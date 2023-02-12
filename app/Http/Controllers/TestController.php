<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Question;
use App\Models\Subject;
use App\Services\TestService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $subjects = Subject::with('questionsByGrade')
            ->whereIn('id', $request->input('subjects'))
            ->get()
            ->map(function ($subject) {
                $subject->questions = match ($subject->id) {
                    1, 3    => $subject->questionsByGrade()
                        ->where('are_many_answers', false)
                        ->take(15)
                        ->get(),
                    2       => $subject->questionsByGrade()
                        ->where('are_many_answers', false)
                        ->take(20)
                        ->get(),
                    default => $subject->questionsByGrade()
                        ->where('are_many_answers', true)
                        ->take(10)
                        ->get()
                        ->concat(
                            $subject->questionsByGrade()
                                ->where('are_many_answers', false)
                                ->take(25)
                                ->get()
                        )->shuffle(),
                };
                return $subject;
            });

        auth()->user()->load('subjects')
            ->subjects()->sync($subjects);

        return view('test', compact( 'subjects'));
    }

    public function showFinish(Request $request, TestService $testService)
    {
        $allSeconds = $request->input('timer');
        $minutes = $allSeconds / 60 % 60;
        $seconds = $allSeconds % 60;

        $score = 0;

        $subjects = Subject::with('questionsByGrade')
            ->whereIn('id', json_decode($request->input('subjects')))
            ->get();

        $questionsIds = [];

        foreach (json_decode($request->input('subjects')) as $subjectId) {
            foreach ((array)$request->input('subject-'. $subjectId) as $question => $answers) {
                $questionsIds[] = intval(substr($question, 10));
            }
        }

        $questions = Question::with('options')
            ->whereIn('id', $questionsIds)
            ->get();

        foreach ($questions as $question) {
            $rightAnswers = $question->optionsForTest
                ->where('is_correct', true)
                ->pluck('option')
                ->toArray();

            $userAnswers = $request->input('subject-' . $question->subject_id . '.questions-' . $question->id) ?? [];

            $correctAnswers = array_intersect($userAnswers, $rightAnswers);
            $mistakes = array_diff($userAnswers, $rightAnswers);

            $score += $testService->scoreSystem(
                count($rightAnswers),
                count($correctAnswers),
                count($mistakes),
            );
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
