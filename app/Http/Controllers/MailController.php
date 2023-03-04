<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
