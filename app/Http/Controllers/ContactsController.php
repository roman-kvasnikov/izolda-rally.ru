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
			$mail->Host = config('mail.mailers.smtp.host');
			$mail->SMTPAuth = true;
			$mail->Username = config('mail.mailers.smtp.username');
			$mail->Password = config('mail.mailers.smtp.password');
			$mail->SMTPSecure = config('mail.mailers.smtp.encryption');
			$mail->Port = config('mail.mailers.smtp.port');

			$mail->CharSet = "UTF-8";
			$mail->Encoding = 'base64';

			$mail->SetFrom($request->email, $request->name);
			$mail->AddReplyTo($request->email, $request->name);

			$mail->AddAddress(config('mail.from.address'), config('mail.from.name'));

			$mail->IsHTML(TRUE);

			$suject = $request->subject;
			$message = $request->message;

			$suject = trim ( $suject );
			$suject = str_replace( array( '\\', "\0", "\n", "\r", "'", '"', "\x1a" ), array( '\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z' ), $suject );
			$suject = stripslashes ( $suject );
			$suject = str_replace( '\'', "'", $suject );
			$suject = str_replace( '\"', '"', $suject );

			$message = trim( $message );
			$message = str_replace( "\r", '', $message );
			$message = preg_replace( "/\n\n+/", '<br><br>', $message );
			$message = preg_replace( "/\n/", '<br>', $message );
			$message = str_replace( array( '\\', "\0", "\n", "\r", "'", '"', "\x1a" ), array( '\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z' ), $message );
			$message = stripslashes ( $message );
			$message = str_replace( '\'', "'", $message );
			$message = str_replace( '\"', '"', $message );

			$mail->Subject = $suject;
			$mail->Body    = $message;

			$mail->Send();

			return ('Ваше сообщение успешно отправлено!');
		} catch (Exception $error) {
			return ('Ваше сообщение не может быть отправлено! Ошибка: ' . $mail->ErrorInfo);
		}
	}
}
