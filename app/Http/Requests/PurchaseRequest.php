<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules() : array
    {
        return [
            'name' => 'required',
            'surname' => 'required',
            'phone' => 'required',
            'email' => 'email|required',
            'supplier' => 'required|accepted'
        ];
    }

    public function messages()
    {
        return [
            'supplier' => 'You must agree to the site rules.'
        ];
    }
}
