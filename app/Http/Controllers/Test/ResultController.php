<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Test;

class ResultController extends Controller
{
    public function index()
    {
        $lastTest = Test::with(['testSubjects', 'testSubjects.subjectQuestions', 'testSubjects.subjectQuestions.studentAnswers'])
            ->where('student_id', auth()->user()->id)
            ->latest()->first();

        dd($lastTest);

        $subjects = Subject::with('questionsByGrade')
            ->whereIn('id', $subjectIds)
            ->get();

        $test = Test::where()->get();

        $minutes = $allSeconds / 60 % 60;
        $seconds = $allSeconds % 60;

        return view('results',
            compact('subjects', 'score', 'minutes', 'seconds')
        );
    }

}
