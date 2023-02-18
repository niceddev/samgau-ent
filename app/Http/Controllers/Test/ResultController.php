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
//        $lastTest = Test::with(['testSubjects', 'testSubjects.subjectQuestions', 'testSubjects.subjectQuestions.studentAnswers'])
//            ->where('student_id', auth()->user()->id)
//            ->latest()->first();
//

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


//        $questions = $resultRequest->input('answers');


//        $test = Test::where()->get();

        $minutes = 9 / 60 % 60;
        $seconds = 9 % 60;
        $score = 1;

        return view('results',
            compact('subjects', 'score', 'minutes', 'seconds')
        );
    }

}
