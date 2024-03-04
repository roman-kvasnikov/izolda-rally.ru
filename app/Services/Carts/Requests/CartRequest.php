<?php

namespace App\Services\Carts\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
			'merch_id'	=> 'required|exists:merches,id',
			'quantity'	=> 'integer|min:1',
			'total'		=> 'boolean'
		];
	}
}
