<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Test;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $studentsSubjects = auth()->user()->load('subjects')->subjects;

        return view('dashboard', compact('studentsSubjects'));
    }

    public function subject(Subject $subject)
    {
        $tests = Test::where('student_id', auth()->user()->id)->get();

        return view('dashboard-subject', compact('subject', 'tests'));
    }

}
