<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserEditRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:1|max:60',
            'surname' => 'nullable|min:1|max:100',
            'current_password' => 'nullable',
            'new_password' => ['nullable', Password::defaults()],
        ];
    }

    public function messages()
    {
        return [
            'name' => __('validation.between.string'),
            'surname' => __('validation.between.string'),
            'new_password' => __('auth.password'),
        ];
    }
}
