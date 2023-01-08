<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $subjects = Subject::get();

        return view('dashboard', compact('subjects'));
    }

}
