<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class NewPasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules() : array
    {
        return [
            'current_password' => 'required|current_password:web',
            'new_password' => ['required', Password::defaults()],
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'current_password' => __('auth.old_password_required'),
    //         'new_password' => __('auth.new_password_required')
    //     ];
    // }
}
