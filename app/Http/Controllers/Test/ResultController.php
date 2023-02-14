<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Test;

class ResultController extends Controller
{
    public function index()
    {
        dd(auth()->user());

        $subjects = Subject::with('questionsByGrade')
            ->whereIn('id', $subjectIds)
            ->get();

        $test = Test::where()->get();

        $minutes = $allSeconds / 60 % 60;
        $seconds = $allSeconds % 60;

        return view('test-finish',
            compact('subjects', 'score', 'minutes', 'seconds')
        );
    }

}
