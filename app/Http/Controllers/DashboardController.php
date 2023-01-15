<?php

namespace App\Http\Controllers;

use App\Models\Subject;
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

        return view('dashboard-subject', compact('subject'));
    }

}
