<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Http\Requests\Test\TestLoadRequest;
use App\Models\Option;
use App\Models\Subject;
use Illuminate\Database\Eloquent\Collection;

class WorkOnMistakesController extends Controller
{
    public function index(TestLoadRequest $testLoadRequest)
    {
        $subjects = Subject::with('questionsByGrade')
            ->whereIn('id', $testLoadRequest->input('subjects'))
            ->get()
            ->map(function ($subject) use ($testLoadRequest) {

                $subject->questions = $subject->questions
                    ->whereIn('id', explode(',', $testLoadRequest->input('questionIds')['subject-' . $subject->id][0] ?? '') ?? []);

                return $subject;
            });

        $questionIds = $testLoadRequest->input('questionIds');
        $studentAnswers = $testLoadRequest->input('studentAnswers');

        $answersOptions = new Collection();
        foreach ($studentAnswers as &$answer) {
            ksort($answer, SORT_NATURAL);
            for ($i = 0; $i < count($answer); $i++) {
                $answersOptions->push(Option::whereIn('id', array_values($answer)[$i])->get());
            }
        }

        return view('test.work-on-mistakes', compact('subjects', 'questionIds', 'answersOptions'));
    }

}
