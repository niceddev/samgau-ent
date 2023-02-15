<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestRequest;
use App\Jobs\CreateTestTransactionJob;
use App\Models\Subject;
use App\Services\TestService;
use Illuminate\Http\Request;

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

    public function store(TestRequest $testRequest, TestService $testService)
    {
        $allSeconds = $testRequest->input('timer');
        $subjectIds = json_decode($testRequest->input('subjects'));

        $score = $testService->scoreSystem(
            $subjectIds,
            $testRequest->input('answers')
        );

        CreateTestTransactionJob::dispatch(
            auth()->user()->id,
            $score,
            $allSeconds,
            $subjectIds,
            $testRequest->input('answers')
        );

        return redirect()->route('results.index', [
            'score'      => $score,
            'allSeconds' => $allSeconds,
            'subjectIds' => $subjectIds,
            'answers'    => $testRequest->input('answers'),
        ]);
    }

}
