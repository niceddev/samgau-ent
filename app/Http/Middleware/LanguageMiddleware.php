<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LanguageMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if(session()->has('lang')){
            App::setLocale(session()->get('lang'));
        }

        return $next($request);
    }
}
