<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $studentsSubjects = auth()->user()->load('subjects')->subjects;

        return view('dashboard', compact('studentsSubjects'));
    }

    public function showDetailed(Request $request)
    {
        $subject = Subject::where('id', $request->input('subject-id'))->first();
        $tests = Test::where('student_id', auth()->user()->id)->get();

        $dates = collect();
        for ($i = 1; $i <= 12; $i++) {
            $dates->push((object)[
                'month' => Carbon::now()->month($i)->monthName,
                'year' => Carbon::now()->format('Y'),
                'days' => Carbon::now()->month($i)->daysInMonth
            ]);
        }

        return view('dashboard-subject', compact('subject', 'tests', 'dates'));
    }

}
