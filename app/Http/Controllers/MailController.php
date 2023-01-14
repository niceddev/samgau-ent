<?php

namespace App\Http\Controllers;

use App\Mail\RegisterConfirmationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendCode(Request $request)
    {
        dd($request->all());

//        Mail::to()
//            ->send(new RegisterConfirmationMail($request));

//        return redirect()->back();
    }

}
