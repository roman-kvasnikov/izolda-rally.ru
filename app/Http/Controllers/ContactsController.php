<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactsRequest;
use App\Mail\ContactsMail;
use Illuminate\Support\Facades\Mail;

class ContactsController extends Controller
{
    public function index()
    {
        return view('contacts');
    }

    public function send(ContactsRequest $request)
    {
        $validated = $request->validated();

        $subject = $validated['subject'];
        $message = $validated['message'];

        $subject = str_replace(['\\', "\0", "\n", "\r", "'", '"', "\x1a"], ['\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'], $subject);
        $subject = stripslashes($subject);
        $subject = str_replace('\'', "'", $subject);
        $subject = str_replace('\"', '"', $subject);

        $message = str_replace("\r", '', $message);
        $message = preg_replace("/\n\n+/", '<br><br>', $message);
        $message = preg_replace("/\n/", '<br>', $message);
        $message = str_replace(['\\', "\0", "\n", "\r", "'", '"', "\x1a"], ['\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'], $message);
        $message = stripslashes($message);
        $message = str_replace('\'', "'", $message);
        $message = str_replace('\"', '"', $message);

        $mail = new ContactsMail([
            'subject' => $subject,
            'from' => [
                'email' => $validated['email'],
                'name' => $validated['name'],
            ],
            'replyTo' => [
                'email' => $validated['email'],
                'name' => $validated['name'],
            ],
            'message' => $message,
        ]);

        Mail::to(config('mail.from.address'), config('mail.from.name'))->send($mail);
    }
}
