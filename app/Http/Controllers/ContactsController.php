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
		$request->validated();

		$subject = $request->subject;
		$message = $request->message;

		$subject = str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $subject);
		$subject = stripslashes($subject);
		$subject = str_replace('\'', "'", $subject);
		$subject = str_replace('\"', '"', $subject);

		$message = str_replace("\r", '', $message);
		$message = preg_replace("/\n\n+/", '<br><br>', $message);
		$message = preg_replace("/\n/", '<br>', $message);
		$message = str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $message);
		$message = stripslashes($message);
		$message = str_replace('\'', "'", $message);
		$message = str_replace('\"', '"', $message);

		$mail = new ContactsMail([
			'subject' => $request->subject,
			'from' => [
				'email' => $request->email,
				'name' => $request->name
			],
			'replyTo' => [
				'email' => $request->email,
				'name' => $request->name
			],
			'message' => $message
		]);

		Mail::to(config('mail.from.address'), config('mail.from.name'))->send($mail);
	}
}
