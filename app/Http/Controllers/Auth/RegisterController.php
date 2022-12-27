<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Region;
use App\Models\School;
use App\Models\Student;
use App\Providers\RouteServiceProvider;
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
        $student = Student::create([
            'fio'       => $registerRequest->input('fio'),
            'email'     => $registerRequest->input('email'),
            'password'  => Hash::make($registerRequest->input('password')),
            'school_id' => $registerRequest->input('school'),
            'grade_id'  => null,
        ]);

        Auth::login($student);

        return redirect(RouteServiceProvider::HOME);
    }

}
