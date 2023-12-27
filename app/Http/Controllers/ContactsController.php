<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactsRequest;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ContactsController extends Controller
{
	public function index()
	{
		return view('contacts');
	}

	public function store(ContactsRequest $request)
	{
		$request->validated();

		$mail = new PHPMailer(true);

		try {
			$mail->SMTPDebug = 0;
			$mail->IsSMTP();
			$mail->Host = env('MAIL_HOST');
			$mail->SMTPAuth = true;
			$mail->Username = env('MAIL_USERNAME');
			$mail->Password = env('MAIL_PASSWORD');
			$mail->SMTPSecure = env('MAIL_ENCRYPTION');
			$mail->Port = env('MAIL_PORT');

			$mail->CharSet = "UTF-8";
			$mail->Encoding = 'base64';

			$mail->SetFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
			$mail->AddReplyTo(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));

			$mail->AddAddress($request->email, $request->name);

			$mail->IsHTML(TRUE);

			$mail->Subject = $request->subject;
			$mail->Body    = $request->message;

			$mail->Send();

			return ('Ваше сообщение успешно отправлено!');
		} catch (Exception $error) {
			return ('Ваше сообщение не может быть отправлено! Ошибка: ' . $mail->ErrorInfo);
		}
	}
}
