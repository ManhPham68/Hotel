<?php

namespace App\Http\Controllers;

use App\Mail\NotifyMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $request->validate([
            'email' => 'required'
        ]);
        $title = $request->title;
        $email = $request->email;
        $contents = $request->contents;
        $detail = [
            'title' => $title,
            'email' => $email,
            'contents' => $contents
        ];
        Mail::to($email)->send(new NotifyMail($detail));
        if (Mail::failures()) {
//            return response()->Fail('Sorry! Please try again latter');
            return response('Sorry! Please try again latter', 500);
        } else {
            return response('Success', 200);
        }

    }

}
