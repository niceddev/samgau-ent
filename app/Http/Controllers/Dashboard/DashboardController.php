<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Test;

class DashboardController extends Controller
{
    public function index()
    {
        $studentsSubjects = auth()->user()->load('subjects')->subjects;

        $test = Test::where('student_id', auth()->user()->id);
        $passedTestsCount = $test->get()->count();
        $maxScore = $test->orderByDesc('score')->first()->score ?? 0;
        $averageScore = $test->avg('score');

        return view('dashboard', compact('studentsSubjects', 'passedTestsCount', 'maxScore', 'averageScore'));
    }

}
