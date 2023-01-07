<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {
        $subjects = Subject::with('questions', 'questions.options')
            ->whereIn('id', $request->input('subjects'))
            ->get();

        return view('test', compact( 'subjects'));
    }

    public function testFinish()
    {
        return view('test_finish');
    }

}
