<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\DetailedDashboardRequest;
use App\Models\Subject;
use App\Models\Test;
use App\Models\TestSubject;
use Illuminate\Support\Carbon;

class DetailedController extends Controller
{
    public function index(DetailedDashboardRequest $detailedDashboardRequest)
    {
        $subject = Subject::query()
            ->where('id', $detailedDashboardRequest->input('subject-id'))
            ->first();

        $allTests = TestSubject::query()
            ->with('test')
            ->where('subject_id', $detailedDashboardRequest->input('subject-id'))
            ->get();

        $latestTestId = Test::query()
            ->select('id')
            ->where('student_id', auth()->user()->id)
            ->whereBetween('created_at', [
                Carbon::parse($detailedDashboardRequest->input('date'))->startOfDay(),
                Carbon::parse($detailedDashboardRequest->input('date'))->endOfDay()
            ])
            ->pluck('id')
            ->first();

        $latestTestSubject = TestSubject::query()
            ->with(['subjectQuestions.question.options', 'subjectQuestions.test.studentId'])
            ->where('test_id', $latestTestId)
            ->where('subject_id', $detailedDashboardRequest->input('subject-id'))
            ->first();

        $dates = collect();
        for ($i = 1; $i <= 12; $i++) {
            $dates->push((object)[
                'month' => Carbon::now()->month($i)->monthName,
                'year' => Carbon::now()->format('Y'),
                'days' => Carbon::now()->month($i)->daysInMonth
            ]);
        }

        return view('dashboard.detailed', compact('allTests', 'subject', 'latestTestSubject', 'dates'));
    }
}
