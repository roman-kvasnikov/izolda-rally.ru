<?php

namespace App\Services\Orders\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderDetailsRequest extends FormRequest
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
			'last_name'			=> 'required|string|min:2|max:20',
			'first_name'		=> 'required|string|min:2|max:20',
			'middle_name'		=> 'required|string|min:2|max:20',
			'email'				=> 'required|string|email:rfc,dns',
			'phone'				=> 'required|string|regex:/^\+[\d]{1}\ \([\d]{3}\)\ [\d]{3}-[\d]{2}-[\d]{2}$/',

			'delivery_method'	=> 'required|in:cdek,pochta',
			'postal_code'		=> 'nullable|digits:6|required_if:delivery_method,pochta',
			'region'			=> 'nullable|string|min:3|max:20|required_if:delivery_method,pochta',
			'city'				=> 'nullable|string|min:3|max:20|required_if:delivery_method,cdek,pochta',
			'address'			=> 'nullable|string|min:10|max:100|required_if:delivery_method,pochta',
			'cdek_address'		=> 'nullable|string|min:10|max:100|required_if:delivery_method,cdek',

			'note'				=> 'nullable|string|min:10|max:1000',
		];
	}

	public function messages()
	{
		return [
			'last_name.required' => 'Введите пожалуйста вашу фамилию!',
			'first_name.required' => 'Введите пожалуйста ваше имя!',
			'middle_name.required' => 'Введите пожалуйста ваше отчество!',
			'email.required' => 'Введите пожалуйста ваш E-Mail!',
			'phone.required' => 'Введите пожалуйста ваш номер телефона!',
			'delivery_method.required' => 'Выберите пожалуйста способ доставки!',

			'postal_code.required_if' => 'Введите пожалуйста ваш почтовый индекс!',
			'region.required_if' => 'Введите пожалуйста ваш регион!',
			'city.required_if' => 'Введите пожалуйста ваш город!',
			'address.required_if' => 'Введите пожалуйста ваш адрес!',
			'cdek_address.required_if' => 'Введите пожалуйста адрес ближайшего пункта СДЭК!',

			'last_name.min' => 'Ваша фамилия должна содержать больше 2 символов!',
			'last_name.max' => 'Ваша фамилия не должна содержать больше 20 символов!',
			'first_name.min' => 'Ваше имя должно содержать больше 2 символов!',
			'first_name.max' => 'Ваше имя не должно содержать больше 20 символов!',
			'middle_name.min' => 'Ваше отчество должно содержать больше 2 символов!',
			'middle_name.max' => 'Ваше отчество не должно содержать больше 20 символов!',
			'email.email' => 'Не верный формат E-Mail!',
			'phone.regex' => 'Не верный формат номера телефона!',

			'postal_code.digits' => 'Ваш почтовый индекс должен содержать 6 цифр!',
			'region.min' => 'Ваш регион должен содержать больше 3 символов!',
			'region.max' => 'Ваш регион не должен содержать больше 20 символов!',
			'city.min' => 'Ваш город должен содержать больше 3 символов!',
			'city.max' => 'Ваш город не должен содержать больше 20 символов!',
			'address.min' => 'Ваш адрес должен содержать больше 10 символов!',
			'address.max' => 'Ваш адрес не должен содержать больше 100 символов!',
			'cdek_address.min' => 'Адрес пункта СДЭК должен содержать больше 10 символов!',
			'cdek_address.max' => 'Адрес пункта СДЭК не должен содержать больше 100 символов!',

			'note.min' => 'Ваше примечание должно содержать больше 10 символов!',
			'note.max' => 'Ваше примечание не должно содержать больше 1000 символов!',
		];
	}
}
