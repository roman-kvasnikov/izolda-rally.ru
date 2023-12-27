<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactsRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 */
	public function authorize(): bool
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
	 */
	public function rules(): array
	{
		return [
			'name'		=> 'required|string|min:5|max:100',
			'email'		=> 'required|string|email:rfc,dns',
			'subject'	=> 'required|string|min:10|max:200',
			'message'	=> 'required|string|min:100|max:10000'
		];
	}

	public function messages()
	{
		return [
			'name.required' => 'Введите пожалуйста свое полное Имя!',
			'email.required' => 'Введите пожалуйста ваш E-Mail!',
			'subject.required' => 'Введите пожалуйста ваше сообщение!',
			'message.required' => 'Введите пожалуйста ваше сообщение!',

			'name.min' => 'Ваше полное Имя должно содержать больше 5 символов!',
			'name.max' => 'Ваше полное Имя должно содержать не больше 100 символов!',
			'email.email' => 'Не верный формат E-Mail!',
			'subject.min' => 'Тема сообщения должна содержать больше 10 символов!',
			'subject.max' => 'Тема сообщения должна содержать не больше 200 символов!',
			'message.min' => 'Ваше сообщение должно содержать больше 100 символов!',
			'message.max' => 'Ваше сообщение должно содержать не больше 10000 символов!'
		];
	}
}
