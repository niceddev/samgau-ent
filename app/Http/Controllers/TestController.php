<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {
//        dd($request->input('subjects'));
        $subjects = Subject::with('questions')->whereIn('id', [1,2,3,4,10])->get();

        return view('test', compact( 'subjects'));
    }

    public function testFinish()
    {
        return view('test_finish');
    }

}
