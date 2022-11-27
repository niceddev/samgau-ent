<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\App;

class MultiLanguageController extends Controller
{
    public function changeLanguage(string $lang)
    {
        App::setLocale($lang);
        session()->put('lang', $lang);

        return redirect()->back();
    }

}
