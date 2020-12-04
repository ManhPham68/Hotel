<?php

namespace App\Http\Controllers;

use App\Mail\NotifyMail;
use App\Mail\NotifyMail2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendEmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $title = $request->title;
        $email = $request->list_email;
        $contents = $request->contents;
        $detail = [
            'title' => $title,
            'contents' => $contents
        ];
        foreach ($email as $item) {
            Mail::to($item)->send(new NotifyMail($detail));

        }
        if (Mail::failures()) {
//            return response()->Fail('Sorry! Please try again latter');
            return response('Sorry! Please try again latter', 500);
        } else {
            return response('Success', 200);
        }
    }
    public function sendEmailFrontend(Request $request)
    {
        $email = $request->email;
        $telephone = $request->telephone;
        $full_name = $request->full_name;
        $detail = [
            'full_name' => $full_name
        ];
        Mail::to($email)->send(new NotifyMail2($detail));
        if (Mail::failures()) {
//            return response()->Fail('Sorry! Please try again latter');
            return response('Sorry! Please try again latter', 500);
        } else {
            return response('Success', 200);
        }
    }
}
