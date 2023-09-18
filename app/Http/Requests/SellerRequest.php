<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {


        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:sellers,email',
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'O e-mail fornecido já foi registrado.',
        ];
    }
}
