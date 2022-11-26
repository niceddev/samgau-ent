<?php

namespace App\Http\Controllers;

use App\Models\MustSubject;
use App\Models\Subject;

class SubjectsController extends Controller
{
    public function index()
    {
        $mustSubjects = MustSubject::get();
        $subjects = Subject::get();

        return view('subjects', compact('subjects', 'mustSubjects'));
    }

}
