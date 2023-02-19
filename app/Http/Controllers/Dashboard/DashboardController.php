<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Test;

class DashboardController extends Controller
{
    public function index()
    {
        $studentsSubjects = auth()->user()->load('subjects')->subjects;

        $tests = Test::where('student_id', auth()->user()->id);
        $passedTestsCount = $tests->get()->count();
        $maxScore = $tests->orderByDesc('score')->first()->score ?? 0;
        $averageScore = $tests->avg('score');

        return view('dashboard.dashboard', compact('studentsSubjects', 'passedTestsCount', 'maxScore', 'averageScore'));
    }

}
