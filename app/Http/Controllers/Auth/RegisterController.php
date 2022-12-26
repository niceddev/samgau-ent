<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Student;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class RegisterController
{
    public function create(): View
    {
        return view('register');
    }

    public function store(RegisterRequest $registerRequest)
    {
        $student = Student::create([
            'fio'      => $registerRequest->input('fio'),
            'email'    => $registerRequest->input('email'),
            'password' => Hash::make($registerRequest->input('password')),
            'school'   => $registerRequest->input('school'),
            'grade_id' => null,
        ]);

        Auth::login($student);

        return redirect(RouteServiceProvider::HOME);
    }

}
