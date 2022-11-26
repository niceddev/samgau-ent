<?php

namespace App\Http\Controllers;

use App\Models\MustSubject;
use App\Models\Subject;
use Illuminate\Support\Facades\App;

class SubjectsController extends Controller
{
    public function index()
    {
        $mustSubjects = MustSubject::get();
        $subjects = Subject::get();

        return view('subjects', compact('subjects', 'mustSubjects'));
    }

    public function changeLanguage(string $lang)
    {
        App::setLocale($lang);
        session()->put('lang', $lang);

        return redirect()->back();
    }

}
