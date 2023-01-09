<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Region;
use App\Models\School;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisterController
{
    public function create(): View
    {
        $regions = Region::with('schools')->get();
        $schools = School::get();

        return view('register', compact('schools', 'regions'));
    }

    public function store(RegisterRequest $registerRequest)
    {
        dd($registerRequest->all());
        $student = Student::create([
            'fio'       => $registerRequest->input('fio'),
            'email'     => $registerRequest->input('email'),
            'password'  => Hash::make($registerRequest->input('password')),
            'school_id' => $registerRequest->input('school'),
            'grade_id'  => $registerRequest->input('grade_number') . '-' . $registerRequest->input('grade_letter'),
        ]);

        Auth::login($student);

        return redirect()->route('login.form')->with('success', __('auth.successfully_registered'));
    }

}
