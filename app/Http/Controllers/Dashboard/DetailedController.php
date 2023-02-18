<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\DetailedDashboardRequest;
use App\Models\Subject;
use App\Models\Test;
use Illuminate\Support\Carbon;

class DetailedController extends Controller
{
    public function index(DetailedDashboardRequest $detailedDashboardRequest)
    {
        $subject = Subject::where('id', $detailedDashboardRequest->input('subject-id'))->first();
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
