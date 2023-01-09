<?php

namespace App\Http\Controllers;

use App\Models\Student;

class ProfileController extends Controller
{
    public function index()
    {
        $student = Student::with('school', 'grade')
            ->where('id', auth()->user()->id)
            ->first();

        return view('profile', compact('student'));
    }

}
