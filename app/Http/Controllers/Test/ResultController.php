<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResultRequest;
use App\Models\Question;
use App\Models\Subject;
use App\Services\TestService;

class ResultController extends Controller
{
    public function index(ResultRequest $resultRequest, TestService $testService)
    {
        $studentAnswers = $resultRequest->input('answers');
        $questionIds = $resultRequest->input('questionsIds');

        $subjects = Subject::with('questionsByGrade')
            ->whereIn('id', $resultRequest->input('subjectIds'))
            ->get()
            ->map(function ($subject) use ($resultRequest, $testService) {
                $idsArray = $resultRequest->input('questionsIds.subject-' . $subject->id);

                $subject->questions = Question::whereIn('id', $idsArray ? explode(',', $idsArray[0]) : [])->get();
                $subject->score = $testService->scoreSystem(
                    [$subject->id],
                    $resultRequest->input('answers')
                );

                return $subject;
            });

        $minutes = 9 / 60 % 60;
        $seconds = 9 % 60;
        $score = 1;

        return view('test.results',
            compact('subjects', 'score', 'minutes', 'seconds', 'questionIds', 'studentAnswers')
        );
    }

}
