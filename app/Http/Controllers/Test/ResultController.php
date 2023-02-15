<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResultRequest;
use App\Models\Subject;

class ResultController extends Controller
{
    public function index(ResultRequest $resultRequest)
    {
//        $lastTest = Test::with(['testSubjects', 'testSubjects.subjectQuestions', 'testSubjects.subjectQuestions.studentAnswers'])
//            ->where('student_id', auth()->user()->id)
//            ->latest()->first();
//
        $subjects = Subject::with('questionsByGrade')
            ->whereIn('id', $resultRequest->input('subjectIds'))
            ->get()
            ->map(function ($subject) {
                $subject->asd


            });


        $questions = $resultRequest->input('answers'));


//        $test = Test::where()->get();

        $minutes = 9 / 60 % 60;
        $seconds = 9 % 60;
        $score = 1;

        return view('results',
            compact('subjects', 'score', 'minutes', 'seconds')
        );
    }

}
