<?php

namespace App\Http\Controllers;

use App\Models\Subject;

class SubjectsController extends Controller
{
    public function index()
    {
        $subjects = Subject::get();

        return view('subjects', compact('subjects'));
    }

}
