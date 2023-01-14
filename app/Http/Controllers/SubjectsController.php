<?php

namespace App\Http\Controllers;

use App\Models\Subject;

class SubjectsController extends Controller
{
    public function index()
    {
        $subjects = Subject::get();
        $chosenSubjectIds = auth()->user()->load('subjects')->subjects->pluck('id');

        return view('subjects', compact('subjects', 'chosenSubjectIds'));
    }

}
