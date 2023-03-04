<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\Test\TestLoadRequest;
use App\Http\Requests\Test\TestRequest;
use App\Jobs\CreateTestTransactionJob;
use App\Models\Subject;
use App\Services\TestService;

class TestController extends Controller
{
    public function index(TestLoadRequest $testLoadRequest)
    {
        if (!is_null($testLoadRequest->input('questionIds'))) {

            $questionIds = $testLoadRequest->input('questionIds');

            $subjects = Subject::with('questionsByGrade')
                ->whereIn('id', $testLoadRequest->input('subjects'))
                ->get()
                ->map(function ($subject) use ($questionIds) {

                    $subject->questions = $subject->questions
                        ->whereIn('id', explode(',', $questionIds['subject-' . $subject->id][0] ?? '') ?? []);

                    return $subject;
                });

            return view('test.test', compact('subjects'));
        }

        $subjects = Subject::with('questionsByGrade')
            ->whereIn('id', $testLoadRequest->input('subjects'))
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

        return view('test.test', compact('subjects'));
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

        return redirect()->route('result', [
            'score'        => $score,
            'allSeconds'   => $allSeconds,
            'subjectIds'   => $subjectIds,
            'answers'      => $testRequest->input('answers'),
            'questionsIds' => $testRequest->input('questionsIds'),
        ]);
    }

}
