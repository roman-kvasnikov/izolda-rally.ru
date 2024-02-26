<?php

namespace App\Http\Requests;

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
            'full_name' => 'required|string|min:10|max:100',
            'email' => 'required|string|email:rfc,dns',
            'phone' => 'required|string|regex:/^\+[\d]{1}\ \([\d]{3}\)\ [\d]{3}-[\d]{2}-[\d]{2}$/',
            'city' => 'required|string|min:3|max:20',
            'note' => 'nullable|string|min:10|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'Введите пожалуйста ваше полное имя!',
            'email.required' => 'Введите пожалуйста ваш E-Mail!',
            'phone.required' => 'Введите пожалуйста ваш номер телефона!',
            'city.required' => 'Введите пожалуйста ваш город!',

            'full_name.min' => 'Ваше полное имя должно содержать больше 10 символов!',
            'full_name.max' => 'Ваше полное имя не должно содержать больше 100 символов!',
            'email.email' => 'Не верный формат E-Mail!',
            'phone.regex' => 'Не верный формат номера телефона!',
            'city.min' => 'Ваш город должен содержать больше 3 символов!',
            'city.max' => 'Ваш город не должен содержать больше 20 символов!',
            'note.min' => 'Ваше примечание должно содержать больше 10 символов!',
            'note.max' => 'Ваше примечание не должно содержать больше 1000 символов!',
        ];
    }
}
