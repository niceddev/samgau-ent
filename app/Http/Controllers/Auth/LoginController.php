<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginController
{
    public function create(): View
    {
        return view('login');
    }

    public function store(LoginRequest $loginRequest)
    {
        if (!Auth::guard('ent')->attempt($loginRequest->only('login', 'password'), $loginRequest->boolean('remember'))) {
            return redirect()->back()->withErrors(['message' => __('auth.failed')]);
        }

        $loginRequest->session()->regenerate();

        return redirect('dashboard');
    }

    public function destroy(Request $request)
    {
        Auth::guard('ent')->logout();

        $request->session()->regenerateToken();

        return redirect()->route('login.form');
    }
}
