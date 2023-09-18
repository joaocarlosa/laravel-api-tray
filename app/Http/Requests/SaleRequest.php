<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'seller_id' => $this->isMethod('post') ? 'required|exists:sellers,id' : 'sometimes|exists:sellers,id',
            'value' => 'required|numeric',
            'sale_date' => $this->isMethod('post') ? 'required|date' : 'sometimes|date',
        ];
    }

}
