<?php

namespace App\Http\Controllers;

use App\Jobs\CreateTestTransactionJob;
use App\Models\Subject;
use App\Models\TestStudentAnswer;
use App\Models\TestSubjectQuestion;
use App\Models\Test;
use App\Models\TestSubject;
use App\Services\TestService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $subjects = Subject::with('questionsByGrade')
            ->whereIn('id', $request->input('subjects'))
            ->get()
            ->map(function ($subject) {
                $subject->questions = match ($subject->id) {
                    1, 3 => $subject->questionsByGrade()
                        ->where('are_many_answers', false)
                        ->take(15)
                        ->get(),
                    2 => $subject->questionsByGrade()
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

        return view('test', compact('subjects'));
    }

    public function showFinish(Request $request, TestService $testService)
    {
        $allSeconds = $request->input('timer');
        $minutes = $allSeconds / 60 % 60;
        $seconds = $allSeconds % 60;

        $subjectIds = json_decode($request->input('subjects'));

        $subjects = Subject::with('questionsByGrade')
            ->whereIn('id', $subjectIds)
            ->get();

        $score = $testService->scoreSystem(
            $subjectIds,
            $request->input('answers')
        );

        CreateTestTransactionJob::dispatch(
            auth()->user()->id,
            $score,
            $subjectIds,
            $request->input('answers')
        );

        return view('test-finish',
            compact('subjects', 'score', 'minutes', 'seconds')
        );
    }

    public function showStatistics()
    {
        $test = Test::all();

        return view('statistics', compact('test'));
    }

    public function showWorkOnMistakes(Request $request)
    {
        $subjects = Subject::with('questions')
//            ->whereIn('id', $request->input('subjects'))
            ->whereIn('id', [1, 2, 3, 4, 5])
            ->get();

        return view('test-work-on-mistakes', compact('subjects'));
    }

}
